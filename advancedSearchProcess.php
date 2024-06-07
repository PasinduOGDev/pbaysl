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

$query = "SELECT * FROM `product`";
$status = 0;

if (!empty($search_txt)) {
    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
    $status = 1;
}

if ($status == 0 && $category != 0) {
    $query .= " WHERE `category_cat_id`='" . $category . "'";
    $status = 1;
} else if ($status != 0 && $category != 0) {
    $query .= " AMD `category_cat_id`='" . $category . "'";
}

$pid = 0;
if ($brand != 0 && $model == 0) {

    $brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "'");
    $brand_num = $brand_rs->num_rows;
    for ($x = 0; $x < $brand_num; $x++) {
        $brand_data = $brand_rs->fetch_assoc();
        $pid = $brand_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

if ($brand == 0 && $model != 0) {
    $model_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "'");
    $model_num = $model_rs->num_rows;
    for ($x = 0; $x < $model_num; $x++) {
        $model_data = $model_rs->fetch_assoc();
        $pid = $model_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `model_has_brand_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `model_has_brand_id`='" . $pid . "'";
    }
}

if ($brand != 0 && $model != 0) {
    $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "' AND 
    `model_model_id`='" . $model . "'");
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

if ($status == 0 && $condition != 0) {
    $query .= " WHERE `condition_condition_id`='" . $condition . "'";
    $status = 1;
} else if ($status != 0 && $condition != 0) {
    $query .= " AND `condition_condition_id`='" . $condition . "'";
}

if ($status == 0 && $color != 0) {
    $query .= " INNER JOIN `product_has_color` ON product.id=product_has_color.product_id WHERE `color_clr_id`='" . $color . "'";
    $status = 1;
} else if ($status != 0 && $color != 0) {
    $query .= " AND `color_clr_id`='" . $color . "'";
}

if (!empty($price_from) && empty($price_to)) {
    if ($status == 0) {
        $query .= " WHERE `price` >= '" . $price_from . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `price` >= '" . $price_from . "'";
    }
} else if (empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
        $query .= " WHERE `price` <= '" . $price_to . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `price` <= '" . $price_to . "'";
    }
} else if (!empty($price_from) && !empty($price_to)) {
    if ($status == 0) {
        $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }
}

?>

<?php

$pageno;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 3;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;
for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();
?>

    <?php

    $product_img = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
    $product_img_data = $product_img->fetch_assoc();

    ?>

    <div class="card my-3 mx-auto bg-body-tertiary product_card" style="width: 18rem;">
        <a class="text-body text-decoration-none" href="<?php echo "singleProductView.php?id=" . $selected_data["id"]; ?>">
            <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top" style="height: 200px;">
            <hr />
            <div class="card-body">
                <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                <?php
                if ($selected_data["condition_condition_id"] == 1) {
                ?>
                    <p class="card-text fw-bold">Condition : <span class="text-primary">Brand New</span></p>
                <?php
                } else {
                ?>
                    <p class="card-text fw-bold">Condition : <span class="text-primary">Used</span></p>
                <?php
                }
                ?>
                <span class="card-text fw-bold">Price : <span class="text-primary">Rs. <?php echo $selected_data["price"]; ?> /=</span></span><br />
                <span class="card-text fw-bold">Quantity : <span class="text-primary"><?php echo $selected_data["qty"]; ?> Items Left</span></span>
                <br /><br />
            </div>
        </a>
    </div>

<?php
}
?>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-4 mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>