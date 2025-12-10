<?php

if (!function_exists('get_all_products')) {
    if (!defined('MODELS_PATH')) {
        define('MODELS_PATH', dirname(__DIR__) . '/models');
    }
    require_once MODELS_PATH . '/products_model.php';
}


function product_index() {
    $category_id = isset($_GET['category']) ? $_GET['category'] : null;
    
    if ($category_id !== null && !is_numeric($category_id)) {
        $category_id = null;
    }

    if ($category_id) {
        $products = get_products_by_category($category_id);
        $current_category_name = get_category_name($category_id) ?? 'Catégorie';
    } else {
        $products = get_all_products();
        $current_category_name = 'SHOP ALL!';
    }

    
    foreach ($products as &$product) {
        $product['price'] = get_product_price($product['id']); 
    }
    unset($product); 

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