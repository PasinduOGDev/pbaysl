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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<body data-bs-theme="light">

    <div class="container-fluid">

        <?php

        session_start();

        include "connection.php";

        if (isset($_SESSION["u"])) {

            $data = $_SESSION["u"];

            ?>

            <div class="row">
                <div class="col-12 bg-body-secondary">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <div class="col-11 mt-1 mb-1 d-flex justify-content-start">
                                <span class="fw-bold"><i class="bi bi-person-circle"></i>
                                    <?php echo $data["fname"]; ?> </span>
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <div class="col-11 mt-1 mb-1 d-flex justify-content-end">
                                <a class="fw-bold link-danger text-decoration-none" onclick="signOut();" href="#">Log Out <i
                                        class="bi bi-box-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

        } else {

            ?>

                <div class="row">
                    <div class="col-12 bg-body-secondary">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="col-12 mt-1 mb-1 d-flex justify-content-start">

                                    <a class="nav-link link-body-tertiary fw-bold" aria-current="page" href="login.php">
                                        <span class="fw-bold"><i class="bi bi-person-circle"></i> </span>Login |
                                        Register</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

        }

        ?>


                </li>
                <nav class="col-12 navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <div class="col-3 col-lg-1 logo" style="height: 60px;" onclick="redirect();"></div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item dropdown">
                                    <a class="nav-link link-body-tertiary fw-bold dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        My pBay
                                    </a>
                                    <ul class="dropdown-menu">

                                        <?php

                                        if (isset($_SESSION["u"])) {

                                            ?>

                                            <li><a class="dropdown-item" href="profile.php">My Profile</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                                            <li><a class="dropdown-item" href="#">My Products</a></li>
                                            <li><a class="dropdown-item" href="#">Watchlist</a></li>
                                            <li><a class="dropdown-item" href="#">Purchased History</a></li>
                                            <li><a class="dropdown-item" href="#">Messages</a></li>

                                            <?php

                                        }

                                        ?>

                                        <li><a class="dropdown-item fw-bold" href="#">Help and Contact</a></li>
                                    </ul>
                                </li>

                            </ul>
                            <div class="d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..."
                                        aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                                </div>

                                <a class="nav-link link-body-tertiary mt-2 mt-md-0 ms-3" href="cart.php"><i
                                        class='cart-icon bx bxs-cart-alt fs-1'></i></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="row bg-body-secondary">
                <?php include "themeSwitch.php"; ?>
            </div>

        </div>

        <!-- js -->
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <!-- js -->
</body>

</html>