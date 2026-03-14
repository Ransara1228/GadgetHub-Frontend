<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetHub - Your Ultimate Tech Marketplace</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --accent: #f093fb;
            --dark: #1a202c;
            --light: #f7fafc;
            --success: #48bb78;
            --warning: #ed8936;
            --danger: #f56565;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background: var(--light);
            overflow-x: hidden;
        }

        /* Top Bar */
        .top-bar {
            background: linear-gradient(135deg, var(--dark) 0%, #2d3748 100%);
            color: white;
            padding: 10px 0;
            font-size: 13px;
        }

        .top-bar-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .top-bar-left {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .top-bar-right {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .top-bar a:hover {
            color: var(--accent);
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo::before {
            content: "⚡";
            font-size: 32px;
            -webkit-text-fill-color: var(--primary);
        }

        .search-bar {
            flex: 1;
            max-width: 600px;
            display: flex;
            position: relative;
        }

        .search-bar select {
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 8px 0 0 8px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            outline: none;
        }

        .search-bar input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-left: none;
            border-right: none;
            outline: none;
            font-size: 14px;
        }

        .search-bar button {
            padding: 12px 25px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s;
        }

        .search-bar button:hover {
            transform: translateX(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .header-actions {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .header-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .header-action:hover {
            transform: translateY(-2px);
        }

        .header-action-icon {
            font-size: 24px;
            margin-bottom: 3px;
        }

        .header-action-text {
            font-size: 11px;
            font-weight: 600;
            color: #718096;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--danger);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 11px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--dark);
        }

        /* Navigation */
        .nav {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 0;
        }

        .nav-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 0;
        }

        .nav-links li {
            position: relative;
        }

        .nav-links a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.15);
        }

        .nav-right {
            display: flex;
            gap: 15px;
        }

        .btn-nav {
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            transition: all 0.3s;
            border: 2px solid white;
        }

        .btn-login {
            color: white;
            background: transparent;
        }

        .btn-login:hover {
            background: white;
            color: var(--primary);
        }

        .btn-signup {
            background: white;
            color: var(--primary);
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255,255,255,0.3);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.1), transparent);
            top: -200px;
            right: -200px;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text h1 {
            font-size: 56px;
            font-weight: 900;
            color: white;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-text .highlight {
            color: #ffd700;
            display: block;
        }

        .hero-text p {
            font-size: 18px;
            color: rgba(255,255,255,0.95);
            margin-bottom: 35px;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 16px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,255,255,0.3);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary);
        }

        .hero-image {
            position: relative;
            animation: slideUp 1s ease-out;
            border-radius: 30px;
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-image img {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 50px rgba(0,0,0,0.3));
            border-radius: 30px;
        }

        /* Stats Section */
        .stats {
            background: white;
            margin: -50px auto 0;
            max-width: 1300px;
            border-radius: 20px;
            box-shadow: 0 10px 50px rgba(0,0,0,0.1);
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 42px;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Features Section */
        .features {
            padding: 100px 20px;
            background: var(--light);
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .section-header h2 {
            font-size: 42px;
            font-weight: 900;
            color: var(--dark);
            margin-bottom: 15px;
        }

        .section-header p {
            font-size: 18px;
            color: #718096;
        }

        .features-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(102, 126, 234, 0.2);
        }

        .feature-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .feature-card p {
            color: #718096;
            line-height: 1.8;
            font-size: 15px;
        }

        /* Categories Section */
        .categories {
            padding: 100px 20px;
            background: white;
        }

        .categories-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .category-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 50px 30px;
            border-radius: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
            opacity: 0;
            transition: all 0.3s;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.3);
        }

        .category-card:nth-child(2) {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .category-card:nth-child(3) {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .category-card:nth-child(4) {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .category-icon {
            font-size: 72px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .category-card h3 {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .category-card p {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        /* Products Section */
        .products {
            padding: 100px 20px;
            background: var(--light);
        }

        .products-grid {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.15);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--danger);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 900;
            z-index: 10;
        }

        .product-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            position: relative;
        }

        .product-info {
            padding: 25px;
        }

        .product-category {
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .product-rating {
            color: #ffc107;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 28px;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .product-card .btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            justify-content: center;
        }

        /* CTA Section */
        .cta {
            padding: 100px 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1), transparent);
            bottom: -200px;
            left: -200px;
            border-radius: 50%;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-size: 48px;
            font-weight: 900;
            color: white;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 20px;
            color: rgba(255,255,255,0.95);
            margin-bottom: 40px;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 80px 20px 30px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin-bottom: 50px;
        }

        .footer-col h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 25px;
            color: white;
        }

        .footer-col p {
            color: #a0aec0;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 12px;
        }

        .footer-col a {
            color: #a0aec0;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .footer-col a:hover {
            color: var(--accent);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #a0aec0;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-text h1 {
                font-size: 42px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .top-bar {
                display: none;
            }

            .header-content {
                flex-wrap: wrap;
            }

            .search-bar {
                order: 3;
                width: 100%;
                max-width: 100%;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .nav-content {
                flex-direction: column;
                padding: 20px;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                display: none;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links a {
                padding: 15px;
                text-align: center;
            }

            .nav-right {
                flex-direction: column;
                width: 100%;
            }

            .btn-nav {
                width: 100%;
                text-align: center;
            }

            .hero {
                padding: 50px 20px;
            }

            .hero-text h1 {
                font-size: 36px;
            }

            .hero-text p {
                font-size: 16px;
            }

            .section-header h2 {
                font-size: 32px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .cta h2 {
                font-size: 36px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 22px;
            }

            .header-actions {
                gap: 15px;
            }

            .hero-text h1 {
                font-size: 28px;
            }

            .btn {
                padding: 12px 25px;
                font-size: 14px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
   

    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">GadgetHub</div>
        
            <div class="search-bar">
                
                <input type="text" placeholder="Search for products, brands and more...">
                <button>🔍 Search</button>
            </div>

            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav">
        <div class="nav-content">
            <ul class="nav-links" id="navLinks">
                <li><a href="index.html">Home</a></li>
                <li><a href="#categories">Categories</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="AboutUs.php">About</a></li>
                <li><a href="Contactus.php">Contact</a></li>
            </ul>
            <div class="nav-right">
                <a href="login.php" class="btn-nav btn-login">Login</a>
                <a href="Customer/register.php" class="btn-nav btn-signup">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>
                    Discover Amazing
                    <span class="highlight">Tech Deals</span>
                </h1>
                <p>Shop the latest gadgets from verified distributors. Get competitive quotes, compare prices, and enjoy secure transactions on your favorite tech products.</p>
                <div class="hero-buttons">
                   
                    <a href="#products" class="btn btn-outline">
                        🛍️ Browse Products
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="Photos/new.jpg" alt="GadgetHub Hero">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">📦</div>
                <div class="stat-number" id="productsCount">500+</div>
                <div class="stat-label">Products Available</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">🏢</div>
                <div class="stat-number" id="distributorsCount">50+</div>
                <div class="stat-label">Verified Distributors</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">👥</div>
                <div class="stat-number" id="usersCount">1000+</div>
                <div class="stat-label">Happy Users</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">✅</div>
                <div class="stat-number" id="ordersCount">2000+</div>
                <div class="stat-label">Orders Completed</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-header">
            <h2>Why Choose GadgetHub?</h2>
            <p>Experience the future of tech shopping with our premium features</p>
        </div>
        <div class="features-grid">
            <div class="feature-card loading">
                <div class="feature-icon">🔒</div>
                <h3>Secure Payments</h3>
                <p>Enterprise-grade security with encrypted transactions. Your data and payments are always protected.</p>
            </div>
            <div class="feature-card loading">
                <div class="feature-icon">⚡</div>
                <h3>Fast Delivery</h3>
                <p>Quick shipping with real-time tracking. Get your gadgets delivered to your doorstep in record time.</p>
            </div>
            <div class="feature-card loading">
                <div class="feature-icon">💰</div>
                <h3>Best Prices</h3>
                <p>Compare quotes from multiple distributors and get the best deals on premium tech products.</p>
            </div>
            <div class="feature-card loading">
                <div class="feature-icon">✓</div>
                <h3>Quality Guaranteed</h3>
                <p>100% authentic products with warranty. All items are verified and quality-assured.</p>
            </div>
            <div class="feature-card loading">
                <div class="feature-icon">🎯</div>
                <h3>Wide Selection</h3>
                <p>Thousands of products across multiple categories. Find everything you need in one place.</p>
            </div>
            <div class="feature-card loading">
                <div class="feature-icon">💬</div>
                <h3>24/7 Support</h3>
                <p>Round-the-clock customer service. Our team is always ready to help you.</p>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="section-header">
            <h2>Browse by Category</h2>
            <p>Explore our extensive range of tech products</p>
        </div>
        <div class="categories-grid">
            <div class="category-card loading">
                <div class="category-icon">📱</div>
                <h3>Smartphones</h3>
                <p>Latest flagship devices</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">💻</div>
                <h3>Laptops</h3>
                <p>Powerful computing solutions</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">🎧</div>
                <h3>Audio</h3>
                <p>Premium sound experience</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">⌚</div>
                <h3>Wearables</h3>
                <p>Smart watches & fitness trackers</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">📷</div>
                <h3>Cameras</h3>
                <p>Professional photography gear</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">🎮</div>
                <h3>Gaming</h3>
                <p>Consoles & accessories</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">🏠</div>
                <h3>Smart Home</h3>
                <p>Connected living solutions</p>
            </div>
            <div class="category-card loading">
                <div class="category-icon">🔋</div>
                <h3>Accessories</h3>
                <p>Chargers, cables & more</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="products">
        <div class="section-header">
            <h2>Featured Products</h2>
            <p>Handpicked deals on the latest tech</p>
        </div>
        <div class="products-grid" id="productsGrid">
            <div class="product-card loading">
                <div class="product-badge">-30%</div>
                <div class="product-image">📱</div>
                <div class="product-info">
                    <div class="product-category">Smartphones</div>
                    <div class="product-name">Latest Smartphone Pro</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐ (256 reviews)</div>
                    <div class="product-price">$999</div>
                    <button class="btn btn-primary">🛒 Add to Cart</button>
                </div>
            </div>
            <div class="product-card loading">
                <div class="product-badge">Sale</div>
                <div class="product-image">💻</div>
                <div class="product-info">
                    <div class="product-category">Laptops</div>
                    <div class="product-name">Ultra Slim Laptop</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐ (189 reviews)</div>
                    <div class="product-price">$1,299</div>
                    <button class="btn btn-primary">🛒 Add to Cart</button>
                </div>
            </div>
            <div class="product-card loading">
                <div class="product-badge">Hot</div>
                <div class="product-image">🎧</div>
                <div class="product-info">
                    <div class="product-category">Audio</div>
                    <div class="product-name">Wireless Earbuds Pro</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐ (412 reviews)</div>
                    <div class="product-price">$199</div>
                    <button class="btn btn-primary">🛒 Add to Cart</button>
                </div>
            </div>
            <div class="product-card loading">
                <div class="product-badge">New</div>
                <div class="product-image">⌚</div>
                <div class="product-info">
                    <div class="product-category">Wearables</div>
                    <div class="product-name">Smart Watch Elite</div>
                    <div class="product-rating">⭐⭐⭐⭐⭐ (328 reviews)</div>
                    <div class="product-price">$399</div>
                    <button class="btn btn-primary">🛒 Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-content">
            <h2>Ready to Start Shopping?</h2>
            <p>Join thousands of satisfied customers and discover the best deals on premium tech products</p>
            <div class="hero-buttons">
                <a href="Customer/register.php" class="btn btn-primary">Create Free Account</a>
                <a href="#products" class="btn btn-outline">Explore Products</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3>GadgetHub</h3>
                <p>Your trusted marketplace for cutting-edge technology and gadgets. Connect with verified distributors and get the best deals.</p>
                <div class="social-links">
                    <a href="#" class="social-link">📘</a>
                    <a href="#" class="social-link">🐦</a>
                    <a href="#" class="social-link">📸</a>
                    <a href="#" class="social-link">💼</a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="#categories">Categories</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Customer Service</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Warranty</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 GadgetHub. All rights reserved. Built with ❤️ for tech enthusiasts.</p>
        </div>
    </footer>

    <script>
        const API_BASE_URL = 'https://localhost:7048/api';

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animate counters
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                if (start >= target) {
                    element.textContent = Math.floor(target) + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(start) + '+';
                }
            }, 16);
        }

        // Load stats from API
        async function loadStats() {
            try {
                // Load products count
                const productsRes = await fetch(`${API_BASE_URL}/product`);
                if (productsRes.ok) {
                    const products = await productsRes.json();
                    animateCounter(document.getElementById('productsCount'), products.length);
                }

                // Load distributors count
                const distributorsRes = await fetch(`${API_BASE_URL}/Distributor/count`);
                if (distributorsRes.ok) {
                    const data = await distributorsRes.json();
                    animateCounter(document.getElementById('distributorsCount'), data.totalDistributors);
                }

                // Load users count
                const usersRes = await fetch(`${API_BASE_URL}/User/count`);
                if (usersRes.ok) {
                    const data = await usersRes.json();
                    animateCounter(document.getElementById('usersCount'), data.totalUsers);
                }

                // Load orders count
                const ordersRes = await fetch(`${API_BASE_URL}/Order/count`);
                if (ordersRes.ok) {
                    const data = await ordersRes.json();
                    animateCounter(document.getElementById('ordersCount'), data.totalOrders);
                }
            } catch (error) {
                console.log('Using default stats values');
            }
        }

        // Load featured products
        async function loadFeaturedProducts() {
            try {
                const response = await fetch(`${API_BASE_URL}/product`);
                if (response.ok) {
                    const products = await response.json();
                    const featured = products.slice(0, 4);
                    
                    const productsGrid = document.getElementById('productsGrid');
                    productsGrid.innerHTML = featured.map(product => {
                        const imageHTML = product.imageBase64 
                            ? `<img src="data:image/png;base64,${product.imageBase64}" alt="${product.productName}" style="width: 100%; height: 100%; object-fit: cover;">`
                            : `<div style="font-size: 80px;">📱</div>`;
                        
                        return `
                            <div class="product-card loading">
                                <div class="product-badge">Featured</div>
                                <div class="product-image">${imageHTML}</div>
                                <div class="product-info">
                                    <div class="product-category">${product.category?.categoryName || 'Electronics'}</div>
                                    <div class="product-name">${product.productName}</div>
                                    <div class="product-rating">⭐⭐⭐⭐⭐ (${Math.floor(Math.random() * 500) + 100} reviews)</div>
                                    <div class="product-price">Request Quote</div>
                                    <button class="btn btn-primary" onclick="viewProduct(${product.productID})">🛒 View Details</button>
                                </div>
                            </div>
                        `;
                    }).join('');
                }
            } catch (error) {
                console.log('Using default featured products');
            }
        }

        // View product details
        function viewProduct(productId) {
            alert(`Redirecting to product details... Product ID: ${productId}`);
            // window.location.href = `product-details.html?id=${productId}`;
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = '0s';
                    entry.target.classList.add('loading');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .category-card, .product-card').forEach(el => {
            observer.observe(el);
        });

        // Header scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.15)';
            } else {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            }

            lastScroll = currentScroll;
        });

        // Add to cart functionality
        let cart = [];
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-primary') && e.target.textContent.includes('Add to Cart')) {
                const productCard = e.target.closest('.product-card');
                const productName = productCard.querySelector('.product-name').textContent;
                cart.push(productName);
                
                // Update cart badge
                const badge = document.querySelector('.badge');
                badge.textContent = cart.length;
                
                // Show notification
                showNotification(`${productName} added to cart!`);
            }
        });

        // Notification system
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: linear-gradient(135deg, var(--success), #38b2ac);
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                z-index: 10000;
                animation: slideIn 0.3s ease-out;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Search functionality
        document.querySelector('.search-bar button').addEventListener('click', () => {
            const searchValue = document.querySelector('.search-bar input').value;
            if (searchValue) {
                showNotification(`Searching for: ${searchValue}`);
                // Implement search logic here
            }
        });

        // Category card click
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', () => {
                const category = card.querySelector('h3').textContent;
                showNotification(`Browsing ${category} category`);
                // Implement category filter logic here
            });
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            loadStats();
            loadFeaturedProducts();
        });

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>