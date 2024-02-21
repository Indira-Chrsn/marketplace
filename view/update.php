<?php
include '../Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

$id = $_GET['id'];
// var_dump($id);
$product = $productController->getProductById($id);

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $product = array(
//         'product_name' => $_POST["product_name"],
//         'price' => $_POST["price"],
//         'quantity' => $_POST["quantity"],
//         'description' => $_POST["description"]
//     );
//     $productController->updateProduct($id, $product);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <h2>Update Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
    <form action="../Handler/add_product.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <input type="hidden" name="action" value="update">

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>"><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>"><br>

        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>"><br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $product["description"]; ?>"> <br>

        <input type="submit" value="Update product">
    </form>
</body>

</html>