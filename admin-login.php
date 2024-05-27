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

<body data-bs-theme="light" class="bg-secondary">

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

            <div class="col-12">
                <div class="col-12 d-flex justify-content-center">

                    <img src="img/logo/shadow-logo.png" class="col-3 col-lg-1">

                </div>
            </div>

            <div class="col-12 d-flex justify-content-center">

                <!-- admin box start -->

                <div class="col-12 col-md-6 mt-lg-3 mb-5 card" id="adminbox">

                    <div class="card-body">

                        <div class="row g-3 p-1">

                            <div class="col-12 p-1">

                                <div class="card-body">

                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <h3>Admin Login</h3>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                id="email">
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" placeholder="Enter Password"
                                                    id="password">
                                                <span class="btn btn-warning" id="pwBtn" onclick="viewPassword();"><i
                                                        class="bi bi-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row mt-3 g-2">
                                        <div class="col-12 col-md-6 d-flex justify-content-end">
                                            <button class="col-12 btn btn-primary" id="login"
                                                onclick="adminlogin();">Login</button>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- admin box end -->

            </div>
        </div>

    </div>

    <!-- js -->
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>