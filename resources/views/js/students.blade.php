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
    var selectedIndex = studentList.selectedIndex;

    if (selectedIndex >= 0) {
        studentList.remove(selectedIndex);

        // Select the option below the removed one, or the new last option if it was the last one
        if (selectedIndex < studentList.options.length) {
            studentList.selectedIndex = selectedIndex;
        } else if (studentList.options.length > 0) {
            studentList.selectedIndex = studentList.options.length - 1;
        }
    }
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
            studentList.add(option, studentList.options[selectedIndex + 1]);
            studentList.selectedIndex = selectedIndex + 1;
        }
    }

    function selectAllStudents() {
        var studentList = document.getElementById("studentList");
        for (var i = 0; i < studentList.length; i++) {
            studentList.options[i].selected = true;
        }
    }

    function randomizeStudentList() {
        var studentList = document.getElementById("studentList");
        var students = [];
        for (var i = 0; i < studentList.options.length; i++) {
            students.push(studentList.options[i].text);
        }

        // Fisher-Yates shuffle algorithm
        for (var i = students.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = students[i];
            students[i] = students[j];
            students[j] = temp;
        }

        // Clear the list and add the shuffled students
        studentList.innerHTML = "";
        students.forEach(function(student) {
            var option = document.createElement("option");
            option.text = student;
            studentList.add(option);
        });
    }
</script>
