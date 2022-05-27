<?php

    class Producto {
        // Connection
        private $conn;

        // Tabla
        private $db_table = "productos";

        // Columnas
        public $id;
        public $nombre;
        public $precio;
        public $imagen;
        public $descripcion;
        public $codigo;

        // DB conexion
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get all
        public function getProduct() {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // Obtener producto 
        public function getSingleProduct() {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "
                        WHERE id = ? 
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->nombre = $dataRow['nombre'];
            $this->precio = $dataRow['precio'];
            $this->imagen = $dataRow['imagen'];
            $this->descripcion = $dataRow['descripcion'];
            $this->codigo = $dataRow['codigo'];

        }

        // Crear producto
        public function createProduct() {
            $sqlQuery = "INSERT INTO " . $this->db_table . " SET 
                nombre = :nombre, 
                precio = :precio, 
                imagen = :imagen, 
                descripcion = :descripcion,
                codigo = :codigo
                ";
            $stmt = $this->conn->prepare($sqlQuery);


            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->precio = htmlspecialchars(strip_tags($this->precio));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->codigo = htmlspecialchars(strip_tags($this->codigo));

        
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->bindParam(":imagen", $this->imagen);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":codigo", $this->codigo);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Actualizar el producto
        public function updateProduct() {
            $sqlQuery = "UPDATE " . $this->db_table . " SET 
                nombre = :nombre, 
                precio = :precio, 
                imagen = :imagen, 
                descripcion = :descripcion,
                codigo = :codigo
                    WHERE 
                id = :id
                ";
            $stmt = $this->conn->prepare($sqlQuery);

           
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->precio = htmlspecialchars(strip_tags($this->precio));
            $this->imagen = htmlspecialchars(strip_tags($this->imagen));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->codigo = htmlspecialchars(strip_tags($this->codigo));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":precio", $this->precio);
            $stmt->bindParam(":imagen", $this->imagen);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":codigo", $this->codigo);
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Eliminar productox
        public function deleteProduct() {
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }














    }
    

?>