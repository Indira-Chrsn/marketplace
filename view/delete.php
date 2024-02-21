<?php
include('../Config/init.php');
include('../Controller/ProductController.php');

$productController = new ProductController();

$id = $_GET['id'];
$ids = $_POST["delete_selected"];

$stringIds = implode(', ',$ids);

$sql = "WHERE id IN ($stringIds)";

if (is_null($id)) {
    $products = $productController->getAllProduct($sql);
}

$product = $productController->getProductById($id);

// try {
//     $stmt = $db->conn->prepare("SELECT * FROM products WHERE id = :id");
//     $stmt->bindParam(':id', $id);
//     $stmt->execute();

//     $row = [];

//     if ($stmt->rowCount() > 0) {
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
//     }
// } catch (PDOException $e){
//     echo "Error: " . $e->getMessage();
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $productController->deleteProduct($_POST['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Product</title>
    </head>

    <body>
        <h2>Delete Product</h2>
        <a href="../index.php">Back to Product List</a>
        <br><br>

            <p>Are you sure you want to delete the following product?</p>
            <table>
                <tr>
                    <td>ID:</td>
                    <td><?php echo $product["id"]; ?></td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td><?php echo $product["product_name"]; ?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>$<?php echo $product["price"]; ?></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td><?php echo $product["quantity"]; ?></td>
                </tr>
                <tr>
                    <td>description:</td>
                    <td><?php echo $product["description"]; ?></td>
                </tr>
            </table>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="submit" value="Delete">
            </form>
    </body>
</html>