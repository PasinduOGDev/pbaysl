<?php

include "connection.php";

$category = $_POST["c"];

if (empty($category)) {
    echo "Please enter a Category";
} else {

    $rs = Database::search("SELECT * FROM `category` WHERE `category_name` = '".$category."'");
    $num = $rs->num_rows;

    if ($num > 0) {
        
        echo "Category already Exists";

    } else {

        Database::iud("INSERT INTO `category` (`category_name`) VALUES ('".$category."')");
        echo "success";

    }

}

?>