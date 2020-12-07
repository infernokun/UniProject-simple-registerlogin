<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <head><title>AUM - Register Page</title></head>

        <script src="../js/register.js"></script>

        <!-- Custom styles for this template -->
        <link href="../css/floating-labels.css" rel="stylesheet">
    </head>
    <?php
    if (isset($_SESSION['session_email'])) {
        $loggedIn = true;
        $type = $_SESSION['user_type'];
    } else {
        $loggedIn = false;
        $type = "";
    }
    
    include('../view/header.php');
    ?>
    <body>
        <main>
            <form class="form-signin" method="post" action="../model/register_model.php">
                <div class="text-center mb-4">
                    <img style="margin-top: 0px;" class="mb-4" src="../images/university__auburn-university-at-montgomery--logo.png" alt="" width="30%" height="30%">
                    <h1 class="h3 mb-3 font-weight-normal">Register Account</h1>
                    <p class="error_message"><?php echo $error_message_gender; ?></p>
                    <p class="error_message"><?php echo $error_message_firstName; ?></p>
                    <p class="error_message"><?php echo $error_message_lastName; ?></p>
                    <p class="error_message"><?php echo $error_message_email; ?></p>
                    <p class="error_message"><?php echo $error_message_gender; ?></p>
                    <p class="error_message"><?php echo $error_message_password; ?></p>
                    <p class="error_message"><?php echo $error_message_passwordConfirm; ?></p>
                    <p class="error_message"><?php echo $error_message_instructorCode; ?></p>
                </div>
                

                <div class="form-label-group">
                    <input type="text" name="firstName" class="form-control" placeholder="First Name" autofocus>
                    <label>First Name</label>
                    
                </div>

                <div class="form-label-group">
                    <input type="text" name="lastName" class="form-control" placeholder="Last Name">
                    <label>Last Name</label>
                    
                </div>

                <div class="form-label-group">
                    
                    <select class="form-control" name="gender">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    
                </div>

                <div class="form-label-group">
                    <input type="email" name="email" class="form-control" placeholder="Email address">
                    <label>Email Address</label>
                    
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <label>Password</label>
                    
                </div>

                <div class="form-label-group">
                    <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirm Password">
                    <label>Confirm Password</label>
                    
                </div>

                <div id="instructorCodeDiv" class="form-label-group" style="visibility: hidden">
                    <input type="password" name="instructorCode" class="form-control" placeholder="Instructor Code">
                    <label>Instructor Code</label>
                    
                </div>

                <div>
                    <label>Register as Instructor?</label>
                    <input style="transform: scale(2); margin-left: 10px;" type="checkbox" id="isInstructor" name="isInstructor" onClick="checkInstructor()">
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            </form>
        </main>
    </body>
<?php include('../view/footer.php'); ?>
</html>