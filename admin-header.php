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

<body data-bs-theme="light">

    <div class="container-fluid">

        <div class="row">

            <nav class="navbar navbar-expand-md bg-body-tertiary">
                <div class="container-fluid">
                    <div class="col-1 col-lg-1 logo" style="height: 60px;"></div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <div class="col-2 col-lg-1 logo" style="height: 60px;"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav ms-auto gap-md-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="admin-dashboard.php">User Management</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin-productmanagement.php">Product Management</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin-stockmanagement.php">Stock Management</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin-report.php">Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-danger fw-bold" href="#" onclick="adminLogout();">Sign Out <i class="bi bi-box-arrow-right"></i></a>
                                </li>
                            </ul>
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

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>