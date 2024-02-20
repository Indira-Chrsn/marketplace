<?php
include PROJECT_ROOT . '/Config/db.php';
// include ('../Model/product.php');

class Database {
    private $conn;
    private $table;

    public function __construct($table) {
        $servername = DB_SERVER;
        $dbname = DB_NAME;
        $this->table = $table;

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
    public function getAllData($queryFilter) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM ($this->table)$queryFilter");
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    // get Data by id
    public function getDataById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM ($this->table) WHERE id =:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // get softdeleted data
    public function getSoftDeletedData() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE deleted_at IS NOT NULL");
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    // create
    public function createData($columns, $columnValues) {
        $collPlaceHolders = implode(', ', $columns);

        $values = implode(', ', array_map(function($col) {
            return ':' . $col;
        }, $columns));

        try {
            $stmt = $this->conn->prepare("INSERT INTO $this->table ($collPlaceHolders) VALUES ($values)");
            
            for ($i = 0; $i < count($columns); $i++) {
                $stmt->bindParam(':' . $columns[$i], $columnValues[$i]);
            }
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // update
    public function updateData($id, $columns, $columnValues) {
        $columnPlaceholders = array_map(function($col, $val) {
            return "$col=:$val";
        }, $columns, $columns);

        $sql = implode(', ', $columnPlaceholders);

        try {
            $stmt = $this->conn->prepare("UPDATE $this->table SET $sql WHERE id=:id");
            
            for ($i = 0; $i < count($columns); $i++) {
                $stmt->bindParam(':' . $columns[$i], $columnValues[$i]);
            }
            $stmt->bindParam(':id', $id);
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
            $stmt = $this->conn->prepare("UPDATE $this->table SET deleted_at = NOW() WHERE id=:id");
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
            $stmt = $this->conn->prepare("UPDATE $this->table SET deleted_at = NULL WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header("Location: ../index.php");
            exit();
        } catch (PDOExcception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    // multiple delete
    public function deleteMultipleProducts($ids) {
        $placeHolders = [];
        $values = [];

        foreach ($ids as $id) {
            $placeHolders[] = '?';
            $values[] = $id;
        }

        $placeHolderString = implode(', ', $placeHolders);

        try {
            $stmt = $this->conn->prepare("UPDATE $this->table SET deleted_at = NOW() WHERE id IN ($placeHolderString)");
            $stmt->execute($values);
        } catch (PDOEXception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // restore multiple
    public function restoreMultipleProducts($ids) {
        $placeHolders = [];
        $values = [];

        foreach ($ids as $id) {
            $placeHolders[] = '?';
            $values[] = $id;
        }

        $placeHolderString = implode(', ',$placeHolders);

        try {
            $stmt = $this->conn->prepare("UPDATE $this->table SET deleted_at = NULL WHERE id IN ($placeHolderString)");
            $stmt->execute($values);
        } catch (PDOEXception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>