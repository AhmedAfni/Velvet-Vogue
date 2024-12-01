<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <a href="index.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
                </li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input
                    type="search"
                    id="searchInput"
                    class="form-control form-control-dark"
                    placeholder="Search..."
                    aria-label="Search"
                >
            </form>

            <div class="text-end">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login_page.php" class="btn btn-outline-warning me-2">LOGIN</a>
                    <a href="register_page.php" class="btn btn-warning me-2">REGISTER</a>
                <?php else: ?>
                    <a href="profile.php" class="text-warning me-2" style="text-decoration: none;">
                        <img src="assets/profile.png" alt="Profile" style="height: 30px;">
                    </a>
                    <a href="cart.php" class="text-warning me-2" style="text-decoration: none;">
                        <img src="assets/shopping-cart.png" alt="Cart" style="height: 30px;">
                    </a>
                    <a href="signout.php" class="btn btn-outline-warning">SIGN OUT</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="home.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'home.php' ? 'active' : ''; ?>">HOME</a></li>
            <li class="nav-item"><a href="tshirt.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'tshirt.php' ? 'active' : ''; ?>">T-SHIRTS</a></li>
            <li class="nav-item"><a href="pants.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'pants.php' ? 'active' : ''; ?>">PANTS</a></li>
            <li class="nav-item"><a href="shorts.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'shorts.php' ? 'active' : ''; ?>">SHORTS</a></li>
            <li class="nav-item"><a href="hoodies.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'hoodies.php' ? 'active' : ''; ?>">HOODIES</a></li>
        </ul>
    </header>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        // Add clear button to search input
        const searchContainer = searchInput.parentElement;
        const clearButton = document.createElement('button');
        clearButton.type = 'button';
        clearButton.className = 'btn btn-link position-absolute end-0 top-50 translate-middle-y text-decoration-none';
        clearButton.innerHTML = '×';
        clearButton.style.fontSize = '1.5rem';
        clearButton.style.padding = '0 10px';
        clearButton.style.color = 'white';
        clearButton.style.display = 'none';
        searchContainer.style.position = 'relative';
        searchContainer.appendChild(clearButton);

        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                const productName = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
                const productDesc = card.querySelector('.card-text')?.textContent.toLowerCase() || '';
                const productCol = card.closest('.col');

                if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                    productCol.style.display = '';
                } else {
                    productCol.style.display = 'none';
                }
            });

            // Show/hide clear button
            clearButton.style.display = this.value ? 'block' : 'none';
        });

        // Clear search functionality
        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            this.style.display = 'none';
        });
    }
});
</script>
