<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$pcode = $_POST["pc"];
$city = $_POST["c"];
$district = $_POST["d"];
$province = $_POST["p"];

if (empty($fname)) {
    echo "Please enter your first name";
} else if (empty($lname)) {
    echo "Please enter your last name";
} else if (empty($line1)) {
    echo "Please enter Address line 1";
} else if (empty($line2)) {
    echo "Please enter Address line 2";
} else if (empty($pcode)) {
    echo "Please enter your postal code";
} else if (empty($city)) {
    echo "Please select city";
} else if (empty($district)) {
    echo "Please select district";
} else if (empty($province)) {
    echo "Please select province";
} else {

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "' WHERE `email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");

        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {

            Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "',
            `city_city_id`='" . $city . "',`postal_code`='" . $pcode . "' WHERE `user_email`='" . $email . "'");
        } else {

            Database::iud("INSERT INTO `user_has_address`(`user_email`,`city_city_id`,`line1`,`line2`,`postal_code`) 
            VALUES ('" . $email . "','" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "')");
        }

        if (sizeof($_FILES) == 1) {

            $image = $_FILES["i"];
            $image_extension = $image["type"];

            $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

            if (in_array($image_extension, $allowed_image_extensions)) {
                $new_img_extension;

                if ($image_extension == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($image_extension == "image/png") {
                    $new_img_extension = ".png";
                } else if ($image_extension == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                $file_name = "resources//profile_images//" . $fname . "_" . uniqid() . $new_img_extension;
                move_uploaded_file($image["tmp_name"], $file_name);

                $profile_img_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email` = '" . $email . "'");

                $profile_img_num = $profile_img_rs->num_rows;

                if ($profile_img_num == 1) {
                    
                    Database::iud("UPDATE `user_img` SET `path`='".$file_name."' WHERE `user_email`='".$email."'");
                    echo "updated";

                } else {

                    Database::iud("INSERT INTO `user_img`(`path`,`user_email`) VALUES ('".$file_name."','".$email."')");
                    echo "saved";

                }

            }

        } elseif (sizeof($_FILES) == 0) {
            
            echo "You have not selected any image!";

        } else {
            echo "You must select only one photo!";
        }

    } else {
        echo "Invalid user!";
    }

}

?>