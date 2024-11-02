   // Buy Now button functionality
   document.getElementById('buyNowButton1').addEventListener('click', function() {
    const selectedSize = document.getElementById('sizeSelect1').value;
    if (selectedSize) {
        alert('Buying size: ' + selectedSize + ' for Product 1');
        // Implement your buy now logic here
    } else {
        alert('Please select a size.');
    }
});

document.getElementById('addToCartButton1').addEventListener('click', function() {
    const selectedSize = document.getElementById('sizeSelect1').value;
    if (selectedSize) {
        alert('Added to cart: ' + selectedSize + ' for Product 1');
        // Implement your add to cart logic here
    } else {
        alert('Please select a size.');
    }
});

// Repeat for other products
document.getElementById('buyNowButton2').addEventListener('click', function() {
    const selectedSize = document.getElementById('sizeSelect2').value;
    if (selectedSize) {
        alert('Buying size: ' + selectedSize + ' for Product 2');
    } else {
        alert('Please select a size.');
    }
});

document.getElementById('addToCartButton2').addEventListener('click', function() {
    const selectedSize = document.getElementById('sizeSelect2').value;
    if (selectedSize) {
        alert('Added to cart: ' + selectedSize + ' for Product 2');
    } else {
        alert('Please select a size.');
    }
});

document.getElementById('buyNowButton3').addEventListener('click', function() {
    const selectedSize = document.getElementById('sizeSelect3').value;
    if (selectedSize) {
        alert('Buying size: ' + selectedSize + ' for Product 3');
    } else {
        alert('Please select a size.');
    }
});

document.getElementById('addToCartButton3').addEventListener('click', function() {
    const selectedSize = document.getElementById('sizeSelect3').value;
    if (selectedSize) {
        alert('Added to cart: ' + selectedSize + ' for Product 3');
    } else {
        alert('Please select a size.');
    }
});