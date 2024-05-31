<?php

include "connection.php";

$brand = $_POST["b"];

if (empty($brand)) {
    echo "Please enter a Brand";
} else {

    $rs = Database::search("SELECT * FROM `brand` WHERE `brand_name` = '".$brand."'");
    $num = $rs->num_rows;

    if ($num > 0) {
        
        echo "Brand already Exists";

    } else {

        Database::iud("INSERT INTO `brand` (`brand_name`) VALUES ('".$brand."')");
        echo "success";

    }

}

?>