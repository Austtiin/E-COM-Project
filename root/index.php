<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>E-ComDesign</title>
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
                        <a onclick="location.href='./why-us.php'" class="nav-link active animated" href="">Why Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" onclick="location.href='./locations.php'">Warehouse Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" onclick="location.href='./about.php'">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" onclick="location.href='./contact.php'">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active animated" onclick="location.href='./login.php'">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <div class="container py-4 py-xl-5">
        <section class="py-4 text-center">
            <h3 class="text-uppercase fw-bold mb-3">Ready to discover better pricing?</h3>
            <div class="section-banner"></div>
        </section>
    </div>

    <!-- Cards Section -->
    <section>
        <div class="container h-100 position-relative" style="top: -50px;">
            <div class="row gy-5 row-cols-1 row-cols-md-2 row-cols-lg-3">
                <!-- Card 1 -->
                <div class="col">
                    <div class="card">
                        <div class="card-body pt-5 p-4">
                            <img src="assets/img/LippertLogo3c_charcoalgreyredorangetransparent_RGB.svg" alt="Lippert Logo">
                            <h4 class="card-title">Lippert</h4>
                            <p class="text-muted card-subtitle mb-2">Lippert Parts offers a wide range of aftermarket, factory, and accessory products to meet various needs.</p>
                        </div>
                        <div class="card-footer p-4 py-3">
                            <a href="#">Learn more</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col">
                    <div class="card">
                        <div class="card-body pt-5 p-4">
                            <img src="assets/img/logoheaddark_large.avif" alt="Patriot Hitches Logo">
                            <h4 class="card-title">Patriot Hitches</h4>
                            <p class="text-muted card-subtitle mb-2">Patriot Hitches offers patented trailer hitches that solve common frustrations.</p>
                        </div>
                        <div class="card-footer p-4 py-3">
                            <a href="#">Learn more</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col">
                    <div class="card">
                        <div class="card-body pt-5 p-4">
                            <img src="assets/img/download.png" alt="Dometic Logo">
                            <h4 class="card-title">Dometic</h4>
                            <p class="text-muted card-subtitle mb-2">Dometic is a leading manufacturer of camping gear, RV toilets, and refrigerators.</p>
                        </div>
                        <div class="card-footer p-4 py-3">
                            <a href="#">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Banner -->
    <div class="border rounded hero-banner d-flex flex-column justify-content-center align-items-center p-4 py-5">
        <div class="text-center">
            <h1 class="text-uppercase fw-bold">Sourcing solutions so you don't have to.</h1>
            <button class="btn btn-primary btn-primary-custom" onclick="location.href='login.php'" type="button">Dealer login</button>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="text-center py-4">
        <div class="container">
            <p class="mb-0 text-muted">© 2024 NorthStar Wholesale. All rights reserved.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="text-muted">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#" class="text-muted">Terms of Service</a></li>
                <li class="list-inline-item"><a href="#" class="text-muted">Contact Us</a></li>
            </ul>
        </div>
    </footer>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
