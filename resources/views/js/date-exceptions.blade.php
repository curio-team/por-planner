<script type="text/javascript" defer>

    function addDateExceptionToList() {
        var dateExceptionFromInput = document.getElementById("dateExceptionFrom");
        var dateExceptionFrom = dateExceptionFromInput.value;
        var dateExceptionToInput = document.getElementById("dateExceptionTo");
        var dateExceptionTo = dateExceptionToInput.value;
        var dateExceptionList = document.getElementById("dateExceptionList");
        var option = document.createElement("option");
        var dateExceptionFromFormatted = dateExceptionFrom.substring(8, 10) + "-" + dateExceptionFrom.substring(5, 7) + "-" + dateExceptionFrom.substring(0, 4);
        var dateExceptionToFormatted = dateExceptionTo.substring(8, 10) + "-" + dateExceptionTo.substring(5, 7) + "-" + dateExceptionTo.substring(0, 4);
        if (dateExceptionFromFormatted == dateExceptionToFormatted) {
            option.text = dateExceptionFromFormatted;
        } else {
            option.text = dateExceptionFromFormatted + " - " + dateExceptionToFormatted;
        }
        dateExceptionList.add(option);
        dateExceptionFromInput.value = "";
        dateExceptionToInput.value = "";
    }

    function copyDateFromTo() {
        var dateExceptionToInput = document.getElementById("dateExceptionTo");
        if (dateExceptionToInput.value == "") {
            var dateExceptionFromInput = document.getElementById("dateExceptionFrom");
            dateExceptionToInput.value = dateExceptionFromInput.value;
        }
        checkDateExceptionTo();
    }

    function checkDateExceptionTo() {
        var dateExceptionFromInput = document.getElementById("dateExceptionFrom");
        var dateExceptionFrom = dateExceptionFromInput.value;
        var dateExceptionToInput = document.getElementById("dateExceptionTo");
        var dateExceptionTo = dateExceptionToInput.value;
        // check if dateExceptionTo is a later date than dateExceptionFrom
        if (dateExceptionTo < dateExceptionFrom) {
            dateExceptionToInput.value = dateExceptionFrom;
        }
    }

    function removeDateExceptionFromList() {
        var dateExceptionList = document.getElementById("dateExceptionList");
        dateExceptionList.remove(dateExceptionList.selectedIndex);
    }

    function selectAllExceptionDates() {
        var dateExceptionList = document.getElementById("dateExceptionList");
        for (var i = 0; i < dateExceptionList.options.length; i++) {
            dateExceptionList.options[i].selected = true;
        }
    }

</script>