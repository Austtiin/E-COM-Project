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
    </header>
    
    <main>
        <div class="login-container">
            <h3>Login</h3>
            <form id="loginForm" action="login.php" method="POST">
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="username" required>
                <br>
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
                <br>
                <button type="submit">Login</button>
                <p id="loginMessage" class="login-message"></p>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2021 NorthStar Wholesale. All rights reserved.</p>
    </footer>

    <script>
        // Add an event listener to the form
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            //the form will be listening for the submit event

            // Prevent the form from submitting to the server
            event.preventDefault();

            // Create a new FormData object
            const formData = new FormData(this);

            // Send the form data to the server
            fetch('php/login_conn.php', {
                //fetch the data from the login_conn.php file
                method: 'POST',
                body: formData
            })

            // Parse the JSON response
            .then(response => response.json())
            //then the response will be parsed into a json object
            .then(data => {
                const loginMessage = document.getElementById('loginMessage');

                //if statement to check if the login was successful
                if (data.success) {
                    loginMessage.textContent = data.message, 'You are now logged in.';
                    loginMessage.style.color = 'green';
                    // Optionally, redirect to another page
                    // window.location.href = 'dashboard.php';

                    
                } else {
                    //else statement to display error message
                    loginMessage.textContent = `Login failed: ${data.message}`;
                    loginMessage.style.color = 'red';

                    // Display the retrieved password
                    if (data.retrieved_password) {
                        loginMessage.textContent += ` (Retrieved password: ${data.retrieved_password})`;
                    }

                    // Display the retrieved username
                    if (data.retrieved_username) {
                        loginMessage.textContent += ` (Retrieved username: ${data.retrieved_username})`;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const loginMessage = document.getElementById('loginMessage');
                loginMessage.textContent = 'An error occurred. Please try again later.';
                loginMessage.style.color = 'red';
            });
        });
    </script>
</body>
</html>