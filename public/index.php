<?php
header('Content-Type: application/json');

$request = $_GET['request'] ?? '';

$routes = [
    'api/v1/create-product' => '../src/apis/create-product.php',
    'api/v1/get-all-products' => '../src/apis/get-all-products.php',
    'api/v1/get-product-by-id' => '../src/apis/get-product-by-id.php',
    'api/v1/update-product' => '../src/apis/update-product.php',
    'api/v1/delete-product' => '../src/apis/delete-product.php',
];

if ($request === '') {
    echo json_encode([
        "status" => true,
        "data" => "OK : Homepage",
    ]);
} 

else if ($request === 'api') {
    echo json_encode([
        "status" => true,
        "data" => "OK : API",
    ]);
} 

else if ($request === 'api/v1') {
    echo json_encode([
        "status" => true,
        "data" => "OK : API - v1",
    ]);
} 

else if (isset($routes[$request])) {
    include $routes[$request];
} 

else {
    echo json_encode([
        'status' => false,
        'data' => "Can't find this URL on this server.",
    ]);
}

?>
