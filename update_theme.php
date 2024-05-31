<?php
session_start();

include "connection.php";

$theme = $_POST["theme"];

// Update user theme in the database
Database::iud("UPDATE `user` SET `theme_id` = '$theme' WHERE `email` = '".$_SESSION["u"]."'");

// Set theme session variable
$_SESSION["theme"] = $theme;

?>