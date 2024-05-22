<?php

include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$mobile = $_POST["m"];
$password = $_POST["p"];
$cpassword = $_POST["cp"];

if (empty($fname)) {
    echo  "Please enter your First Name";
} else if (strlen($fname) > 50) {
    echo ("First Name must contain LOWER THAN 100 characters");
} else if (empty($lname)) {
    echo "Please enter your Last Name or Surname";
} else if (strlen($lname) > 50) {
    echo ("Surname must contain LOWER THAN 100 characters");
} else if (empty($email)) {
    echo "Please enter an Email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Please enter a Valid Email";
} else if (strlen($email) > 100) {
    echo ("Email must contain LOWER THAN 100 characters");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo "Please enter a valid Mobile Number";
} else if (empty($password)) {
    echo "Please enter a Password";
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must contain 5 to 20 characters");
} else if (empty($cpassword)) {
    echo "Please confirm your Password";
} else if ($password != $cpassword) {
    echo "Password did not match";
} else if (!preg_match("/[0-9]/", $password)) {
    echo "Password must contain a Number";
} else if (!preg_match("/[a-z]/", $password)) {
    echo "Password must contain a Letter";
} else if (!preg_match("/[!,@,#,$,%,&,*]/", $password)) {
    echo "Password must contain a Special character";
} else if (empty($mobile)) {
    echo "Please enter a Mobile Number";
} else if (strlen($mobile) != 10) {
    echo "Mobile Number must contain 10 characters";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("This Email or Mobile is Already Exists");
    } else {

        Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`mobile`,`status_status_id`) VALUES
        ('".$fname."','".$lname."','".$email."','".$password."','".$mobile."','1')");

        echo "Success";

    }

}


?>