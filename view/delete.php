<?php
include('../Config/init.php');
include('../Controller/ProductController.php');

$productController = new ProductController();

if (isset($_GET["delete_selected"])) {
    $ids = $_GET["delete_selected"];
} else if (isset($_POST["delete_selected"])){
    $ids = $_POST["delete_selected"];
}

if (count($ids) > 1) {
    $stringIds = implode(', ',$ids);
    $sql = "WHERE id IN ($stringIds)";
} else {
    $sql = "WHERE id = " . $ids[0];
}

$products = $productController->getAllProduct($sql);
// $product = $productController->getProductById($id);

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
    // $productController->deleteProduct($_POST['id']);
    $selected_products = explode(', ', $_POST['selected_products']);

    $productController->multipleDelete($selected_products);
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

        <form action="" method="post">
            <table>
                <?php if (count($products) > 0) : ?>
                    <?php foreach ($products as $product) : ?>
                        <?php $ids[] = $product['id']; ?>
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
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">0 result</td>
                    </tr>
                <?php endif ?>
            </table>
            <?php 
                $selectedProducts = implode(', ',$ids);
                if (count($ids) == 1) {
                    $selectedProducts = $ids[0];
                }
            ?>
            <input type="hidden" name="selected_products" value="<?php echo $selectedProducts ?>">
            <input type="submit" value="Delete">
        </form>
    </body>
</html>