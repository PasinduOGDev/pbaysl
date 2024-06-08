<?php

include "connection.php";

$brand = $_POST["b"];

if (empty($brand)) {
    echo "Please enter a Brand";
} else {

    $rs = Database::search("SELECT * FROM `brand` WHERE `brand_name` = '" . $brand . "'");
    $num = $rs->num_rows;

    if ($num > 0) {

        // Check if the category has associated products
        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON 
        product.model_has_brand_id=model_has_brand.id INNER JOIN `brand` ON model_has_brand.brand_brand_id=brand.brand_id 
        WHERE `brand_name`='".$brand."'");
        $product_num = $product_rs->num_rows;

        if ($product_num > 0) {
            echo "Brand has associated products";
        } else {
            // Delete the category
            Database::iud("DELETE FROM `brand` WHERE `brand_name`='" . $brand . "'");
            echo "deleted";
        }

    } else {

        echo "Brand does not Exists";

    }
}

?>