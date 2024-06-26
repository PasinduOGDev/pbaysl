<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | pBay</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="img/logo/logo.png" />
</head>

<body class="body" data-bs-theme="light">

    <div class="fixed-top">

        <?php include "main-header.php"; ?>

    </div>

    <div class="container-fluid">

        <!-- header -->

        <div class="row">

            <?php

            if (isset($_SESSION["u"])) {

                $user = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;

            ?>

                <!-- header -->

                <hr />

                <!-- bodycontent -->

                <div class="container-fluid mb-3" style="padding-top: 150px;">

                    <div class="row">
                        <div class="col-12">

                            <div class="row">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a class="text-decoration-none fw-bold" href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="container">
                                <div class="row bg-body-secondary p-2 mt-2 mb-5" style="border-radius: 10px;">
                                    <div class="col-12 text-center">
                                        <h4 class="mt-2 fw-bold">
                                            <span><i class="bi bi-bag"></i></span>
                                            <span class="px-1">My Cart</span>
                                        </h4>
                                    </div>
                                </div>

                            </div>

                            <?php

                            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                            $cart_num = $cart_rs->num_rows;

                            if ($cart_num == 0) {

                            ?>

                                <!-- empty cart view -->

                                <div class="col-12">

                                    <hr />

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 emptyCart"></div>
                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-1 fw-bold">
                                                    You have no items in your Cart
                                                </label>
                                            </div>
                                            <div class="offset-md-4 col-12 col-md-4 col-lg-4 mb-4 d-grid">
                                                <a href="index.php" class="btn btn-danger fs-4 fw-bold">
                                                    Back to Home
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                </div>

                                <!-- empty cart view -->

                            <?php

                            } else {

                            ?>

                                <!-- product div start-->

                                <div class="row">

                                    <div class="col-12 col-lg-9">

                                        <?php

                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                            product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                            $address_rs = Database::search("SELECT `city_city_id` AS c_id FROM `user_has_address` INNER JOIN `city` ON
                                            user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id
                                             WHERE `user_email`='" . $user . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            $ship = 0;

                                            $color_rs = Database::search("SELECT * FROM `product_has_color` INNER JOIN `product` ON product_has_color.product_id=product.id INNER JOIN
                                             `color` ON product_has_color.color_clr_id=color.clr_id WHERE id = '" . $cart_data["product_id"] . "'");
                                            $color_data = $color_rs->fetch_assoc();

                                            if ($address_data == null) {

                                        ?>

                                                <hr />

                                                <div class="row d-flex align-items-center">
                                                    <div class="col-6 text-start text-danger">
                                                        <?php

                                                        echo "Can not make a Delivery because User Shipping Address not found.";
                                                        ?>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <a href="profile.php" class="btn btn-danger">Profile Details</a>
                                                    </div>
                                                </div>
                                            <?php

                                            } else {

                                                if ($address_data["c_id"] == 1) {
                                                    $ship = $product_data["delivery_fee_colombo"];
                                                    $shipping = $shipping + $ship;
                                                } else {
                                                    $ship = $product_data["delivery_fee_other"];
                                                    $shipping = $shipping + $ship;
                                                }
                                            }

                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                            $seller_data = $seller_rs->fetch_assoc();
                                            $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                            ?>
                                            <hr />

                                            <!-- single product div -->

                                            <div class="row">

                                                <div class="col-4 col-md-3">
                                                    <img src="<?php echo $product_data["img_path"]; ?>" width="100%">
                                                </div>

                                                <div class="col-8 col-md-5">
                                                    <h4 class="fw-bold"><?php echo $product_data["title"]; ?></h4>
                                                    <p>Color: <?php echo $color_data["clr_name"]; ?></p>
                                                    <h5>Price: <span class="fs-4 fw-bold">LKR
                                                            <?php echo $product_data["price"]; ?></span></h5>
                                                    <div class="row mt-4 mb-2">
                                                        <div class="col-12 col-lg-3 mt-2 mb-2 d-flex justify-content-start align-items-center">
                                                            <span>Quantity:</span>
                                                        </div>
                                                        <div class="col-3 d-flex justify-content-start">
                                                            <input type="number" class="form-control" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQty(<?php echo $cart_data['cart_id'] ?>);" min="1" max="<?php echo $product_data["qty"]; ?>" id="qty" />
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <p>Delivery Fee: LKR <?php echo $ship; ?></p>
                                                    <hr />
                                                </div>

                                                <div class="col-12 col-md-4 text-end">

                                                    <div class="col-12 mt-2 mb-2">
                                                        <button class="col-12 col-lg-9 btn btn-secondary" onclick="deleteCart(<?php echo $cart_data['cart_id'] ?>);"><i class="bi bi-cart-dash"></i></button>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- single product div -->

                                        <?php

                                        }

                                        ?>

                                        <hr />

                                    </div>

                                    <!-- product div -->

                                    <!-- checkout div -->

                                    <div class="col-12 col-lg-3">

                                        <div class="col-12 card">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="fw-bold">Summary</h3>
                                                    </div>
                                                </div>

                                                <div class="row mt-4 mb-2">
                                                    <div class="col-6">
                                                        <span>Number of Products</span>
                                                    </div>

                                                    <div class="col-6 text-end">
                                                        <span><?php echo $cart_num; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row mt-2 mb-2">
                                                    <div class="col-6">
                                                        <span>Delivery Charge</span>
                                                    </div>

                                                    <div class="col-6 text-end">
                                                        <span>LKR <?php echo $shipping; ?></span>
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="row mt-4 mb-2">
                                                    <div class="col-6">
                                                        <span class="fs-5">Total</span>
                                                    </div>

                                                    <div class="col-6 text-end">
                                                        <span class="fs-5 fw-bold">LKR <?php echo $total + $shipping; ?></span>
                                                    </div>
                                                </div>

                                                <hr />

                                                <button class="col-12 btn btn-primary" id="payhere-payment" onclick="buyNow(<?php echo $product_data['id']; ?>);">Checkout</button>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- checkout div -->

                                </div>

                                <!-- product div end -->

                            <?php

                            }

                            ?>

                        </div>
                    </div>

                </div>

                <!-- bodycontent -->

            <?php

            } else {

            ?>

                <script>
                    window.location = "login.php";
                </script>

            <?php

            }

            ?>

        </div>

        <!-- footer -->

        <div class="row">

            <hr />

            <?php include "footer.php"; ?>

        </div>

        <!-- footer -->

    </div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- payhere js -->
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <!-- payhere js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>