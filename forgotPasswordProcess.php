<?php

session_start();

include "connection.php";

include "email_resources/SMTP.php";
include "email_resources/Exception.php";
include "email_resources/PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (empty($email)) {
    echo "Please enter your Email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email";
} else {

    if (isset($_GET["e"])) {

        $email = $_GET["e"];

        $_SESSION["fu"] = $email;

        $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        $num = $rs->num_rows;

        if ($num == 1) {

            $user_data = $rs->fetch_assoc();

            $fname = $user_data["fname"];
            $lname = $user_data["lname"];

            $otp = rand(100000, 999999);
            Database::iud("UPDATE `user` SET `verification_code`='" . $otp . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '***********************';
            $mail->Password = '***************';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('***********************', 'Reset Password');
            $mail->addReplyTo('***********************', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Pbay Forgot password Verification';
            $bodyContent = '<div style="text-align: start;">
    
            <img src="https://i.postimg.cc/gk8bBgJw/shadow-logo.png" width="60px" style="text-align: center;">
    
            <div style="margin-top: 25px;">
                <span style="font-family: sans-serif;">Hi '.$fname. " " .$lname.',</span>
                <h4 style="font-family: sans-serif;">Thank you for using Pbay&trade; Shopping Application</h4>
            </div>
    
            <div style="border: 1px solid black; padding: 10px;">
                <h4 style="font-family: sans-serif;">OTP Passcode: '.$otp.' </h4>
                <h5 style="font-family: sans-serif; color: gray;">(Attention: Please do not share with anyone)</h5>
            </div>
    
            <div style="margin-top: 25px;">
                <h6 style="font-family: sans-serif;">Thank your for using Pbay...</h6>
                <h6 style="font-family: sans-serif;">Copyright &copy; 2024 Pbay&trade; All Rights Reserved.</h6>
            </div>
    
        </div>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "OTP sending failed";
            } else {
                echo "Success";
            }

        } else {

            echo "Invalid Email Address";

        }

    } else {

        echo "Please enter your Email in the Email field";

    }

}

?>
