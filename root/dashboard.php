<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>


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
                    <li class="nav-item">
                        <a class="nav-link active animated" href='./logout.php'>Logout</a>
                    </li>

                    <li class="nav-item">
                        <button id="viewCartButton" class="btn btn-primary">View Cart</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="text-center mb-4">Product Dashboard</h2>

        <div class="row mb-4">
            <div class="col-md-4">
                <input type="text" id="searchBar" class="form-control" placeholder="Search Products" />
            </div>
            <div class="col-md-4">
                <select id="categoryFilter" class="form-select">
                    <option value="">All Categories</option>
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

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                    <th>In Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="products"></tbody>
        </table>

        <footer class="text-center py-3">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/3gZMZVAkAqKuPD8zkufDJh?utm_source=generator" width="250" height="152" frameborder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <p>&copy; 2024 NorthStar Wholesale. All rights reserved.</p>
        </footer>
    </div>

    <script>
        let allProducts = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Fetch categories and populate the category filter
            fetch('./api/categories.php')
                .then(response => response.json())
                .then(categories => {
                    const categoryFilter = document.getElementById('categoryFilter');
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category;
                        option.textContent = category;
                        categoryFilter.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                });

            // Fetch products and populate the table
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
                    document.getElementById('products').innerHTML = '<p class="text-danger">Unable to get products right now.</p>';
                });

            // Function to populate products
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
                    productLink.href = `product.php?id=${product.productID}`;
                    productLink.textContent = product.productName;
                    productLink.classList.add('text-primary', 'text-decoration-none');
                    productNameCell.appendChild(productLink);

                    const productDescriptionCell = document.createElement('td');
                    productDescriptionCell.textContent = product.productDescription || "No description available";

                    const productPriceCell = document.createElement('td');
                    productPriceCell.textContent = `$${product.productPrice}`;

                    const productStockCell = document.createElement('td');
                    productStockCell.textContent = product.productStock || "Not Available";

                    const productActionsCell = document.createElement('td');
                    const quantitySelect = document.createElement('select');
                    quantitySelect.classList.add('form-select', 'quantity-select');
                    for (let i = 1; i <= 10; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        quantitySelect.appendChild(option);
                    }
                    const addToCartButton = document.createElement('button');
                    addToCartButton.textContent = 'Add to Cart';
                    addToCartButton.classList.add('btn', 'btn-primary', 'add-to-cart-button');
                    addToCartButton.addEventListener('click', () => {
                        addToCart(product.productID, quantitySelect.value);
                    });
                    productActionsCell.appendChild(quantitySelect);
                    productActionsCell.appendChild(addToCartButton);

                    productRow.appendChild(productImgCell);
                    productRow.appendChild(productNameCell);
                    productRow.appendChild(productDescriptionCell);
                    productRow.appendChild(productPriceCell);
                    productRow.appendChild(productStockCell);
                    productRow.appendChild(productActionsCell);

                    productsContainer.appendChild(productRow);
                });
            }

            // Function to add product to cart
            function addToCart(productID, quantity) {
                fetch('./api/add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            productID,
                            quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Product added to cart successfully!');
                        } else {
                            alert('Failed to add product to cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error adding product to cart:', error);
                        alert('An error occurred. Please try again later.');
                    });
            }

            // Event listeners for the search bar and filters
            document.getElementById('searchBar').addEventListener('input', filterProducts);
            document.getElementById('categoryFilter').addEventListener('change', filterProducts);
            document.getElementById('priceFilter').addEventListener('change', filterProducts);

            // Function to filter products
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

            // Add event listener for the View Cart button
            document.getElementById('viewCartButton').addEventListener('click', function() {
                window.location.href = './cart.php';
            });
        });
    </script>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<?php
session_start();
require_once './php/db_conn_users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT UserID, UserName FROM users WHERE UserName = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['UserName'] = $user['UserName'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}