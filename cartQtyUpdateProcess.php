<?php

include "connection.php";

if (isset($_GET["qty"]) & isset($_GET["id"])) {
    
    $qty = $_GET["qty"];
    $cart_id = $_GET["id"];

    Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `cart_id`='".$cart_id."'");
    echo "updated";

} else {
    echo "Something went wrong";
}

?>