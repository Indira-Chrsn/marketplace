<?php
include('../Config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    
    try {
        $stmt = $conn->prepare("INSERT INTO products (product_name, price, quantity, description) VALUES (:product_name, :price, :quantity, :description)");
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

$conn = null;

?>