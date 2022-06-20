<script type="text/javascript" defer>
    function addStudentToList() {

        var studentInput = document.getElementById("studentName");
        var studentInputValue = studentInput.value;

        if (studentInputValue == "") {
            return;
        }
        
        var studentList = document.getElementById("studentList");

        var studentInputValueArray = studentInputValue.split(";");

        if (studentInputValueArray.length > 1) {
            studentInputValueArray.forEach(function(student) {
                if (checkDuplicateStudents(student)) {
                    var option = document.createElement("option");
                    option.text = student;
                    studentList.add(option);
                }
            });
        } else {
            if (checkDuplicateStudents(studentInputValue)) {
                var option = document.createElement("option");
                option.text = studentInputValue;
                studentList.add(option);
            }
        }
        studentInput.value = "";        
    }

    function checkDuplicateStudents(studentName) {
        var studentListOptions = studentList.options;
        for (var i = 0; i < studentListOptions.length; i++) {
            if (studentListOptions[i].text == studentName) {
                return false;
            }
        }
        return true;
    }

    function removeStudentFromList() {
        var studentList = document.getElementById("studentList");
        studentList.remove(studentList.selectedIndex);
    }

    function moveStudentUp() {
        var studentList = document.getElementById("studentList");
        var selectedIndex = studentList.selectedIndex;
        if (selectedIndex > 0) {
            var option = studentList.options[selectedIndex];
            studentList.remove(selectedIndex);
            studentList.add(option, selectedIndex - 1);
            studentList.selectedIndex = selectedIndex - 1;
        }
    }

    function moveStudentDown() {
        var studentList = document.getElementById("studentList");
        var selectedIndex = studentList.selectedIndex;
        if (selectedIndex < studentList.length - 1) {
            var option = studentList.options[selectedIndex];
            studentList.remove(selectedIndex);
            studentList.add(option, selectedIndex + 1);
            studentList.selectedIndex = selectedIndex + 1;
        }
    }

    function selectAllStudents() {
        var studentList = document.getElementById("studentList");
        for (var i = 0; i < studentList.length; i++) {
            studentList.options[i].selected = true;
        }
    }
</script>