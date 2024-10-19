<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - NorthStar Wholesale</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>

    <!-- Navbar -->
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
                        <a href='./why-us.php' class="nav-link active animated">Why Us</a>
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
        <h2 class="text-center mb-4">Product Dashboard</h2>

        <!-- Search and Filter Options -->
        <div class="row mb-4">
            <div class="col-md-4">
                <input type="text" id="searchBar" class="form-control" placeholder="Search Products" />
            </div>
            <div class="col-md-4">
                <select id="categoryFilter" class="form-select">
                    <option value="">All Categories</option>
                    <option value="Category1">Accessories</option>
                    <option value="Category2">Category 2</option>
                    <option value="Category3">Category 3</option>
                </select>
            </div>
            <div class="col-md-4">
                <select id="priceFilter" class="form-select">
                    <option value="">All Prices</option>
                    <option value="0-50">$0 - $50</option>
                    <option value="51-100">$51 - $100</option>
                    <option value="101-200">$101 - $200</option>
                    <option value="201+">$201+</option>
                </select>
            </div>
        </div>

        <!-- Product Display Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                    <th>In Stock</th>
                </tr>
            </thead>
            <tbody id="products"></tbody>
        </table>

        <!-- Footer with Spotify Embed -->
        <footer class="text-center py-3">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3gZMZVAkAqKuPD8zkufDJh?utm_source=generator" width="250" height="152" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <p>&copy; 2024 NorthStar Wholesale. All rights reserved.</p>
        </footer>

        <!-- JavaScript for Product Filters -->
        <script>
            let allProducts = [];

            document.addEventListener('DOMContentLoaded', function() {
                fetch('./api/products.php')
                    .then(response => response.json())
                    .then(data => {
                        allProducts = data;
                        if (allProducts.length === 0) {
                            document.getElementById('products').innerHTML = '<p class="text-warning">No products available at this time.</p>';
                        } else {
                            populateProducts(allProducts);
                        }
                    })
                    .catch(error => {
                        document.getElementById('products').innerHTML = '<p class="text-danger">Unable to load products at this time. Please try again later.</p>';
                    });

                function populateProducts(products) {
                    const productsContainer = document.getElementById('products');
                    productsContainer.innerHTML = '';

                    products.forEach(product => {
                        const productRow = document.createElement('tr');

                        const productImgCell = document.createElement('td');
                        const productImg = document.createElement('img');
                        productImg.src = product.productIMG;
                        productImg.alt = product.productName;
                        productImg.classList.add('img-fluid', 'product-img');
                        productImgCell.appendChild(productImg);

                        const productNameCell = document.createElement('td');
                        const productLink = document.createElement('a');
                        productLink.href = `product.php?id=${product.productID}`; // Link to product detail page
                        productLink.textContent = product.productName;
                        productLink.classList.add('text-primary', 'text-decoration-none');
                        productNameCell.appendChild(productLink);

                        const productDescriptionCell = document.createElement('td');
                        productDescriptionCell.textContent = product.productDescription || "No description available";

                        const productPriceCell = document.createElement('td');
                        productPriceCell.textContent = `$${product.productPrice}`;

                        const productStockCell = document.createElement('td');
                        productStockCell.textContent = product.productStock || "Not Available";

                        productRow.appendChild(productImgCell);
                        productRow.appendChild(productNameCell);
                        productRow.appendChild(productDescriptionCell);
                        productRow.appendChild(productPriceCell);
                        productRow.appendChild(productStockCell);

                        productsContainer.appendChild(productRow);
                    });
                }

                document.getElementById('searchBar').addEventListener('input', filterProducts);
                document.getElementById('categoryFilter').addEventListener('change', filterProducts);
                document.getElementById('priceFilter').addEventListener('change', filterProducts);

                function filterProducts() {
                    const searchTerm = document.getElementById('searchBar').value.toLowerCase();
                    const selectedCategory = document.getElementById('categoryFilter').value;
                    const selectedPrice = document.getElementById('priceFilter').value;

                    const filteredProducts = allProducts.filter(product => {
                        const matchesSearch = product.productName.toLowerCase().includes(searchTerm);
                        const matchesCategory = selectedCategory ? product.productCategory.toLowerCase() === selectedCategory.toLowerCase() : true;
                        const priceInRange = (price) => {
                            if (selectedPrice === "") return true;
                            const [min, max] = selectedPrice.split('-').map(Number);
                            return (price >= min && (max ? price <= max : true));
                        };
                        const matchesPrice = priceInRange(product.productPrice);

                        return matchesSearch && matchesCategory && matchesPrice;
                    });

                    populateProducts(filteredProducts);
                }
            });
        </script>

        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>