<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            border-bottom: 1px solid #e0e0e0;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 65px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.5px;
        }

        .nav-logo i {
            margin-right: 10px;
            font-size: 1.8rem;
            color: #0066cc;
        }

        .nav-menu {
            display: flex;
            gap: 0;
            margin-left: 40px;
        }

        .nav-link {
            padding: 10px 16px;
            background: transparent;
            border: 1px solid #e0e0e0;
            border-right: none;
            color: #333;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .nav-link:last-child {
            border-right: 1px solid #e0e0e0;
        }

        .nav-link:hover {
            background: #f0f0f0;
            color: #0066cc;
        }

        .nav-link.active {
            background: #0066cc;
            color: white;
            border-color: #0066cc;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .cart-icon {
            position: relative;
            cursor: pointer;
            padding: 10px 16px;
            background: #0066cc;
            transition: all 0.3s ease;
            border: 1px solid #0066cc;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .cart-icon:hover {
            background: #0052a3;
        }

        .cart-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .cart-badge {
            position: absolute;
            top: 2px;
            right: 8px;
            background: #d32f2f;
            color: white;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            border: 2px solid white;
        }

        /* Main Content */
        .main-content {
            margin-top: 85px;
            padding: 40px 20px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: #666;
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Search Bar */
        .search-container {
            background: white;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
            border: 1px solid #e0e0e0;
        }

        .search-box {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box input,
        .search-box select {
            padding: 12px 14px;
            border: 1px solid #d0d0d0;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
            color: #333;
        }

        .search-box input {
            flex: 1;
            min-width: 250px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .search-box select {
            min-width: 180px;
            cursor: pointer;
        }

        .search-box select:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .search-box button {
            padding: 12px 24px;
            background: #0066cc;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-box button:hover {
            background: #0052a3;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .product-card {
            background: white;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            border: 1px solid #e0e0e0;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #0066cc;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .product-image {
            width: 100%;
            height: 280px;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            border-bottom: 1px solid #e0e0e0;
        }

        .product-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.05) 100%);
            pointer-events: none;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-image i {
            font-size: 4rem;
            color: #d0d0d0;
        }

        .product-info {
            padding: 20px;
        }

        .product-category {
            display: inline-block;
            background: #0066cc;
            color: white;
            padding: 4px 12px;
            font-size: 0.8rem;
            margin-bottom: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-code {
            font-size: 0.9rem;
            color: #0066cc;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-code::before {
            content: '🏷️';
            font-size: 0.9rem;
        }

        .product-description {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 12px;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 45px;
        }

        .product-date {
            font-size: 0.85rem;
            color: #999;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-date::before {
            content: '📅';
            font-size: 0.85rem;
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 12px;
            background: #0066cc;
            color: white;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-to-cart-btn:hover {
            background: #0052a3;
        }

        .add-to-cart-btn:active {
            transform: translateY(-1px);
        }

        /* Shopping Cart Sidebar */
        .cart-sidebar {
            position: fixed;
            right: -500px;
            top: 0;
            width: 450px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 20px rgba(0, 0, 0, 0.15);
            transition: right 0.4s ease;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            border-left: 1px solid #e0e0e0;
        }

        .cart-sidebar.active {
            right: 0;
        }

        .cart-header {
            background: #0066cc;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #004fa3;
        }

        .cart-header h2 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .close-cart {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-cart:hover {
            transform: rotate(90deg);
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background: #f9f9f9;
        }

        .cart-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: white;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .cart-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transform: translateX(-3px);
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 2rem;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-item-name {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
            font-size: 1rem;
        }

        .cart-item-code {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .quantity-btn {
            width: 28px;
            height: 28px;
            border: 1px solid #d0d0d0;
            background: white;
            color: #0066cc;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .quantity-btn:hover {
            background: #0066cc;
            color: white;
            border-color: #0066cc;
        }

        .quantity {
            font-weight: 700;
            min-width: 30px;
            text-align: center;
            font-size: 1rem;
            color: #1a1a1a;
        }

        .remove-item {
            background: #d32f2f;
            color: white;
            border: none;
            padding: 4px 10px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .remove-item:hover {
            background: #b71c1c;
        }

        .cart-empty {
            text-align: center;
            padding: 50px 20px;
            color: #999;
        }

        .cart-empty i {
            font-size: 4rem;
            margin-bottom: 15px;
            opacity: 0.2;
        }

        .cart-empty p {
            font-size: 1rem;
            font-weight: 500;
        }

        .cart-footer {
            border-top: 1px solid #e0e0e0;
            padding: 20px;
            background: white;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1a1a1a;
        }

        .checkout-btn {
            width: 100%;
            padding: 14px;
            background: #10ac84;
            color: white;
            border: none;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .checkout-btn:hover {
            background: #0d8b68;
        }

        .checkout-btn:disabled {
            background: #999;
            cursor: not-allowed;
        }

        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1999;
            display: none;
            backdrop-filter: blur(2px);
        }

        .cart-overlay.active {
            display: block;
        }

        .loading {
            text-align: center;
            padding: 4rem;
            color: #666;
        }

        .loading p {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .spinner {
            border: 4px solid #e0e0e0;
            border-top: 4px solid #0066cc;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .no-results {
            text-align: center;
            padding: 4rem;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .no-results h2 {
            color: #0066cc;
            margin-bottom: 1rem;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .no-results p {
            color: #666;
            font-size: 1.05rem;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                gap: 16px;
            }

            .search-box {
                flex-direction: column;
            }

            .search-box input,
            .search-box select,
            .search-box button {
                width: 100%;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .main-content {
                padding: 20px 15px;
            }

            .nav-menu {
                margin-left: 20px;
                gap: 0;
            }

            .nav-link {
                padding: 10px 12px;
                font-size: 0.85rem;
            }
        }

        @media screen and (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .nav-logo {
                font-size: 1.2rem;
            }

            .page-header h1 {
                font-size: 1.6rem;
            }

            .search-container {
                padding: 15px;
            }

            .nav-menu {
                display: none;
            }

            .nav-link {
                display: none;
            }
        }

        /* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 2001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
}

.modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 0;
    width: 90%;
    max-width: 500px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.modal-header {
    background: #0066cc;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #004fa3;
}

.modal-header h2 {
    font-size: 1.4rem;
    font-weight: 700;
    margin: 0;
}

.modal-close {
    background: transparent;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    transform: rotate(90deg);
}

.modal-body {
    padding: 25px;
}

.form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 8px;
}

.form-group input {
    padding: 12px 14px;
    border: 1px solid #d0d0d0;
    font-size: 1rem;
    transition: all 0.3s;
}

.form-group input:focus {
    outline: none;
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.modal-footer {
    padding: 15px 25px;
    border-top: 1px solid #e0e0e0;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    background: #f9f9f9;
}

.btn-cancel {
    padding: 10px 24px;
    background: #e0e0e0;
    color: #333;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: #d0d0d0;
}

.btn-save {
    padding: 10px 24px;
    background: #10ac84;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-save:hover {
    background: #0d8b68;
}

.btn-save:disabled {
    background: #999;
    cursor: not-allowed;
}
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-left">
                <div class="nav-logo">
                    <i class="fas fa-shopping-bag"></i>
                    <span>GadgetHub</span>
                </div>
                <div class="nav-menu">
                    <button class="nav-link active" onclick="navigateTo('products')">
                        <i class="fas fa-boxes"></i> Products
                    </button>
                    <button class="nav-link" onclick="navigateTo('orders')">
                        <i class="fas fa-receipt"></i> My Orders
                    </button>
                    <button class="nav-link" onclick="navigateTo('profile')">
                        <i class="fas fa-user-circle"></i> My Details
                    </button>
                    <button class="nav-link" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
            
            <div class="nav-right">
                <button class="cart-icon" onclick="toggleCart()">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Cart Overlay -->
    <div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>

    <!-- Shopping Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h2><i class="fas fa-shopping-cart"></i> Your Cart</h2>
            <button class="close-cart" onclick="toggleCart()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cartItems">
            <div class="cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <p>Your cart is empty</p>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total Items:</span>
                <span id="totalItems">0</span>
            </div>
            <button class="checkout-btn" onclick="checkout()">
                <i class="fas fa-credit-card"></i> Proceed to Checkout
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <h1>📦 Our Products</h1>
            <p>Discover amazing gadgets and electronics</p>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search products by name or code..." onkeyup="searchProducts()">
                <select id="categoryFilter" onchange="searchProducts()">
                    <option value="">All Categories</option>
                </select>
                <button onclick="searchProducts()">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading" style="display: none;">
            <div class="spinner"></div>
            <p>Loading products...</p>
        </div>

        <!-- Product Grid -->
        <div class="product-grid" id="productGrid"></div>

        <!-- No Results -->
        <div id="noResults" class="no-results" style="display: none;">
            <h2>No Products Found</h2>
            <p>Try adjusting your search criteria.</p>
        </div>
    </main>

    <!-- Edit Profile Modal -->
<div id="profileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit My Details</h2>
            <button class="modal-close" onclick="closeProfileModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="profileForm">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password (leave blank to keep current)</label>
                    <input type="password" id="password" placeholder="Enter new password or leave blank">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" placeholder="Confirm new password">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeProfileModal()">Cancel</button>
            <button class="btn-save" onclick="saveProfileChanges()">Save Changes</button>
        </div>
    </div>
</div>
    <script>
        const PRODUCT_API_URL = 'https://localhost:7048/api/Product';
        const CATEGORY_API_URL = 'https://localhost:7048/api/Category';
        const ORDER_API_URL = 'https://localhost:7048/api/Order';
        const USER_API_URL = 'https://localhost:7048/api/User';

        let cart = [];
        let allProducts = [];
        let allCategories = [];
        let currentUserId = null;

        document.addEventListener('DOMContentLoaded', function() {
            currentUserId = sessionStorage.getItem("userId");
            const fullName = sessionStorage.getItem("fullName");
            const role = sessionStorage.getItem("role");
            
            if (!currentUserId || role !== "Customer") {
                alert("Session expired or access unauthorized. Please log in.");
                window.location.href = "../login.html";
                return;
            }

            loadCategories();
            loadProducts();
        });

        async function loadCategories() {
            try {
                const response = await fetch(CATEGORY_API_URL);
                if (response.ok) {
                    allCategories = await response.json();
                    populateCategoryFilters();
                }
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        }

        function populateCategoryFilters() {
            const categoryFilter = document.getElementById('categoryFilter');
            categoryFilter.innerHTML = '<option value="">All Categories</option>';
            
            allCategories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.categoryID || category.CategoryID;
                option.textContent = category.categoryName || category.CategoryName;
                categoryFilter.appendChild(option);
            });
        }

        async function loadProducts() {
            try {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.getElementById('productGrid').innerHTML = '';
                document.getElementById('noResults').style.display = 'none';

                const response = await fetch(PRODUCT_API_URL);
                
                if (!response.ok) {
                    throw new Error('Failed to fetch products');
                }

                allProducts = await response.json();
                displayProducts(allProducts);
                
            } catch (error) {
                console.error('Error loading products:', error);
                document.getElementById('loadingSpinner').innerHTML = 
                    '<i class="fas fa-exclamation-triangle" style="color: #d32f2f;"></i><p style="color: #d32f2f;">Failed to load products. Please check your API connection.</p>';
            } finally {
                document.getElementById('loadingSpinner').style.display = 'none';
            }
        }

        function getCategoryName(categoryID) {
            const category = allCategories.find(cat => 
                (cat.categoryID || cat.CategoryID) === categoryID
            );
            return category ? (category.categoryName || category.CategoryName) : 'Uncategorized';
        }

        function displayProducts(products) {
            const galleryGrid = document.getElementById('productGrid');
            galleryGrid.innerHTML = '';

            if (!products || products.length === 0) {
                document.getElementById('noResults').style.display = 'block';
                return;
            }

            document.getElementById('noResults').style.display = 'none';

            products.forEach(product => {
                const card = document.createElement('div');
                card.className = 'product-card';
                
                const imageBase64 = product.imageBase64 || product.ImageBase64;
                let imageHTML;
                if (imageBase64) {
                    const imageSource = imageBase64.startsWith('data:') 
                        ? imageBase64 
                        : `data:image/jpeg;base64,${imageBase64}`;
                    imageHTML = `<img src="${imageSource}" alt="${product.productName || product.ProductName}">`;
                } else {
                    imageHTML = '<i class="fas fa-image"></i>';
                }

                const productId = product.productID || product.ProductID;
                const productName = product.productName || product.ProductName || 'Unnamed Product';
                const productCode = product.productCode || product.ProductCode || 'N/A';
                const description = product.description || product.Description || 'No description available';
                const categoryID = product.categoryID || product.CategoryID;
                const categoryName = product.category?.categoryName || 
                                   product.Category?.CategoryName || 
                                   getCategoryName(categoryID);

                const createdAt = product.createdAt || product.CreatedAt;
                const createdDate = createdAt ? new Date(createdAt).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                }) : '';

                const safeName = productName.replace(/'/g, "\\'").replace(/"/g, '&quot;');
                const safeCode = productCode.replace(/'/g, "\\'").replace(/"/g, '&quot;');
                const safeImage = (imageBase64 || '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                
                card.innerHTML = `
                    <div class="product-image">${imageHTML}</div>
                    <div class="product-info">
                        <span class="product-category">${categoryName}</span>
                        <div class="product-name">${productName}</div>
                        <div class="product-code">Code: ${productCode}</div>
                        <div class="product-description">${description}</div>
                        ${createdDate ? `<div class="product-date">Added: ${createdDate}</div>` : ''}
                        <button class="add-to-cart-btn" onclick="addToCart(${productId}, '${safeName}', '${safeCode}', '${safeImage}')">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                `;
                
                galleryGrid.appendChild(card);
            });
        }

        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilterValue = document.getElementById('categoryFilter').value;
            
            const filteredProducts = allProducts.filter(product => {
                const productName = product.productName || product.ProductName || '';
                const productCode = product.productCode || product.ProductCode || '';
                const categoryID = product.categoryID || product.CategoryID;
                
                const matchesSearch = productName.toLowerCase().includes(searchTerm) ||
                                    productCode.toLowerCase().includes(searchTerm);
                
                const matchesCategory = !categoryFilterValue || categoryID === parseInt(categoryFilterValue);
                
                return matchesSearch && matchesCategory;
            });
            
            displayProducts(filteredProducts);
        }

        function addToCart(id, name, code, image) {
            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    code: code,
                    image: image,
                    quantity: 1
                });
            }
            
            updateCart();
            showNotification('Item added to cart!');
        }

        function updateCart() {
            const cartItemsContainer = document.getElementById('cartItems');
            const cartBadge = document.getElementById('cartBadge');
            const totalItems = document.getElementById('totalItems');
            
            const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartBadge.textContent = totalCount;
            totalItems.textContent = totalCount;
            
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="cart-empty">
                        <i class="fas fa-shopping-basket"></i>
                        <p>Your cart is empty</p>
                    </div>
                `;
                return;
            }
            
            cartItemsContainer.innerHTML = cart.map(item => {
                const imageHTML = item.image 
                    ? `<img src="data:image/jpeg;base64,${item.image}" alt="${item.name}">`
                    : '<i class="fas fa-image"></i>';
                
                return `
                    <div class="cart-item">
                        <div class="cart-item-image">${imageHTML}</div>
                        <div class="cart-item-details">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-code">${item.code}</div>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="quantity">${item.quantity}</span>
                                <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="remove-item" onclick="removeFromCart(${item.id})">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function updateQuantity(id, change) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(id);
                } else {
                    updateCart();
                }
            }
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart();
        }

        function toggleCart() {
            const sidebar = document.getElementById('cartSidebar');
            const overlay = document.getElementById('cartOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        async function checkout() {
            if (cart.length === 0) {
                alert('Your cart is empty!');
                return;
            }

            if (!currentUserId) {
                alert('User session not found. Please log in again.');
                window.location.href = "../login.html";
                return;
            }

            const checkoutBtn = document.querySelector('.checkout-btn');
            checkoutBtn.disabled = true;
            checkoutBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            let successCount = 0;
            let failCount = 0;
            const errors = [];

            for (const item of cart) {
                try {
                    const orderData = {
                        UserId: parseInt(currentUserId),
                        ProductId: item.id,
                        Quantity: item.quantity
                    };

                    console.log('Creating order:', orderData);

                    const response = await fetch(ORDER_API_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(orderData)
                    });

                    if (response.ok) {
                        const result = await response.json();
                        console.log('Order created:', result);
                        successCount++;
                    } else {
                        const errorData = await response.json();
                        console.error('Order failed:', errorData);
                        failCount++;
                        errors.push(`${item.name}: ${errorData.message || 'Failed to create order'}`);
                    }
                } catch (error) {
                    console.error('Error creating order for item:', item.name, error);
                    failCount++;
                    errors.push(`${item.name}: ${error.message}`);
                }
            }

            checkoutBtn.disabled = false;
            checkoutBtn.innerHTML = '<i class="fas fa-credit-card"></i> Proceed to Checkout';

            if (successCount > 0 && failCount === 0) {
                showNotification(`✓ Successfully placed ${successCount} order(s)!`);
                cart = [];
                updateCart();
                toggleCart();
                
                setTimeout(() => {
                    alert(`Order placed successfully!\n\nTotal orders: ${successCount}\n\nYour orders are being processed. Thank you for shopping with GadgetHub!`);
                }, 500);
            } else if (successCount > 0 && failCount > 0) {
                alert(`Partial Success:\n\n✓ ${successCount} order(s) placed successfully\n✗ ${failCount} order(s) failed\n\nFailed items:\n${errors.join('\n')}`);
                cart = cart.filter(item => 
                    errors.some(err => err.startsWith(item.name))
                );
                updateCart();
            } else {
                alert(`Checkout Failed:\n\nAll ${failCount} order(s) failed to process.\n\nErrors:\n${errors.join('\n')}\n\nPlease try again or contact support.`);
            }
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 90px;
                right: 20px;
                background: #10ac84;
                color: white;
                padding: 12px 20px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 3000;
                animation: slideIn 0.3s ease;
                font-weight: 600;
            `;
            notification.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 2000);
        }

        window.onclick = function(event) {
            const sidebar = document.getElementById('cartSidebar');
            const overlay = document.getElementById('cartOverlay');
            if (event.target === overlay) {
                toggleCart();
            }
        }
function navigateTo(page) {
    if (page === 'profile') {
        openProfileModal();
        return;
    }
    
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });

    switch(page) {
        case 'products':
            window.location.href = '#products';
            break;
        case 'orders':
            window.location.href = 'ManageOrders.php';
            break;
        default:
            break;
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('profileModal');
    if (event.target === modal) {
        closeProfileModal();
    }
}

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                // Clear session storage
                sessionStorage.removeItem('userId');
                sessionStorage.removeItem('fullName');
                sessionStorage.removeItem('role');
                
                // Redirect to login page
                window.location.href = '../Homepage.php';
            }
        }

        async function openProfileModal() {
    const modal = document.getElementById('profileModal');
    modal.classList.add('active');
    
    // Load current user data
    const fullName = sessionStorage.getItem('fullName');
    const email = sessionStorage.getItem('email') || '';
    
    document.getElementById('fullName').value = fullName || '';
    document.getElementById('email').value = email;
    document.getElementById('password').value = '';
    document.getElementById('confirmPassword').value = '';
}

function closeProfileModal() {
    const modal = document.getElementById('profileModal');
    modal.classList.remove('active');
}

async function saveProfileChanges() {
    const userId = sessionStorage.getItem('userId');
    const fullName = document.getElementById('fullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (!fullName || !email) {
        alert('Full Name and Email are required');
        return;
    }

    if (password && password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }

    const saveBtn = document.querySelector('.btn-save');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

    try {
        const userData = {
            fullName: fullName,
            email: email,
            role: 'Customer'
        };

        if (password) {
            userData.password = password;
        }

        const response = await fetch(`${USER_API_URL}/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(userData)
        });

        if (response.ok) {
            // Update session storage
            sessionStorage.setItem('fullName', fullName);
            sessionStorage.setItem('email', email);
            
            showNotification('Profile updated successfully!');
            closeProfileModal();
        } else {
            const error = await response.json();
            alert('Error updating profile: ' + (error.message || 'Unknown error'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to update profile. Please try again.');
    } finally {
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<i class="fas fa-check"></i> Save Changes';
    }
}
    </script>
</body>
</html>