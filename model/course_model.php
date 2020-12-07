<?php

require('database.php');

// gets a course by the given ID
function get_course($courseID) {
    
    global $db;
    $query = 'SELECT * FROM courseInfo WHERE courseID = :courseID';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseID', $courseID);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    
    return $course;
}

// gets courses and cross checks them with the enrolled courses to remove them from available courses
function get_courses($enrolled) {
    
    global $db;
    $query = 'SELECT * FROM courseInfo';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();
    
    $available = array();
    
    foreach ($courses as $c) {
        $found = false;
        foreach ($enrolled as $e) {
            if ($c['courseID'] == $e['courseID']) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $available[] = $c;
        }
    }

    return $available;
}

// given the enrolled courses and the searched courses, cross check and remove from available courses
function get_courses_searched($enrolled, $searchedCourses) {
    $available = array();
    
    foreach ($searchedCourses as $c) {
        $found = false;
        foreach ($enrolled as $e) {
            if ($c['courseID'] == $e['courseID']) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $available[] = $c;
        }
    }

    return $available;
}

// returns the enrolled courses for a student
function get_enrolledCourses($studentID) {
    $foundCourses = array();

    global $db;
    $query = 'SELECT * FROM enrolledCourses where studentID = :studentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':studentID', $studentID);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($courses as $c) {
        $query = 'SELECT * FROM courseInfo where courseID = :courseID';
        $statement = $db->prepare($query);
        $statement->bindValue(':courseID', $c['courseID']);
        $statement->execute();
        $course = $statement->fetchAll();
        $statement->closeCursor();

        $foundCourses[] = $course[0];
    }
    return $foundCourses;
}

function getInstructorCourses($instructorID) {
    global $db;
    $query = 'SELECT * FROM courseInfo WHERE instructorID = :instructorID';
    $statement = $db->prepare($query);
    $statement->bindValue(':instructorID', $instructorID);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();
    
    return $courses;
}

function getClassRoster($courseID) {
    global $db;
    $query = 'SELECT student.studentID, firstName, lastName, grade, courseID from enrolledCourses inner join student WHERE '
            . 'enrolledCourses.studentID = student.studentID AND enrolledCourses.courseID = :courseID';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseID', $courseID);
    $statement->execute();
    $roster = $statement->fetchAll();
    $statement->closeCursor();
    
    return $roster;
}
