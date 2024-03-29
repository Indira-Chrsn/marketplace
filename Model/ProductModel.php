<?php
include PROJECT_ROOT . '/Database/database.php';

class ProductModel {
    private $table;
    private $fillable = ['id', 'product_name', 'price', 'quantity', 'description'];
    private $createColls = ['product_name', 'price', 'quantity', 'description'];

    private $getAllQueryFilter = "WHERE deleted_at IS NULL";

    private $db;

    public function __construct($table) {
        $this->table = $table;
        $this->db = new Database($this->table);
    }

    // GetAll
    public function GetAllProduct($getQueryFilter) {
        return $this->db->getAllData($getQueryFilter);
    }

    // get by id
    public function GetProductById($id) {
        return $this->db->getDataById($id);
    }

    // get deleted product
    public function getSoftDeletedProducts() {
        return $this->db->getSoftDeletedData();
    }

    // create
    public function addProduct($product) {
        // var_dump($product);
        $collValues = array();
        foreach ($product as $value) {
            $collValues[] = $value;
        }

        return $this->db->createData($this->createColls, $collValues);
    }

    // update
    public function updateProduct($id, $product) {
        $collValues = array ();
        foreach ($product as $value) {
            $collValues[] = $value;
        }

        return $this->db->updateData($id, $this->createColls, $collValues);
    }

    // delete
    public function deleteProduct($id) {
        return $this->db->deleteProduct($id);
    }

    // recover
    public function restoreProduct($id) {
        return $this->db->restoreDeletedProduct($id);
    }

    // multiple delete
    public function multipleDelete($ids) {
        return $this->db->deleteMultipleProducts($ids);
    }

    // multiple restore
    public function multipleRestore($ids) {
        return $this->db->restoreMultipleProducts($ids);
    }
}

// $product = new Product();
// $product->productName = $_POST["product_name"];
// $product->price = $_POST["price"];
// $product->quantity = $_POST["quantity"];
// $product->description = $_POST["description"];

?>