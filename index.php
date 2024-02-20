<?php
include('Config/init.php');
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

$products = $productController->getAllProduct("WHERE deleted_at IS NULL");

/*
$sql = "SELECT * FROM products WHERE deleted_at IS NULL";
$result = $db->query($sql);

$products = $result->fetchAll(PDO::FETCH_ASSOC);


if ($result->rowCount() > 0){
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $products[] = $row;
    }
}
$conn = null;
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = $_POST["delete_selected"];
    $productController->multipleDelete($ids);
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Product List</h2>
    <a href="<?php echo BASE_URL . "/view/create.php"?>">Add Product</a> | <a href="<?php echo BASE_URL . "/view/restore.php"?>">Restore Deleted Product</a>
    <br><br>

    <form action="" method="post">
        <table>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Total Price</th>
                <th></th>
            </tr>

            <?php if (count($products) > 0) : ?>
                <?php $counter = 1 ?>
                <?php foreach ($products as $product) : ?>
                    <?php $totalPrice = $product["price"] * $product["quantity"] ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $product["product_name"] ?></td>
                        <td><?php echo $product["price"] ?></td>
                        <td><?php echo $product["quantity"] ?></td>
                        <td><?php echo $totalPrice ?></td>
                        <td>
                            <a href="view/detail.php?id=<?php echo $product["id"] ?>">View</a>
                            <a href="view/update.php?id=<?php echo $product["id"] ?>">Update</a>
                            <a href="view/delete.php?id=<?php echo $product["id"] ?>">Delete</a>
                        </td>
                        <td>
                            <input type="checkbox" name="delete_selected[]" value="<?php echo $product["id"] ?>">
                        </td>
                    </tr>
                    <?php $counter++ ?>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="5"> 0 result</td>
                </tr>
            <?php endif ?>
        </table>
        <input type="submit" value="Delete selected products">
    </form>
</body>
</html>