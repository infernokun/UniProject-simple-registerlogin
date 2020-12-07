<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <head><title>AUM - Student Personal Info Page</title></head>

        <script src="../js/register.js"></script>

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

    $studentID = $_SESSION['session_id'];
    
    $student = get_student($studentID);

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
            <p><?php
    if (isset($_SESSION["error_full"])) {
        echo $_SESSION["error_full"];
    }
    ?></p>
            <h1>Enrolled Courses</h1>
            <table>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Instructor Name</th>
                    <th>Class Room</th>
                    <th>Semester</th>
                    <th>Class Time</th>
                    <th>Seats</th>
                    <th>&nbsp;</th>
                </tr>


<?php
foreach ($enrolled as $e) :
    $instructor = get_instructor($e['instructorID']);
    $i = $instructor;
    ?>
                    <tr>
                        <th><?php echo $e['courseID']; ?></th>
                        <th><?php echo $e['courseName']; ?></th>
                        <th><?php echo $i['firstName'] . ' ' . $i['lastName']; ?></th>
                        <th><?php echo $e['classRoom']; ?></th>
                        <th><?php echo $e['semester']; ?></th>
                        <th><?php echo $e['days'] . ' ' . date('h:i:s a', strtotime($e['startTime'])) . ' - ' . date('h:i:s a', strtotime($e['endTime'])); ?></th>
                        <th><?php echo $e['enrolled'] . " / " . $e['seats']; ?></th>
                        <th>
                            <form action="../personal/index.php" method="post">
                                <input type="hidden" name="action" value="drop">
                                <input type="hidden" name="studentID" value="<?php echo $_SESSION['session_id'] ?>">
                                <input type="hidden" name="courseID" value="<?php echo $e['courseID'] ?>">
                                <input type="submit" value="Withdraw">
                            </form>
                        </th>
                    </tr>
<?php endforeach; ?>
            </table><br>
            
            <h1>Profile</h1>
            
            <p class="error_message"><?php echo $error_message_firstName; ?></p>
            <p class="error_message"><?php echo $error_message_lastName; ?></p>
            <p class="error_message"><?php echo $error_message_email; ?></p>
            <p class="error_message"><?php echo $error_message_gender; ?></p>
            <p class="error_message"><?php echo $error_message_password; ?></p>
            <p class="error_message"><?php echo $error_message_passwordNew; ?></p>
            <p class="error_message"><?php echo $error_message_birthday; ?></p>
            <p class="error_message"><?php echo $success; ?></p>
            
            <form method="post" action="../personal/index.php">
                <input type="hidden" name="action" value="change">
                <input type="hidden" name="profileType" value="student">

                <label>First Name</label>
                <input type="text" name="firstName" value="<?php echo $student['firstName']; ?>"><br>
                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php echo $student['lastName']; ?>"><br>
                <label>Birthday</label>
                <input type="date" name="birthday" value="<?php echo $student['birthday']; ?>"><br>
                <label>Gender</label>
                <select name="gender">
                        <option value="">Gender</option>
                        <option value="Male" 
                                <?php if ($student['gender'] == "Male") { echo "selected"; } ?>>Male</option>
                        <option value="Female"  
                                <?php if ($student['gender'] == "Female") { echo "selected"; } ?>>Female</option>
                        <option value="Other"  
                                <?php if ($student['gender'] == "Other") { echo "selected"; } ?>>Other</option>
                </select><br>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>"><br>
                <label>Current Password</label>
                <input type="password" name="cPassword"><br>
                <label>New Password</label>
                <input type="password" name="nPassword"><br>
                <input type="submit" value="Submit Changes"><br>
            </form>
        </main>
    </body>
<?php include('../view/footer.php'); ?>
</html>