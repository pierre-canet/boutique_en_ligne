<?php

require_once '../bootstrap.php';
header('Content-Type: application/json');

// Le reste du code...

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = $_GET['q'] ?? '';
    $products = search_products($search);

    echo json_encode($products);
}