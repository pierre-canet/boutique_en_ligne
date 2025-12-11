<?php
// Contrôleur minimal pour le panier stocké en session

if (!defined('MODELS_PATH')) {
    define('MODELS_PATH', dirname(__DIR__) . '/models');
}
require_once MODELS_PATH . '/products_model.php';

/**
 * Affiche la page du panier
 */
function cart_index()
{
    $cart = $_SESSION['cart'] ?? [];

    $total = 0;
    foreach ($cart as $item) {
        $total += ($item['price'] * $item['qty']);
    }

    $data = [
        'title' => 'Votre panier',
        'cart'  => $cart,
        'total' => $total
    ];

    load_view_with_layout('cart/index', $data);
}

/**
 * Ajoute un produit au panier via POST (JSON ou form)
 */
function cart_add()
{
    // Autoriser seulement POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        return;
    }

    // Lecture des données (JSON ou form)
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        $input = $_POST;
    }

    $id = $input['id'] ?? null;
    $qty = isset($input['qty']) ? (int)$input['qty'] : 1;

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Product id missing']);
        return;
    }

    $product = get_product_by_id($id);
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        return;
    }

    $price = get_product_price($product['id']);
    $image = $product['product_image'] ?? '';
    $name = $product['name'] ?? '';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Utiliser l'id produit comme clé
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += max(1, $qty);
    } else {
        $_SESSION['cart'][$id] = [
            'id'    => $id,
            'name'  => $name,
            'price' => (float)$price,
            'image' => $image,
            'qty'   => max(1, $qty)
        ];
    }

    // Calculer résumé
    $count = 0; $total = 0;
    foreach ($_SESSION['cart'] as $it) { $count += $it['qty']; $total += $it['price'] * $it['qty']; }

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Produit ajouté', 'count' => $count, 'total' => $total, 'cart' => array_values($_SESSION['cart'])]);
}

/**
 * Met à jour la quantité d'un produit
 */
function cart_update()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) { $input = $_POST; }

    $id = $input['id'] ?? null;
    $qty = isset($input['qty']) ? (int)$input['qty'] : null;

    if (!$id || $qty === null) {
        echo json_encode(['success' => false, 'message' => 'Missing parameters']);
        return;
    }

    if (!isset($_SESSION['cart'][$id])) {
        echo json_encode(['success' => false, 'message' => 'Item not in cart']);
        return;
    }

    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id]['qty'] = $qty;
    }

    $count = 0; $total = 0;
    foreach ($_SESSION['cart'] as $it) { $count += $it['qty']; $total += $it['price'] * $it['qty']; }

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'count' => $count, 'total' => $total, 'cart' => array_values($_SESSION['cart'])]);
}

/**
 * Supprime un produit du panier
 */
function cart_remove()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        return;
    }

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) { $input = $_POST; }

    $id = $input['id'] ?? null;
    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Missing id']);
        return;
    }

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    $count = 0; $total = 0;
    foreach ($_SESSION['cart'] as $it) { $count += $it['qty']; $total += $it['price'] * $it['qty']; }

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'count' => $count, 'total' => $total, 'cart' => array_values($_SESSION['cart'])]);
}
