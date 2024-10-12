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

        <iframe 
            style="border-radius:12px" src="https://open.spotify.com/embed/track/3ijzLcWcnHqPgMBWXkgOm1?utm_source=generator" 
            width="250" height="152" frameBorder="0" allowfullscreen="" 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">
        </iframe>
    </header>

    <main>
        <!--products that are loaded from sql database-->
        <div class="product-container">
            <h3>Featured Products</h3>
            <div id="products"></div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/products.php')
                .then(response => response.json())
                .then(data => {
                    const productsContainer = document.getElementById('products');
                    data.forEach(product => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product');
                        
                        const productImg = document.createElement('img');
                        productImg.src = product.image;
                        productImg.alt = product.name;
                        
                        const productName = document.createElement('h4');
                        productName.textContent = product.name;
                        
                        const productPrice = document.createElement('p');
                        productPrice.textContent = `$${product.price}`;
                        
                        const addToCartButton = document.createElement('button');
                        addToCartButton.textContent = 'Add to Cart';
                        
                        productDiv.appendChild(productImg);
                        productDiv.appendChild(productName);
                        productDiv.appendChild(productPrice);
                        productDiv.appendChild(addToCartButton);
                        
                        productsContainer.appendChild(productDiv);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        });
    </script>

    <footer>
        <p>&copy; 2024 NorthStar Wholesale. All rights reserved.</p>
    </footer>
</body>
</html>
