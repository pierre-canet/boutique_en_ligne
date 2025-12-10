<?php
header('Content-Type: application/json');

$bootstrapPath = __DIR__ . '/../bootstrap.php';
if (!file_exists($bootstrapPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'bootstrap not found', 'path' => $bootstrapPath]);
    exit;
}
include_once $bootstrapPath;

if (!function_exists('get_subcategories')) {
    http_response_code(500);
    echo json_encode(['error' => 'get_subcategories function not available']);
    exit;
}

try {
    if (isset($_GET['debug']) && $_GET['debug'] == '1') {
        $all = get_all_categories();
        echo json_encode(['debug' => true, 'count' => count($all), 'categories' => $all]);
        exit;
    }

    if (!isset($_GET['parent_id'])) {
        echo json_encode([]);
        exit;
    }

    $parent_id = (int)$_GET['parent_id'];
    $subs = get_subcategories($parent_id);

    if ($subs === false || $subs === null) {
        echo json_encode([]);
        exit;
    }

    echo json_encode($subs);
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'exception', 'message' => $e->getMessage()]);
    exit;
}
