<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | pBay</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="icon" href="img/logo/logo.png" />
</head>

<body class="body" data-bs-theme="light">

    <!-- header start -->

    <?php

    session_start();

    include "connection.php";

    if (isset($_SESSION["u"])) {

        $user_email = $_SESSION["u"]["email"];

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user_email . "'");

        $image_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email`='" . $user_email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
        user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id INNER JOIN
        `province` ON district.province_province_id=province.province_id WHERE `user_email`='" . $user_email . "'");

        $user_data = $user_rs->fetch_assoc();
        $img_data = $image_rs->fetch_assoc();
        $address_data = $address_rs->fetch_assoc();

    ?>

        <!-- header end -->

        <div class="container-fluid mt-2">
            <?php include "themeSwitch.php"; ?>
        </div>

        <div class="container-fluid mt-3">

            <div class="row mb-2">
                <div class="col-12">

                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none fw-bold" href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container">
                        <div class="row bg-body-secondary p-2 mt-2 mb-5" style="border-radius: 10px;">
                            <div class="col-12 text-center">
                                <h4 class="mt-2 fw-bold">
                                    <span><i class="bi bi-person-circle"></i></span>
                                    <span class="px-1">My Profile</span>
                                </h4>
                            </div>
                        </div>

                    </div>

                    <!-- content -->

                    <div class="row">
                        <div class="col-12">

                            <div class="row p-3">

                                <div class="col-12 col-lg-3 card bg-body-tertiary p-4 border-0 text-center" style="border-radius: 0;">

                                    <div class="col-12 mt-lg-5">

                                        <?php

                                        if (empty($img_data["path"])) {

                                        ?>

                                            <img src="img/user.png" class="col-4 col-lg-8" width="100%" height="100%" id="img">

                                        <?php

                                        } else {

                                        ?>

                                            <img src="<?php echo $img_data["path"]; ?>" class="rounded col-4 col-lg-8" width="100%" height="100%" id="img">

                                        <?php

                                        }

                                        ?>

                                    </div>

                                    <div class="col-12 mt-4">
                                        <h4 class="fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>
                                        </h4>
                                    </div>

                                    <div class="col-12">
                                        <h6><?php echo $user_data["email"]; ?></h6>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <input type="file" class="d-none" id="profileimage">
                                        <label for="profileimage" class="col-5 col-md-10 btn btn-primary" onclick="changeProfileimage();">Change Image</label>
                                    </div>

                                </div>

                                <div class="col-12 col-lg-6 card bg-body-tertiary p-4 border-0" style="border-radius: 0;">

                                    <div class="row g-4">

                                        <div class="col-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" value="<?php echo $user_data["fname"]; ?>" id="fname">
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Surname</label>
                                            <input type="text" class="form-control" value="<?php echo $user_data["lname"]; ?>" id="lname">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control bg-body-secondary" value="<?php echo $user_data["email"]; ?>" readonly>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Your Password</label>
                                            <div class="row g-2">
                                                <div class="input-group">
                                                    <input type="password" id="password" class="form-control bg-body-secondary" value="<?php echo $user_data["password"]; ?>" readonly>
                                                    <span class="btn btn-warning" id="pwBtn" onclick="viewPassword4()"><i class="bi bi-eye-slash"></i></span>
                                                </div>

                                                <div class="col-12">
                                                    <div class="btn col-12 btn btn-danger">Change Password</div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-6">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control bg-body-secondary" value="<?php echo $user_data["mobile"]; ?>" readonly>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Registered Date</label>
                                            <input type="datetime" class="form-control bg-body-secondary" value="<?php echo $user_data["joined_date"]; ?>" readonly>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Address Line 1</label>

                                            <?php

                                            if (empty($address_data["line1"])) {

                                            ?>

                                                <input type="text" id="line1" class="form-control" placeholder="Enter Address here">

                                            <?php

                                            } else {

                                            ?>

                                                <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>">

                                            <?php

                                            }

                                            ?>

                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Address Line 2</label>

                                            <?php

                                            if (empty($address_data["line2"])) {

                                            ?>

                                                <input type="text" id="line2" class="form-control" placeholder="Enter Address here">

                                            <?php

                                            } else {

                                            ?>

                                                <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"]; ?>">

                                            <?php

                                            }

                                            ?>

                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Postal Code</label>

                                            <?php

                                            if (empty($address_data["postal_code"])) {

                                            ?>

                                                <input type="text" class="form-control" placeholder="Enter Postal Code here" id="pcode">

                                            <?php

                                            } else {

                                            ?>

                                                <input type="text" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" id="pcode">

                                            <?php

                                            }

                                            ?>

                                        </div>

                                        <?php

                                        $province_rs = Database::search("SELECT * FROM `province`");
                                        $district_rs = Database::search("SELECT * FROM `district`");
                                        $city_rs = Database::search("SELECT * FROM `city`");

                                        ?>

                                        <div class="col-6">
                                            <label class="form-label">City</label>
                                            <select class="form-select" id="city">
                                                <option value="0">Select City</option>

                                                <?php

                                                for ($y = 0; $y < $city_rs->num_rows; $y++) {
                                                    $city_data = $city_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $city_data["city_id"] ?>" <?php
                                                                                                        if (!empty($address_data["city_id"])) {
                                                                                                            if ($city_data["city_id"] == $address_data["city_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>>

                                                        <?php echo $city_data["city_name"]; ?>

                                                    </option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">District</label>
                                            <select class="form-select" id="district">
                                                <option value="0">Select District</option>

                                                <?php

                                                for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                    $district_data = $district_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $district_data["district_id"] ?>" <?php
                                                                                                                if (!empty($address_data["district_id"])) {
                                                                                                                    if ($district_data["district_id"] == $address_data["district_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>>

                                                        <?php echo $district_data["district_name"]; ?>

                                                    </option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">Province</label>
                                            <select class="form-select" id="province">
                                                <option value="0">Select Province</option>

                                                <?php

                                                for ($y = 0; $y < $province_rs->num_rows; $y++) {
                                                    $province_data = $province_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $province_data["province_id"] ?>" <?php
                                                                                                                if (!empty($address_data["province_id"])) {
                                                                                                                    if ($province_data["province_id"] == $address_data["province_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>>

                                                        <?php echo $province_data["province_name"]; ?>

                                                    </option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 mt-5 text-center">
                                            <button class="col-12 btn btn-success" onclick="updateProfile();">Update Profile</button>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-12 col-lg-3 card bg-body-secondary p-4 border-0 text-center" style="border-radius: 0;">

                                    <h6 class="mt-lg-5 fw-bold">Display Ads</h6>

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- content -->

                </div>
            </div>

            <div class="row">

                <?php include "footer.php"; ?>

            </div>

        </div>

    <?php

    } else {

    ?>

        <script>
            window.location = "login.php";
        </script>

    <?php

    }

    ?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>