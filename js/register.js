function checkInstructor() {
    var codeBox = document.getElementById("isInstructor");
    var instructorBox = document.getElementById("instructorCodeDiv");
    
    if (codeBox.checked) {
        instructorBox.style.visibility = 'visible';
    } else {
        instructorBox.style.visibility = 'hidden';
    }
}