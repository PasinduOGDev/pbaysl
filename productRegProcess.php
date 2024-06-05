<?php

session_start();
include "connection.php";

$email = $_SESSION["a"]["email"];

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$color = $_POST["col"];
$title = $_POST["t"];
$condition = $_POST["con"];
$price = $_POST["p"];
$qty = $_POST["q"];
$dwc = $_POST["dwc"];
$doc = $_POST["dwc"];
$description = $_POST["desc"];

if (empty($category)) {
    echo "Please select category";
} else if (empty($brand)) {
    echo "Please select brand";
} else if (empty($model)) {
    echo "Please select model";
} else if (empty($color)) {
    echo "Please select colour";
} else if (empty($title)) {
    echo "Please enter product title";
} else if (empty($condition)) {
    echo "Please select condition";
} else if (empty($price)) {
    echo "Please enter price amount";
} else if (empty($qty)) {
    echo "Please enter quantity";
} else if (empty($dwc)) {
    echo "Please enter Delivery within Colombo amount";
} else if (empty($doc)) {
    echo "Please enter Delivery out of Colombo amount";
} else if (empty($description)) {
    echo "Please add description";
} else {

    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`=' ".$model."' AND 
`brand_brand_id`='" . $brand . "'");

    $model_has_brand_id;

    $model_has_brand_num = $model_has_brand_rs->num_rows;

    if ($model_has_brand_num > 0) {

        $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
        $model_has_brand_id = $model_has_brand_data["id"];
    } else {

        Database::iud("INSERT INTO `model_has_brand` (`model_model_id`,`brand_brand_id`) VALUES 
    ('" . $model . "','" . $brand . "')");

        $model_has_brand_id = Database::$connection->insert_id;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
    `delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`condition_condition_id`,`status_status_id`,`user_email`) 
    VALUES ('" . $price . "','" . $qty . "','" . $description . "','" . $title . "','" . $date . "','" . $dwc . "','" . $doc . "','" . $category . "','" . $model_has_brand_id . "',
    '" . $condition . "','" . $status . "','" . $email . "')");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 1 && $length > 0) {

        $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {

                $image_files = $_FILES["image" . $x];
                $file_extension = $image_files["type"];

                if (in_array($file_extension, $allowed_image_extensions)) {

                    $new_img_extension;

                    if ($file_extension == "image/jpeg") {
                        $new_img_extension = ".jpeg";
                    } else if ($file_extension == "image/png") {
                        $new_img_extension = ".png";
                    } else if ($file_extension == "image/svg+xml") {
                        $new_img_extension = ".svg";
                    }

                    $file_name = "resources/product_img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($image_files["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img` (`img_path`,`product_id`) VALUES 
                    ('" . $file_name . "','" . $product_id . "')");
                } else {
                    echo "Invalid image type!";
                }
            }
        }

        Database::iud("INSERT INTO `product_has_color` (`product_id`,`color_clr_id`) VALUES 
                    ('" . $product_id . "','" . $color . "')");

        echo ("success");
    } else {
        echo "Invalid image count";
    }
}

?>