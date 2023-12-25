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

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id !== null) {
        $productModel = new Product($conn);

        if ($productModel->deleteProduct($id)) {
            echo jsonResponse(true, "Product deleted successfully");
        } else {
            echo jsonResponse(false, "Error deleting product");
        }
    } else {
        echo jsonResponse(false, "Invalid or missing 'id' parameter");
    }
} else {
    echo jsonResponse(false, "Invalid request method");
}

$conn->close();

?>
