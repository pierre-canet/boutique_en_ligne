<?php
require_admin();
function admin_index()
{
    $data = [];

    load_view_with_layout('admin/index', $data, 'admin_layout');
}
function admin_product_management()
{
    $data = [
        'title' => 'gestion produits',
        'products' => get_all_products_infos(),
        'categories' => get_all_categories()
    ];

    load_view_with_layout('admin/product_management', $data, 'admin_layout');
}
