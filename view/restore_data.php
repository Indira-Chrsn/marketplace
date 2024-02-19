<?php
include '../Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productController = new ProductController();
    $id = $_POST['id'];
    
    $productController->recoverProduct($id);
}
?>