<?php

include "connection.php";

if (isset($_GET["id"])) {
    $invoice_id = $_GET["id"];

    Database::iud("DELETE FROM `invoice` WHERE `invoice_id`='".$invoice_id."'");
    echo "removed";

} else {

    echo "Something went wrong";

}

?>