<?php

session_start();

include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];

if (empty($email)) {
    echo "Please enter your Email";
} else if (strlen($email) > 100) {
    echo "Email must have less than 100 characters";
} else if (empty($password)) {
    echo "Please enter your Password";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' LIMIT 1");
    $num = $rs->num_rows;

    if ($num == 1) {

        $row = $rs->fetch_assoc();

        $hashed_password = $row["password"];
        
        if ($row["user_type_id"] == 1) {
            
            if (!password_verify($password, $hashed_password)) {
            
                echo "Invalid Password! Please try again";

            } else {

                echo "Success";

                $rs1 = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");

                $ad = $rs1->fetch_assoc();

                $_SESSION["a"] = $ad;

            }

        } else {

            echo "You're not an Admin";

        }

    } else {

        echo "You don't have an Admin account";

    }

}

?>