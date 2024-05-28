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

        <!-- Stock management -->

        <div class="container mb-5" id="stockmanagement">

            <div class="col-12">

                <div class="row mt-4 mb-5">

                    <div class="col-12 col-md-6 d-flex justify-content-center">

                        <div class="row g-4">

                            <div class="col-12 text-center">
                                <h2>Product Registration</h2>
                            </div>

                            <div class="col-12 mt-3">
                                <label class="form-label">Product Title</label>
                                <input type="text" class="form-control" placeholder="Enter Product Title">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" placeholder="Select Category">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" placeholder="Select Brand">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Model</label>
                                <input type="text" class="form-control" placeholder="Select Model">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Colour</label>
                                <input type="text" class="form-control" placeholder="Select Colour">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea id="" class="form-control" placeholder="Enter Description"></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Product image</label>
                                <input type="file" class="form-control" placeholder="Select photo">
                            </div>

                            <div class="col-12">
                                <button class="col-12 btn btn-secondary">Register Product</button>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-6 mt-5 mt-md-0">

                        <div class="row g-4 d-flex justify-content-center">

                            <div class="col-12 text-center">
                                <h2>Stock Registration</h2>
                            </div>

                            <div class="col-12 mt-3">
                                <label class="form-label">Product Title</label>
                                <input type="text" class="form-control" placeholder="Enter Product Title">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" placeholder="Enter Product Quantity">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Unit Price</label>
                                <input type="text" class="form-control" placeholder="Enter Unit Price">
                            </div>

                            <div class="col-12">
                                <button class="col-12 btn btn-secondary">Update Stock</button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Stock management -->

    </div>

    <!-- js -->
    <script src="script.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->
</body>

</html>