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

    if (is_post()) {
        $product_name = clean_input($_POST['']);
        $product_desc = clean_input($_POST['']);
        $product_price = clean_input($_POST['']);
        $product_stock = clean_input($_POST['']);
        $product_category = clean_input($_POST['']);
        if (empty($product_name) || empty($product_desc) || empty($product_price) || empty($product_stock) || empty($product_category)) {
            set_flash('error', 'Tous les champs du formulaire sont obligatoires.');
        } else {
        }
    };

    load_view_with_layout('admin/product_management', $data, 'admin_layout');
}
