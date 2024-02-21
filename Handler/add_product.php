<?php
include ('../Config/init.php');
include PROJECT_ROOT . '/Controller/ProductController.php';

$productController = new ProductController();
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $noError = true;

    echo $action;

    var_dump($action);
    $product = array(
        'product name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description'],
    );

    if ($action == "insert") {
        // product name validation
        if (empty($_POST['product_name'])) {
            $errors[] = " product name must be filled";
            echo "<script type='text/javascript'>alert('product name must be filled');location='../view/create.php';</script>";
            $noError = false;
        }

        // price validation
        if (empty($_POST['price'])) {
            $errors[] = " price field must be filled.";
            echo "<script type='text/javascript'>alert('Price can't be null);location='../view/create.php';</script>";
            $noError = false;
        }
        if (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
            $errors[] = "Price must be filled with positive number or zero.";
            echo "<script type='text/javascript'>alert('Price must be filled with positive number or zero.');location='../view/create.php';</script>";
            $noError = false;
        }

        // quantity validation
        if (empty($_POST['quantity'])) {
            $errors[] = "quantity field must be filled with number.";
            echo "<script type='text/javascript'>alert('Quantity can't be null.');location='../view/create.php';</script>";
            $noError = false;
        }
        if (!is_numeric($_POST['quantity']) || $_POST['quantity'] < 0) {
            $errors[] = "quantity must be filled with positive number or zero.";
            echo "<script type='text/javascript'>alert('Quantity must be filled with positive number or zero.');location='../view/create.php';</script>";
            $noError = false;
        }

        // description validation
        if (empty($_POST['description'])) {
            $errors = "Description can't be empty.";
            echo "<script type='text/javascript'>alert('Description can't be empty.');location='../view/create.php';</script>";
            $noError = false;
        }
        if (strlen($_POST['description']) > 255) {
            $error = "Description must be 255 characters";
            echo "<script type='text/javascript'>alert('Description must be 255 characters');location='../view/create.php';</script>";
            $noError = false;
        }

        // if no error found, add data to database
        if ($noError) {
            $productController->addProduct($product);
        }


        // update product
    } else if ($action == "update") {
        $id = $_POST['id'];

        if (empty($_POST['product_name'])) {
            $errors[] = " product name must be filled";
            echo "<script type='text/javascript'>alert('product name must be filled');location='../view/update.php?id=$id';</script>";
            $noError = false;
        }

        // price validation
        if (empty($_POST['price'])) {
            $errors[] = " price field must be filled.";
            echo "<script type='text/javascript'>alert('Price can't be null);location='../view/update.php?id=$id';</script>";
            $noError = false;
        }
        if (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
            $errors[] = "Price must be filled with positive number or zero.";
            echo "<script type='text/javascript'>alert('Price must be filled with positive number or zero.');location='../view/update.php?id=$id';</script>";
            $noError = false;
        }

        // quantity validation
        if (empty($_POST['quantity'])) {
            $errors[] = "quantity field must be filled with number.";
            echo "<script type='text/javascript'>alert('Quantity can't be null.');location='../view/update.php?id=$id';</script>";
            $noError = false;
        }
        if (!is_numeric($_POST['quantity']) || $_POST['quantity'] < 0) {
            $errors[] = "quantity must be filled with positive number or zero.";
            echo "<script type='text/javascript'>alert('Quantity must be filled with positive number or zero.');location='../view/update.php?id=$id';</script>";
            $noError = false;
        }

        // description validation
        if (empty($_POST['description'])) {
            $errors = "Description can't be empty.";
            echo "<script type='text/javascript'>alert('Description can't be empty.');location='../view/update.php?id=$id';</script>";
            $noError = false;
        }
        if (strlen($_POST['description']) > 255) {
            $error = "Description must be 255 characters";
            echo "<script type='text/javascript'>alert('Description must be 255 characters');location='../view/update.php?id=$id';</script>";
            $noError = false;
        }

        // if no error, update data
        if ($noError) {
            $productController->updateProduct($id, $product); 
        }
    }
}

/*
    foreach ($product as $key => $data) {
        // add
        if ($action == "insert") {
            if ($data == null) {
                echo "<script type='text/javascript'>alert('$key must be filled');location='../view/create.php';</script>";
                $noError = false;
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
*/
?>