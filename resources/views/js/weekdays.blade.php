<script type="text/javascript" defer>

    @foreach ($weekdays as $weekday => $weekdag)

    function {{ $weekday }}Check() {
        var checkbox = document.getElementById("check{{ $weekday }}");

        if (checkbox.checked) {
            document.getElementById("timeSelection{{ $weekday }}").classList.remove('d-none');
            document.getElementById("startHour{{ $weekday }}").disabled = false;
            document.getElementById("startMinute{{ $weekday }}").disabled = false;
            document.getElementById("endHour{{ $weekday }}").disabled = false;
            document.getElementById("endMinute{{ $weekday }}").disabled = false;
        } else {
            document.getElementById("timeSelection{{ $weekday }}").classList.add('d-none');
            document.getElementById("startHour{{ $weekday }}").disabled = true;
            document.getElementById("startMinute{{ $weekday }}").disabled = true;
            document.getElementById("endHour{{ $weekday }}").disabled = true;
            document.getElementById("endMinute{{ $weekday }}").disabled = true;
        }
    }

    function {{ $weekday }}TimeCheck() {
        var {{ $weekday }}HourFromInput = document.getElementById("startHour{{ $weekday }}");
        var {{ $weekday }}HourFrom = {{ $weekday }}HourFromInput.value;
        if ({{ $weekday }}HourFrom.length == 1) {
            {{ $weekday }}HourFrom = "0" + {{ $weekday }}HourFrom;
        }
        var {{ $weekday }}MinuteFromInput = document.getElementById("startMinute{{ $weekday }}");
        var {{ $weekday }}MinuteFrom = {{ $weekday }}MinuteFromInput.value;
        if ({{ $weekday }}MinuteFrom.length == 1) {
            {{ $weekday }}MinuteFrom = "0" + {{ $weekday }}MinuteFrom;
        }
        var {{ $weekday }}TimeFrom = new Date('1970-01-01T' + {{ $weekday }}HourFrom + ":" + {{ $weekday }}MinuteFrom);

        var {{ $weekday }}HourToInput = document.getElementById("endHour{{ $weekday }}");
        var {{ $weekday }}HourTo = {{ $weekday }}HourToInput.value;
        if ({{ $weekday }}HourTo.length == 1) {
            {{ $weekday }}HourTo = "0" + {{ $weekday }}HourTo;
        }
        var {{ $weekday }}MinuteToInput = document.getElementById("endMinute{{ $weekday }}");
        var {{ $weekday }}MinuteTo = {{ $weekday }}MinuteToInput.value;
        if ({{ $weekday }}MinuteTo.length == 1) {
            {{ $weekday }}MinuteTo = "0" + {{ $weekday }}MinuteTo;
        }
        var {{ $weekday }}TimeTo = new Date('1970-01-01T' + {{ $weekday }}HourTo + ":" + {{ $weekday }}MinuteTo);

        if ({{ $weekday }}TimeFrom > {{ $weekday }}TimeTo) {
            {{ $weekday }}HourToInput.value = {{ $weekday }}HourFromInput.value;
            {{ $weekday }}MinuteToInput.value = {{ $weekday }}MinuteFromInput.value;
        }
    }

    @endforeach

    
    
</script>