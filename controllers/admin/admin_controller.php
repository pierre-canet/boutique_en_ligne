<?php
require_admin();
function admin_index()
{
    $data = [];

    load_view_with_layout('admin/index', $data, 'admin_layout');
}
function admin_product_management()
{
    $products = get_all_products();
    foreach ($products as &$product) {
        $product['price'] = get_product_price($product['id']);
    }
    unset($product);
    $data = [
        'title' => 'gestion produits',
        'products' => $products,
    ];

    load_view_with_layout('admin/product_management', $data, 'admin_layout');
}
