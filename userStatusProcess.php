<?php

include "connection.php";
include "email_resources/SMTP.php";
include "email_resources/Exception.php";
include "email_resources/PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

$user_email = $_POST["u"];

if (empty($user_email)) {
    echo "Please enter User Email";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user_email . "' AND `user_type_id` = '2'");
    $num = $rs->num_rows;

    if ($num == 1) {

        $d = $rs->fetch_assoc();

        if ($d["status_status_id"] == 1) {

            Database::iud("UPDATE `user` SET `status_status_id`='2' WHERE `email`='" . $user_email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '***********************';
            $mail->Password = '*****************';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('Pbay Sri Lanka', 'Your Membership is banned');
            $mail->addReplyTo('Pbay Sri Lanka', 'Your Membership is banned');
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = 'Pbay Admin Council';
            $bodyContent = '<div style="text-align: start;">
    
            <img src="https://i.postimg.cc/gk8bBgJw/shadow-logo.png" width="60px" style="text-align: center;">
    
            <div style="margin-top: 25px;">
                <span style="font-family: sans-serif;">Hi ' . $d["fname"] . " " . $d["lname"] . ',</span>
                <h4 style="font-family: sans-serif;">Thank you for using Pbay&trade;</h4>
            </div>
    
            <div style="border: 1px solid black; padding: 10px;">
                <h3 style="font-family: sans-serif;">Your Membership is Temporary Banned!</h3>
                <h5 style="font-family: sans-serif; color: red;">(Attention: Please Contact Admin for reactivate your Account!)</h5>
            </div>
    
            <div style="margin-top: 25px;">
                <h6 style="font-family: sans-serif;">Thank your for using Pbay...</h6>
                <h6 style="font-family: sans-serif;">Copyright &copy; 2024 Pbay&trade; All Rights Reserved.</h6>
            </div>
    
        </div>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "Message sent failed";
            } else {
                echo "Deactivated";
            }

        }

        if ($d["status_status_id"] == 2) {

            Database::iud("UPDATE `user` SET `status_status_id`='1' WHERE `email`='" . $user_email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '***********************';
            $mail->Password = '*****************';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('Pbay Sri Lanka', 'Your Membership is banned');
            $mail->addReplyTo('Pbay Sri Lanka', 'Your Membership is banned');
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = 'Pbay Admin Council';
            $bodyContent = '<div style="text-align: start;">
    
            <img src="https://i.postimg.cc/gk8bBgJw/shadow-logo.png" width="60px" style="text-align: center;">
    
            <div style="margin-top: 25px;">
                <span style="font-family: sans-serif;">Hi ' . $d["fname"] . " " . $d["lname"] . ',</span>
                <h4 style="font-family: sans-serif;">Thank you for using Pbay&trade;</h4>
            </div>
    
            <div style="border: 1px solid black; padding: 10px;">
                <h4 style="font-family: sans-serif;">Your Membership is Successfully recovered!</h4>
            </div>
    
            <div style="margin-top: 25px;">
                <h6 style="font-family: sans-serif;">Thank your for using Pbay...</h6>
                <h6 style="font-family: sans-serif;">Copyright &copy; 2024 Pbay&trade; All Rights Reserved.</h6>
            </div>
    
        </div>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "Message sent failed";
            } else {
                echo "Activated";
            }

        }

    } else {

        echo "Invalid User Email!";

    }

}

?>
