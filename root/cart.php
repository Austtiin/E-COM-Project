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
    <div class="container mt-5">
        <h2 class="text-center">Your Cart</h2>
        <div id="cart-items" class="list-group"></div>
        <div class="text-center mt-4">
            <a class="btn btn-primary" href="dashboard.php">Back to Shopping</a>
        </div>
        <div class="mt-4">
            <h3>Total Price: $<span id="total-price">0.00</span></h3>
        </div>
        <div class="mt-4">
            <h3>Payment Information</h3>
            <form id="payment-form">
                <div class="form-group">
                    <label for="name">Name on Card</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="address">Billing Address</label>
                    <input type="text" class="form-control" id="address" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Information</label>
                    <input type="text" class="form-control" id="contact" required>
                </div>
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input type="text" class="form-control" id="card-number" required>
                </div>
                <div class="form-group">
                    <label for="expiry-date">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry-date" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" required>
                </div>
                <button type="submit" class="btn btn-success">Pay Now</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded and parsed');
            fetch('./api/get_cart.php')
                .then(response => {
                    console.log('Response received:', response);
                    return response.text(); // Get the response as text
                })
                .then(text => {
                    console.log('Response text:', text);
                    try {
                        const data = JSON.parse(text); // Parse the text as JSON
                        console.log('Data received:', data);
                        const cartItemsContainer = document.getElementById('cart-items');
                        let totalPrice = 0;
                        if (data.error) {
                            console.error('Error in data:', data.error);
                            cartItemsContainer.innerHTML = `<p class="text-center text-danger">${data.error}</p>`;
                        } else if (data.length === 0) {
                            console.log('Cart is empty');
                            cartItemsContainer.innerHTML = '<p class="text-center">Your cart is empty.</p>';
                        } else {
                            console.log('Populating cart items');
                            data.forEach(item => {
                                const itemElement = document.createElement('div');
                                itemElement.className = 'list-group-item';
                                itemElement.innerHTML = `
                                    <h5 class="mb-1">${item.productName}</h5>
                                    <p class="mb-1">Quantity: <input type="number" class="quantity-input" data-product-id="${item.productId}" value="${item.quantity}" min="1"></p>
                                    <p class="mb-1">Price: $${item.productPrice}</p>
                                    <p class="mb-1">Total: $<span class="item-total">${(item.productPrice * item.quantity).toFixed(2)}</span></p>
                                `;
                                cartItemsContainer.appendChild(itemElement);
                                totalPrice += item.productPrice * item.quantity;
                            });

                            // Update total price
                            document.getElementById('total-price').innerText = totalPrice.toFixed(2);

                            // Add event listeners to quantity inputs
                            document.querySelectorAll('.quantity-input').forEach(input => {
                                input.addEventListener('change', function() {
                                    const productId = this.getAttribute('data-product-id');
                                    const newQuantity = this.value;
                                    updateQuantity(productId, newQuantity);
                                });
                            });
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        console.log('Response was not valid JSON:', text);
                        const cartItemsContainer = document.getElementById('cart-items');
                        cartItemsContainer.innerHTML = `<p class="text-center text-danger">Error parsing JSON: ${error.message}</p><p class="text-center text-danger">Response was not valid JSON:</p><pre class="text-center text-danger">${text}</pre>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching cart items:', error);
                    const cartItemsContainer = document.getElementById('cart-items');
                    cartItemsContainer.innerHTML = `<p class="text-center text-danger">Error fetching cart items: ${error.message}</p>`;
                });
        });

        function updateQuantity(productId, newQuantity) {
            fetch('./api/update_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ productId: productId, quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Quantity updated successfully');
                    // Recalculate total price
                    let totalPrice = 0;
                    document.querySelectorAll('.list-group-item').forEach(item => {
                        const quantityInput = item.querySelector('.quantity-input');
                        const itemTotal = item.querySelector('.item-total');
                        const price = parseFloat(item.querySelector('.mb-1:nth-child(3)').innerText.replace('Price: $', ''));
                        const quantity = parseInt(quantityInput.value);
                        const total = price * quantity;
                        itemTotal.innerText = total.toFixed(2);
                        totalPrice += total;
                    });
                    document.getElementById('total-price').innerText = totalPrice.toFixed(2);
                } else {
                    console.error('Error updating quantity:', data.error);
                }
            })
            .catch(error => {
                console.error('Error updating quantity:', error);
            });
        }
    </script>
</body>
</html>