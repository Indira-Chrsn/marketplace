<?php
include PROJECT_ROOT . '/Database/database.php';

class ProductModel {
    private $fillable = ['id', 'product_name', 'price', 'quantity', 'description'];

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // GetAll
    public function GetAllProduct() {
        return $this->db->getAllProduct();
    }

    // get by id
    public function GetProductById($id) {
        return $this->db->getProductById($id);
    }

    // get deleted product
    public function getSoftDeletedProducts() {
        return $this->db->getSoftDeletedData();
    }

    // create
    public function addProduct($product) {
        var_dump($product);
        return $this->db->createProduct($product['product_name'], $product['price'], $product['quantity'], $product['description']);
    }

    // update
    public function updateProduct($product) {
        return $this->db->updateProduct($product);
    }

    // delete
    public function deleteProduct($id) {
        return $this->db->deleteProduct($id);
    }

    // recover
    public function restoreProduct($id) {
        return $this->db->restoreDeletedProduct($id);
    }
}

// $product = new Product();
// $product->productName = $_POST["product_name"];
// $product->price = $_POST["price"];
// $product->quantity = $_POST["quantity"];
// $product->description = $_POST["description"];

?>