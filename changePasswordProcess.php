<?php 

session_start();
include "connection.php";

$old_password = $_POST["op"];
$new_password = $_POST["np"];
$confirm_password = $_POST["cp"];
$email = $_SESSION["u"]["email"];

if (empty($old_password)) {
    echo "Please enter old password";
} else if (empty($new_password)) {
    echo "Please enter new password";
} else if (empty($confirm_password)) {
    echo "Please confirm password";
} else if ($new_password != $confirm_password) {
    echo "Password did not match";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' LIMIT 1");
    $n = $rs->num_rows;

    if ($n == 1) {

        $row = $rs->fetch_assoc();
        $hash_password = $row["password"];

        if (!password_verify($old_password, $hash_password)) {
            
            echo "Old password is invalid";

        } else {

            $hash_password = password_hash($new_password, PASSWORD_BCRYPT);

            Database::iud("UPDATE `user` SET `password`='".$hash_password."' WHERE `email`='".$email."'");
            echo "success";

        }

    } else {

        echo "Something went wrong";

    }

}

?>