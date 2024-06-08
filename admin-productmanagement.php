<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management | Pbay</title>

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

                    <div class="row mt-4 d-flex justify-content-center g-4">

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" placeholder="Enter Category" id="category">
                                <div class="row g-2 mt-1">
                                    <div class="col-md-6">
                                        <button class="btn btn-success col-12" onclick="categoryRegister();">Register</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger col-12" onclick="categoryDelete();">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Brand Name</label>
                                <input type="text" class="form-control" placeholder="Enter Brand" id="brand">
                                <div class="row g-2 mt-1">
                                    <div class="col-md-6">
                                        <button class="btn btn-success col-12" onclick="brandRegister();">Register</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger col-12" onclick="brandDelete();">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row mt-4 d-flex justify-content-center g-3">

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Model Name</label>
                                <input type="text" class="form-control" placeholder="Enter Model" id="model">
                                <div class="row g-2 mt-1">
                                    <div class="col-md-6">
                                        <button class="btn btn-success col-12" onclick="modelRegister();">Register</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger col-12" onclick="modelDelete();">Delete</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="col-8">
                                <label class="form-label">Colour</label>
                                <input type="text" class="form-control" placeholder="Enter Colour" id="color">
                                <div class="row g-2 mt-1">
                                    <div class="col-md-6">
                                        <button class="btn btn-success col-12" onclick="colorRegister();">Register</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger col-12" onclick="colorDelete();">Delete</button>
                                    </div>
                                </div>
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