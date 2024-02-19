<?php
include('../Config/init.php');
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

$products = $productController->getSoftDeletedProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Deleted Product</title>
    <style>
        table {
            border-collapse: collapse;
            width: 85%;
        }
        th, td {
            border: 1px, solid #dddddd;
            text-allign: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Deleted Product List</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php if (count($products) > 0) : ?>
            <?php $counter = 1 ?>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $product["product_name"] ?></td>
                    <td><?php echo $product["price"] ?></td>
                    <td><?php echo $product["quantity"] ?></td>
                    <td><?php echo $product["description"] ?></td>
                    <td>
                        <form action="restore_data.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
                            <input type="submit" style="border: none;" value="Restore">
                        </form>
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
</body>
</html>