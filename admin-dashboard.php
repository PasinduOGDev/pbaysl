<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Pbay</title>

    <!-- CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<?php

session_start();

if (isset($_SESSION["a"])) {

    ?>

    <body class="bg-body-secondary" data-bs-theme="light" onload="loadUser();">

            

        <!-- js -->
        <script src="script.js"></script>
        <!-- js -->

        <!-- js sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- js sweetalert -->
    </body>

    <?php

} else {

    header("Location: login.php");

}

?>

</html>