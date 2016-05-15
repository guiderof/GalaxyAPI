<?php
class productList {
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
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row['SKU'];
        }
    } else {
        echo "0 results";
    }

    $conn->close();
  }
}
$productList = new productList();
$productList->getAll();
?>
