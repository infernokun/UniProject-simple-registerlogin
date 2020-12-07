<?php

require("database.php");

function enrollStudent($studentID, $courseID) {
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
