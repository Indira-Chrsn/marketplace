<?php
include PROJECT_ROOT . '/Model/ProductModel.php';

class ProductController {
    private $table;
    private $model;

    public function __construct() {
        $this->table = "products";
        $this->model = new ProductModel($this->table);
    }

    // getAll
    public function getAllProduct() {
        return $this->model->GetAllProduct();
    }

    // get by id
    public function getProductById($id) {
        return $this->model->GetProductById($id);
    }

    // get soft deleted data
    public function getSoftDeletedProducts() {
        return $this->model->getSoftDeletedProducts();
    }

    // create
    public function addProduct($product) {
        return $this->model->addProduct($product);
    }

    // update
    public function updateProduct($product) {
        return $this->model->updateProduct($product);
    }

    // delete
    public function deleteProduct($id) {
        return $this->model->deleteProduct($id);
    }

    // recover
    public function recoverProduct($id) {
        return $this->model->restoreProduct($id);
    }

    // multiple delete
    public function multipleDelete($ids) {
        return $this->model->multipleDelete($ids);
    }

    // multiple restore
    public function multipleRestore($ids) {
        return $this->model->multipleRestore($ids);
    }
}

/*
    // create
    function create($db, $product) {
        $db->createProduct($db->conn, $product);
        $productName = $product->productName;
        $price = $product->price;
        $quantity = $product->quantity;
        $description = $product->description;
    }

    // update
    function update($db, $product) {
        $db->updateProduct($db->conn, $product);
    }

    // delete
    function delete($db, $id) {
        $db->deleteProduct($db->conn, $id);
    }

    // restore
    function restore($db, $id) {
        $db->restoreDeletedProduct($db->conn, $id);
    }
*/
?>