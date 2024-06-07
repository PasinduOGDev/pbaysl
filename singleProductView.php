<?php

?>
<div class="fixed-top">
    <?php include "main-header.php"; ?>
</div>
<?php

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,
    product.status_status_id,product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM 
    `product` INNER JOIN `model_has_brand` ON model_has_brand.id=product.model_has_brand_id INNER JOIN 
    `brand` ON brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
    model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $model_has_brand_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON product.model_has_brand_id=model_has_brand.id 
    INNER JOIN `brand` ON model_has_brand.brand_brand_id=brand.brand_id INNER JOIN `model` ON model_has_brand.model_model_id=model.model_id 
    WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();
        $mhb_data = $model_has_brand_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $product_data["title"]; ?> | Pbay</title>

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

            <div class="container-fluid" style="padding-top: 160px;">

                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none fw-bold" href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["title"]; ?></li>
                        </ol>
                    </nav>
                </div>

                <div class="row mb-5 justify-content-center">
                    <div class="col-10 h-100 card p-3 bg-body-tertiary">

                        <div class="row g-3">

                            <div class="col-12 col-md-5">
                                <div class="card bg-body-tertiary" style="border: none;">
                                    <div class="card-body d-flex justify-content-center">

                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;

                                        if ($image_num == 1) {

                                            $image_data = $image_rs->fetch_assoc();
                                        }

                                        ?>

                                        <img src="<?php echo $image_data["img_path"]; ?>" class="col-6 col-md-12 image-fluid">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-7">
                                <div class="card h-100">
                                    <div class="card-body">

                                        <div class="row">
                                            <h2 class="col-12 fs-4"><?php echo $product_data["title"]; ?></h2>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <span>Brand | <b class="text-danger"><?php echo $mhb_data["brand_name"]; ?></b></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span>Model | <b class="text-success"><?php echo $mhb_data["model_name"]; ?></b></span>

                                            </div>
                                        </div>

                                        <?php

                                        $price = $product_data["price"];
                                        $adding_price = ($price / 100) * 10;
                                        $new_price = $price + $adding_price;
                                        $difference = $new_price - $price;

                                        ?>

                                        <div class="row mt-4 align-items-center">
                                            <h1 class="col-12 text-danger fw-bold">Rs. <?php echo $product_data["price"]; ?></h1>
                                            <h5 class="col-12"><span class="text-decoration-line-through">Rs. <?php echo $new_price; ?></span> | -10%</h5>
                                        </div>

                                        <?php

                                        if ($product_data["condition_condition_id"] == 1) {

                                        ?>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h5 class="fs-5">Warranty: 2 Years</h5>
                                                    <h5 class="fs-5">Return Policy: 6 Months</h5>
                                                    <h5 class="fs-5 text-success">In Stock: <?php echo $product_data["qty"]; ?> Stocks Available</h5>
                                                    <div class="col-12 col-md-2">
                                                        <input type="number" class="form-control" value="1" min="1" max="<?php echo $product_data["qty"]; ?>" id="qty" />

                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        } else {

                                        ?>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h5 class="fs-5">Warranty: 6 Months</h5>
                                                    <h5 class="fs-5">Return Policy: 3 Months</h5>
                                                    <h5 class="fs-5 text-success">In Stock: <?php echo $product_data["qty"]; ?> Stocks Available</h5>
                                                    <div class="col-12 col-md-2">
                                                        <input type="number" class="form-control" value="1" min="1" max="<?php echo $product_data["qty"]; ?>" id="qty" />

                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <button class="col-12 btn btn-warning" type="submit" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">Buy</button>
                                            </div>
                                            <div class="col-6">
                                                <button class="col-12 btn btn-success" onclick="addtoCart(<?php echo $product_data['id']; ?>);"><i class="bi bi-cart3"></i> Cart</button>
                                            </div>
                                        </div>

                                    </div>
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

            <!-- payhere js -->
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <!-- payhere js -->

            <!-- js sweetalert -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <!-- js sweetalert -->
        </body>

        </html>

<?php

    } else {
        echo "Sorry for the inconvinence. Please try again later!";
    }
}
// } else {
//     echo "Something went wrong!";
// }

?>