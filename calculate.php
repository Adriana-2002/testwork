<?php
require_once 'backend/sdbh.php';
$dbh = new sdbh();

$product_id = $_POST['product'];
$days = (int)$_POST['days'];
$selected_services = isset($_POST['services']) ? $_POST['services'] : [];

// Получение данных о продукте
$product_result = $dbh->mselect_rows('a25_products', ['ID' => $product_id], 0, 1, 'ID');
if (!$product_result) {
    die("Request execution error or empty result.");
}

$product = $product_result[0];

$price = (float)$product['PRICE'];
if (!empty($product['TARIFF'])) {
    $tariffs = unserialize($product['TARIFF']);
    foreach ($tariffs as $days_limit => $tariff_price) {
        if ($days >= (int)$days_limit) {
            $price = (float)$tariff_price;
        }
    }
}

$total_cost = $price * $days;
$services_result = $dbh->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id');

$services_row = $services_result[0];
$services = unserialize($services_row['set_value']);

foreach ($selected_services as $service_key) {
    if (isset($services[$service_key])) {
        $service_cost = (float)$services[$service_key];
        $total_cost += $service_cost * $days;
    }
}

echo "Итоговая стоимость: $total_cost рублей";

?>
