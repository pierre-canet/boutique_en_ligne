<?php
require_once '../bootstrap.php';
header('Content-Type: application/json');

$category_id = $_GET['category'] ?? null;
$direct_only = isset($_GET['direct']) && in_array($_GET['direct'], ['1', 'true']);

$products = $category_id
    ? ($direct_only && function_exists('get_products_by_category_direct')
        ? get_products_by_category_direct($category_id)
        : get_products_by_category($category_id))
    : get_all_products();

foreach ($products as &$p) {
    $price_row = db_select_one("SELECT price FROM product_item WHERE product_id = ?", [$p['id']]);
    $p['price'] = $price_row['price'] ?? 9.99;

    $img = trim($p['product_image'] ?? '');
    if (empty($img)) {
        $p['product_image'] = '/assets/images/default.jpg';
    } else {
        $p['product_image'] = '/' . ltrim($img, '/'); 
    }
}

echo json_encode(['products' => $products]);
exit;