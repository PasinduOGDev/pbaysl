<?php 

include "connection.php";

if (isset($_GET["id"])) {
    $cart_id = $_GET["id"];

    Database::iud("DELETE FROM `cart` WHERE `cart_id`='".$cart_id."'");
    echo "removed";

} else {

    echo "Something went wrong";

}

?>