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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset(
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

        if ($productModel->createProduct($name, $description, $price, $category, $quantity)) {

            $last_insert_id = $conn->insert_id;

            $createdRecord = $productModel->getProductById($last_insert_id);

            if ($createdRecord) {
                echo jsonResponse(true, $createdRecord);
            } else {
                echo jsonResponse(false, "Error retrieving created record");
            }
        } else {
            echo jsonResponse(false, "Error creating product");
        }
    } else {
        echo jsonResponse(false, "Required keys are missing in the JSON data.");
    }
} else {
    echo jsonResponse(false, "Invalid request method");
}

$conn->close();

?>
