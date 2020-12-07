<head><title>AUM - Logged In</title>
<?php
include '../view/header.php';

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
}
 ?>

    <style>.header_img {
        width: 425px;
        height: 150px;
        margin-left: 330px;
        }</style></head>
<main>
    <h1>You are logged in!</h1>
    <p>No need to access this page.</p>
</main>
<?php include '../view/footer.php'; ?>
