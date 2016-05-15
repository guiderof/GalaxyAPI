<?php
class productListTest extends PHPUnit_Framework_TestCase
{
    // ...
    public $productList;

    public function setUp() {
        $this->$productList = new productsList;
    }

    public function test_get_products_list() {
        // Assert
        $this->assertEquals(1, count($this->$productList->getProductsList()));
    }

    // ...
}
