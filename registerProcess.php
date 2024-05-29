<?php

include "connection.php";
include "email_resources/SMTP.php";
include "email_resources/Exception.php";
include "email_resources/PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$mobile = $_POST["m"];
$password = rand(10000000, 99999999);
$agreebox = $_POST["a"];

if (empty($fname)) {
    echo "Please enter your First Name";
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
} else if (empty($mobile)) {
    echo "Please enter a Mobile Number";
} else if (strlen($mobile) != 10) {
    echo "Mobile Number must contain 10 characters";
} else if ($agreebox != "true") {
    echo "Please accept our terms and conditions";
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");


    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mobile . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("This Email or Mobile is Already Exists");
    } else {

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pasinduogdev@gmail.com';
        $mail->Password = 'kfsjiraxzliobkao';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('Pbay Sri Lanka', 'Login Password');
        $mail->addReplyTo('Pbay Sri Lanka', 'Login Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Pbay User Registration Verification';
        $bodyContent = '<div style="text-align: start;">
    
        <img src="https://i.postimg.cc/gk8bBgJw/shadow-logo.png" width="60px" style="text-align: center;">

        <div style="margin-top: 25px;">
            <span style="font-family: sans-serif;">Hi ' . $fname . " " . $lname . ',</span>
            <h4 style="font-family: sans-serif;">Thank you for using Pbay&trade; Shopping Application</h4>
        </div>

        <div style="border: 1px solid black; padding: 10px;">
            <h4 style="font-family: sans-serif;">Your Login Password: ' . $password . ' </h4>
            <h5 style="font-family: sans-serif; color: gray;">(Attention: Please do not share with anyone and you can change password anytime from your User Settings!)</h5>
        </div>

        <div style="margin-top: 25px;">
            <h6 style="font-family: sans-serif;">Thank your for using Pbay...</h6>
            <h6 style="font-family: sans-serif;">Copyright &copy; 2024 Pbay&trade; All Rights Reserved.</h6>
        </div>

    </div>';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo "Registration failed";
        } else {

            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`) VALUES
        ('" . $fname . "','" . $lname . "','" . $email . "','" . $password_hash . "','" . $mobile . "','" . $date . "')");

            echo "Success";

        }

    }

}

?>