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


/**
 *Il s'agit d'une fonction de pont permettant à la page show.php d'obtenir des informations de la base de données
 */
function product_show($id) {
    // 1. S'il n'y a pas d'identifiant, donnez une erreur

    if (!$id) {
        load_404();
        return;
    }

    // 2. Obtenez des informations sur le produit (la même fonction utilisée dans le module)

    $product = get_product_by_id($id);

    if (!$product) {
        load_404();
        return;
    }

    // 3. Obtenez le prix (la même logique que vous avez sur la page principale)

    if (function_exists('get_product_price')) {
        $product['price'] = get_product_price($product['id']);
    } else {
        $item = db_select_one("SELECT price FROM product_item WHERE product_id = ?", [$product['id']]);
        $product['price'] = $item['price'] ?? null;
    }

    // 4. Obtenez des produits associés

    $related = [];
    if (function_exists('get_related_products')) {
        $related = get_related_products($product['category_id'], $product['id'], 3);
        foreach ($related as &$rel) {
            $rel['price'] = get_product_price($rel['id']);
        }
    }

    // 5. Envoyer des informations à afficher (show.php)

    $data = [
        'title'   => $product['name'],
        'product' => $product,
        'related' => $related
    ];

    load_view_with_layout('products/show', $data);
}
function featured_index() {
    $fresh_drops = get_all_products(3, 0); 

    $hot_picks = get_all_products(3, 3);   

    $candy_universe = get_all_products(3, 6); 

    foreach ($fresh_drops as &$p) { $p['price'] = get_product_price($p['id']); }
    foreach ($hot_picks as &$p)   { $p['price'] = get_product_price($p['id']); }
    foreach ($candy_universe as &$p) { $p['price'] = get_product_price($p['id']); }
    unset($p);

    $data = [
        'title'          => 'Home Sweet Home',
        'message'        => 'Welcome to the Candy Shop',
        'fresh_drops'    => $fresh_drops,
        'hot_picks'      => $hot_picks,
        'candy_universe' => $candy_universe
    ];

    load_view_with_layout('home/index', $data); 
}