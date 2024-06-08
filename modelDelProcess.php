<?php

include "connection.php";

$model = $_POST["m"];

if (empty($model)) {
    echo "Please enter a Model";
} else {

    $rs = Database::search("SELECT * FROM `model` WHERE `model_name` = '" . $model . "'");
    $num = $rs->num_rows;

    if ($num > 0) {

        // Check if the category has associated products
        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON 
        product.model_has_brand_id=model_has_brand.id INNER JOIN `model` ON model_has_brand.model_model_id=model.model_id 
        WHERE `model_name`='".$model."'");
        $product_num = $product_rs->num_rows;

        if ($product_num > 0) {
            echo "Model has associated products";
        } else {
            // Delete the category
            Database::iud("DELETE FROM `model` WHERE `model_name`='" . $model . "'");
            echo "deleted";
        }

    } else {

        echo "Model does not Exists";

    }
}

?>