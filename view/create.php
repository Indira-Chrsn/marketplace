<?php

include('../Config/init.php');
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
/*
jadikan dalam bentuk array
    $product->productName = $_POST["product_name"];
    $product->price = $_POST["price"];
    $product->quantity = $_POST["quantity"];
    $product->description = $_POST["description"];
    $action = $_POST["action"];
*/

    $product = array(
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description'],
    );

    // var_dump($product);
    $productController->addProduct($product);
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    <h2>Create Product</h2>
    <a href="../index.php">Back to Product</a>
    <br><br>

    <form action="" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br>

        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" required><br>

        <label for="quantity">Description:</label>
        <input type="text" id="description" name="description" required><br>

        <input type="submit" value="Create Product">
    </form>
</body>

</html>