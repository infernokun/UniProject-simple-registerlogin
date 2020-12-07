<?php
if (!isset($_SESSION["session_email"])) {
    $loggedIn = false;
    
    header("Location: ../errors/notLoggedIn.php");
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <head><title>AUM - Course Info Page</title></head>

        <script src="../js/course_info.js"></script>

        <style>
            table, th {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>

        <!-- Custom styles for this template -->
        <link href="../css/floating-labels.css" rel="stylesheet">
    </head>
    <?php
    include('../view/header.php');
    require("../model/course_model.php");
    require("../model/student_model.php");

    $studentID = $_SESSION['session_id'];

    // gets all courses student is enrolled for
    $enrolled = get_enrolledCourses($studentID);
    
    // if the search comes up empty then get courses as usal
    if (!empty($searchedCourses)) {
        $courses = get_courses_searched($enrolled, $searchedCourses);
    } else {
        $courses = get_courses($enrolled);
    }
    ?>
    <body>
        <main>
            <p class="error_message"><?php
    if (isset($_SESSION["error_full"])) {
        echo $_SESSION["error_full"];
    }
    ?></p>
            <h4><label>Search by: </label></h4>
            <form action="../course/index.php" method="post">
                <input name="usrInput" type="text">
                <input type="hidden" name="action" value="search">
                <select name="search">
                    <option value="">Select</option>
                    <option value="search_courseID">Course ID</option>
                    <option value="search_courseName">Course Name</option>
                    <option value="search_instructorName">Instructor Name</option>
                </select>
                <input type="submit">
            </form> <button style="margin-left: 360px;" onClick="resetTable()">Reset</button>
            <h1>Available Courses</h1>
            <table>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Instructor Name</th>
                    <th>Class Room</th>
                    <th>Semester</th>
                    <th>Class Time</th>
                    <th>Seats</th>
                    <th>Enroll</th>
                </tr>
<?php
foreach ($courses as $c) :
    $instructor = get_instructor($c['instructorID']);
    $i = $instructor;
    ?>
                    <tr>
                        <th><?php echo $c['courseID']; ?></th>
                        <th><?php echo $c['courseName']; ?></th>
                        <th><?php echo $i['firstName'] . ' ' . $i['lastName']; ?></th>
                        <th><?php echo $c['classRoom']; ?></th>
                        <th><?php echo $c['semester']; ?></th>
                        <th><?php echo $c['days'] . ' ' . date('h:i:s a', strtotime($c['startTime'])) . ' - ' . date('h:i:s a', strtotime($c['endTime'])); ?></th>
                        <th><?php echo $c['enrolled'] . " / " . $c['seats']; ?></th>
                        <th>
                            <form action="../course/index.php" method="post">
                                <input type="hidden" name="action" value="enroll">
                                <input type="hidden" name="courseID" value="<?php echo $c['courseID'] ?>">
                                <input type="hidden" name="studentID" value="<?php echo $_SESSION['session_id'] ?>">
                                <input type="submit" value="Enroll">
                            </form>
                        </th>
                    </tr>
<?php endforeach; ?>
            </table>
        </main>
    </body>
<?php include('../view/footer.php'); ?>
</html>