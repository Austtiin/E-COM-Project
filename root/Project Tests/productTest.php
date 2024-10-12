<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $servername = "e-com-dev-server.mysql.database.azure.com";
        $username = "hlsguvphvt";
        $password = "Baseball00!";
        $dbname = "products";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void
    {
        $this->conn->close();
    }



    
    public function testLoadProducts()
    {
        $sql = "SELECT * FROM products.product;";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Products should be loaded successfully.");
    }

    public function testProductFields()
    {
        $sql = "SELECT * FROM products.product;";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Products should be loaded successfully.");

        $product = $result->fetch_assoc();
        $this->assertArrayHasKey('productID', $product, "Product should have an 'id' field.");
        $this->assertArrayHasKey('productName', $product, "Product should have a 'name' field.");
        $this->assertArrayHasKey('productPrice', $product, "Product should have a 'price' field.");
        $this->assertArrayHasKey('productIMG', $product, "Product should have an 'image' field.");
        $this->assertArrayHasKey('productDesc', $product, "Product should have a 'description' field.");
        $this->assertArrayHasKey('productCategory', $product, "Product should have a 'category' field.");
        $this->assertArrayHasKey('productStock', $product, "Product should have a 'stock' field.");
    }
}