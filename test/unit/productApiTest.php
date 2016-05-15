<?php
require_once(dirname(__FILE__) . '/../../model/productList.php');

class productListTest extends PHPUnit_Framework_TestCase
{
    public $productList;

    public function setUp() {
        $this->productList = new productList;
    }

    public function test_get_found_products() {
        $this->assertNotEmpty($this->productList->getAll());
    }
}
