<?php

class ProductBackendModel{

	public function addProduct($params){

		$sku = $params["SKU"];
		$name = $params["ProductName"];

        $servername = "localhost";
        $username = "root";
        $password = "readygalaxy";

        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "INSERT INTO product ( sku, productName) VALUES ('$sku', '$name')";
	}
}
?>
