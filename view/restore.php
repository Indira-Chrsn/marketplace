<?php
include('../Config/init.php');
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();

$products = $productController->getAllProduct("WHERE deleted_at IS NOT NULL");

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $ids = $_POST["restore_selected"];
//     $productController->multipleRestore($ids);
//     header("Location: ../index.php");
// }
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

    <form action="restore_data.php" method="post">
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
                    <!-- <td>
                        <form action="restore_data.php" method="post">
                            <input type="hidden" name="restore_selected[]" value="<?php echo $product["id"]; ?>">
                            <input type="hidden" name="isMultiple" value="false">
                            <input type="submit" style="border: none;" value="Restore">
                        </form>
                    </td> -->
                    <td>
                        <input type="checkbox" name="restore_selected[]" value="<?php echo $product["id"] ?>">
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
    <input type="submit" value="restore selected products">
    </form>
</body>
</html>