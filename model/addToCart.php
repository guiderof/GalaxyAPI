<?php
session_start();

class addToCart{

	public function addProduct($params){

		$sku=$params["sku"];
		$name=$params["name"];
		$price=$params["price"];
		$price=$params["price"];

		if(!isset($_SESSION[$sku])){
			$_SESSION[$sku]["sku"] = $sku;
			$_SESSION[$sku]["name"] = $name;
			$_SESSION[$sku]["price"] = $price;
			$_SESSION[$sku]["quantity"] = 1;
		}else{
			$_SESSION[$sku]["quantity"] = $_SESSION[$sku]["quantity"]+1;
		}

	}

	public function getProduct(){

		return $_SESSION;

	}

	public function clearProduct(){

		session_destroy();

	}

}
?>
