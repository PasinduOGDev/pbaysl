<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Pbay</title>

    <!-- CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <!-- CSS -->

    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<body data-bs-theme="light">

    <div class="container-fluid">

        <?php

        require "connection.php";

        session_start();

        if (isset($_SESSION["u"])) {

            $data = $_SESSION["u"];

            ?>

            <div class="row">
                <div class="col-12 bg-body-tertiary">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <div class="col-11 mt-1 mb-1 d-flex justify-content-start">
                                <span class="fw-bold"><b class="text-success">Welcome </b>
                                    <?php echo $data["fname"]; ?>
                                </span> 
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <div class="col-11 mt-1 mb-1 d-flex justify-content-end">
                                <a class="fw-bold link-danger text-decoration-none" onclick="signOut();"
                                    href="#">Sign Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

        } else {

            ?>

            <a class="nav-link link-body-tertiary fw-bold btn btn-outline-warning" aria-current="page"
                href="index.php">Login or Register</a>

            <?php

        }

        ?>


        </li>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link link-body-tertiary fw-bold dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                My pBay
                            </a>
                            <ul class="dropdown-menu">

                                <?php

                                if (isset($_SESSION["u"])) {

                                    ?>

                                    <li><a class="dropdown-item" href="#" onclick="userConfirm();">My Profile</a></li>
                                    <li><a class="dropdown-item" href="#">My Sellings</a></li>
                                    <li><a class="dropdown-item" href="#">My Products</a></li>
                                    <li><a class="dropdown-item" href="#">Watchlist</a></li>
                                    <li><a class="dropdown-item" href="#">Purchased History</a></li>
                                    <li><a class="dropdown-item" href="#">Messages</a></li>

                                    <?php

                                }

                                ?>

                                <li><a class="dropdown-item" href="#">Contact Admin</a></li>
                                <li><a class="dropdown-item fw-bold" href="#">Help and Contact</a></li>
                            </ul>
                        </li>

                        <?php

                        if (isset($_SESSION["u"])) {

                            ?>

                            <li class="nav-item">
                                <a class="nav-link link-body-tertiary fw-bold" aria-current="page" href="#">Sell</a>
                            </li>

                            <?php

                        }

                        ?>

                    </ul>
                    <div class="d-flex">
                        <a class="nav-link link-body-tertiary mt-sm-1" href="cart.php"><i
                                class='cart-icon bx bxs-cart-alt fs-1'></i></a>
                    </div>
                </div>
            </div>
        </nav>

        <?php include "themeSwitch.php"; ?>


    </div>

    <!-- js -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- js -->
</body>

</html>