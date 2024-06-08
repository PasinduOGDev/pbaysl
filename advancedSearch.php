<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search | Pbay</title>

    <!-- CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<body data-bs-theme="light" class="bg-body-tertiary">

    <div class="container-fluid mt-2">

        <div class="row">
            <div class="col-6 d-flex justify-content-start">
                <div class="row mx-4 mt-1 py-1">
                    <a href="index.php" class="text-body text-decoration-none"><i class="bi bi-house"></i> Home</a>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div class="form-check form-switch mx-4 mt-1 py-1">

                    <input type="checkbox" class="form-check-input p-2" role="switch" onclick="themeChange();">
                    <label class="form-check-label" id="icon"><i class="bi bi-brightness-high text-dark"></i></label>

                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">

        <!-- Search panel -->

        <div class="row justify-content-center">
            <div class="col-10 card mt-3 bg-body-secondary">
                <div class="card-body">

                    <div class="container">
                        <div class="row bg-body-tertiary p-2 mt-2 mb-5" style="border-radius: 10px;">
                            <div class="col-12 text-center">
                                <h4 class="mt-2 fw-bold">
                                    <span><i class="bi bi-funnel"></i></span>
                                    <span class="px-1">Advanced Search</span>
                                </h4>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3">

                        <div class="col-9">
                            <input type="text" class="form-control" placeholder="Type keyword to Search..." id="t">
                        </div>

                        <div class="col-3">
                            <button class="col-12 btn btn-primary" onclick="advancedSearch(0);">Search</button>
                        </div>

                    </div>

                    <hr />

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <select class="form-select" id="c1">
                                <option value="0">Select Category</option>

                                <?php

                                include "connection.php";
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($i = 0; $i < $category_num; $i++) {
                                    $category_data = $category_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["category_name"]; ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <select class="form-select" id="b1">
                                <option value="0">Select Brand</option>

                                <?php

                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                $brand_num = $brand_rs->num_rows;

                                for ($i = 0; $i < $brand_num; $i++) {
                                    $brand_data = $brand_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <select class="form-select" id="m">
                                <option value="0">Select Model</option>

                                <?php

                                $model_rs = Database::search("SELECT * FROM `model`");
                                $model_num = $model_rs->num_rows;

                                for ($i = 0; $i < $model_num; $i++) {
                                    $model_data = $model_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>

                    </div>

                    <div class="row mt-2 g-3">

                        <div class="col-12 col-md-6">
                            <select class="form-select" id="c2">
                                <option value="0">Select Condition</option>

                                <?php

                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                $condition_num = $condition_rs->num_rows;

                                for ($i = 0; $i < $condition_num; $i++) {
                                    $condition_data = $condition_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>

                        <div class="col-12 col-md-6">
                            <select class="form-select" id="c3">
                                <option value="0">Select Colour</option>

                                <?php

                                $color_rs = Database::search("SELECT * FROM `color`");
                                $color_num = $color_rs->num_rows;

                                for ($i = 0; $i < $color_num; $i++) {
                                    $color_data = $color_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $color_data["clr_id"]; ?>"><?php echo $color_data["clr_name"]; ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>

                    </div>

                    <div class="row mt-2 g-3">

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" placeholder="Price From..." id="pf">
                        </div>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" placeholder="Price to..." id="pt">
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Search panel -->

        <!-- Sort panel -->

        <!-- <div class="row justify-content-center">
            <div class="col-10 card mt-2">
                <div class="card-body d-flex justify-content-end">

                    <div class="col-12 col-md-4">
                        <select id="s" class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark">
                            <option value="0">SORT BY</option>
                            <option value="1">PRICE LOW TO HIGH</option>
                            <option value="2">PRICE HIGH TO LOW</option>
                            <option value="3">QUANTITY LOW TO HIGH</option>
                            <option value="4">QUANTITY HIGH TO LOW</option>
                        </select>
                    </div>

                </div>
            </div>
        </div> -->

        <!-- Sort panel -->

        <div class="row justify-content-center">
            <div class="col-10 card mt-2 mb-5">
                <div class="card-body h-100 justify-content-center d-flex">

                    <div class="row" id="view_area">
                        <div class="col-12 d-flex justify-content-center">
                            <span class="fw-bold text-body"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <span class="h1 text-body fw-bold">No Items Searched Yet...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php include "footer.php"; ?>

    <!-- js -->
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>