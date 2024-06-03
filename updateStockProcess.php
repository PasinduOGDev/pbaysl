<?php

include "connection.php";

$select_product = $_POST["sp"];
$qty = $_POST["q"];
$unit_price = $_POST["up"];

if (empty($select_product)) {
    echo "Please select a product";
} else if (empty($qty)) {
    echo "Please enter quantity amount";
} else if (empty($unit_price)) {
    echo "Please enter unit price";
} else {

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='". $select_product ."'");
    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        
        Database::iud("UPDATE `product` SET `price`='".$unit_price."', `qty`='".$qty."' WHERE `id`='".$select_product."'");
        echo "success";

    } else {

        echo "Product not found!";

    }

}

?>