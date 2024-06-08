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
include "connection.php";

if (isset($_SESSION["a"])) {

    $rs = Database::search("SELECT * FROM `product`");
    $num = $rs->num_rows;

?>

    <body class="bg-body-secondary" data-bs-theme="light">

        <div class="container-fluid">

            <div class="row">
                <?php
                include "admin-header.php";
                ?>
            </div>

            <div class="container mt-4 printbtn">
            <a href="admin-Report.php"><img src="img/logo/logo.png" style="width: 50px; cursor: pointer;" /></a>

            </div>

            <div class="justify-content-center align-content-center d-flex">
                <div class="container mt-4">
                    <h2 class="text-center ">Stock Report</h2>
                    <table class="table table-hover table-bordered mt-5 text-center">

                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Stock Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            for ($i = 0; $i < $num; $i++) {

                                $d = $rs->fetch_assoc();

                            ?>

                                <tr>
                                    <td><?php echo $d["id"] ?></td>
                                    <td><?php echo $d["title"] ?></td>
                                    <td><?php echo $d["qty"] ?> items</td>
                                    <td>LKR <?php echo $d["price"] ?></td>
                                </tr>

                            <?php

                            }

                            ?>



                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container d-flex justify-content-center mt-5 mb-5 gap-4">
                <button class="btn btn-outline-dark col-2 printbtn" onclick="window.print()">Print</button>
                <!-- <button class="btn btn-outline-danger text-light col-2" >Download</button> -->
            </div>

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