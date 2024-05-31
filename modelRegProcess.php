<?php

include "connection.php";

$model = $_POST["m"];

if (empty($model)) {
    echo "Please enter a Model";
} else {

    $rs = Database::search("SELECT * FROM `model` WHERE `model_name` = '".$model."'");
    $num = $rs->num_rows;

    if ($num > 0) {
        
        echo "Model already Exists";

    } else {

        Database::iud("INSERT INTO `model` (`model_name`) VALUES ('".$model."')");
        echo "success";

    }

}

?>