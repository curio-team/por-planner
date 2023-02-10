<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class PlannerController extends Controller
{
    // Define weekdays so that they are constant throughout the application, and easily intercangable between dutch and english.
    const WEEKDAYS = [
        'Monday' => 'Maandag',
        'Tuesday' => 'Dinsdag',
        'Wednesday' => 'Woensdag',
        'Thursday' => 'Donderdag',
        'Friday' => 'Vrijdag'
    ];

    // Show the main screen
    public function index(Request $request){
        if ($request->session()->get('formData')){
            $formData = $request->session()->get('formData');
        } else {
            $formData = $request->all();
        }

        return view('home', [
            'weekdays' => self::WEEKDAYS,
            'formData' => $formData,
        ]);
    }

    // Process the main screen form
    public function processPlanner(Request $request) {
        $validationErrors = [];
        // Check if startDate filled in
        if(!$request->startDate){
            $validationErrors[] = 'Er is geen startdatum ingevuld.';
        }

        // Gather the selected weekdays, and construct an array with their corresponding start and end times
        $selectedWeekdays = [];
        foreach(self::WEEKDAYS as $weekday => $weekdag){
            if($request->has($weekday)){
                $selectedWeekdays[$weekday] = [
                    'startHour' => $request['startHour'.$weekday],
                    'startMinute' => $request['startMinute'.$weekday],
                    'endHour' => $request['endHour'.$weekday],
                    'endMinute' => $request['endMinute'.$weekday],
                ];
            }
        }
        // then check if any weekday was selected at all
        if(!$selectedWeekdays){
            $validationErrors[] = 'Er is geen weekdag geselecteerd.';
        }

        // Check if studentList filled in
        if(!$request->studentList){
            $validationErrors[] = 'Er is geen studentenlijst ingevuld.';
        }

        if($validationErrors){
            Session::flash('alert-danger', $validationErrors);
            return redirect()->back()->with('formData', $request->all());
        }

        // Construct dates that are excepted for the selected weekdays
        $dateExceptions = [];
        if($request->dateExceptionList){
            foreach ($request->dateExceptionList as $dateException) {
                // if there are two dates, split by -
                if (strpos($dateException, ' - ') !== false) {
                    $dates = explode(' - ', $dateException);
                    $startDate = Carbon::createFromFormat('d-m-Y', $dates[0]);
                    $endDate = Carbon::createFromFormat('d-m-Y', $dates[1]);
                } else {
                    $startDate = $endDate = Carbon::createFromFormat('d-m-Y', $dateException);
                }
                $dateExceptions[] = [
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                ];
            }
        } else {
            $dateExceptions = null;
        }

        // Construct the first date to plan
        $currentDate = $this->nextSelectedWeekday(Carbon::createFromFormat('Y-m-d',  $request->startDate), $selectedWeekdays, $dateExceptions);
        $currentDate = $currentDate->hour($selectedWeekdays[$currentDate->format('l')]['startHour'])->minute($selectedWeekdays[$currentDate->format('l')]['startMinute']);

        // Loop through all entered students, and assign a timeslot to each
        $planner = [];
        Carbon::setLocale('nl');
        foreach($request->studentList as $student){
            $planner[] = [
                self::WEEKDAYS[$currentDate->format('l')] .' '. $currentDate->format('d-m-Y'),
                $currentDate->format('H:i'),
                utf8_decode($student),
            ];
            $currentDate = $this->nextTimeSlot($currentDate, $request->interval, $selectedWeekdays, $dateExceptions);
        }

        $this->downloadCSV($planner);
    }

    private function nextTimeSlot($currentDate, $interval, $selectedWeekdays, $dateExceptions){
        // go to the next time slot
        $currentDate->addMinutes($interval);

        // check if the current date does not exceed the end of the timeslot
        $currentDateEndTime = $currentDate->copy();
        $currentDateEndTime = $currentDateEndTime->hour($selectedWeekdays[$currentDateEndTime->format('l')]['endHour'])->minute($selectedWeekdays[$currentDateEndTime->format('l')]['endMinute']);
        if ($currentDate >= $currentDateEndTime) {
            // If the timeslot is over, go to the next weekday
            $currentDate = $this->nextSelectedWeekday($currentDate->addDays(1), $selectedWeekdays, $dateExceptions);
        }

        return $currentDate;
    }

    private function nextSelectedWeekday($currentDate, $selectedWeekdays, $dateExceptions){
        // Check if the day of currentDate is in the selectedWeekdays
        if(!array_key_exists($currentDate->format('l'), $selectedWeekdays)){
            // If not, find the next selected weekday
            $currentDate = $this->nextSelectedWeekday($currentDate->addDays(1), $selectedWeekdays, $dateExceptions);
        } elseif($dateExceptions) {
            // If yes, check if the currentDate is in the dateExceptions
            foreach($dateExceptions as $dateException){
                if($currentDate->startOfDay()->between($dateException['startDate']->startOfDay(), $dateException['endDate']->startOfDay())){
                    // If yes, find the next selected weekday
                    $currentDate = $this->nextSelectedWeekday($currentDate->addDays(1), $selectedWeekdays, $dateExceptions);
                }
            }
        }

        return $currentDate
            ->hour($selectedWeekdays[$currentDate->format('l')]['startHour'])
            ->minute($selectedWeekdays[$currentDate->format('l')]['startMinute']);
    }

    private function downloadCSV($planner){
        // Define the CSV header
        header('Content-Type: text/csv; charset=utf8;');
        header('Content-Disposition: attachment; filename=por-planning-'. Carbon::now()->format('d-m-Y') .'.csv');

        // Create the CSV file and write the header
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Datum','Tijd','Student'], ';');

        // Loop through all the planned dates, and put them in the CSV file
        foreach ($planner as $row) {
            // check if currentDate is set, if not, set it to the first date
            if(!isset($currentDate)){
                $currentDate = $row[0];
            } elseif($row[0] != $currentDate){
                $currentDate = $row[0];
                // If the date changes, add a blank line.
                fputcsv($output, ['', '', ''], ';');
            }
            fputcsv($output, $row, ';');
        }
    }
}
