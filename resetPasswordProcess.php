<?php

session_start();

include "connection.php";

$email = $_SESSION["fu"];
$otp = $_POST["o"];
$new_password = $_POST["np"];
$confirm_password = $_POST["cp"];

if (empty($new_password)) {
    echo "Please enter a new password";
} else if (strlen($new_password) < 5 || strlen($new_password) > 20) {
    echo "Password must be between 5 to 20 characters";
} else if (!preg_match("/[0-9]/", $new_password)) {
    echo "Password must contain a Number";
} else if (!preg_match("/[a-z]/", $new_password)) {
    echo "Password must contain a Letter";
} else if (!preg_match("/[!,@,#,$,%,&,*]/", $new_password)) {
    echo "Password must contain a Special character";
} else if (empty($confirm_password)) {
    echo "Please confirm your password";
} else if ($new_password != $confirm_password) {
    echo "Passwords did not match";
} else if (empty($otp)) {
    echo "Please enter your OTP Password";
} else if (strlen($otp) > 6) {
    echo "OTP Passcode must have 6 characters";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $otp . "' LIMIT 1");

    $row = $rs->fetch_array();
    $hashed_password = $row["password"];

    if (password_verify($new_password, $hashed_password)) {

        $num = $rs->num_rows;

        if ($num == 1) {

            

            Database::iud("UPDATE `user` SET `password`='" . $new_password . "' WHERE `email`='" . $email . "'");

            echo "Success";

        } else {

            echo "Verification Failed";

        }

    }

}

?>