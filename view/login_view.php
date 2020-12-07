<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <head><title>AUM - Login Page</title></head>

        <script src="../js/register.js"></script>

        <!-- Custom styles for this template -->
        <link href="../css/floating-labels.css" rel="stylesheet">
    </head>
    <?php
    include('../view/header.php');
    
    if (isset($_SESSION['session_email'])) {
        $loggedIn = true;
        $type = $_SESSION['user_type'];
    } else {
        $loggedIn = false;
        $type = "";
    }
    ?>
    <body>
        <main>
            <form class="form-signin" method="post" action="../model/login_model.php">
                <div class="text-center mb-4">
                    <img style="margin-top: 0px;" class="mb-4" src="../images/university__auburn-university-at-montgomery--logo.png" alt="" width="30%" height="30%">
                    <h1 class="h3 mb-3 font-weight-normal">Login</h1>
                    <input type="hidden" name="action" value="login">
                    <p class="error_message"><?php echo $error_message_email; ?></p>
                    <p class="error_message"><?php echo $error_message_password; ?></p>
                </div>

                <div class="form-label-group">
                    <input type="email" name="email" class="form-control" placeholder="Email address">
                    <label>Email Address</label>
                    
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <label>Password</label>
                    
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
        </main>
    </body>
<?php include('../view/footer.php'); ?>
</html>