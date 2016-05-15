<?php
require_once("../model/ProductBackendModel.php");

$backend = new ProductBackendModel();

$result = $backend->addProduct($_POST);

echo json_encode($result);

?>
