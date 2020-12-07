<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <head><title>AUM - Instructor Personal Info Page</title></head>

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

    $instructorID = $_SESSION['session_id'];

    $instructor = get_instructor($instructorID);

    $courses = getInstructorCourses($instructorID);
    ?>
    <body>
        <main>
            <h1>My Courses</h1>
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
                foreach ($courses as $c) :
                    ?>
                    <tr>
                        <th><?php echo $c['courseID']; ?></th>
                        <th><?php echo $c['courseName']; ?></th>
                        <th><?php echo $instructor['firstName'] . " " . $instructor['lastName']; ?></th>
                        <th><?php echo $c['classRoom']; ?></th>
                        <th><?php echo $c['semester']; ?></th>
                        <th><?php echo $c['days'] . ' ' . date('h:i:s a', strtotime($c['startTime'])) . ' - ' . date('h:i:s a', strtotime($c['endTime'])); ?></th>
                        <th><?php echo $c['enrolled'] . " / " . $c['seats']; ?></th>
                        <th>
                            <form action="../personal/index.php" method="post">
                                <input type="hidden" name="action" value="show">
                                <input type="hidden" name="courseID" value="<?php echo $c['courseID']; ?>">
                                <input type="submit" value="Show Roster">
                            </form>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </table><br>

            <?php if ($action == "show") : ?>
                <h2><?php echo $courseID ?></h2>

                <table>

                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Letter Grade</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>

                    <?php $roster = getClassRoster($courseID);

                    foreach ($roster as $r) :
                        ?>
                        <tr>
                            <th><?php echo $r['studentID']; ?></th>
                            <th><?php echo $r['firstName'] . " " . $r['lastName']; ?></th>
                            <th><?php echo $r['grade']; ?></th>
                        <form method="post" action="../personal/index.php">
                            <input type="hidden" name="action" value="changeGrade">
                            <input type="hidden" name="studentID" value="<?php echo $r['studentID']; ?>">
                            <input type="hidden" name="courseID" value="<?php echo $r['courseID']; ?>">
                            <th>
                                <select name="gradeSelect">
                                    <option value=""></option>
                                    <option value="A" <?php if ($r['grade'] == "A") {echo "selected";} ?>>A</option>
                                    <option value="B" <?php if ($r['grade'] == "B") {echo "selected";} ?>>B</option>
                                    <option value="C" <?php if ($r['grade'] == "C") {echo "selected";} ?>>C</option>
                                    <option value="D" <?php if ($r['grade'] == "D") {echo "selected";} ?>>D</option>
                                    <option value="F" <?php if ($r['grade'] == "F") {echo "selected";} ?>>F</option>
                                </select>
                            </th>
                            <th><input type="submit" value="Change Grade"></th>
                        </form>
                        </tr>
                            <?php endforeach; endif;?>
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
                <input type="hidden" name="profileType" value="instructor">

                <label>First Name</label>
                <input type="text" name="firstName" value="<?php echo $instructor['firstName']; ?>"><br>
                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php echo $instructor['lastName']; ?>"><br>
                <label>Gender</label>
                <select name="gender">
                    <option value="">Gender</option>
                    <option value="Male" <?php if ($instructor['gender'] == "Male") { echo "selected"; } ?>>Male</option>
                    <option value="Female" <?php if ($instructor['gender'] == "Female") { echo "selected"; } ?>>Female</option>
                    <option value="Other" <?php if ($instructor['gender'] == "Other") { echo "selected"; } ?>>Other</option>
                </select><br>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $instructor['email']; ?>"><br>
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