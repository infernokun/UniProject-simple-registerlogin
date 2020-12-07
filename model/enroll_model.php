<?php

require("database.php");

// adds a student to the enrolledCourses database, updates count, and checks if the course is full
function enrollStudent($studentID, $courseID) {
    global $db;
    require('course_model.php');

    $course = get_course($courseID);

    if ($course['enrolled'] == $course['seats']) {
        $_SESSION["error_full"] = "The course " . $course['courseID'] . " is full!";
    } else {
        $query = 'INSERT INTO enrolledCourses
                 (courseID, studentID, grade)
              VALUES
                 (:courseID, :studentID, "")';
        $statement = $db->prepare($query);
        $statement->bindValue(':courseID', $courseID);
        $statement->bindValue(':studentID', $studentID);
        $statement->execute();
        $statement->closeCursor();

        $query2 = 'UPDATE courseInfo SET enrolled = enrolled + 1 WHERE courseID = :courseID';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':courseID', $courseID);
        $statement2->execute();
        $statement2->closeCursor();
        
        $_SESSION["error_full"] = "Enrolled for " . $course['courseID'] ."!";
    }
}

// removes student from the enrolledCourses database and updates count
function dropStudent($studentID, $courseID) {
    global $db;
    $query = 'DELETE FROM enrolledCourses WHERE courseID = :courseID AND studentID = :studentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseID', $courseID);
    $statement->bindValue(':studentID', $studentID);
    $statement->execute();
    $statement->closeCursor();

    $query2 = 'UPDATE courseInfo SET enrolled = enrolled - 1 WHERE courseID = :courseID';
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':courseID', $courseID);
    $statement2->execute();
    $statement2->closeCursor();
}

// determines the search type for the database and returns the type
function searchType($searchVal) {
    switch ($searchVal) {
        case "search_courseID":
            return "courseID";
        case "search_courseName":
            return "courseName";
        case "search_instructorName":
            return "instructorName";
        default:
            return null;
    }
}

// searches the database for the given type and returns the found courses for the user input
function searchFor($searchType, $usrInput) {
    global $db;

    if ($searchType == "courseName" || $searchType == "courseID") {
        $query = "SELECT * FROM courseInfo where " . $searchType . " LIKE :usrInput";
        $statement = $db->prepare($query);
        $statement->bindValue(':usrInput', '%' . $usrInput . '%');
    } else if ($searchType == 'instructorName') {
        // allows you to search by first name or last name
        $query = "SELECT * FROM courseInfo inner join instructor WHERE courseInfo.instructorID = instructor.instructorID " . 
                "AND (firstName like :usrInput " .
                "OR lastName like :usrInput)";
        $statement = $db->prepare($query);
        $statement->bindValue(':usrInput', '%' . $usrInput . '%');
    } else {
        $query = "SELECT * FROM courseInfo where " . $searchType . " = :usrInput";
        $statement = $db->prepare($query);
        $statement->bindValue(':usrInput', $usrInput);
    }
    $statement->execute();
    $searchedCourses = $statement->fetchAll();
    $statement->closeCursor();

    return $searchedCourses;
}
