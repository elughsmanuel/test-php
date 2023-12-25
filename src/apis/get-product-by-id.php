<?php
include __DIR__ . '/../config/db.php';
include __DIR__ . '/../models/Product.php';

function jsonResponse($status, $data = null) {
    $response = array('status' => $status);
    if ($data !== null) {
        $response['data'] = $data;
    }
    return json_encode($response);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $productId = $_GET['id'] ?? null;

    if ($productId !== null) {
        $productModel = new Product($conn);
        $product = $productModel->getProductById($productId);

        if ($product !== null) {
            echo jsonResponse(true, $product);
        } else {
            echo jsonResponse(false, "Product not found");
        }
    } else {
        echo jsonResponse(false, "Missing product ID in the request");
    }
} else {
    echo jsonResponse(false, "Invalid request method");
}

$conn->close();
?>
