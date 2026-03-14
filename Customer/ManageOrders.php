<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - GadgetHub</title>
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
            color: white;
        }

        .cart-icon:hover {
            background: #0052a3;
        }

        .cart-icon i {
            font-size: 1.5rem;
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

        /* Filter Section */
        .filter-container {
            background: white;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
            border: 1px solid #e0e0e0;
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-container select {
            padding: 12px 14px;
            border: 1px solid #d0d0d0;
            font-size: 0.95rem;
            cursor: pointer;
            background: white;
            transition: all 0.3s;
        }

        .filter-container select:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        /* Orders Container */
        .orders-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-card {
            background: white;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .order-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            background: #f9f9f9;
        }

        .order-info {
            flex: 1;
        }

        .order-code {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 5px;
        }

        .order-date {
            font-size: 0.9rem;
            color: #666;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .order-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 0;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffc107;
        }

        .status-confirmed {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #198754;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .status-distributor {
            background: #cfe2ff;
            color: #084298;
            border: 1px solid #0d6efd;
        }

        .order-body {
            padding: 20px;
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 20px;
        }

        .product-image-container {
            width: 120px;
            height: 120px;
            border: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f9f9f9;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image-container i {
            font-size: 3rem;
            color: #ddd;
        }

        .order-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .order-detail {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 0.85rem;
            color: #999;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 1.1rem;
            color: #1a1a1a;
            font-weight: 600;
        }

        .order-footer {
            padding: 15px 20px;
            border-top: 1px solid #e0e0e0;
            background: #f9f9f9;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-view {
            background: #0066cc;
            color: white;
        }

        .btn-view:hover {
            background: #0052a3;
        }

        .btn-edit {
            background: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background: #218838;
        }

        .btn-edit:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .btn-delete:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            width: 90%;
            max-width: 600px;
            animation: slideDown 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 20px;
            background: #0066cc;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: all 0.3s;
        }

        .close:hover {
            opacity: 0.7;
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d0d0d0;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .form-group input:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
        }

        .modal-footer {
            padding: 20px;
            background: #f9f9f9;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #e0e0e0;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .btn-save {
            background: #28a745;
            color: white;
        }

        .btn-save:hover {
            background: #218838;
        }

        /* Loading & Empty States */
        .loading {
            text-align: center;
            padding: 4rem;
            color: #666;
        }

        .spinner {
            border: 4px solid #e0e0e0;
            border-top: 4px solid #0066cc;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 4rem;
            background: white;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h2 {
            color: #0066cc;
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn-shop {
            padding: 10px 24px;
            background: #0066cc;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-shop:hover {
            background: #0052a3;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .nav-menu {
                margin-left: 20px;
            }

            .nav-link {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .order-body {
                grid-template-columns: 1fr;
            }

            .order-details-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }

        @media screen and (max-width: 480px) {
            .nav-menu {
                display: none;
            }

            .page-header h1 {
                font-size: 1.6rem;
            }

            .filter-container {
                flex-direction: column;
            }

            .filter-container select {
                width: 100%;
            }

            .order-details-grid {
                grid-template-columns: 1fr;
            }

            .order-footer {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        .btn-confirm {
    background: #28a745;
    color: white;
}

.btn-confirm:hover {
    background: #218838;
}

.btn-confirm:disabled {
    background: #6c757d;
    cursor: not-allowed;
    opacity: 0.6;
}

.btn-cancel-order {
    background: #dc3545;
    color: white;
}

.btn-cancel-order:hover {
    background: #c82333;
}

.btn-cancel-order:disabled {
    background: #6c757d;
    cursor: not-allowed;
    opacity: 0.6;
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
                    <button class="nav-link" onclick="navigateTo('products')">
                        <i class="fas fa-boxes"></i> Products
                    </button>
                    <button class="nav-link active" onclick="navigateTo('orders')">
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
                <button class="cart-icon" onclick="navigateTo('products')">
                    <i class="fas fa-arrow-left"></i> Back to Shopping
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <h1>My Orders</h1>
            <p>View and manage your orders</p>
        </div>

        <!-- Filter Section -->
        <div class="filter-container">
            <label for="statusFilter" style="color: #666; font-weight: 600;">Filter by Status:</label>
            <select id="statusFilter" onchange="filterOrders()">
                <option value="">All Orders</option>
                <option value="0">Pending</option>
                <option value="1">Confirmed</option>
                <option value="2">Cancelled</option>
                <option value="3">Added to Distributor</option>
            </select>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading" style="display: none;">
            <div class="spinner"></div>
            <p>Loading your orders...</p>
        </div>

        <!-- Orders Container -->
        <div class="orders-container" id="ordersContainer"></div>

        <!-- Empty State -->
        <div id="emptyState" class="empty-state" style="display: none;">
            <i class="fas fa-inbox"></i>
            <h2>No Orders Found</h2>
            <p>You haven't placed any orders yet. Start shopping now!</p>
            <button class="btn-shop" onclick="navigateTo('products')">
                <i class="fas fa-shopping-cart"></i> Continue Shopping
            </button>
        </div>
    </main>

    <!-- Edit Order Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-edit"></i> Edit Order</h2>
                <span class="close" onclick="closeEditModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editOrderForm">
                    <input type="hidden" id="editOrderId">
                    
                    <div class="form-group">
                        <label>Order Code</label>
                        <input type="text" id="editOrderCode" disabled>
                    </div>

                    <div class="form-group">
                        <label>Product</label>
                        <input type="text" id="editProductName" disabled>
                    </div>

                    <div class="form-group">
                        <label for="editQuantity">Quantity <span style="color: red;">*</span></label>
                        <input type="number" id="editQuantity" min="1" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" value="Pending" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-cancel" onclick="closeEditModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="btn btn-save" onclick="saveOrderChanges()">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
<div id="profileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit My Details</h2>
            <span class="close" onclick="closeProfileModal()">&times;</span>
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
            <button class="btn btn-cancel" onclick="closeProfileModal()">
                <i class="fas fa-times"></i> Cancel
            </button>
            <button class="btn btn-save" onclick="saveProfileChanges()">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </div>
</div>
    <script>
        const ORDER_API_URL = 'https://localhost:7048/api/Order';
        const PRODUCT_API_URL = 'https://localhost:7048/api/Product';
        const USER_API_URL = 'https://localhost:7048/api/User';

        let allOrders = [];
        let allProducts = [];
        let currentUserId = null;

        document.addEventListener('DOMContentLoaded', function() {
            currentUserId = sessionStorage.getItem("userId");
            const fullName = sessionStorage.getItem("fullName");
            const role = sessionStorage.getItem("role");
            
            if (!currentUserId || role !== "Customer") {
                alert("Session expired or access unauthorized. Please log in.");
                window.location.href = "../login.php";
                return;
            }

            loadProducts();
            loadOrders();
        });

        async function loadProducts() {
            try {
                const response = await fetch(PRODUCT_API_URL);
                if (response.ok) {
                    allProducts = await response.json();
                    console.log('Products loaded:', allProducts.length);
                    // Log first product to see structure
                    if (allProducts.length > 0) {
                        console.log('Sample product:', allProducts[0]);
                    }
                }
            } catch (error) {
                console.error('Error loading products:', error);
            }
        }

        async function loadOrders() {
            try {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.getElementById('ordersContainer').innerHTML = '';
                document.getElementById('emptyState').style.display = 'none';

                const response = await fetch(ORDER_API_URL);
                
                if (!response.ok) {
                    throw new Error('Failed to fetch orders');
                }

                const orders = await response.json();
                
                // Filter orders for current user only - handle all property name variations
                allOrders = orders.filter(order => {
                    const orderUserId = order.userId || order.UserId || order.userid || order.UserID;
                    return orderUserId === parseInt(currentUserId);
                });
                
                // Wait for products to load before displaying
                if (allProducts.length === 0) {
                    await loadProducts();
                }
                
                displayOrders(allOrders);
                
            } catch (error) {
                console.error('Error loading orders:', error);
                document.getElementById('ordersContainer').innerHTML = 
                    '<div style="padding: 2rem; background: white; border: 1px solid #e0e0e0; text-align: center; color: #d32f2f;"><i class="fas fa-exclamation-triangle"></i><p>Failed to load orders. Please try again later.</p></div>';
            } finally {
                document.getElementById('loadingSpinner').style.display = 'none';
            }
        }

        function getProduct(productId) {
            const product = allProducts.find(p => {
                const pId = p.productID || p.ProductID || p.productId || p.ProductId;
                return pId === productId;
            });
            
            if (product) {
                console.log('Found product for ID', productId, ':', product);
            } else {
                console.log('Product not found for ID:', productId);
            }
            
            return product;
        }

        function getProductName(productId) {
            const product = getProduct(productId);
            return product ? (product.productName || product.ProductName || 'Unknown Product') : 'Unknown Product';
        }

        function getProductImage(productId) {
            const product = getProduct(productId);
            if (!product) {
                console.log('No product found for image lookup, ID:', productId);
                return '';
            }
            
            // Check for Base64 image with all possible property names
            const imageBase64 = product.imageBase64 || product.ImageBase64 || 
                               product.imagebase64 || product.IMAGEBASE64;
            
            console.log('Image Base64 found:', imageBase64 ? 'Yes (length: ' + imageBase64.length + ')' : 'No');
            
            if (imageBase64) {
                // Check if it already has data:image prefix
                if (imageBase64.startsWith('data:image')) {
                    return imageBase64;
                }
                // Add prefix if missing
                return `data:image/jpeg;base64,${imageBase64}`;
            }
            
            // Fallback to URL if exists
            const imageUrl = product.imageUrl || product.ImageUrl || 
                           product.imageURL || product.ImageURL;
            
            console.log('Image URL found:', imageUrl || 'No');
            
            return imageUrl || '';
        }

        function getStatusText(status) {
            const statuses = {
                0: 'Pending',
                1: 'Confirmed',
                2: 'Cancelled',
                3: 'Added to Distributor'
            };
            return statuses[status] || 'Unknown';
        }

        function getStatusClass(status) {
            const classes = {
                0: 'status-pending',
                1: 'status-confirmed',
                2: 'status-cancelled',
                3: 'status-distributor'
            };
            return classes[status] || '';
        }

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        function displayOrders(orders) {
            const container = document.getElementById('ordersContainer');
            container.innerHTML = '';

            if (!orders || orders.length === 0) {
                document.getElementById('emptyState').style.display = 'block';
                return;
            }

            document.getElementById('emptyState').style.display = 'none';

            orders.forEach(order => {
                // Handle all property name variations
                const productId = order.productId || order.ProductId || order.productID || order.ProductID;
                console.log('Processing order with productId:', productId);
                
                const productName = getProductName(productId);
                const productImage = getProductImage(productId);
                
                console.log('Product name:', productName, 'Image:', productImage ? 'Found' : 'Not found');
                const status = order.status !== undefined ? order.status : order.Status;
                const statusText = getStatusText(status);
                const statusClass = getStatusClass(status);
                const createdAt = order.createdAt || order.CreatedAt;
                const formattedDate = formatDate(createdAt);
                const orderCode = order.orderCode || order.OrderCode;
                const quantity = order.quantity || order.Quantity;
                const unitPrice = order.unitPrice || order.UnitPrice || 0;
                const totalPrice = order.totalPrice || order.TotalPrice || 0;
                const orderId = order.orderId || order.OrderId || order.orderID || order.OrderID;
                
                // Only allow edit/delete if status is 0 (Pending)
                const canEdit = status === 0;
                
                const card = document.createElement('div');
                card.className = 'order-card';
                
                card.innerHTML = `
                    <div class="order-header">
                        <div class="order-info">
                            <div class="order-code">${orderCode}</div>
                            <div class="order-date">
                                <i class="fas fa-calendar"></i> ${formattedDate}
                            </div>
                        </div>
                        <div class="order-status ${statusClass}">
                            ${statusText}
                        </div>
                    </div>
                    <div class="order-body">
                        <div class="product-image-container">
                            ${productImage ? 
                                `<img src="${productImage}" alt="${productName}">` : 
                                '<i class="fas fa-image"></i>'
                            }
                        </div>
                        <div class="order-details-grid">
                            <div class="order-detail">
                                <div class="detail-label">Product</div>
                                <div class="detail-value">${productName}</div>
                            </div>
                            <div class="order-detail">
                                <div class="detail-label">Quantity</div>
                                <div class="detail-value">${quantity}</div>
                            </div>
                            <div class="order-detail">
                                <div class="detail-label">Unit Price</div>
                                <div class="detail-value">Rs. ${unitPrice.toFixed(2)}</div>
                            </div>
                            <div class="order-detail">
                                <div class="detail-label">Total Price</div>
                                <div class="detail-value">Rs. ${totalPrice.toFixed(2)}</div>
                            </div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <button class="btn btn-view" onclick="viewOrderDetails(${orderId})">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-confirm" onclick="confirmOrder(${orderId})" ${!canEdit ? 'disabled title="Only pending orders can be confirmed"' : ''}>
                            <i class="fas fa-check"></i> Confirm
                        </button>
                        <button class="btn btn-cancel-order" onclick="cancelOrder(${orderId})" ${!canEdit ? 'disabled title="Only pending orders can be cancelled"' : ''}>
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button class="btn btn-edit" onclick="openEditModal(${orderId})" ${!canEdit ? 'disabled title="Only pending orders can be edited"' : ''}>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-delete" onclick="deleteOrder(${orderId})" ${!canEdit ? 'disabled title="Only pending orders can be deleted"' : ''}>
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                `;
                
                container.appendChild(card);
            });
        }

        function filterOrders() {
            const statusFilter = document.getElementById('statusFilter').value;
            
            if (!statusFilter) {
                displayOrders(allOrders);
            } else {
                const filtered = allOrders.filter(order => {
                    const orderStatus = order.status !== undefined ? order.status : order.Status;
                    return orderStatus === parseInt(statusFilter);
                });
                displayOrders(filtered);
            }
        }

        function viewOrderDetails(orderId) {
            const order = allOrders.find(o => {
                const oId = o.orderId || o.OrderId || o.orderID || o.OrderID;
                return oId === orderId;
            });
            
            if (order) {
                const productId = order.productId || order.ProductId || order.productID || order.ProductID;
                const productName = getProductName(productId);
                const orderCode = order.orderCode || order.OrderCode;
                const quantity = order.quantity || order.Quantity;
                const unitPrice = order.unitPrice || order.UnitPrice || 0;
                const totalPrice = order.totalPrice || order.TotalPrice || 0;
                const status = order.status !== undefined ? order.status : order.Status;
                const statusText = getStatusText(status);
                const createdAt = order.createdAt || order.CreatedAt;
                const formattedDate = formatDate(createdAt);
                
                alert(`Order Details:\n\nOrder Code: ${orderCode}\nProduct: ${productName}\nQuantity: ${quantity}\nUnit Price: Rs. ${unitPrice.toFixed(2)}\nTotal Price: Rs. ${totalPrice.toFixed(2)}\nStatus: ${statusText}\nCreated: ${formattedDate}`);
            }
        }

        function openEditModal(orderId) {
            const order = allOrders.find(o => {
                const oId = o.orderId || o.OrderId || o.orderID || o.OrderID;
                return oId === orderId;
            });
            
            if (!order) return;

            const status = order.status !== undefined ? order.status : order.Status;
            
            // Only allow editing if status is 0 (Pending)
            if (status !== 0) {
                alert('Only pending orders can be edited!');
                return;
            }

            const productId = order.productId || order.ProductId || order.productID || order.ProductID;
            const productName = getProductName(productId);
            const orderCode = order.orderCode || order.OrderCode;
            const quantity = order.quantity || order.Quantity;
            const orderId2 = order.orderId || order.OrderId || order.orderID || order.OrderID;

            document.getElementById('editOrderId').value = orderId2;
            document.getElementById('editOrderCode').value = orderCode;
            document.getElementById('editProductName').value = productName;
            document.getElementById('editQuantity').value = quantity;

            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('editOrderForm').reset();
        }

        async function saveOrderChanges() {
            const orderId = document.getElementById('editOrderId').value;
            const quantity = document.getElementById('editQuantity').value;

            if (!quantity || quantity < 1) {
                alert('Please enter a valid quantity (minimum 1)');
                return;
            }

            try {
                const response = await fetch(`${ORDER_API_URL}/${orderId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        Quantity: parseInt(quantity)
                    })
                });

                if (response.ok) {
                    alert('Order updated successfully!');
                    closeEditModal();
                    loadOrders(); // Reload orders
                } else {
                    const error = await response.json();
                    alert('Failed to update order: ' + (error.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error updating order:', error);
                alert('Failed to update order. Please try again.');
            }
        }

        async function deleteOrder(orderId) {
            const order = allOrders.find(o => {
                const oId = o.orderId || o.OrderId || o.orderID || o.OrderID;
                return oId === orderId;
            });

            if (!order) return;

            const status = order.status !== undefined ? order.status : order.Status;
            
            // Only allow deleting if status is 0 (Pending)
            if (status !== 0) {
                alert('Only pending orders can be deleted!');
                return;
            }

            const orderCode = order.orderCode || order.OrderCode;

            if (!confirm(`Are you sure you want to delete order ${orderCode}?\n\nThis action cannot be undone.`)) {
                return;
            }

            try {
                const response = await fetch(`${ORDER_API_URL}/${orderId}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    alert('Order deleted successfully!');
                    loadOrders(); // Reload orders
                } else {
                    const error = await response.json();
                    alert('Failed to delete order: ' + (error.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error deleting order:', error);
                alert('Failed to delete order. Please try again.');
            }
        }

        function navigateTo(page) {
    if (page === 'profile') {
        openProfileModal();
        return;
    }
    
    switch(page) {
        case 'products':
            window.location.href = 'userdashboard.php';
            break;
        case 'orders':
            // Already on orders page
            break;
        default:
            break;
    }
}

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                sessionStorage.removeItem('userId');
                sessionStorage.removeItem('fullName');
                sessionStorage.removeItem('role');
                window.location.href = '../Homepage.php';
            }
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                closeEditModal();
            }
        }
        async function openProfileModal() {
    const modal = document.getElementById('profileModal');
    modal.style.display = 'block';
    
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
    modal.style.display = 'none';
    document.getElementById('profileForm').reset();
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
    const originalHTML = saveBtn.innerHTML;
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
        saveBtn.innerHTML = originalHTML;
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
        font-weight: 600;
        border-radius: 4px;
    `;
    notification.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// Close modals when clicking outside of them
window.onclick = function(event) {
    const editModal = document.getElementById('editModal');
    const profileModal = document.getElementById('profileModal');
    
    if (event.target == editModal) {
        closeEditModal();
    }
    
    if (event.target == profileModal) {
        closeProfileModal();
    }
}
async function confirmOrder(orderId) {
    const order = allOrders.find(o => {
        const oId = o.orderId || o.OrderId || o.orderID || o.OrderID;
        return oId === orderId;
    });

    if (!order) return;

    const orderCode = order.orderCode || order.OrderCode;

    if (!confirm(`Are you sure you want to confirm order ${orderCode}?`)) {
        return;
    }

    try {
        // Use the /status endpoint
        const response = await fetch(`${ORDER_API_URL}/${orderId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(1)  // Send just the status value
        });

        if (response.ok) {
            showNotification('Order confirmed successfully!');
            loadOrders();
        } else {
            const error = await response.json();
            alert('Failed to confirm order: ' + (error.message || 'Unknown error'));
        }
    } catch (error) {
        console.error('Error confirming order:', error);
        alert('Failed to confirm order. Please try again.');
    }
}

async function cancelOrder(orderId) {
    const order = allOrders.find(o => {
        const oId = o.orderId || o.OrderId || o.orderID || o.OrderID;
        return oId === orderId;
    });

    if (!order) return;

    const orderCode = order.orderCode || order.OrderCode;

    if (!confirm(`Are you sure you want to cancel order ${orderCode}?\n\nThis action cannot be undone.`)) {
        return;
    }

    try {
        // Use the /status endpoint
        const response = await fetch(`${ORDER_API_URL}/${orderId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(2)  // Send just the status value
        });

        if (response.ok) {
            showNotification('Order cancelled successfully!');
            loadOrders();
        } else {
            const error = await response.json();
            alert('Failed to cancel order: ' + (error.message || 'Unknown error'));
        }
    } catch (error) {
        console.error('Error cancelling order:', error);
        alert('Failed to cancel order. Please try again.');
    }
}
    </script>
</body>
</html>