<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Dashboard</title>
         <link rel="stylesheet" href="css/DistributerDashboard.css">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                📦 DistroHub
            </a>
            <button class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="distributordashboard.php" class="nav-link active">Dashboard</a></li>
                <li><a href="ManageOrders.php" class="nav-link">Orders</a></li>

                <li><button class="logout-btn" id="logoutBtn">Logout</button></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Profile Card -->
        <div class="dashboard-grid">
            <div class="card profile-card">
                <div class="profile-info">
                    <h2>Welcome, <span id="distName"></span>!</h2>
                    <p>Distributor ID: <span id="distId"></span></p>
                </div>
                <div class="profile-badge">
                    <p>Status</p>
                    <strong style="color: #ffd700;">Active</strong>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="dashboard-grid">
            <div class="card">
                <div class="card-icon">📊</div>
                <div class="card-title">Total Orders</div>
                <div class="card-value">1,284</div>
                <div class="card-subtitle">+12% from last month</div>
            </div>

            <div class="card">
                <div class="card-icon">💰</div>
                <div class="card-title">Revenue</div>
                <div class="card-value">$45,820</div>
                <div class="card-subtitle">This month</div>
            </div>

            <div class="card">
                <div class="card-icon">📦</div>
                <div class="card-title">Products</div>
                <div class="card-value">342</div>
                <div class="card-subtitle">In inventory</div>
            </div>

            <div class="card">
                <div class="card-icon">⭐</div>
                <div class="card-title">Rating</div>
                <div class="card-value">4.8/5</div>
                <div class="card-subtitle">Customer satisfaction</div>
            </div>
        </div>

        <!-- Additional Stats Section -->
        <div class="stats-section">
            <div class="stats-title">Performance Metrics</div>
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-label">Pending Orders</div>
                    <div class="stat-value">23</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Completed Orders</div>
                    <div class="stat-value">1,261</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Avg Delivery Time</div>
                    <div class="stat-value">2.5 days</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Return Rate</div>
                    <div class="stat-value">0.8%</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fetch distributor data from sessionStorage
        const distId = sessionStorage.getItem("distributorId") || "DIST-001";
        const distName = sessionStorage.getItem("distributorName") || "John Distributor";

        // Protect the page: redirect to login if not logged in
        if (!sessionStorage.getItem("distributorId") || !sessionStorage.getItem("distributorName")) {
            console.log("Session not found. In production, redirect to login.");
        }

        // Display the info
        document.getElementById("distId").textContent = distId;
        document.getElementById("distName").textContent = distName;

        // Mobile hamburger menu
        const hamburger = document.getElementById("hamburger");
        const navMenu = document.getElementById("navMenu");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            navMenu.classList.toggle("active");
        });

        // Close menu when a link is clicked
        document.querySelectorAll(".nav-link").forEach(link => {
            link.addEventListener("click", function() {
                document.querySelectorAll(".nav-link").forEach(l => l.classList.remove("active"));
                this.classList.add("active");
                hamburger.classList.remove("active");
                navMenu.classList.remove("active");
            });
        });

// Logout functionality
document.getElementById("logoutBtn").addEventListener("click", () => {
    sessionStorage.clear();
    alert("Logged out successfully!");
    window.location.href = "../login.php";
});
    </script>
</body>
</html>