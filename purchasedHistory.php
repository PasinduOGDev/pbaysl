<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchased History | Pbay</title>

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
        <?php

        include "main-header.php";

        ?></div><?php

                if (isset($_SESSION["u"])) {
                    $mail = $_SESSION["u"]["email"];

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "'");
                    $invoice_num = $invoice_rs->num_rows;

                ?>

        <div class="container-fluid mb-3" style="padding-top: 160px;">

            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none fw-bold" href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Purchased History</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <div class="row bg-body-secondary p-2 mt-2 mb-5" style="border-radius: 10px;">
                            <div class="col-12 text-center">
                                <h4 class="mt-2 fw-bold">
                                    <span><i class="bi bi-receipt"></i></span>
                                    <span class="px-1">Purchased History</span>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <?php

                    if ($invoice_num == 0) {

                    ?>

                        <!-- empty view -->

                        <div class="col-12 text-center mb-3">
                            <span class="text-body-tertiary d-block fs-1"><i class="bi bi-clock-history"></i></span>
                            <span class="fs-1 fw-bold text-body-tertiary d-block">You haven't purchased any item!</span>
                        </div>

                        <!-- empty view -->

                    <?php

                    } else {

                    ?>

                        <!-- have product -->

                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-1" scope="col">#</th>
                                            <th class="col-4 text-center" scope="col">Order Details</th>
                                            <th class="col-1 text-center" scope="col">Quantity</th>
                                            <th scope="col-2 text-center">Amount</th>
                                            <th scope="col-2 text-center">Date & Time</th>
                                            <th scope="col-2 text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                        ?>

                                            <tr>
                                                <th scope="row text-center"><?php echo $invoice_data["invoice_id"]; ?></th>

                                                <td>
                                                    <div class="col-12">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="card bg-body-tertiary">
                                                                <div class="row g-0 d-flex justify-content-center">

                                                                    <?php

                                                                    $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                                                        product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email 
                                                                        WHERE `id`='" . $invoice_data["product_id"] . "'");

                                                                    $product_data = $details_rs->fetch_assoc();

                                                                    ?>

                                                                    <div class="col-md-4"><img src="<?php echo $product_data["img_path"]; ?>" class="img-thumbnail rounded-start mt-3" />
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title"><?php echo $product_data["title"] ?></h5>
                                                                            <p class="card-text">LKR <?php echo $product_data["price"] ?></p>
                                                                            <span class="badge rounded-pill text-bg-warning">Waiting to accept</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-1 text-center"><?php echo $invoice_data["qty"]; ?></td>
                                                <td class="col-2">LKR <?php echo $invoice_data["total"]; ?></td>

                                                <td class="col-2"><?php echo $invoice_data["date"]; ?></td>
                                                <td>
                                                    <div class="row col-12 g-2">
                                                        <div class="col-lg-6">
                                                            <a href="<?php echo "invoice.php?id=" . $invoice_data["order_id"]; ?>" class="col-12 btn btn-success"><i class="bi bi-receipt"></i></a>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a class="col-12 btn btn-danger"><i class="bi bi-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php

                                        }

                                        ?>

                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-1 mx-3 justify-content-end">
                                <button class="btn btn-warning col-md-2">Remove all</button>
                            </div>

                        </div>

                        <!-- have product -->

                    <?php

                    }

                    ?>

                </div>
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