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

<body>

    <div class="row">
        <div class="col-6 d-flex justify-content-start">
            <div class="row mx-4 mt-1 py-1">
                <span><i class="bi bi-funnel"></i> Advanced</span>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <div class="form-check form-switch mx-4 mt-1 py-1">

                <input type="checkbox" class="form-check-input p-2" role="switch" onclick="themeChange();">
                <label class="form-check-label" id="icon"><i class="bi bi-brightness-high text-dark"></i></label>

            </div>
        </div>
    </div>

    <!-- js -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- js -->
</body>

</html>