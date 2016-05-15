<?php
require_once("../model/addToCart.php");

$action=$_GET["action"];
$cart=new addToCart($_GET);

if(isset($action) && $action=="add"){

	$cart->addProduct($_GET);

}else if(isset($action) && $action=="clear"){

	$cart->clearProduct();

}else{

	header('Content-type: application/json');
	echo json_encode($cart->getProduct());

}

?>
