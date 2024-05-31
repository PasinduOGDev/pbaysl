<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Pbay</title>

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

            <div class="container mb-5" id="productmanagement">

                <div class="col-12 mt-5">
                    <h2 class="text-center">Product Management</h2>

                    <div class="row mt-4 d-flex justify-content-center g-3">

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" placeholder="Enter Category" id="category">
                                <button class="btn btn-secondary col-12 mt-2" onclick="categoryRegister();">Category Register</button>
                            </div>

                        </div>

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Brand Name</label>
                                <input type="text" class="form-control" placeholder="Enter Brand" id="brand">
                                <button class="btn btn-secondary col-12 mt-2" onclick="brandRegister();">Brand Register</button>
                            </div>

                        </div>

                    </div>

                    <div class="row mt-4 d-flex justify-content-center g-3">

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Model Name</label>
                                <input type="text" class="form-control" placeholder="Enter Model" id="model">
                                <button class="btn btn-secondary col-12 mt-2" onclick="modelRegister();">Model Register</button>
                            </div>

                        </div>

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Color</label>
                                <input type="text" class="form-control" placeholder="Enter Colour" id="color">
                                <button class="btn btn-secondary col-12 mt-2" onclick="colorRegister();">Colour Register</button>
                            </div>

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