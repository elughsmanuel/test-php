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

function getAllProducts($conn) {
    $productModel = new Product($conn);
    $allProducts = $productModel->getAllProducts();

    echo jsonResponse(true, $allProducts);
}

getAllProducts($conn);
?>
