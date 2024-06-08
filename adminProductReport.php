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

    $rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON product.model_has_brand_id=model_has_brand.id INNER JOIN 
    `brand` ON model_has_brand.brand_brand_id=brand.brand_id INNER JOIN `model` ON model_has_brand.model_model_id=model.model_id INNER JOIN 
    `product_has_color` ON product.id=product_has_color.product_id INNER JOIN `color` ON product_has_color.color_clr_id=color.clr_id
     ORDER BY product.id ASC");

     $img_rs = Database::search("SELECT * FROM `product_img` INNER JOIN `product` ON product_img.product_id=product.id");

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
                    <h2 class="text-center ">Product Report</h2>
                    <table class="table table-hover table-bordered mt-5 text-center">

                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Brand Name</th>
                                <th>Colour</th>
                                <th>Image</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            for ($i = 0; $i < $num; $i++) {

                                $d = $rs->fetch_assoc();
                                $img_data = $img_rs->fetch_assoc();

                            ?>

                                <tr>
                                    <td><?php echo $d["id"] ?></td>
                                    <td><?php echo $d["title"] ?></td>
                                    <td><?php echo $d["brand_name"] ?></td>
                                    <td><?php echo $d["clr_name"] ?></td>
                                    <td><img src="<?php echo $img_data["img_path"] ?>" height="100"></td>

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