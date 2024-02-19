<?php
include('Config/db.php');

// create method
function createProduct($conn) {
    $var_dump = ($_POST);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = $_POST["product_name"];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];

        try {
            $stmt = $conn->prepare("INSERT INTO products (product_name, price, quantity, description) VALUES (:product_name, :price, :quantity, :description)");
            $stmt->bindParam(':product_name', $productName);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Update method
function updateProduct($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $productName = $_POST["product_name"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $description = $_POST["description"];

        try {
            $stmt = $conn->prepare("UPDATE products SET product_name=:product_name, price=:price, quantity=:quantity, description=:description WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':product_name', $productName);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

// Delete method
function deleteProduct($conn) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// var_dump($_POST);
// $conn = null;

if ($_SERVER["REQUEST_METHOD"]  == "POST"){
    $action = $_POST["action"]; //assign variable $action dengan jenis action yang ditangkap dari form
    // memanggil fungsi sesuai action yang ditangkap
    switch ($action) {
        case "create":
            createProduct($conn);
            break;
        case "update":
            updateProduct($conn);
            break;
        default:
            break;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET["action"];
    if ($action == "delete") {
        deleteProduct($conn);
    }
} else {
    // jika form tidak dikirim melalui metode POST
    echo "Akses tidak sah";
}

$conn = null;
?>