<?php
if (!defined('MODELS_PATH')) {
    define('MODELS_PATH', dirname(__DIR__) . '/models');
}
function product_index() {
    $category_id = $_GET['category'] ?? null;

    if ($category_id && is_numeric($category_id)) {
        $products = get_products_by_category($category_id);
        $cat_info = db_select_one("SELECT category_name FROM product_category WHERE id = ?", [$category_id]);
        $current_category_name = $cat_info ? $cat_info['category_name'] : 'Catégorie';
    } else {
        $products = get_all_products();
        $current_category_name = 'SHOP ALL!';
        $category_id = null;
    }

    $data = [
        'title'                 => 'Shop All!',
        'message'               => count($products) . ' ITEMS READY TO GRAB',
        'categories'            => get_all_categories(),
        'products'              => $products,
        'current_category_id'   => $category_id,
        'current_category_name' => $current_category_name
    ];

    load_view_with_layout('products/index', $data);
}