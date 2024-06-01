<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management | Pbay</title>

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

?>

    <body class="bg-body-secondary" data-bs-theme="light">

        <div class="container-fluid">

            <div class="row">
                <?php include "admin-header.php"; ?>
            </div>

            <!-- Stock management -->

            <div class="container mb-5" id="stockmanagement">

                <div class="col-12">

                    <div class="row mt-4 mb-5">

                        <div class="col-12 col-md-6 d-flex justify-content-center">

                            <div class="row g-4">

                                <div class="col-12 text-center">
                                    <h2>Product Registration</h2>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label">Product Title</label>
                                    <input type="text" class="form-control" id="product_title" placeholder="Enter Product Title">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Category</label>
                                    <select class="form-select" id="category">
                                        <option value="0">Select Category</option>

                                        <?php

                                        $cat_rs = Database::search("SELECT * FROM `category`");
                                        $n = $cat_rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {

                                            $cat_data = $cat_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $cat_data["cat_id"]; ?>"><?php echo $cat_data["category_name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Brand</label>
                                    <select class="form-select" id="brand">
                                        <option value="0">Select Brand</option>

                                        <?php

                                        $brand_rs = Database::search("SELECT * FROM `brand`");
                                        $n = $brand_rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {

                                            $brand_data = $brand_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Model</label>
                                    <select class="form-select" id="model">
                                        <option value="0">Select Model</option>

                                        <?php

                                        $model_rs = Database::search("SELECT * FROM `model`");
                                        $n = $model_rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {

                                            $model_data = $model_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Colour</label>
                                    <select class="form-select" id="color">
                                        <option value="0">Select Colour</option>

                                        <?php

                                        $color_rs = Database::search("SELECT * FROM `color`");
                                        $n = $color_rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {

                                            $color_data = $color_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $color_data["clr_id"]; ?>"><?php echo $color_data["clr_name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" class="form-control" id="price" placeholder="Enter Price">
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="qty" placeholder="Enter Quantity">
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label">Condition</label>
                                    <select class="form-select" id="condition">
                                        <option value="0">Select Condition</option>

                                        <?php

                                        $condition_rs = Database::search("SELECT * FROM `condition`");
                                        $n = $condition_rs->num_rows;

                                        for ($i = 0; $i < $n; $i++) {

                                            $condition_data = $condition_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="Enter Description" id="desc"></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Product image</label>
                                    <input type="file" class="form-control" placeholder="Select photo" id="product_img">
                                </div>

                                <div class="col-12">
                                    <button class="col-12 btn btn-secondary" onclick="registerProduct();">Register Product</button>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-md-6 mt-5 mt-md-0">

                            <div class="row g-4 d-flex justify-content-center">

                                <div class="col-12 text-center">
                                    <h2>Stock Registration</h2>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label">Product Title</label>
                                    <input type="text" class="form-control" placeholder="Enter Product Title">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" placeholder="Enter Product Quantity">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" class="form-control" placeholder="Enter Unit Price">
                                </div>

                                <div class="col-12">
                                    <button class="col-12 btn btn-secondary">Update Stock</button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Stock management -->

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