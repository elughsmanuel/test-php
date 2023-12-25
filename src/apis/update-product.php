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

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id !== null && isset(
        $data['name'],
        $data['description'],
        $data['price'],
        $data['category'],
        $data['quantity']
    )) {
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $category = $data['category'];
        $quantity = $data['quantity'];

        $productModel = new Product($conn);

        if ($productModel->updateProduct($id, $name, $description, $price, $category, $quantity)) {
            $updatedRecord = $productModel->getProductById($id);

            if ($updatedRecord) {
                echo jsonResponse(true, $updatedRecord);
            } else {
                echo jsonResponse(false, "Error retrieving updated record");
            }
        } else {
            echo jsonResponse(false, "Error updating product");
        }
    } else {
        echo jsonResponse(false, "Required keys are missing in the JSON data for update.");
    }
} else {
    echo jsonResponse(false, "Invalid request method");
}

$conn->close();

?>
