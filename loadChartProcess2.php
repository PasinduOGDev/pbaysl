<?php
include "connection.php";

$rs = Database::search("SELECT DATE(order_history.order_date) as order_date, SUM(order_item.oi_qty * stock.price) as daily_income
FROM order_item
INNER JOIN stock ON order_item.stock_stock_id = stock.stock_id
INNER JOIN order_history ON order_item.order_history_ohid = order_history.ohid
GROUP BY DATE(order_history.order_date)
ORDER BY order_date ASC");

$num = $rs->num_rows;

$dates = array();
$incomes = array();

for ($i = 0; $i < $num; $i++) {
    $d = $rs->fetch_assoc();

    $dates[] = $d["order_date"];
    $incomes[] = $d["daily_income"];
}

$rs_total = Database::search("SELECT SUM(amount) as total_amount FROM order_history");
$d_total = $rs_total->fetch_assoc();

$json = array();

$json["dates"] = $dates;
$json["incomes"] = $incomes;
$json["total_amount"] = $d_total["total_amount"];

echo json_encode($json);
?>