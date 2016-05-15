<?php
require_once 'product.php';
class productList extends product {

  public function getAll() {
    $servername = "readygalaxy.hopto.org";
    $username = "readygalaxy";
    $password = "readygalaxy";
    $dbname = "readygalaxy";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Product";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $productArray = array();
        while($row = $result->fetch_assoc()) {
            $product = new product();
            $product->SKU = $row['SKU'];
            $product->ProductName = $row['ProductName'];
            $product->SpecialPrice = $row['SpecialPrice'];
            $product->Price = $row['Price'];
            $product->Description = $row['Description'];
            $product->Image = $row['Image'];
            $product->Order = $row['Order'];
            $productArray[] = $product;
        }
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode($productArray);
    } else {
        echo "0 results";
    }

    $conn->close();
  }
}
$productList = new productList();
$productList->getAll();
?>
