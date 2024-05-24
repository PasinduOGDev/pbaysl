<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    
    if (isset($_GET["id"])) {
        
        $product_id = $_GET["id"];
        $user_email = $_SESSION["u"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$product_id."' AND `user_email`='".$user_email."'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$product_id."'");
        $product_data = $product_rs->fetch_assoc();

        $product_qty = $product_data["qty"];

        if ($cart_num == 1) {
            
            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if ($product_qty >= $new_qty) {

                Database::iud("UPDATE `cart` SET `qty`=".$new_qty." WHERE `cart_id`='".$cart_data["cart_id"]."'");
                echo ("updated");

            } else {

                echo ("invalid");

            }

        } else {

            Database::iud("INSERT INTO `cart` (`qty`, `user_email`, `product_id`) VALUES ('1', '".$user_email."', '".$product_id."')");
            echo ("added");

        }

    } else {

        echo ("Someting went wrong!");

    }

} else {

    echo ("Please Login First");

}

?>