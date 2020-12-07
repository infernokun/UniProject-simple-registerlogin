<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AUM - Success Login</title>
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

            <div class="text-center mb-4">
                <img style="margin-top: 0px;" class="mb-4" src="../images/university__auburn-university-at-montgomery--logo.png" alt="" width="30%" height="30%">
                <h1 class="h3 mb-3 font-weight-normal">Login Successful for <?php echo $email ?> as <?php echo $type ?></h1>
            </div>


        </main>
    </body>
    <?php include('../view/footer.php'); ?>
</html>