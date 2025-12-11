<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

if (!isset($_GET['product_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'product_id required']);
    exit;
}

$id = (int) $_GET['product_id'];
$product = get_product_by_id($id);
if (!$product) {
    http_response_code(404);
    echo json_encode(['error' => 'not found']);
    exit;
}

// Get price
$price_row = db_select_one("SELECT price FROM product_item WHERE product_id = ?", [$id]);
$product['price'] = $price_row ? $price_row['price'] : null;

echo json_encode($product);
exit;
