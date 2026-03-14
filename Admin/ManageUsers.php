<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
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
            color: #667eea;
            font-size: 1.2rem;
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

        /* Users Table */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .user-id {
            font-weight: 600;
            color: #667eea;
        }

        .user-role {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .role-admin {
            background: #e3f2fd;
            color: #1976d2;
        }

        .role-customer {
            background: #e8f5e9;
            color: #388e3c;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.6rem 1rem;
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
            color: #999;
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
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            animation: slideUp 0.3s;
            margin: 2rem auto;
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
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

            .search-box input {
                width: 100%;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.75rem;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <h1>👥 Manage Customers</h1>
            <a href="admindashboard.php" class="back-btn">← Back to Dashboard</a>
        </div>
    </header>

    <!-- Container -->
    <div class="container">
        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search customers by name or email..." onkeyup="searchUsers()">
                <button onclick="searchUsers()">🔍 Search</button>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="loading">
            <div class="spinner"></div>
            <p>Loading customers...</p>
        </div>

        <!-- Users Table -->
        <div id="tableContainer" class="table-container" style="display: none;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                </tbody>
            </table>
        </div>

        <!-- No Results -->
        <div id="noResults" class="no-results" style="display: none;">
            <p>No customers found</p>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>✏️ Edit Customer</h2>
            <form id="editForm" onsubmit="updateUser(event)">
                <input type="hidden" id="editUserId">
                <input type="hidden" id="editRole">

                <div class="form-group">
                    <label for="editFullName">Full Name *</label>
                    <input type="text" id="editFullName" required>
                </div>

                <div class="form-group">
                    <label for="editEmail">Email *</label>
                    <input type="email" id="editEmail" required>
                </div>

                <div class="form-group">
                    <label for="editPassword">Password (leave blank to keep current)</label>
                    <input type="password" id="editPassword" placeholder="Enter new password or leave blank">
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn-save">💾 Save Changes</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const API_URL = 'https://localhost:7048/api/User';
        let allUsers = [];

        // Load users on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadUsers();
            
            // Test API connection
            testApiConnection();
        });

        // Test API Connection
        async function testApiConnection() {
            try {
                const response = await fetch(API_URL);
                console.log('✅ API Connection Test - Status:', response.status);
                if (response.ok) {
                    console.log('✅ API is reachable');
                }
            } catch (error) {
                console.error('❌ API Connection Failed:', error);
            }
        }

        // Load all users
        async function loadUsers() {
            try {
                document.getElementById('loadingSpinner').style.display = 'block';
                document.getElementById('tableContainer').style.display = 'none';
                document.getElementById('noResults').style.display = 'none';

                const response = await fetch(API_URL);
                if (!response.ok) throw new Error('Failed to load users');

                const users = await response.json();
                
                // Filter to show only customers
                allUsers = users.filter(user => user.role === 'Customer');
                displayUsers(allUsers);

            } catch (error) {
                console.error('Error loading users:', error);
                alert('Failed to load users. Please check your API connection.');
            } finally {
                document.getElementById('loadingSpinner').style.display = 'none';
            }
        }

        // Display users in table
        function displayUsers(users) {
            const tableBody = document.getElementById('usersTableBody');
            const tableContainer = document.getElementById('tableContainer');
            const noResults = document.getElementById('noResults');

            if (users.length === 0) {
                tableContainer.style.display = 'none';
                noResults.style.display = 'block';
                return;
            }

            tableBody.innerHTML = '';
            users.forEach(user => {
                const createdDate = new Date(user.createdAt).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });

                const roleClass = user.role === 'Admin' ? 'role-admin' : 'role-customer';

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="user-id">#${user.userId}</td>
                    <td>${user.fullName}</td>
                    <td>${user.email}</td>
                    <td><span class="user-role ${roleClass}">${user.role}</span></td>
                    <td>${createdDate}</td>
                    <td>
                        <div class="actions">
                            <button class="btn btn-edit" onclick="openEditModal(${user.userId})">✏️ Edit</button>
                            <button class="btn btn-delete" onclick="deleteUser(${user.userId}, '${user.fullName}')">🗑️ Delete</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            tableContainer.style.display = 'block';
            noResults.style.display = 'none';
        }

        // Search users
        function searchUsers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filtered = allUsers.filter(user =>
                user.role === 'Customer' && (
                    user.fullName.toLowerCase().includes(searchTerm) ||
                    user.email.toLowerCase().includes(searchTerm)
                )
            );
            displayUsers(filtered);
        }

        // Open edit modal
        async function openEditModal(userId) {
            try {
                console.log('=== EDIT MODAL DEBUG ===');
                console.log('User ID:', userId);
                console.log('User ID Type:', typeof userId);
                
                // Show loading state
                document.getElementById('editModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';

                // Build URL
                const url = `${API_URL}/${userId}`;
                console.log('Full URL:', url);
                
                // Test if user exists in allUsers array first
                const userFromList = allUsers.find(u => u.userId === userId);
                console.log('User from list:', userFromList);
                
                if (userFromList) {
                    // Use data from the list if available
                    console.log('✅ Using user data from list');
                    document.getElementById('editUserId').value = userFromList.userId;
                    document.getElementById('editFullName').value = userFromList.fullName;
                    document.getElementById('editEmail').value = userFromList.email;
                    document.getElementById('editPassword').value = '';
                    document.getElementById('editRole').value = userFromList.role;
                    return;
                }
                
                // Fetch from API
                console.log('Fetching from API...');
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                
                console.log('Response Status:', response.status);
                console.log('Response OK:', response.ok);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Error Response:', errorText);
                    throw new Error(`HTTP ${response.status}: ${errorText}`);
                }

                const user = await response.json();
                console.log('✅ User data received:', user);

                // Populate form fields
                document.getElementById('editUserId').value = user.userId;
                document.getElementById('editFullName').value = user.fullName;
                document.getElementById('editEmail').value = user.email;
                document.getElementById('editPassword').value = '';
                document.getElementById('editRole').value = user.role;

            } catch (error) {
                console.error('❌ ERROR:', error);
                console.error('Error Stack:', error.stack);
                alert(`Failed to load user details.\n\nError: ${error.message}\n\nCheck the browser console (F12) for more details.`);
                closeEditModal();
            }
        }

        // Close edit modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            document.getElementById('editForm').reset();
        }

        // Update user
        async function updateUser(event) {
            event.preventDefault();

            const userId = document.getElementById('editUserId').value;
            const fullName = document.getElementById('editFullName').value.trim();
            const email = document.getElementById('editEmail').value.trim();
            const password = document.getElementById('editPassword').value.trim();
            const role = document.getElementById('editRole').value;

            if (!fullName || !email || !role) {
                alert('Please fill all required fields.');
                return;
            }

            try {
                const updateData = {
                    userId: parseInt(userId),
                    fullName: fullName,
                    email: email,
                    role: role
                };

                // Only include password if it's provided
                if (password) {
                    updateData.password = password;
                }

                const response = await fetch(`${API_URL}/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(updateData)
                });

                if (!response.ok) {
                    const error = await response.json();
                    alert(`Failed to update user: ${error.message || 'Unknown error'}`);
                    return;
                }

                alert('✅ User updated successfully!');
                closeEditModal();
                loadUsers();

            } catch (error) {
                console.error('Error updating user:', error);
                alert('An error occurred while updating the user. Please try again.');
            }
        }

        // Delete user
        async function deleteUser(userId, fullName) {
            if (!confirm(`Are you sure you want to delete "${fullName}"?\n\nThis action cannot be undone.`)) {
                return;
            }

            try {
                const response = await fetch(`${API_URL}/${userId}`, {
                    method: 'DELETE'
                });

                if (!response.ok) {
                    alert('Failed to delete user. Please try again.');
                    return;
                }

                alert('✅ User deleted successfully!');
                loadUsers();

            } catch (error) {
                console.error('Error deleting user:', error);
                alert('An error occurred while deleting the user. Please try again.');
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