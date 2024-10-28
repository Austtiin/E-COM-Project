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
        $dbname = "nsw_db";

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

    public function testEmptyUsername()
    {
        $username = '';
        $password = 'somePassword';

        $sql = "SELECT * FROM `users`.`users` WHERE Username = '$username' AND PasswordHash='$password'";
        $result = $this->conn->query($sql);

        $this->assertEquals(0, $result->num_rows, "Login should fail for empty username.");
    }

    public function testEmptyPassword()
    {
        $username = 'someUser';
        $password = '';

        $sql = "SELECT * FROM `users`.`users` WHERE Username = '$username' AND PasswordHash='$password'";
        $result = $this->conn->query($sql);

        $this->assertEquals(0, $result->num_rows, "Login should fail for empty password.");
    }

    public function testSqlInjection()
    {
        $username = 'admin';
        $password = "' OR '1'='1";

        $sql = "SELECT * FROM `users`.`users` WHERE Username = '$username' AND PasswordHash='$password'";
        $result = $this->conn->query($sql);

        $this->assertEquals(0, $result->num_rows, "Login should fail for SQL injection attempt.");
    }
}
    {
        $this->conn->close();
    }
