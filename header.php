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

        <div class="row bg-secondary bg-opacity-25" data-bs-theme=>
            <div class="col-12">

                <ul class="nav">
                    <li class="nav-item mt-1 mt-lg-2">

                        <?php

                        require "connection.php";

                        session_start();

                        if (isset($_SESSION["u"])) {

                            $data = $_SESSION["u"];

                            ?>

                        <li class="nav-item py-1 py-lg-0 mt-2 mt-lg-3">
                            <span class="text-dark fw-bold"><b class="text-success">Welcome </b>
                                <?php echo $data["fname"]; ?>
                            </span> |
                            <a class="fw-bold link-danger text-decoration-none" onclick="signout();" href="#">Sign Out</a>
                        </li>

                        <?php

                        } else {

                            ?>

                        <a class="nav-link link-dark text-dark fw-bold btn btn-outline-warning" aria-current="page"
                            href="index.php">Login or Register</a>

                        <?php

                        }

                        ?>


                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link-dark fw-bold dropdown-toggle" href="#" role="button"
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

                        <li class="nav-item mt-1 mt-lg-2">
                            <a class="nav-link link-dark fw-bold btn btn-warning" aria-current="page" href="#">Sell</a>
                        </li>

                        <?php

                    }

                    ?>

                    <li class="nav-item ms-auto">
                        
                    </li>
                </ul>

            </div>
        </div>

        <?php include "themeSwitch.php" ?>

        <!-- modal start -->

        <div class="modal" tabindex="-1" id="confirmBox">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h4 class="form-label text-danger"><img src="img/logo/logo.png" width="80px" height="80px"></h4>
                        <h4 class="form-label text-danger"><i class="bi bi-shield-lock-fill"></i></h4>
                        <p id="textmodal">Enter Password to verify it's you</p>
                        <div class="col-12 input-group">
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Enter Your Password">
                            <button class="btn btn-light" id="confirmPwBtn" onclick="showPassword2();"><i
                                    class="bi bi-eye-fill"></i></button>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center modal-footer">
                        <button type="button" class="col-8 btn btn-primary" data-bs-dismiss="modal"
                            onclick="userVerify();">Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal end -->

        <!-- msg modal start -->

        <div class="modal" tabindex="-1" id="msgModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h4 class="form-label" id="iconName"></h4>
                        <p id="textName"></p>
                    </div>
                    <div class="col-12 d-flex justify-content-center modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="msgbtn"
                            onclick="tryToConfirm();">Try Again</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- msg modal end -->

    </div>

    <!-- js -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- js -->
</body>

</html>