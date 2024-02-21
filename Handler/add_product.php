<?php
include ('../Config/init.php');
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $status = true;

    echo $action;

    var_dump($action);
    $product = array(
        'product name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description'],
    );

    foreach ($product as $key => $data) {
        // add
        if ($action == "insert") {
            if ($data == null) {
                echo "<script type='text/javascript'>alert('$key must be filled');location='../view/create.php';</script>";
                $status = false;
            }

            if (($key == "price" || $key == "quantity") && !is_numeric($data)) {
                echo "<script type='text/javascript'>alert('$key must be numeric value');location='../view/create.php';</script>";
            }

            if ( is_numeric($data) && ($data < 0)) {
                // $errors['$data'] = "$data can't be negative value";
                echo "<script type='text/javascript'>alert('$key must equals to or greater than 0');location='../view/create.php';</script>";
                $status = false;
            }
            

            // check multiple products
            // $sql = "WHERE product_name = " . $_POST['product_name'];
            // $prod = $productController->getAllProduct($sql);

            if ($status) {
                $productController->addProduct($product);
            }
        } else if ($action == "update") {
            $id = $_POST['id'];

            if (($key == "price" || $key == "quantity") && !is_numeric($data)) {
                echo "<script type='text/javascript'>alert('$key must be numeric value');location='../view/update.php?id=$id';</script>";
            }

            if (is_numeric($data)) {
                if ($data < 0) {
                    // $errors['$data'] = "$data can't be negative value";
                    echo "<script type='text/javascript'>alert('$key must equals to or greater than 0');location='../view/update.php?id=$id';</script>";
                    $status = false;
                }
            }
            
            if ($data == null) {
                echo "<script type='text/javascript'>alert('$key must be filled');location='../view/update.php?id=$id';</script>";
                $status = false;
            }

            if ($status) {
                $productController->updateProduct($id, $product);
            }
        }
    }
}
?>