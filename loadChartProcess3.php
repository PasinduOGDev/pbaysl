<?php
include "connection.php";

$rs = Database::search("SELECT c.cat_name AS category_name, SUM(oi.oi_qty) AS total_sold
FROM order_item oi
INNER JOIN stock s ON oi.stock_stock_id = s.stock_id
INNER JOIN product p ON s.product_id = p.id
INNER JOIN category c ON p.category_id = c.cat_id
GROUP BY c.cat_name
ORDER BY total_sold DESC
LIMIT 3;");

$num=$rs->num_rows;

$labels=array();
$data=array();

for ($i=0; $i <$num ; $i++) {
    $d=$rs->fetch_assoc();


    $labels[]=$d["category_name"];
    $data[]=$d["total_sold"];
    # code...
}

$json=array();

$json["labels"]=$labels;
$json["data"]=$data;

echo json_encode($json);

?>