<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report | Pbay</title>

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

    <body class="bg-body-secondary" data-bs-theme="light">

        <div class="container-fluid">

            <div class="row">
                <?php include "admin-header.php"; ?>
            </div>

            <!-- Product Registration -->

            <div class="container mb-5" id="report">

                <div class="col-12 mt-5">
                    <h2 class="text-center">Report</h2>

                    <div class="row mt-5">
                        <div class="col-4">
                            <a href="adminReportStock.php"><button class="btn btn-outline-secondary col-12">Stock
                                    Report</button></a>
                        </div>
                        <div class="col-4">
                            <a href="adminReportProduct.php"><button class="btn btn-outline-secondary col-12">Product
                                    Report</button></a>
                        </div>
                        <div class="col-4">
                            <a href="adminReportUser.php"><button class="btn btn-outline-secondary col-12">User
                                    Report</button></a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Product Registration -->

        </div>

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