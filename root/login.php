<!--Austin Stephens
Rasmussen University
E-COM - CDA4859C-01
Professor Corey
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <title>NorthStar Wholesale</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./styles/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <a href="./index.php"><img src="./images/NSWS_Logo.png" alt="NorthStar Wholesale logo" class="logo"></a>
        <nav>
            <ul>
                <li><a href="./home.php">Home</a></li>
                <li><a href="./products.php">Products</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        
        <div class="hero">
            <h2>Welcome to NorthStar Wholesale</h2>
            <a href="./login.php" class="buttonAccount" id="loginBtn">Account Login</a>
            <a href="./register.php" class="buttonAccount" id="registerBtn">Create an Account</a>
        </div>
<body>
    <main>
        <div class="login-container">
            <h3>Login</h3>
            <form action="login.php" method="POST">
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="username" required>
                <br>
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
                <br>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
</body>
<footer>
    <p>&copy; 2021 NorthStar Wholesale. All rights reserved.</p>
</footer>
</html>