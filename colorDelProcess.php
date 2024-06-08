<?php

include "connection.php";

$color = $_POST["col"];

if (empty($color)) {
    echo "Please enter a Colour";
} else {

    $rs = Database::search("SELECT * FROM `color` WHERE `clr_name` = '" . $color . "'");
    $num = $rs->num_rows;

    if ($num > 0) {

        // Check if the category has associated products
        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_has_color` ON 
        product.id=product_has_color.product_id INNER JOIN `color` ON product_has_color.color_clr_id=color.clr_id 
        WHERE `clr_name`='".$color."'");
        $product_num = $product_rs->num_rows;

        if ($product_num > 0) {
            echo "Colour has associated products";
        } else {
            // Delete the category
            Database::iud("DELETE FROM `color` WHERE `clr_name`='" . $color . "'");
            echo "deleted";
        }

    } else {

        echo "Colour does not Exists";

    }
}

?>