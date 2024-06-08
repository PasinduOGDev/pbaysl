<?php

include "connection.php";

$category = $_POST["c"];

if (empty($category)) {
    echo "Please enter a Category";
} else {

    $rs = Database::search("SELECT * FROM `category` WHERE `category_name` = '" . $category . "'");
    $num = $rs->num_rows;

    if ($num > 0) {

        // Check if the category has associated products
        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id` IN (SELECT `cat_id` FROM `category` WHERE `category_name` = '" . $category . "')");
        $product_num = $product_rs->num_rows;

        if ($product_num > 0) {
            echo "Category has associated products";
        } else {
            // Delete the category
            Database::iud("DELETE FROM `category` WHERE `category_name`='" . $category . "'");
            echo "deleted";
        }

    } else {

        echo "Category does not Exists";

    }
}

?>