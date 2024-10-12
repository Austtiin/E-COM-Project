<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $servername = "e-com-dev-server.mysql.database.azure.com";
        $username = "hlsguvphvt";
        $password = "Baseball00!";
        $dbname = "users";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void
    {
        $this->conn->close();
    }





    public function testValidLogin()
    {
        $username = 'admin';
        $password = '1';

        $sql = "SELECT * FROM `users`.`users` WHERE Username = '$username' AND PasswordHash='$password'";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "Login should be successful for valid credentials.");
    }

    public function testInvalidLogin()
    {
        $username = 'invalidUser';
        $password = 'invalidPassword';

        $sql = "SELECT * FROM `users`.`users` WHERE Username = '$username' AND PasswordHash='$password'";
        $result = $this->conn->query($sql);

        $this->assertEquals(0, $result->num_rows, "Login should fail for invalid credentials.");
    }
}
