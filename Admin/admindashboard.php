<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetHub Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            color: #2c3e50;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo::before {
            content: "⚙️";
            font-size: 2rem;
        }

        nav ul.nav-menu {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        nav ul.nav-menu li a {
            color: white;
            text-decoration: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        nav ul.nav-menu li a:hover,
        nav ul.nav-menu li a.active {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid rgba(255,255,255,0.5);
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            background: rgba(255,255,255,0.4);
            transform: scale(1.05);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            background: white;
            min-width: 200px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        .dropdown-content.active {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.2s;
        }

        .dropdown-content a:hover {
            background: #f5f5f5;
            padding-left: 20px;
        }

        .dropdown-content a:last-child {
            color: #e74c3c;
            border-top: 1px solid #f0f0f0;
        }

        /* Main Container */
        .main-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 2rem;
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .dashboard-header p {
            color: #7f8c8d;
            font-size: 1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            transition: width 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .stat-card:hover::before {
            width: 100%;
            opacity: 0.05;
        }

        .stat-card.orders::before { background: #667eea; }
        .stat-card.categories::before { background: #10b981; }
        .stat-card.products::before { background: #f59e0b; }
        .stat-card.users::before { background: #8b5cf6; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .stat-card.orders .stat-icon { background: rgba(102, 126, 234, 0.15); }
        .stat-card.categories .stat-icon { background: rgba(16, 185, 129, 0.15); }
        .stat-card.products .stat-icon { background: rgba(245, 158, 11, 0.15); }
        .stat-card.users .stat-icon { background: rgba(139, 92, 246, 0.15); }

        .stat-content h3 {
            font-size: 0.85rem;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #ecf0f1;
        }

        .trend-indicator {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }

        .trend-up {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .trend-down {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        .trend-text {
            font-size: 0.85rem;
            color: #95a5a6;
        }

        /* Charts Section */
        .charts-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .chart-filter {
            display: flex;
            gap: 0.5rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .filter-btn:hover {
            background: #f5f5f5;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .chart-wrapper {
            position: relative;
            height: 350px;
        }

        /* Recent Activity */
        .activity-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .activity-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .activity-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .view-all {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .view-all:hover {
            color: #764ba2;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: #f9fafb;
            margin: 0 -1rem;
            padding: 1rem;
            border-radius: 8px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .activity-icon.order { background: rgba(102, 126, 234, 0.15); }
        .activity-icon.product { background: rgba(245, 158, 11, 0.15); }
        .activity-icon.user { background: rgba(139, 92, 246, 0.15); }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 0.95rem;
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #95a5a6;
        }

        /* Quick Stats */
        .quick-stats {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .quick-stat-item {
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }

        .quick-stat-item:hover {
            transform: translateX(5px);
        }

        .quick-stat-item.revenue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .quick-stat-item.pending {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .quick-stat-item.completed {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .quick-stat-label {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .quick-stat-value {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .quick-stat-icon {
            font-size: 2rem;
        }

        /* Loading State */
        .loading {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 200px;
            color: #95a5a6;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .charts-container,
            .activity-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            nav ul.nav-menu {
                display: none;
            }

            .menu-toggle {
                display: block;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .main-container {
                padding: 1rem;
            }

            .chart-wrapper {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">GadgetHub</div>
            
            <nav>
                <ul class="nav-menu">
                    <li><a href="admindashboard.php" class="active">Dashboard</a></li>
                    <li><a href="managecategory.php">Category</a></li>
                    <li><a href="manageproducts.php">Products</a></li>
                    <li><a href="ManageOrders.php">Orders</a></li>
                    <li><a href="ManageQutations.php">Quotations</a></li>
                    <li><a href="ManageUsers.php">Users</a></li>
                </ul>
            </nav>

            <div class="user-profile">
                <span id="welcomeText">Welcome, Admin</span>
                <div class="dropdown">
                    <div class="profile-avatar" id="profileAvatar" onclick="toggleDropdown()">A</div>
                    <div class="dropdown-content" id="profileDropdown">
                        <a href="#" onclick="logout(event)">Logout</a>
                    </div>
                </div>
            </div>

            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Dashboard Overview</h1>
            <p>Monitor your business performance and key metrics</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card orders">
                <div class="stat-icon">📦</div>
                <div class="stat-content">
                    <h3>Total Orders</h3>
                    <div class="stat-value" id="ordersCount">0</div>
                    <div class="stat-trend">
                        <span class="trend-indicator trend-up">↑ 12%</span>
                        <span class="trend-text">vs last month</span>
                    </div>
                </div>
            </div>

            <div class="stat-card categories">
                <div class="stat-icon">🏷️</div>
                <div class="stat-content">
                    <h3>Categories</h3>
                    <div class="stat-value" id="categoriesCount">0</div>
                    <div class="stat-trend">
                        <span class="trend-indicator trend-up">↑ 5%</span>
                        <span class="trend-text">active categories</span>
                    </div>
                </div>
            </div>

            <div class="stat-card products">
                <div class="stat-icon">🛍️</div>
                <div class="stat-content">
                    <h3>Total Products</h3>
                    <div class="stat-value" id="productsCount">0</div>
                    <div class="stat-trend">
                        <span class="trend-indicator trend-up">↑ 8%</span>
                        <span class="trend-text">in inventory</span>
                    </div>
                </div>
            </div>

            <div class="stat-card users">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <h3>Total Users</h3>
                    <div class="stat-value" id="usersCount">0</div>
                    <div class="stat-trend">
                        <span class="trend-indicator trend-up">↑ 15%</span>
                        <span class="trend-text">new registrations</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <h2 class="chart-title">Sales Overview</h2>
                    <div class="chart-filter">
                        <button class="filter-btn active" onclick="updateChart('week')">Week</button>
                        <button class="filter-btn" onclick="updateChart('month')">Month</button>
                        <button class="filter-btn" onclick="updateChart('year')">Year</button>
                    </div>
                </div>
                <div class="chart-wrapper">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h2 class="chart-title">Order Status</h2>
                </div>
                <div class="chart-wrapper">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="activity-section">
            <div class="activity-card">
                <div class="activity-header">
                    <h2 class="activity-title">Recent Orders</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <ul class="activity-list" id="recentOrders">
                    <li class="loading">
                        <div class="spinner"></div>
                    </li>
                </ul>
            </div>

            <div class="activity-card">
                <div class="activity-header">
                    <h2 class="activity-title">Quick Stats</h2>
                </div>
                <div class="quick-stats">
                    <div class="quick-stat-item revenue">
                        <div>
                            <div class="quick-stat-label">Total Revenue</div>
                            <div class="quick-stat-value" id="totalRevenue">$0</div>
                        </div>
                        <div class="quick-stat-icon">💰</div>
                    </div>
                    <div class="quick-stat-item pending">
                        <div>
                            <div class="quick-stat-label">Pending Orders</div>
                            <div class="quick-stat-value" id="pendingOrders">0</div>
                        </div>
                        <div class="quick-stat-icon">⏳</div>
                    </div>
                    <div class="quick-stat-item completed">
                        <div>
                            <div class="quick-stat-label">Completed</div>
                            <div class="quick-stat-value" id="completedOrders">0</div>
                        </div>
                        <div class="quick-stat-icon">✅</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_BASE_URL = 'https://localhost:7048/api';
        let salesChart, statusChart;

        // Initialize Dashboard
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
            initCharts();
            loadRecentOrders();
        });

        // Load Statistics
        async function loadStatistics() {
            try {
                const [ordersRes, categoriesRes, productsRes, usersRes] = await Promise.all([
                    fetch(`${API_BASE_URL}/Order/count`),
                    fetch(`${API_BASE_URL}/category`),
                    fetch(`${API_BASE_URL}/product`),
                    fetch(`${API_BASE_URL}/User/count`)
                ]);

                if (ordersRes.ok) {
                    const data = await ordersRes.json();
                    document.getElementById('ordersCount').textContent = data.totalOrders || 0;
                }

                if (categoriesRes.ok) {
                    const data = await categoriesRes.json();
                    document.getElementById('categoriesCount').textContent = data.length || 0;
                }

                if (productsRes.ok) {
                    const data = await productsRes.json();
                    document.getElementById('productsCount').textContent = data.length || 0;
                }

                if (usersRes.ok) {
                    const data = await usersRes.json();
                    document.getElementById('usersCount').textContent = data.totalUsers || 0;
                }

                loadOrderStats();
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        // Load Order Statistics
        async function loadOrderStats() {
            try {
                const ordersRes = await fetch(`${API_BASE_URL}/Order`);
                if (ordersRes.ok) {
                    const orders = await ordersRes.json();
                    
                    let totalRevenue = 0;
                    let pending = 0;
                    let completed = 0;

                    orders.forEach(order => {
                        totalRevenue += order.totalPrice || 0;
                        if (order.status === 0) pending++;
                        if (order.status === 2) completed++;
                    });

                    document.getElementById('totalRevenue').textContent = 
                        '$' + totalRevenue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('pendingOrders').textContent = pending;
                    document.getElementById('completedOrders').textContent = completed;
                }
            } catch (error) {
                console.error('Error loading order stats:', error);
            }
        }

        // Initialize Charts
        function initCharts() {
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Sales',
                        data: [120, 190, 130, 250, 220, 310, 280],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#667eea'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
                    datasets: [{
                        data: [30, 20, 45, 5],
                        backgroundColor: [
                            '#f59e0b',
                            '#667eea',
                            '#10b981',
                            '#ef4444'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
        }

        // Load Recent Orders
        async function loadRecentOrders() {
            try {
                const ordersRes = await fetch(`${API_BASE_URL}/Order`);
                if (ordersRes.ok) {
                    const orders = await ordersRes.json();
                    const recentOrders = orders.slice(0, 5);
                    
                    const ordersList = document.getElementById('recentOrders');
                    ordersList.innerHTML = recentOrders.map(order => {
                        const statusText = ['Pending', 'Processing', 'Completed', 'Cancelled'][order.status] || 'Unknown';
                        const timeAgo = getTimeAgo(new Date(order.createdAt));
                        
                        return `
                            <li class="activity-item">
                                <div class="activity-icon order">📦</div>
                                <div class="activity-content">
                                    <div class="activity-text">Order ${order.orderCode} - ${statusText}</div>
                                    <div class="activity-time">${timeAgo}</div>
                                </div>
                            </li>
                        `;
                    }).join('');
                }
            } catch (error) {
                console.error('Error loading recent orders:', error);
                document.getElementById('recentOrders').innerHTML = 
                    '<li style="padding: 2rem; text-align: center; color: #95a5a6;">No recent orders</li>';
            }
        }

        // Update Chart Filter
        function updateChart(period) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            let labels, data;
            if (period === 'week') {
                labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                data = [120, 190, 130, 250, 220, 310, 280];
            } else if (period === 'month') {
                labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                data = [850, 920, 780, 1100];
            } else {
                labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                data = [3200, 3500, 3100, 3800, 4200, 4500, 4100, 4800, 4400, 5100, 4900, 5500];
            }

            salesChart.data.labels = labels;
            salesChart.data.datasets[0].data = data;
            salesChart.update();
        }

        // Helper Functions
        function getTimeAgo(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            
            if (seconds < 60) return 'Just now';
            if (seconds < 3600) return Math.floor(seconds / 60) + ' minutes ago';
            if (seconds < 86400) return Math.floor(seconds / 3600) + ' hours ago';
            return Math.floor(seconds / 86400) + ' days ago';
        }

        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('active');
        }

        function toggleMenu() {
            const nav = document.querySelector('.nav-menu');
            nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
        }

        function logout(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                alert('Logged out successfully!');
                window.location.href = '../login.php';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const avatar = document.getElementById('profileAvatar');
            
            if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Auto-refresh data every 30 seconds
        setInterval(() => {
            loadStatistics();
            loadRecentOrders();
        }, 30000);

        // Smooth scroll for view all links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>