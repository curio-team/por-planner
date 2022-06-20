@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('processPlanner') }}" method="post">
                    @csrf
                    <!-- Startdatum -->
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="startDate" class="form-label">Startdatum:</label>
                            <div class="ms-3">    
                                <input type="date" class="form-control" id="startDate" name="startDate" value="{{ array_key_exists('startDate', $formData) ? $formData['startDate'] : '' }}">
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>

                    <!-- Dagen van de Week -->
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="weekDays" class="form-label">Dagen van de week:</label>
                            <div class="ms-3">
                                @foreach ($weekdays as $weekday => $weekdag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="check{{ $weekday }}" name="{{ $weekday }}" onclick="{{ $weekday }}Check()" {{ array_key_exists($weekday, $formData) ? 'checked="checked"' : '' }}>
                                    <label class="form-check-label" for="check{{ $weekday }}">
                                    {{ $weekdag }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col">
                            @foreach ($weekdays as $weekday => $weekdag)
                            <div class="row mb-3{{ array_key_exists($weekday, $formData) ? '' : ' d-none' }}" id="timeSelection{{ $weekday }}">
                                <p class="mb-0">{{ $weekdag }}:</p>
                                <div class="ms-3">
                                    <label class="form-label" for="startTime{{ $weekday }}">Starttijd:</label>
                                    <div class="ms-3"> 
                                        <div class="col d-flex justify-between">  
                                            <select class="form-select" id="startHour{{ $weekday }}" name="startHour{{ $weekday }}" {{ array_key_exists($weekday, $formData) ? '' : 'disabled' }}- onchange="{{ $weekday }}TimeCheck()">
                                                @php array_key_exists($weekday, $formData) ? $startHour = $formData['startHour'.$weekday] : $startHour = '' @endphp
                                                <option value="8" {{ $startHour == "8" ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ $startHour == "9" ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ $startHour == "10" ? 'selected' : '' }}>10</option>
                                                <option value="11" {{ $startHour == "11" ? 'selected' : '' }}>11</option>
                                                <option value="12" {{ $startHour == "12" ? 'selected' : '' }}>12</option>
                                                <option value="13" {{ $startHour == "13" ? 'selected' : '' }}>13</option>
                                                <option value="14" {{ $startHour == "14" ? 'selected' : '' }}>14</option>
                                                <option value="15" {{ $startHour == "15" ? 'selected' : '' }}>15</option>
                                                <option value="16" {{ $startHour == "16" ? 'selected' : '' }}>16</option>
                                                <option value="17" {{ $startHour == "17" ? 'selected' : '' }}>17</option>
                                            </select>
                                            <span class="mx-3" style="font-size: 3rem; line-height: 2rem;">:</span>
                                            <select class="form-select" id="startMinute{{ $weekday }}" name="startMinute{{ $weekday }}" {{ array_key_exists($weekday, $formData) ? '' : 'disabled' }} onchange="{{ $weekday }}TimeCheck()">
                                                @php array_key_exists($weekday, $formData) ? $startMinute = $formData['startMinute'.$weekday] : $startMinute = '' @endphp
                                                <option value="00" {{ $startMinute == "00" ? 'selected' : '' }}>00</option>
                                                <option value="15" {{ $startMinute == "15" ? 'selected' : '' }}>15</option>
                                                <option value="30" {{ $startMinute == "30" ? 'selected' : '' }}>30</option>
                                                <option value="45" {{ $startMinute == "45" ? 'selected' : '' }}>45</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <label class="form-label" for="endTime{{ $weekday }}">Eindtijd:</label>
                                    <div class="ms-3"> 
                                        <div class="col d-flex justify-between">  
                                            <select class="form-select" id="endHour{{ $weekday }}" name="endHour{{ $weekday }}" {{ array_key_exists($weekday, $formData) ? '' : 'disabled' }} onchange="{{ $weekday }}TimeCheck()">
                                                @php array_key_exists($weekday, $formData) ? $endHour = $formData['endHour'.$weekday] : $endHour = '' @endphp
                                                <option value="8" {{ $endHour == "8" ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ $endHour == "9" ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ $endHour == "10" ? 'selected' : '' }}>10</option>
                                                <option value="11" {{ $endHour == "11" ? 'selected' : '' }}>11</option>
                                                <option value="12" {{ $endHour == "12" ? 'selected' : '' }}>12</option>
                                                <option value="13" {{ $endHour == "13" ? 'selected' : '' }}>13</option>
                                                <option value="14" {{ $endHour == "14" ? 'selected' : '' }}>14</option>
                                                <option value="15" {{ $endHour == "15" ? 'selected' : '' }}>15</option>
                                                <option value="16" {{ $endHour == "16" ? 'selected' : '' }}>16</option>
                                                <option value="17" {{ $endHour == "17" ? 'selected' : '' }}>17</option>
                                            </select>
                                            <span class="mx-3" style="font-size: 3rem; line-height: 2rem;">:</span>
                                            <select class="form-select" id="endMinute{{ $weekday }}" name="endMinute{{ $weekday }}" {{ array_key_exists($weekday, $formData) ? '' : 'disabled' }} onchange="{{ $weekday }}TimeCheck()">
                                                @php array_key_exists($weekday, $formData) ? $endMinute = $formData['endMinute'.$weekday] : $endMinute = '' @endphp
                                                <option value="00" {{ $endMinute == "00" ? 'selected' : '' }}>00</option>
                                                <option value="15" {{ $endMinute == "15" ? 'selected' : '' }}>15</option>
                                                <option value="30" {{ $endMinute == "30" ? 'selected' : '' }}>30</option>
                                                <option value="45" {{ $endMinute == "45" ? 'selected' : '' }}>45</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Lengte gesprekken -->
                    <div class="mb-3 row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="interval" class="form-label">Lengte Gesprekken:</label>
                                <div class="ms-3 col"> 
                                    <div class="d-flex justify-between">  
                                        <select class="form-select" id="interval" name="interval">
                                            @php array_key_exists('interval', $formData) ? $interval = $formData['interval'] : $interval = '' @endphp
                                            <option value="10" {{ $interval == "10" ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ $interval == "15" ? 'selected' : '' }}>15</option>
                                            <option value="20" {{ $interval == "20" ? 'selected' : '' }}>20</option>
                                            <option value="30" {{ $interval == "30" ? 'selected' : '' }}>30</option>
                                            <option value="60" {{ $interval == "60" ? 'selected' : '' }}>60</option>
                                        </select>
                                        <span class="mx-3" style="font-size: 1rem; line-height: 2rem;">minuten</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>

                    <!-- Student namen -->
                    <div class="mb-3 row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="studentName" class="form-label">Student:</label>
                                <div class="ms-3">    
                                    <input type="text" class="form-control" id="studentName">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success" onclick="addStudentToList()">Toevoegen &rarr;</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="studentName" class="form-label">Studentenlijst:</label>
                                <select multiple class="form-control" size="8" id="studentList" name="studentList[]">
                                    @if (array_key_exists('studentList', $formData))
                                        @foreach ($formData['studentList'] as $student)
                                            <option>{{ $student }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-info" onclick="moveStudentUp()">&uarr;</button>
                                <button type="button" class="btn btn-info ms-1" onclick="moveStudentUp()">&darr;</button>
                                <button type="button" class="btn btn-danger ms-1" onclick="removeStudentFromList()">Verwijderen</button>
                            </div>
                        </div>
                    </div>

                    <!-- Datums Uitzonderen -->
                    <div class="mb-3 row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="studentName" class="form-label">Datum uitzonderen van:</label>
                                <div class="ms-3">    
                                    <input type="date" class="form-control" id="dateExceptionFrom" onchange="copyDateFromTo()">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="studentName" class="form-label">Datum uitzonderen tot:</label>
                                <div class="ms-3">    
                                    <input type="date" class="form-control" id="dateExceptionTo" onchange="checkDateExceptionTo()">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success" onclick="addDateExceptionToList()">Toevoegen &rarr;</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="studentName" class="form-label">Uitgezonderde datums:</label>
                                <select multiple class="form-control" size="8" id="dateExceptionList" name="dateExceptionList[]">
                                    @if (array_key_exists('dateExceptionList', $formData))
                                        @foreach ($formData['dateExceptionList'] as $exception)
                                            <option>{{ $exception }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger ms-1" onclick="removeDateExceptionFromList()">Verwijderen</button>
                            </div>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Downloaden" class="btn btn-success ms-1" onclick="selectAllStudents(); selectAllExceptionDates();">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('js.startdate')
@include('js.weekdays')
@include('js.students')
@include('js.date-exceptions')