<?php

session_start();
include "connection.php";

$email = $_SESSION["a"]["email"];

$title = $_POST["t"];
$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$color = $_POST["col"];
$price = $_POST["p"];
$qty = $_POST["q"];
$condition = $_POST["con"];
$desc = $_POST["d"];

if (empty($title)) {
    echo "Please enter product title";
} else if (empty($category)) {
    echo "Please select category";
} else if (empty($brand)) {
    echo "Please select brand";
} else if (empty($model)) {
    echo "Please select model";
} else if (empty($color)) {
    echo "Please select colour";
} else if (empty($price)) {
    echo "Please enter price";
} else if (empty($qty)) {
    echo "Please enter quantity";
} else if (empty($condition)) {
    echo "Please select condition;";
} else if (empty($desc)) {
    echo "Please add description";
} else {

    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "' 
    AND `brand_brand_id`='" . $brand . "'");

    $model_has_brand_id;

    if ($mhb_rs->num_rows > 0) {

        $mhb_data = $mhb_rs->fetch_assoc();
        $model_has_brand_id = $mhb_data["id"];
    } else {

        Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) VALUES 
        ('" . $model . "','" . $brand . "')");

        $model_has_brand_id = Database::$connection->insert_id;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`
    ,`category_cat_id`,`model_has_brand_id`,`condition_condition_id`,`status_status_id`,`user_email`) VALUES
    ('" . $price . "','" . $qty . "','" . $desc . "','" . $title . "','" . $date . "','" . $category . "','" . $model . "','" . $condition . "',
    '" . $status . "','" . $email . "')");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 1 && $length > 0) {

        $allowed_image_extensions = array("img/jpeg", "img/png", "img/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["img" . $x])) {

                $image_file = $_FILES["img" . $x];
                $file_extension = $image_file["type"];

                if (in_array($file_extension, $allowed_image_extensions)) {

                    $new_img_extension;

                    if ($file_extension == "img/jpeg") {
                        $new_img_extension = ".jpeg";
                    } else if ($file_extension == "img/png") {
                        $new_img_extension = ".png";
                    } else if ($file_extension == "img/svg+xml") {
                        $new_img_extension = ".svg";
                    }

                    $file_name = "img/resources/product_img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($image["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
                    ('" . $file_name . "','" . $product_id . "')");
                } else {

                    echo "Invalid image type!";
                }
            }
        }

        echo ("success");

    } else {
        echo "Invalid image count!";
    }
}

?>