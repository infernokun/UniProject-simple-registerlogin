<?php
if (!isset($_SESSION["session_email"])) {
    if (!isset($_SESSION["session_email"])) {
        $loggedIn = false;
    } else {
        $loggedIn = true;
    }
} else {
    $loggedIn = true;
}
if (isset($_SESSION['user_type'])) {
    $type = $_SESSION['user_type'];
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="../css/blog.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <header class="blog-header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4 text-center">
                        <a href="../"><img class="header_img" style="margin-left: 330px;" src="../images/standard.png" width="125%" height="125%"></a>
                    </div>
                </div>
            </header>

            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">

                    <!-- Home Button -->
                    <a class="p-2 text-muted" id="homepageNav" <?php
                    global $page;
                    if ($page != "homepage") {
                        echo "href=\"../\"";
                    }
                    ?>>Home</a>

                    <!-- Register Button -->
                    <?php if ($loggedIn != true) : ?>
                        <a class="p-2 text-muted" id="registerNav" <?php
                        global $page;
                        if ($page != "register") {
                            echo "href=\"../register/\"";
                        }
                        ?>>Register</a>
                    <?php endif; ?>

                    <!-- Login Button -->
                    <?php if ($loggedIn != true) : ?>
                        <a class="p-2 text-muted" id="loginNav" <?php
                        global $page;
                        if ($page != "login") {
                            echo "href=\"../login/\"";
                        }
                        ?>>Login</a>
                    <?php endif; ?>

                    <!-- Logout Button -->
                    <?php if ($loggedIn == true) : ?>
                        <a class="p-2 text-muted" id="logoutNav" <?php
                           global $page;
                           if ($page != "logout") {
                               echo "href=\"../logout/\"";
                           }
                           ?>>Logout</a>
                    <?php endif; ?>


                    <!-- Personal Info Button -->
                    <?php if ($loggedIn == true && $type != "") : ?>
                    <a class="p-2 text-muted" id="personalNav" <?php
                    global $page;
                    if ($page != "personalInfo") {
                        echo "href=\"../personal/\"";
                    }
                    ?>>Personal Info</a>
                    <?php endif; ?>

                    <!-- Course Info Button -->
                       <?php if ($loggedIn == true && $type == "student") : ?>
                        <a class="p-2 text-muted" id="courseNav" <?php
                       global $page;
                       if ($page != "courseInfo") {
                           echo "href=\"../course/\"";
                       }
                       ?>>Course Info</a>
                           <?php endif; ?>
                    <!--<a class="p-2 text-muted" href="#">Travel</a>-->
                </nav>
            </div>