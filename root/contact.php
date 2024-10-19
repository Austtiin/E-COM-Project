<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contact Us - E-ComDesign</title>
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
        <h2 class="text-center mb-4">Contact Us</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-primary-custom">Send Message</button>
        </form>
    </div>

    <footer class="text-center py-4">
        <div class="container">
            <p class="mb-0 text-muted">© 2024 NorthStar Wholesale. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>