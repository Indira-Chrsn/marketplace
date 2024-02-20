<?php
include '../Config/init.php';
include PROJECT_ROOT . '/Controller/ProductController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productController = new ProductController();

    $ids = $_POST["restore_selected"];
    
    if (count($ids) == 1) {
        $productController->recoverProduct($ids[0]);
    }else {
        $ids = $_POST["restore_selected"];
        $productController->multipleRestore($ids);
    }
    header("Location: ../index.php");
}
?>