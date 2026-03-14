<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header h1 {
            font-size: 1.8rem;
        }

        .back-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s;
            font-size: 1rem;
            display: inline-block;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .tab-navigation {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 0.8rem 1.5rem;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            color: #333;
        }

        .tab-btn:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .search-container {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box input {
            flex: 1;
            min-width: 200px;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-box select {
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: border-color 0.3s;
            min-width: 150px;
        }

        .search-box select:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-box button {
            padding: 0.8rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s;
            white-space: nowrap;
        }

        .search-box button:hover {
            transform: translateY(-2px);
        }

        .loading {
            text-align: center;
            padding: 3rem;
            font-size: 1.2rem;
            color: #667eea;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
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

        .orders-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image.no-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 3rem;
        }

        .card-content {
            padding: 1.5rem;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .order-code {
            font-weight: 600;
            color: #667eea;
            font-size: 1.1rem;
            word-break: break-word;
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            word-wrap: break-word;
        }

        .customer-name {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
            word-wrap: break-word;
        }

        .order-details {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            gap: 0.5rem;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            color: #666;
            font-weight: 500;
        }

        .detail-value {
            color: #333;
            font-weight: 600;
            text-align: right;
        }

        .quotation-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
        }

        .quotation-info .detail-row {
            margin-bottom: 0.3rem;
        }

        .quotation-price {
            color: #667eea;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .quotation-total {
            color: #764ba2;
            font-weight: 700;
            font-size: 1.2rem;
            text-align: right;
            padding-top: 0.5rem;
            border-top: 2px solid #667eea;
        }

        .created-at {
            font-size: 0.85rem;
            color: #999;
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
            margin-bottom: 1rem;
        }

.action-buttons {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.8rem;
}

        .btn-action {
            padding: 0.7rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-quotation {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-quotation:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(79, 172, 254, 0.3);
        }

        .btn-action:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .no-results h2 {
            color: #667eea;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #666;
        }

        .order-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
            overflow-y: auto;
            padding: 1rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: white;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
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
            font-size: 1.5rem;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 1.5rem;
        }

        .modal-body {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group .info-text {
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.3rem;
        }

        .price-calculation {
            background: #e8f5e9;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .price-calculation .calc-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            gap: 1rem;
        }

        .price-calculation .calc-row:last-child {
            margin-bottom: 0;
            padding-top: 0.5rem;
            border-top: 2px solid #4caf50;
            font-weight: 600;
            font-size: 1.1rem;
            color: #2e7d32;
        }

        .modal-footer {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .btn-modal {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.2s;
            flex: 1;
            min-width: 120px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .btn-close {
            background: #e0e0e0;
            color: #333;
        }

        .btn-close:hover {
            background: #d0d0d0;
        }

        @media (max-width: 1024px) {
            .orders-container {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .header h1 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
                margin: 1rem auto;
            }

            .header {
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .header h1 {
                font-size: 1.4rem;
                text-align: center;
            }

            .back-btn {
                width: 100%;
                text-align: center;
            }

            .search-container {
                padding: 1rem;
            }

            .search-box {
                flex-direction: column;
            }

            .search-box input,
            .search-box select,
            .search-box button {
                width: 100%;
                min-width: auto;
            }

            .orders-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .product-image {
                height: 180px;
            }

            .card-content {
                padding: 1.2rem;
            }

            .modal {
                padding: 0.5rem;
            }

            .modal-content {
                margin: 1rem auto;
                padding: 1.5rem;
            }

            .modal-header {
                font-size: 1.3rem;
            }

            .modal-footer {
                flex-direction: column;
            }

            .btn-modal {
                width: 100%;
            }

            .tab-navigation {
                flex-direction: column;
            }

            .tab-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.2rem;
            }

            .back-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .container {
                margin: 0.5rem auto;
                padding: 0 0.75rem;
            }

            .search-container {
                padding: 0.8rem;
                margin-bottom: 1rem;
            }

            .search-box input,
            .search-box select,
            .search-box button {
                padding: 0.7rem 0.8rem;
                font-size: 0.95rem;
            }

            .orders-container {
                gap: 1rem;
            }

            .product-image {
                height: 160px;
            }

            .product-image.no-image {
                font-size: 2.5rem;
            }

            .card-content {
                padding: 1rem;
            }

            .order-code {
                font-size: 1rem;
            }

            .product-name {
                font-size: 1rem;
            }

            .customer-name {
                font-size: 0.85rem;
            }

            .detail-row {
                font-size: 0.85rem;
            }

            .order-details {
                padding: 0.8rem;
            }

            .quotation-info {
                padding: 0.8rem;
            }

            .created-at {
                font-size: 0.8rem;
            }

            .btn-action {
                padding: 0.6rem 0.8rem;
                font-size: 0.85rem;
            }

            .order-count {
                padding: 1rem;
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            .modal-content {
                padding: 1.2rem;
            }

            .modal-header {
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group label {
                font-size: 0.9rem;
            }

            .form-group input,
            .form-group select {
                padding: 0.7rem;
                font-size: 0.95rem;
            }

            .form-group .info-text {
                font-size: 0.8rem;
            }

            .price-calculation {
                padding: 0.8rem;
            }

            .price-calculation .calc-row {
                font-size: 0.85rem;
            }

            .price-calculation .calc-row:last-child {
                font-size: 1rem;
            }

            .btn-modal {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
            }

            .no-results {
                padding: 2rem 1rem;
            }

            .no-results h2 {
                font-size: 1.3rem;
            }

            .no-results p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>📦 Manage Orders</h1>
            <button class="back-btn" onclick="goBack()">← Back</button>
        </div>
    </div>

    <div class="container">
        <div class="tab-navigation">
            <button class="tab-btn active" onclick="switchTab('all')">All Orders</button>
            <button class="tab-btn" onclick="switchTab('pending')">Pending Orders</button>
            <button class="tab-btn" onclick="switchTab('quotations')">Quotations Sent</button>
        </div>

        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by order code or customer name..." onkeyup="searchOrders()">
                <select id="statusFilter" onchange="searchOrders()">
                    <option value="">All Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Completed</option>
                    <option value="2">Cancelled</option>
                </select>
                <button onclick="searchOrders()">🔍 Search</button>
            </div>
        </div>

        <div id="loadingSpinner" class="loading">
            <div class="spinner"></div>
            <p>Loading orders...</p>
        </div>

        <div id="orderCount" class="order-count" style="display: none;"></div>
        <div id="ordersContainer" class="orders-container" style="display: none;"></div>

        <div id="noResults" class="no-results" style="display: none;">
            <h2>No Orders Found</h2>
            <p>No orders match your search criteria.</p>
        </div>
    </div>

    <div id="quotationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">📧 Send Quotation</div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Order Code</label>
                    <input type="text" id="modalOrderCode" readonly>
                </div>
                <div class="form-group">
                    <label>Product</label>
                    <input type="text" id="modalProduct" readonly>
                </div>
                <div class="form-group">
                    <label>Customer</label>
                    <input type="text" id="modalCustomer" readonly>
                </div>
                <div class="form-group">
                    <label>Quantity Requested</label>
                    <input type="number" id="modalQuantity" readonly>
                </div>
                <div class="form-group">
                    <label>Original Unit Price (per item)</label>
                    <input type="number" id="modalUnitPrice" readonly step="0.01">
                </div>
                <div class="form-group">
                    <label>Your Quoted Price (per item) *</label>
                    <input type="number" id="modalQuotedPrice" placeholder="Enter your price per item" step="0.01" required oninput="calculateTotal()">
                    <div class="info-text">Enter the price for ONE item/unit of this product</div>
                </div>
                <div class="price-calculation" id="priceCalculation" style="display: none;">
                    <div class="calc-row">
                        <span>Price per item:</span>
                        <span id="calcUnitPrice">$0.00</span>
                    </div>
                    <div class="calc-row">
                        <span>Quantity:</span>
                        <span id="calcQuantity">0</span>
                    </div>
                    <div class="calc-row">
                        <span>Total Quotation:</span>
                        <span id="calcTotal">$0.00</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-modal btn-close" onclick="closeQuotationModal()">Cancel</button>
                <button class="btn-modal btn-submit" onclick="submitQuotation()">Send Quotation</button>
            </div>
        </div>
    </div>

    <script>
        const ORDER_API_URL = 'https://localhost:7048/api/Order';
        const PRODUCT_API_URL = 'https://localhost:7048/api/Product';
        const CUSTOMER_API_URL = 'https://localhost:7048/api/User';
        const QUOTATION_API_URL = 'https://localhost:7048/api/Quotation';

        let allOrders = [];
        let allProducts = {};
        let allCustomers = {};
        let allQuotations = [];
        let currentOrderData = null;
        let currentDistributorId = null;
        let currentTab = 'all';

        function goBack() {
            window.history.back();
        }

        document.addEventListener('DOMContentLoaded', function() {
            currentDistributorId = sessionStorage.getItem("distributorId");
            
            if (!currentDistributorId) {
                alert('Session expired. Please login again.');
                window.location.href = '../login.php';
                return;
            }

            loadAllData();
        });

        async function loadAllData() {
            try {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.getElementById('ordersContainer').style.display = 'none';
                document.getElementById('noResults').style.display = 'none';
                document.getElementById('orderCount').style.display = 'none';

                await Promise.all([
                    loadOrders(),
                    loadProducts(),
                    loadCustomers(),
                    loadQuotations()
                ]);

                refreshCurrentTab();

            } catch (error) {
                console.error('Error loading data:', error);
                alert('Failed to load data. Please check your API connections.');
            } finally {
                document.getElementById('loadingSpinner').style.display = 'none';
            }
        }

        async function loadOrders() {
            try {
                const response = await fetch(ORDER_API_URL);
                if (!response.ok) throw new Error('Failed to fetch orders');
                allOrders = await response.json();
            } catch (error) {
                console.error('Error loading orders:', error);
                throw error;
            }
        }

        async function loadProducts() {
            try {
                const response = await fetch(PRODUCT_API_URL);
                if (!response.ok) throw new Error('Failed to fetch products');
                const products = await response.json();
                products.forEach(p => {
                    allProducts[p.productID] = p;
                });
            } catch (error) {
                console.error('Error loading products:', error);
            }
        }

        async function loadCustomers() {
            try {
                const response = await fetch(CUSTOMER_API_URL);
                if (!response.ok) throw new Error('Failed to fetch customers');
                const customers = await response.json();
                customers.forEach(c => {
                    allCustomers[c.customerID] = c;
                });
            } catch (error) {
                console.error('Error loading customers:', error);
            }
        }

        async function loadQuotations() {
            try {
                const response = await fetch(QUOTATION_API_URL);
                if (!response.ok) throw new Error('Failed to fetch quotations');
                allQuotations = await response.json();
            } catch (error) {
                console.error('Error loading quotations:', error);
            }
        }

        function switchTab(tab) {
            currentTab = tab;
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            refreshCurrentTab();
        }

        function refreshCurrentTab() {
            let ordersToDisplay = [];

            if (currentTab === 'all') {
                ordersToDisplay = allOrders;
            } else if (currentTab === 'pending') {
    ordersToDisplay = allOrders.filter(order => 
        order.status === 0 && !hasDistributorQuotedOrder(order.orderID, currentDistributorId)
    );
} else if (currentTab === 'quotations') {
                ordersToDisplay = allOrders.filter(order => {
                    return allQuotations.some(q => 
                        q.orderID === order.orderID && q.distributorID === parseInt(currentDistributorId)
                    );
                });
            }

            displayOrders(ordersToDisplay);
        }

        function hasDistributorQuotedOrder(orderId, distributorId) {
            return allQuotations.some(q => 
                q.orderID === parseInt(orderId) && q.distributorID === parseInt(distributorId)
            );
        }

        function getDistributorQuotation(orderId, distributorId) {
            return allQuotations.find(q => 
                q.orderID === parseInt(orderId) && q.distributorID === parseInt(distributorId)
            );
        }

        function getStatusInfo(status) {
            switch(status) {
                case 0:
                    return { text: 'Pending', class: 'status-pending' };
                case 1:
                    return { text: 'Completed', class: 'status-completed' };
                case 2:
                    return { text: 'Cancelled', class: 'status-cancelled' };
                default:
                    return { text: 'Unknown', class: 'status-pending' };
            }
        }

        function displayOrders(orders) {
            const container = document.getElementById('ordersContainer');
            const countDiv = document.getElementById('orderCount');
            const noResults = document.getElementById('noResults');

            container.innerHTML = '';

            if (orders.length === 0) {
                container.style.display = 'none';
                countDiv.style.display = 'none';
                noResults.style.display = 'block';
                return;
            }

            container.style.display = 'grid';
            countDiv.style.display = 'block';
            noResults.style.display = 'none';

            countDiv.textContent = `Showing ${orders.length} Order${orders.length !== 1 ? 's' : ''}`;

            orders.forEach(order => {
                const product = allProducts[order.productId] || {};
                const customer = allCustomers[order.customerID] || {};
                const statusInfo = getStatusInfo(order.status);
                const createdDate = new Date(order.createdAt).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const hasQuoted = hasDistributorQuotedOrder(order.orderID, currentDistributorId);
                const quotation = getDistributorQuotation(order.orderID, currentDistributorId);

                let productImageHtml = '';
                if (product.imageBase64) {
                    productImageHtml = `<div class="product-image"><img src="data:image/png;base64,${product.imageBase64}" alt="Product"></div>`;
                } else {
                    productImageHtml = `<div class="product-image no-image">📦</div>`;
                }

                let quotationHtml = '';
                if (hasQuoted && quotation && currentTab === 'quotations') {
                    const quotationTotal = quotation.quotedPrice * order.quantity;
                    quotationHtml = `
                        <div class="quotation-info">
                            <div class="detail-row">
                                <span class="detail-label">Your Quoted Price:</span>
                                <span class="quotation-price">${quotation.quotedPrice.toFixed(2)}/unit</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Quantity:</span>
                                <span class="detail-value">${order.quantity} units</span>
                            </div>
                            <div class="quotation-total">
                                Total: ${quotationTotal.toFixed(2)}
                            </div>
                        </div>
                    `;
                }

                const card = document.createElement('div');
                card.className = 'order-card';
                card.innerHTML = `
                    ${productImageHtml}
                    <div class="card-content">
                        <div class="order-header">
                            <span class="order-code">${order.orderCode}</span>
                            <span class="status-badge ${statusInfo.class}">${statusInfo.text}</span>
                        </div>

                        <div class="product-name">${product.productName || 'N/A'}</div>
                        <div class="customer-name">Customer: <strong>${customer.fullName || 'N/A'}</strong></div>

                        <div class="order-details">
                            <div class="detail-row">
                                <span class="detail-label">Quantity:</span>
                                <span class="detail-value">${order.quantity}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Unit Price:</span>
                                <span class="detail-value">${order.unitPrice.toFixed(2)}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Total Price:</span>
                                <span class="detail-value">${order.totalPrice.toFixed(2)}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Order ID:</span>
                                <span class="detail-value">#${order.orderID}</span>
                            </div>
                        </div>

                        ${quotationHtml}

                        <div class="created-at">${createdDate}</div>

                        <div class="action-buttons">
                            <button class="btn-action btn-quotation" onclick="openQuotationModal(${order.orderID}, '${order.orderCode}')" ${order.status !== 0 || hasQuoted ? 'disabled' : ''}>${hasQuoted ? '✓ Quoted' : '📧 Quotation'}</button>
                        </div>
                    </div>
                `;

                container.appendChild(card);
            });
        }

        function openQuotationModal(orderId, orderCode) {
            const order = allOrders.find(o => o.orderID === orderId);
            if (!order) {
                alert('Order not found');
                return;
            }

            if (hasDistributorQuotedOrder(orderId, currentDistributorId)) {
                alert('You have already submitted a quotation for this order.');
                return;
            }

            const product = allProducts[order.productId] || {};
            const customer = allCustomers[order.customerID] || {};

            currentOrderData = order;

            document.getElementById('modalOrderCode').value = orderCode;
            document.getElementById('modalProduct').value = product.productName || 'N/A';
            document.getElementById('modalCustomer').value = customer.fullName || 'N/A';
            document.getElementById('modalQuantity').value = order.quantity;
            document.getElementById('modalUnitPrice').value = order.unitPrice.toFixed(2);
            document.getElementById('modalQuotedPrice').value = '';
            document.getElementById('priceCalculation').style.display = 'none';

            document.getElementById('quotationModal').style.display = 'block';
        }

        function closeQuotationModal() {
            document.getElementById('quotationModal').style.display = 'none';
            currentOrderData = null;
        }

        function calculateTotal() {
            const quotedPrice = parseFloat(document.getElementById('modalQuotedPrice').value);
            const quantity = parseInt(document.getElementById('modalQuantity').value);

            if (!isNaN(quotedPrice) && quotedPrice > 0 && !isNaN(quantity)) {
                const total = quotedPrice * quantity;
                
                document.getElementById('calcUnitPrice').textContent = `${quotedPrice.toFixed(2)}`;
                document.getElementById('calcQuantity').textContent = quantity;
                document.getElementById('calcTotal').textContent = `${total.toFixed(2)}`;
                document.getElementById('priceCalculation').style.display = 'block';
            } else {
                document.getElementById('priceCalculation').style.display = 'none';
            }
        }

        async function submitQuotation() {
            const quotedPrice = document.getElementById('modalQuotedPrice').value;

            if (!quotedPrice) {
                alert('Please enter a quoted price per item');
                return;
            }

            if (isNaN(quotedPrice) || quotedPrice <= 0) {
                alert('Please enter a valid quoted price');
                return;
            }

            try {
                const response = await fetch(`${QUOTATION_API_URL}/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: currentOrderData.orderID,
                        distributorID: parseInt(currentDistributorId),
                        quotedPrice: parseFloat(quotedPrice)
                    })
                });

                if (response.ok) {
                    alert('Quotation sent successfully!');
                    closeQuotationModal();
                    loadAllData();
                } else {
                    const errorData = await response.json();
                    alert(`Failed to send quotation: ${errorData.message || 'Unknown error'}`);
                }
            } catch (error) {
                console.error('Error submitting quotation:', error);
                alert('An error occurred while sending the quotation.');
            }
        }

        function searchOrders() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;

            let ordersToFilter = [];

            if (currentTab === 'all') {
                ordersToFilter = allOrders;
            } else if (currentTab === 'pending') {
                ordersToFilter = allOrders.filter(order => order.status === 0);
            } else if (currentTab === 'quotations') {
                ordersToFilter = allOrders.filter(order => {
                    return allQuotations.some(q => 
                        q.orderID === order.orderID && q.distributorID === parseInt(currentDistributorId)
                    );
                });
            }

            const filteredOrders = ordersToFilter.filter(order => {
                const product = allProducts[order.productId] || {};
                const customer = allCustomers[order.customerID] || {};

                const matchesSearch =
                    order.orderCode.toLowerCase().includes(searchTerm) ||
                    (customer.fullName || '').toLowerCase().includes(searchTerm) ||
                    (product.productName || '').toLowerCase().includes(searchTerm);

                const matchesStatus = !statusFilter || order.status.toString() === statusFilter;

                return matchesSearch && matchesStatus;
            });

            displayOrders(filteredOrders);
        }

        window.onclick = function(event) {
            const modal = document.getElementById('quotationModal');
            if (event.target == modal) {
                closeQuotationModal();
            }
        }
    </script>
</body>
</html>