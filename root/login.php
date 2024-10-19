<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - E-ComDesign</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style1.css">
</head>

<body>
<nav class="navbar navbar-light navbar-expand-md navbar-secondary">
        <div class="container-fluid justify-content-center">
            <img class="img-fluid navbar-logo" src="assets/img/NSWS_Logo.png" alt="NSWS Logo">
        </div>
    </nav>
    <nav class="navbar navbar-light navbar-expand-md navbar-custom py-3 justify-content-center">
        <div class="container">
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a href='./why-us.php' class="nav-link active animated" href="">Why Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" href='./locations.php'>Warehouse Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" href='./about.php'>About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" href='./contact.php'>Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" href='./login.php'>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container py-5">
        <h2 class="text-center mb-4">Dealer Login</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="loginForm" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required aria-label="Username" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required aria-label="Password" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-primary-custom">Login</button>
                        </form>
                        <div id="loginMessage" class="text-center mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4">
        <div class="container">
            <p class="mb-0 text-muted">© 2024 NorthStar Wholesale. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        const formData = new FormData(this);

        fetch('./php/login_conn.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const loginMessage = document.getElementById('loginMessage');

            if (data.success) {
                loginMessage.textContent = data.message + ' You are now logged in.';
                loginMessage.style.color = 'green';
                // redirect to another page
                // window.location.href = 'dashboard.php';
            } else {
                loginMessage.textContent = `Login failed: ${data.message}`;
                loginMessage.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const loginMessage = document.getElementById('loginMessage');
            loginMessage.textContent = 'An error occurred: ' + error.message;
            loginMessage.style.color = 'red';
        });
    });
</script>
</body>
</html>
