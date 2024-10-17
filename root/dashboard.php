<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - NorthStar Wholesale</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Updated CSS for Dashboard -->
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

    <div class="container py-5">
        <h2 class="text-center mb-4">Product Dashboard</h2>
        
        <!-- Search and Filter Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <input type="text" id="searchBar" class="form-control" placeholder="Search Products" />
            </div>
            <div class="col-md-4">
                <select id="categoryFilter" class="form-select">
                    <option value="">All Categories</option>
                    <!-- Categories will be populated here -->
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

        <div id="products" class="row"></div> <!-- Container for Products -->
    </div>

    <footer>
        <iframe style="border-radius:12px"
            src="https://open.spotify.com/embed/track/3gZMZVAkAqKuPD8zkufDJh?utm_source=generator"
            width="250" height="152" frameBorder="0" allowfullscreen=""
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">
        </iframe>
        <p>&copy; 2024 NorthStar Wholesale. All rights reserved.</p>
    </footer>

    <script>
        let allProducts = []; // Array to hold all products

        // Fetch products and categories on load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('./api/products.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    allProducts = data; // Store fetched products
                    populateProducts(allProducts);
                    return fetch('./api/categories.php'); // Fetch categories from server
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(categories => {
                    const categoryFilter = document.getElementById('categoryFilter');
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id; // Assuming category object has an id
                        option.textContent = category.name; // Assuming category object has a name
                        categoryFilter.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('products').innerHTML = '<p class="text-danger">Unable to load products at this time. Please try again later.</p>';
                });

            // Event listeners for filters
            document.getElementById('searchBar').addEventListener('input', filterProducts);
            document.getElementById('categoryFilter').addEventListener('change', filterProducts);
            document.getElementById('priceFilter').addEventListener('change', filterProducts);
        });

        function populateProducts(products) {
            const productsContainer = document.getElementById('products');
            productsContainer.innerHTML = ''; // Clear previous products

            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product', 'col-md-4', 'mb-4');

                const productImg = document.createElement('img');
                productImg.src = product.productIMG;
                productImg.alt = product.productName;
                productImg.classList.add('img-fluid');

                const productName = document.createElement('h4');
                productName.textContent = product.productName;

                const productPrice = document.createElement('p');
                productPrice.textContent = `$${product.productPrice}`;

                const productCategory = document.createElement('p');
                productPrice.textContent = product.productCategory;

                const addToCartButton = document.createElement('button');
                addToCartButton.textContent = 'Add to Cart';
                addToCartButton.classList.add('btn', 'btn-primary');

                productDiv.appendChild(productImg);
                productDiv.appendChild(productName);
                productDiv.appendChild(productPrice);
                productDiv.appendChild(addToCartButton);
                productDiv.appendChild(productCategory);
                productsContainer.appendChild(productDiv);
            });
        }

        function filterProducts() {
            const searchTerm = document.getElementById('searchBar').value.toLowerCase();
            const selectedCategory = document.getElementById('categoryFilter').value;
            const selectedPrice = document.getElementById('priceFilter').value;

            const filteredProducts = allProducts.filter(product => {
                // Filter by search term
                const matchesSearch = product.productName.toLowerCase().includes(searchTerm);

                // Filter by category
                const matchesCategory = selectedCategory ? product.productCategory === selectedCategory : true; // Assuming product has categoryId

                // Filter by price
                const priceInRange = (price) => {
                    if (selectedPrice === "") return true; // No price filter
                    const [min, max] = selectedPrice.split('-').map(Number);
                    return (price >= min && (max ? price <= max : true));
                };
                const matchesPrice = priceInRange(product.productPrice);

                return matchesSearch && matchesCategory && matchesPrice;
            });

            populateProducts(filteredProducts);
        }
    </script>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
