<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AUM - Success Register</title>

        <script src="../js/register.js"></script>

        <!-- Custom styles for this template -->
        <link href="../css/floating-labels.css" rel="stylesheet">
    </head>
    <?php
    $loggedIn = false;

    include('../view/header.php');
    ?>
    <body>
        <main>

            <div class="text-center mb-4">
                <img style="margin-top: 0px;" class="mb-4" src="../images/university__auburn-university-at-montgomery--logo.png" alt="" width="30%" height="30%">
                <h1 class="h3 mb-3 font-weight-normal">Register Successful for <?php echo $email ?> as <?php echo $type ?>.</h1>
                <h2 class="h3 mb-3 font-weight-normal">Proceed to login!</h2>
            </div>


        </main>
    </body>
    <?php include('../view/footer.php'); ?>
</html>