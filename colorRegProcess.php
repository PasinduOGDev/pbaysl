<?php

include "connection.php";

$color = $_POST["col"];

if (empty($color)) {
    echo "Please enter a Colour";
} else {

    $rs = Database::search("SELECT * FROM `color` WHERE `clr_name` = '".$color."'");
    $num = $rs->num_rows;

    if ($num > 0) {
        
        echo "Colour already Exists";

    } else {

        Database::iud("INSERT INTO `color` (`clr_name`) VALUES ('".$color."')");
        echo "success";

    }

}

?>