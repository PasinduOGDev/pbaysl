<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Pbay</title>

    <!-- CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<body>

    <?php

    session_start();
    include "connection.php";

    if (isset($_SESSION["u"])) {
        $email = $_SESSION["u"]["email"];
        $order_id = $_GET["id"];

    ?>

        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-15">Invoice <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                <div class="mb-4">
                                    <h2 class="mb-1 text-muted"><img src="img/logo/logo.png" class="col-2"></h2>
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">No.68, Andunwenna 1st Mawatha, Mathugama</p>
                                    <p class="mb-1"><i class="bi bi-envelope me-1"></i> pasinduogdev@gmail.com</p>
                                    <p><i class="bi bi-phone me-1"></i> 0715518744</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">

                                    <?php
                                    
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
                                    $address_data = $address_rs->fetch_assoc();

                                    ?>

                                        <h5 class="font-size-16 mb-3">Billed To:</h5>
                                        <h5 class="font-size-15 mb-2"><?php echo $_SESSION["u"]["fname"]." ".$_SESSION["u"]["lname"]; ?></h5>
                                        <p class="mb-1"><?php echo $address_data["line1"]." ".$address_data["line2"]. " " . $address_data["postal_code"]; ?></p>
                                        <p class="mb-1"><i class="bi bi-envelope me-1"></i> <?php echo $email; ?></p>
                                        <p><i class="bi bi-phone me-1"></i> <?php echo $_SESSION["u"]["mobile"]; ?></p>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">

                                    <?php 
                                    
                                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$order_id."'");
                                    $invoice_data = $invoice_rs->fetch_assoc();
                                    
                                    ?>

                                        <div>
                                            <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                            <p><?php echo $invoice_data["invoice_id"]; ?></p>

                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                            <p><?php echo $invoice_data["date"] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="py-2">
                                <h5 class="font-size-15">Order Summary</h5>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $invoice_data["invoice_id"]; ?></th>
                                                <td>

                                                <?php 
                                                
                                                $product_rs = Database::search("SELECT * FROM `product_has_color` INNER JOIN `product` ON product_has_color.product_id=product.id INNER JOIN
                                                 `color` ON product_has_color.color_clr_id=color.clr_id WHERE `id`='".$invoice_data["product_id"]."'");
                                                $product_data = $product_rs->fetch_assoc();
                                                
                                                ?>

                                                    <div>
                                                        <h5 class="text-truncate font-size-14 mb-1"><?php echo $product_data["title"]; ?></h5>
                                                        <p class="text-muted mb-0"><?php echo $product_data["clr_name"]; ?></p>
                                                    </div>
                                                </td>
                                                <td>LKR <?php echo $product_data["price"]; ?></td>

                                                <td><?php echo $invoice_data["qty"]; ?></td>
                                                <td class="text-end">LKR <?php echo $product_data["price"] *  $invoice_data["qty"]; ?></td>

                                            </tr>
                                            <!-- end tr -->

                                            <?php
                                            
                                            $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='".$address_data["city_city_id"]."'");
                                            $city_data = $city_rs->fetch_assoc();

                                            $delivery = 0;

                                            if ($city_data["district_district_id"] == 2) {
                                                $delivery = $product_data["delivery_fee_colombo"];
                                            } else {
                                                $delivery = $product_data["delivery_fee_other"];
                                            }

                                            $t = $invoice_data["total"];
                                            $g = $t - $delivery;
                                            
                                            ?>

                                            <tr>
                                                <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                <td class="text-end">LKR <?php echo $g; ?></td>
                                            </tr>
                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Shipping Charge :</th>
                                                <td class="border-0 text-end">LKR <?php echo $delivery; ?></td>
                                            </tr>
                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0 fw-semibold">LKR <?php echo $t; ?></h4>
                                                </td>
                                            </tr>
                                            <!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->
                                <div class="d-print-none mt-4">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success me-1"><i class="bi bi-printer"></i></a>
                                        <a href="#" class="btn btn-primary w-md">Send</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
        </div>

    <?php

    }

    ?>

    <!-- js -->
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>