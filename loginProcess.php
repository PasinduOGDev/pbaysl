<?php

session_start();

include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["rm"];

if (empty($email)) {
    echo "Enter your Email!";
} else if (strlen($email) > 100) {
    echo ("Email must contain lower than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($password)) {
    echo "Enter your Password";
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must contain 5 to 20 characters");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' LIMIT 1");

    $row = $rs->fetch_assoc();

    if ($row === null) {
        echo "User not found! Please register.";
    } else {
        $hashed_password = $row["password"];

        if (!password_verify($password, $hashed_password)) {

            echo "Invalid Password! Please try again";

        } else {

            $num = $rs->num_rows;

            if ($num == 1) {

                echo ("Success");
                $rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
                $d = $rs1->fetch_assoc();
                $_SESSION["u"] = $d;

                if ($rememberme == "true") {

                    setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                    setcookie("password", $password, time() + (60 * 60 * 24 * 365));

                } else {

                    setcookie("email", "", -1);
                    setcookie("password", "", -1);

                }

            } else {

                echo "User has not registered! Please Register!";

            }
        }
    }
}

?>