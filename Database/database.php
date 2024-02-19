<?php
include PROJECT_ROOT . '/Config/db.php';
// include ('../Model/product.php');

class Database {
    private $conn;

    public function __construct() {
        $servername = DB_SERVER;
        $dbname = DB_NAME;

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    // get product
    public function getAllProduct() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE deleted_at IS NULL");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    // get product by id
    public function getProductById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE id =:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get softdeleted data
    public function getSoftDeletedData() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE deleted_at IS NOT NULL");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // create
    public function createProduct($product_name, $price, $quantity, $description) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO products (product_name, price, quantity, description) VALUES (:product_name, :price, :quantity, :description)");
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // update
    public function updateProduct($product) {
        try {
            var_dump($product);
            $stmt = $this->conn->prepare("UPDATE products SET product_name=:product_name, price=:price, quantity=:quantity, description=:description WHERE id=:id");
            $stmt->bindParam(':product_name', $product["product_name"]);
            $stmt->bindParam(':price', $product["price"]);
            $stmt->bindParam(':quantity', $product["quantity"]);
            $stmt->bindParam(':description', $product["description"]);
            $stmt->bindParam(':id', $product["id"]);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // delete
    public function deleteProduct($id) {
        try {
            $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NOW() WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage;
        }
    }

    // restore
    public function restoreDeletedProduct($id) {
        try {
            $stmt = $this->conn->prepare("UPDATE products SET deleted_at = NULL WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOExcception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}
?>