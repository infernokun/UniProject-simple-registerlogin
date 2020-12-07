<?php

session_start();

$action = filter_input(INPUT_POST, 'action');

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
    $type = $_SESSION['user_type'];
} else {
    $loggedIn = false;
    $type = "";
    $action = "notLoggedIn";
}

if ($action == null) {
    $action = "courseInfo";
}

switch ($action) {
    case "courseInfo":
        require("../model/database.php");

        $page = "courseInfo";
        include("../view/course_info.php");
        break;
    case "enroll":
        require("../model/database.php");

        $studentID = filter_input(INPUT_POST, 'studentID');
        $courseID = filter_input(INPUT_POST, 'courseID');

        require("../model/enroll_model.php");

        enrollStudent($studentID, $courseID);

        header("Location: ../course");
        exit();
        break;
    case "search":
        require("../model/database.php");

        $search = filter_input(INPUT_POST, 'search');

        if ($search == "") {
            $_SESSION["error_full"] = "Must select a type to search by!";
        } else {
            $usrInput = filter_input(INPUT_POST, 'usrInput');

            if ($usrInput == "") {
                $_SESSION["error_full"] = "Must enter a value!";
            } else {
                require("../model/enroll_model.php");

                $searchedCourses = searchFor(searchType($search), $usrInput);

                if (empty($searchedCourses)) {
                    $_SESSION["error_full"] = "None found!";
                }
            }
        }
        include("../view/course_info.php");
        if (isset($_SESSION["error_full"])) {
            unset($_SESSION["error_full"]);
        }
        exit();
        break;
    case "notLoggedIn":
        include("../errors/notLoggedIn.php");
        break;
    default:
        $error_message = "Error";
        break;
}