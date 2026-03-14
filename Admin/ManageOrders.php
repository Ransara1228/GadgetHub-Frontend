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

        /* Header */
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
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Search Bar */
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
            min-width: 250px;
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
        }

        .search-box button:hover {
            transform: translateY(-2px);
        }

        /* Loading Spinner */
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

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 1.3rem;
        }

        .order-count {
            background: rgba(255,255,255,0.2);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        thead th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #e0e0e0;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #f8f9ff;
        }

        tbody td {
            padding: 1rem;
            color: #333;
            font-size: 0.95rem;
        }

        .order-code {
            font-weight: 600;
            color: #667eea;
        }

.status-badge {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
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

.status-added {
    background: #d1ecf1;
    color: #0c5460;
}

        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #4facfe;
            color: white;
        }

        .btn-edit:hover {
            background: #3a8fd9;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
            transform: translateY(-2px);
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 3rem;
        }

        .no-results h2 {
            color: #667eea;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #666;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            animation: slideUp 0.3s;
            margin: 2rem auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #999;
            transition: color 0.2s;
        }

        .close:hover {
            color: #f44336;
        }

        .modal-content h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-group input[type="number"],
        .form-group input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group .readonly {
            background: #f5f5f5;
            cursor: not-allowed;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .modal-actions button {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-save:hover {
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #e0e0e0;
            color: #333;
        }

        .btn-cancel:hover {
            background: #d0d0d0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .search-box {
                flex-direction: column;
            }

            .search-box input,
            .search-box select {
                width: 100%;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }

            .action-btns {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <h1>📋 Manage Orders</h1>
            <a href="admindashboard.php" class="back-btn">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Container -->
    <div class="container">
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by order code, user ID, or product ID..." onkeyup="searchOrders()">
                <select id="statusFilter" onchange="searchOrders()">
                    <option value="">All Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Completed</option>
                    <option value="2">Cancelled</option>
                    <option value="3">Distributer added</option>
                </select>
                <button onclick="searchOrders()">🔍 Search</button>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading">
            <div class="spinner"></div>
            <p>Loading orders...</p>
        </div>

        <!-- Table Container -->
        <div id="tableContainer" class="table-container" style="display: none;">
            <div class="table-header">
                <h2>📦 Order List</h2>
                <span class="order-count" id="orderCount">0 Orders</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Code</th>
                        <th>User ID</th>
                        <th>Product ID</th>
                        <th>Distributor ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <!-- Orders will be populated here -->
                </tbody>
            </table>
        </div>

        <!-- No Results -->
        <div id="noResults" class="no-results" style="display: none;">
            <h2>No Orders Found</h2>
            <p>No orders match your search criteria.</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Order</h2>
            <form id="editForm" onsubmit="updateOrder(event)">
                <input type="hidden" id="editOrderId">
                
                <div class="form-group">
                    <label for="editOrderCode">Order Code:</label>
                    <input type="text" id="editOrderCode" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label for="editUserId">User ID:</label>
                    <input type="number" id="editUserId" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label for="editProductId">Product ID:</label>
                    <input type="number" id="editProductId" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label for="editDistributorId">Distributor ID:</label>
                    <input type="number" id="editDistributorId" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label for="editQuantity">Quantity: *</label>
                    <input type="number" id="editQuantity" min="1" required>
                </div>

                <div class="form-group">
                    <label for="editUnitPrice">Unit Price:</label>
                    <input type="number" id="editUnitPrice" step="0.01" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label for="editTotalPrice">Total Price:</label>
                    <input type="number" id="editTotalPrice" step="0.01" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label for="editStatus">Status:</label>
                    <input type="text" id="editStatus" class="readonly" readonly>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn-save">💾 Save Changes</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const ORDER_API_URL = 'https://localhost:7048/api/Order';
        let allOrders = [];

        // Load orders on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadOrders();
        });

        // ✅ Load all orders from API
        async function loadOrders() {
            try {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.getElementById('tableContainer').style.display = 'none';
                document.getElementById('noResults').style.display = 'none';

                const response = await fetch(ORDER_API_URL);
                
                if (!response.ok) {
                    throw new Error('Failed to fetch orders');
                }

                allOrders = await response.json();
                displayOrders(allOrders);
                
            } catch (error) {
                console.error('Error loading orders:', error);
                alert('Failed to load orders. Please check your API connection.');
            } finally {
                document.getElementById('loadingSpinner').style.display = 'none';
            }
        }

        // ✅ Get status text and class
        function getStatusInfo(status) {
            switch(status) {
                case 0:
                    return { text: 'Pending', class: 'status-pending' };
                case 1:
                    return { text: 'Completed', class: 'status-completed' };
                case 2:
                    return { text: 'Cancelled', class: 'status-cancelled' };
                case 3:
                    return { text: 'Distributer Added', class: 'status-added' };
                default:
                    return { text: 'Unknown', class: 'status-pending' };
            }
        }

        // ✅ Display orders in table view
        function displayOrders(orders) {
            const tableBody = document.getElementById('orderTableBody');
            const orderCount = document.getElementById('orderCount');
            tableBody.innerHTML = '';

            if (orders.length === 0) {
                document.getElementById('tableContainer').style.display = 'none';
                document.getElementById('noResults').style.display = 'block';
                return;
            }

            document.getElementById('tableContainer').style.display = 'block';
            document.getElementById('noResults').style.display = 'none';
            orderCount.textContent = `${orders.length} Order${orders.length !== 1 ? 's' : ''}`;

            orders.forEach(order => {
                const row = document.createElement('tr');
                
                // Format date
                const createdDate = new Date(order.createdAt).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const statusInfo = getStatusInfo(order.status);

                row.innerHTML = `
                    <td>${order.orderID}</td>
                    <td><span class="order-code">${order.orderCode}</span></td>
                    <td>${order.userId}</td>
                    <td>${order.productId}</td>
                    <td>${order.distributorId}</td>
                    <td>${order.quantity}</td>
                    <td>$${order.unitPrice.toFixed(2)}</td>
                    <td>$${order.totalPrice.toFixed(2)}</td>
                    <td><span class="status-badge ${statusInfo.class}">${statusInfo.text}</span></td>
                    <td>${createdDate}</td>
                    <td>
                        <div class="action-btns">
                            <button class="btn btn-edit" onclick="openEditModal(${order.orderID})">✏️ Edit</button>
                            <button class="btn btn-delete" onclick="deleteOrder(${order.orderID}, '${order.orderCode}')">🗑️ Delete</button>
                        </div>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        }

        // ✅ Search orders
        function searchOrders() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            
            const filteredOrders = allOrders.filter(order => {
                const matchesSearch = 
                    order.orderCode.toLowerCase().includes(searchTerm) ||
                    order.userId.toString().includes(searchTerm) ||
                    order.productId.toString().includes(searchTerm);
                
                const matchesStatus = !statusFilter || order.status.toString() === statusFilter;
                
                return matchesSearch && matchesStatus;
            });
            
            displayOrders(filteredOrders);
        }

        // ✅ Open edit modal
        async function openEditModal(orderId) {
            try {
                // Find order in allOrders array
                const order = allOrders.find(o => o.orderID === orderId);
                
                if (!order) {
                    throw new Error('Order not found');
                }
                
                document.getElementById('editOrderId').value = order.orderID;
                document.getElementById('editOrderCode').value = order.orderCode;
                document.getElementById('editUserId').value = order.userId;
                document.getElementById('editProductId').value = order.productId;
                document.getElementById('editDistributorId').value = order.distributorId;
                document.getElementById('editQuantity').value = order.quantity;
                document.getElementById('editUnitPrice').value = order.unitPrice.toFixed(2);
                document.getElementById('editTotalPrice').value = order.totalPrice.toFixed(2);
                
                const statusInfo = getStatusInfo(order.status);
                document.getElementById('editStatus').value = statusInfo.text;
                
                document.getElementById('editModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
                
            } catch (error) {
                console.error('Error loading order:', error);
                alert('Failed to load order details.');
            }
        }

        // Close edit modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // ✅ Update order (only quantity can be updated)
        async function updateOrder(event) {
            event.preventDefault();
            
            const orderId = document.getElementById('editOrderId').value;
            const quantity = parseInt(document.getElementById('editQuantity').value);
            
            if (quantity < 1) {
                alert('Quantity must be at least 1.');
                return;
            }

            try {
                const updateResponse = await fetch(`${ORDER_API_URL}/${orderId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: parseInt(orderId),
                        quantity: quantity
                    })
                });

                if (updateResponse.ok) {
                    alert('Order updated successfully!');
                    closeEditModal();
                    loadOrders();
                } else {
                    const errorData = await updateResponse.json();
                    alert(`Failed to update order: ${errorData.message || 'Unknown error'}`);
                }
                
            } catch (error) {
                console.error('Error updating order:', error);
                alert('An error occurred while updating the order.');
            }
        }

        // ✅ Delete order
        async function deleteOrder(orderId, orderCode) {
            if (!confirm(`Are you sure you want to delete order "${orderCode}"?`)) {
                return;
            }

            try {
                const response = await fetch(`${ORDER_API_URL}/${orderId}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    alert('Order deleted successfully!');
                    loadOrders();
                } else {
                    const errorData = await response.json();
                    alert(`Failed to delete order: ${errorData.message || 'Unknown error'}`);
                }
                
            } catch (error) {
                console.error('Error deleting order:', error);
                alert('An error occurred while deleting the order.');
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>