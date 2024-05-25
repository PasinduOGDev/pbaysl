<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register | Pbay</title>

    <!-- CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<body class="bg-secondary" data-bs-theme="light">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="col-12 d-flex justify-content-end">
                    <div class="form-check form-switch mx-4 mt-4">
                        <input type="checkbox" class="form-check-input p-2" role="switch" onclick="setMode();">
                        <label class="form-check-label" id="mode"><i
                                class="bi bi-brightness-high text-white"></i></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12 d-lg-none">
                <div class="col-12 d-flex justify-content-center">

                    <img src="img/logo/logo.png" class="col-3">

                </div>
            </div>

            <div class="col-12 d-flex justify-content-center">

                <!-- Login box start -->

                <div class="col-12 col-md-10 mt-lg-4 mb-5 card" id="loginbox">

                    <div class="card-body">

                        <div class="row g-3 p-1">

                            <div
                                class="col-12 d-none d-lg-block col-lg-5 p-1 d-flex justify-content-center align-items-center">
                                <img src="img/logo/shadow-logo.png" class="col-12">
                            </div>

                            <div class="col-12 col-lg-7 p-1">

                                <div class="card-body">

                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <h3>Login to your account</h3>
                                        </div>
                                    </div>

                                    <?php

                                    $email = "";
                                    $password = "";

                                    if (isset($_COOKIE["email"])) {
                                        $email = $_COOKIE["email"];
                                    }

                                    if (isset($_COOKIE["password"])) {
                                        $password = $_COOKIE["password"];

                                    }

                                    ?>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                id="email" value="<?php echo $email; ?>">
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Enter Password"
                                                id="password" value="<?php echo $password; ?>">
                                                <span class="btn btn-warning"><i class="bi bi-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2 g-3 p-2">
                                        <div class="col-6 form-check">
                                            <input type="checkbox" class="form form-check-input" id="rememberme">
                                            <label class="form-check-label">Remember Me</label>
                                        </div>

                                        <div class="col-6 text-end">
                                            <a href="#" class="link-primary text-decoration-none" id="forgotPassword"
                                                onclick="forgotPassword();">Forgotten Password?</a>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row mt-3 g-2">
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <button class="col-12 btn btn-primary" id="login"
                                                onclick="login();">Login</button>
                                        </div>

                                        <div class="col-12 col-md-8 d-flex justify-content-start">
                                            <button class="col-12 btn btn-success" onclick="changeView();"
                                                id="change2">New to Pbay? Register</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Login box end -->

                <!-- Registration box start -->

                <div class="col-12 col-md-10 mt-lg-4 mt-5 mb-5 card d-none" id="registerbox">

                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-12 d-none d-lg-block col-lg-5 p-1 d-flex justify-content-center align-items-center"
                                style="border-radius: 0;">
                                <img src="img/logo/shadow-logo.png" class="col-12">
                            </div>

                            <div class="col-12 col-lg-7">

                                <div class="card-body">

                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <h3>Pbay Account Registration</h3>
                                        </div>
                                    </div>

                                    <div class="row g-3">

                                        <div class="col-6">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" placeholder="Ex: John" id="fname">
                                        </div>

                                        <div class="col-6">
                                            <label for="lastname" class="form-label">Last Name or Surname</label>
                                            <input type="text" class="form-control" placeholder="Ex: Doe" id="lname">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Ex: johndoe@email.com"
                                                id="email2">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" placeholder="Ex: 0712345678"
                                                id="mobile">
                                        </div>

                                    </div>

                                    <hr />

                                    <div class="row g-2 p-2">
                                        <div class="col-12 form-check">
                                            <input type="checkbox" class="form form-check-input" id="agreeBox">
                                            <label class="form-check-label">I agree to all <a href="#" class="link-primary text-decoration-none">terms and conditions</a></label>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row g-2">
                                        <div class="col-12 col-md-4 d-flex justify-content-end">
                                            <button class="col-12 btn btn-success" id="register"
                                                onclick="register();">Register</button>
                                        </div>

                                        <div class="col-12 col-md-8 d-flex justify-content-start">
                                            <button class="col-12 btn btn-danger" onclick="changeView();"
                                                id="change">Existing Pbay user? Login</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Registration box end -->

                <!-- modal start -->

        <div class="modal" tabindex="-1" id="otpBox">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h4 class="form-label text-danger"><img src="img/logo/logo.png" width="80px" height="80px"></h4>
                        <h4 class="form-label text-danger"><i class="bi bi-shield-lock-fill"></i></h4>
                        <p id="textmodal">Enter OTP to verify it's you</p>
                        <div class="col-12 input-group">
                            <input type="text" class="form-control" id="otpcode"
                                placeholder="Enter OTP Passcode">
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center modal-footer">
                        <button type="button" class="col-8 btn btn-primary" data-bs-dismiss="modal"
                            onclick="otpVerify();">Verify</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal end -->

            </div>
        </div>

    </div>

    <!-- js -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>