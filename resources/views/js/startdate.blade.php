<script type="text/javascript" defer>
    window.onload = function () { 
        startDate = document.getElementById('startDate');
        // if startdate is not defined, set the date
        if (startDate.valueAsDate == null) {
            startDate.valueAsDate = new Date();
        }
    }
</script>