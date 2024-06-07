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

<body data-bs-theme="light">

    <div class="fixed-top">
        <?php include "main-header.php"; ?>
    </div>

    <div class="container-fluid col-12 col-md-8 mt-5 mb-3" style="padding-top: 120px;" id="anim-carousal">

        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/banner/banner1.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/banner/banner2.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="img/banner/banner3.jpg" class="d-block w-100">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    <div class="container-fluid mb-5">

        <!-- brands -->

        <div class="row mb-5 d-flex justify-content-center">

            <div class="col-12 mt-5">
                <h2 class="text-center">Our Authorized Partners</h2>
            </div>

            <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">

                <div class="col">
                    <div class="col-12 card h-100 h-100 border-0 bg-body-secondary">
                        <div class="card-body justify-content-center align-items-center d-flex">
                            <img src="img/logo/mobile/apple.svg" class="col-5">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="col-12 card h-100 border-0 bg-body-secondary">
                        <div class="card-body justify-content-center align-items-center d-flex">
                            <img src="img/logo/mobile/samsung.svg" class="col-5">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="col-12 card h-100 border-0 bg-body-secondary">
                        <div class="card-body  justify-content-center align-items-center d-flex">
                            <img src="img/logo/mobile/huawei.svg" class="col-5">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="col-12 card h-100 border-0 bg-body-secondary">
                        <div class="card-body justify-content-center align-items-center d-flex">
                            <img src="img/logo/mobile/asus.svg" class="col-5">
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php

        $category1_rs = Database::search("SELECT * FROM `category`");
        $category1_num = $category1_rs->num_rows;

        for ($y = 0; $y < $category1_num; $y++) {
            $category1_data = $category1_rs->fetch_assoc();

        ?>

            <!-- brands -->

            <div class="row mt-5 py-2 bg-body-secondary text-center">
                <div class="col-12"><span class="fs-1"><?php echo $category1_data["category_name"]; ?></span></div>
            </div>

            <div class="row d-flex justify-content-center">

                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center">

                    <?php

                    $product_rs = Database::search("SELECT * FROM `product` WHERE 
                            `category_cat_id`='" . $category1_data["cat_id"] . "' AND 
                            `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 10 OFFSET 0");
                    $product_num = $product_rs->num_rows;

                    for ($z = 0; $z < $product_num; $z++) {
                        $product_data = $product_rs->fetch_assoc();

                    ?>

                        <div class="col">

                            <?php

                            if ($product_data["qty"] > 0) {

                            ?>

                                <a class="text-decoration-none" href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">
                                    <div class="card product_card bg-body-secondary h-100">

                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                        ?>

                                        <img src="<?php echo $image_data["img_path"]; ?>" class="card-img-top">
                                        <hr />
                                        <div class="card-body text-center">
                                            <p class="card-text"><?php echo $product_data["title"]; ?></p>
                                            <span class="card-text text-primary fs-3 fw-bold">Rs.
                                                <?php echo $product_data["price"]; ?></span><br />

                                            <span class="card-text text-success fw-bold">In Stock</span><br />
                                            <span class="card-text"><?php echo $product_data["qty"]; ?> Stocks</span><br />
                                        </div>

                                    </div>
                                </a>
                        </div>


                    <?php

                            } else {

                    ?>

                        <div class="card bg-body-tertiary h-100 disabled">

                            <?php

                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                $image_data = $image_rs->fetch_assoc();

                            ?>

                            <img src="<?php echo $image_data["img_path"]; ?>" class="card-img-top">
                            <hr />
                            <div class="card-body text-center">
                                <p class="card-text"><?php echo $product_data["title"]; ?></p>
                                <span class="card-text text-primary fs-3 fw-bold">Rs.
                                    <?php echo $product_data["price"]; ?></span><br />

                                <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                            </div>

                        </div>
                </div>


            <?php

                            }

            ?>

        <?php

                    }

        ?>

            </div>

    </div>

<?php

        }

?>

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