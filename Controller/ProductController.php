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
    public function getAllProduct($getQueryFilter) {
        return $this->model->GetAllProduct($getQueryFilter);
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
    public function updateProduct($id, $product) {
        return $this->model->updateProduct($id, $product);
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
?>