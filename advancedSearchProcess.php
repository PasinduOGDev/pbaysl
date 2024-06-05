<?php

include "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "'";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' 
        AND `model_model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $brand != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' 
        AND `model_model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "'";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "'";
        }
    }

    if (!empty($price_from && empty($price_to))) {

        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query = " AND `price` >= '" . $price_from . "'";
        }
    }

    if (empty($price_from && !empty($price_to))) {

        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query = " AND `price` >= '" . $price_from . "'";
        }
    }

    if (!empty($price_from && !empty($price_to))) {

        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query = " AND `price` >= '" . $price_from . "'";
        }
    }
} else if ($sort == 1) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($brand == 0 && $model != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' 
        AND `model_model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($brand != 0 && $brand != 0) {
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' 
        AND `model_model_id`='" . $model . "'");

        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for ($x = 0; $x < $model_has_brand_num; $x++) {
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "' ORDER BY `price` ASC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_condition_id`='" . $condition . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "' ORDER BY `price` ASC";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from && empty($price_to))) {

        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query = " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }

    if (empty($price_from && !empty($price_to))) {

        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query = " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from && !empty($price_to))) {

        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query = " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }
}

?>