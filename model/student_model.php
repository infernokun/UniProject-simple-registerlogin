<?php

require('database.php');

// returns all students
function get_students() {
    global $db;
    $query = 'SELECT * FROM student';
    $statement = $db->prepare($query);
    $statement->execute();
    $students = $statement->fetchAll();
    $statement->closeCursor();
    
    return $students;
}

function get_student($id) {
    global $db;
    $query = 'SELECT * FROM student where studentID = :studentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':studentID', $id);
    $statement->execute();
    $student = $statement->fetch();
    $statement->closeCursor();
    
    return $student;
}


// returns all instructors
function get_instructors() {
    global $db;
    $query = 'SELECT * FROM instructor';
    $statement = $db->prepare($query);
    $statement->execute();
    $instructors = $statement->fetchAll();
    $statement->closeCursor();
    return $instructors;
}

// returns instructor given an ID for them
function get_instructor($id) {
    global $db;
    $query = 'SELECT * FROM instructor where instructorID = :instructorID';
    $statement = $db->prepare($query);
    $statement->bindValue(':instructorID', $id);
    $statement->execute();
    $instructor = $statement->fetch();
    $statement->closeCursor();
    
    return $instructor;
}

// preforms an inner join on the instructor and courseInfo tables to show instructor info for the course
function instructorInnerJoin() {
    global $db;
    $query = "select firstName, lastName from courseInfo inner join"
                . " instructor where courseInfo.instructorID = instructor.instructorID";
    $statement = $db->prepare($query);
    $statement->execute();
    $instructors = $statement->fetchAll();
    $statement->closeCursor();
    return $instructors;
}