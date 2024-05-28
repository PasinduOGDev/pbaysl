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
            <?php include "admin-header.php"; ?>
        </div>

        <!-- User Management -->

        <div class="container" id="usermanagement">

            <div class="col-12 mt-5">
                <h2 class="text-center">User Management</h2>

                <div class="row g-2 d-flex justify-content-end mt-4">

                    <div class="d-none" id="msgDiv" onclick="reload();">
                        <div class="alert alert-danger" id="msg"></div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <input type="text" class="form-control" placeholder="User Id" id="uid" />
                    </div>

                    <button class="btn btn-outline-secondary col-12 col-lg-2" onclick="updateUserStatus();">Change Status</button>
                </div>

                <div class="mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <!-- Table Row -->
                            <!-- Table Row -->
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

        <!-- User Management -->

    </div>

    <!-- js -->
    <script src="script.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>