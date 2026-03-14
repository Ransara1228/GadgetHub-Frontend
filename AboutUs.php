<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Gadget Hub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #f5f5f5;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #2d3561 0%, #1e2749 100%);
            color: white;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .header-top {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            background: linear-gradient(135deg, #00d4ff, #00f0ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
            cursor: pointer;
        }

        .search-container {
            flex: 1;
            margin: 0 40px;
            position: relative;
            display: flex;
            gap: 10px;
        }

        .search-container select {
            padding: 10px 15px;
            background: white;
            border: none;
            border-radius: 5px 0 0 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .search-container input {
            flex: 1;
            padding: 10px 15px;
            background: white;
            border: none;
            font-size: 14px;
        }

        .search-btn {
            padding: 10px 20px;
            background: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-weight: 600;
            color: #2d3561;
        }

        .header-icons {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .header-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s;
            font-size: 12px;
        }

        .header-icon:hover {
            transform: scale(1.1);
        }

        .header-icon span {
            font-size: 20px;
            margin-bottom: 3px;
        }

        .cart-badge {
            background: #ff006e;
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 900;
            position: absolute;
            top: -8px;
            right: -8px;
        }

        /* Nav */
        nav {
            background: linear-gradient(135deg, #1e2749 0%, #2d3561 100%);
            padding: 15px 0;
            border-top: 1px solid rgba(0, 212, 255, 0.1);
        }

        .nav-items {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-items a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: color 0.3s;
        }

        .nav-items a:hover {
            color: #00d4ff;
        }

        .nav-more {
            margin-left: auto;
            display: flex;
            gap: 20px;
        }

        /* Hero Banner */
        .about-hero {
            background: linear-gradient(135deg, #3d4a8f 0%, #5a3fb0 50%, #8b2d5a 100%);
            padding: 100px 40px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.15), transparent);
            border-radius: 50%;
        }

        .about-hero h1 {
            font-size: 56px;
            color: white;
            font-weight: 900;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .about-hero p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Main Content */
        .about-content {
            max-width: 1600px;
            margin: 0 auto;
            padding: 80px 40px;
        }

        .story-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 80px;
            align-items: center;
        }

        .story-text h2 {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .story-text p {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 15px;
        }

        .story-image {
            background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
            height: 400px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 150px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        /* Values Section */
        .values-section {
            margin-bottom: 80px;
        }

        .values-section h2 {
            font-size: 36px;
            font-weight: 900;
            text-align: center;
            margin-bottom: 50px;
            color: #1a1a1a;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .value-card {
            background: white;
            padding: 35px 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .value-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .value-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #2d3561;
        }

        .value-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #6a4cff, #9c27b0);
            padding: 60px 40px;
            border-radius: 15px;
            margin-bottom: 80px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 10px;
            color: #00d4ff;
        }

        .stat-label {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        /* Team Section */
        .team-section {
            margin-bottom: 80px;
        }

        .team-section h2 {
            font-size: 36px;
            font-weight: 900;
            text-align: center;
            margin-bottom: 50px;
            color: #1a1a1a;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .team-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .team-photo {
            background: linear-gradient(135deg, #e0e0e0, #d0d0d0);
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 100px;
        }

        .team-info {
            padding: 25px;
            text-align: center;
        }

        .team-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #1a1a1a;
        }

        .team-role {
            font-size: 14px;
            color: #00d4ff;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .team-bio {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            padding: 60px;
            border-radius: 15px;
            text-align: center;
            color: white;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 15px;
        }

        .cta-section p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .cta-btn {
            display: inline-block;
            background: white;
            color: #ff9800;
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 14px;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 40px 30px;
            margin-top: 0;
        }

        .footer-content {
            max-width: 1600px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            font-size: 14px;
            font-weight: 900;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-col a {
            display: block;
            color: #aaa;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .footer-col a:hover {
            color: #00d4ff;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #333;
            color: #666;
            font-size: 13px;
        }

        @media (max-width: 1200px) {
            .values-grid,
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .story-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .story-image {
                height: 300px;
                font-size: 120px;
            }
        }

        @media (max-width: 768px) {
            .header-top {
                padding: 0 20px;
                flex-wrap: wrap;
                gap: 15px;
            }

            .logo {
                font-size: 24px;
            }

            .search-container {
                order: 3;
                width: 100%;
                margin: 0;
            }

            .header-icons {
                gap: 15px;
            }

            .header-icon span {
                font-size: 18px;
            }

            .header-icon small {
                font-size: 10px;
            }

            .nav-items {
                padding: 0 20px;
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
            }

            .nav-items a {
                font-size: 13px;
            }

            .nav-more {
                margin-left: 0;
                width: 100%;
                justify-content: center;
                padding-top: 10px;
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .about-hero {
                padding: 60px 20px 50px;
            }

            .about-hero h1 {
                font-size: 36px;
            }

            .about-hero p {
                font-size: 16px;
            }

            .about-content {
                padding: 50px 20px;
            }

            .story-section {
                margin-bottom: 50px;
            }

            .story-text h2 {
                font-size: 28px;
            }

            .story-text p {
                font-size: 15px;
            }

            .story-image {
                height: 250px;
                font-size: 100px;
            }

            .values-section h2,
            .team-section h2 {
                font-size: 28px;
                margin-bottom: 30px;
            }

            .values-grid,
            .team-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .value-card {
                padding: 30px 20px;
            }

            .value-icon {
                font-size: 50px;
            }

            .stats-section {
                padding: 40px 20px;
                margin-bottom: 50px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .stat-number {
                font-size: 36px;
            }

            .stat-label {
                font-size: 12px;
            }

            .team-photo {
                height: 200px;
                font-size: 80px;
            }

            .team-info {
                padding: 20px;
            }

            .cta-section {
                padding: 40px 20px;
            }

            .cta-section h2 {
                font-size: 28px;
            }

            .cta-section p {
                font-size: 15px;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            footer {
                padding: 40px 20px 20px;
            }
        }

        @media (max-width: 480px) {
            .about-hero h1 {
                font-size: 28px;
            }

            .about-hero p {
                font-size: 14px;
            }

            .story-text h2,
            .values-section h2,
            .team-section h2,
            .cta-section h2 {
                font-size: 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .search-container select {
                display: none;
            }

            .search-container input {
                border-radius: 5px 0 0 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-top">
            <div class="logo">Gadget<span style="color: #ffc107;">Hub+</span></div>
        </div>
    </header>

    <!-- Navigation -->
    <nav>
        <div class="nav-items">
            <a href="Homepage.php">Back to homepage</a>
        </div>
    </nav>

    <!-- About Hero -->
    <section class="about-hero">
        <h1>About Gadget Hub</h1>
        <p>Your trusted destination for premium electronics and cutting-edge technology since 2015</p>
    </section>

    <!-- Main Content -->
    <div class="about-content">
        <!-- Our Story -->
        <section class="story-section">
            <div class="story-text">
                <h2>Our Story</h2>
                <p>Founded in 2015, Gadget Hub began with a simple mission: to make premium electronics accessible to everyone. What started as a small online store has grown into one of the most trusted names in consumer electronics.</p>
                <p>We believe technology should enhance lives, not complicate them. That's why we carefully curate every product in our catalog, ensuring it meets our high standards for quality, innovation, and value.</p>
                <p>Today, we serve millions of customers worldwide, offering everything from smartphones and laptops to smart home devices and accessories. Our commitment to excellence and customer satisfaction remains unchanged.</p>
            </div>
            <div class="story-image">🏢</div>
        </section>

        <!-- Our Values -->
        <section class="values-section">
            <h2>Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">💎</div>
                    <h3>Quality First</h3>
                    <p>We only offer products that meet our rigorous quality standards and come from trusted manufacturers.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Customer Focus</h3>
                    <p>Your satisfaction is our priority. We go above and beyond to ensure every purchase exceeds expectations.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🚀</div>
                    <h3>Innovation</h3>
                    <p>We stay ahead of tech trends to bring you the latest and most innovative products on the market.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌍</div>
                    <h3>Sustainability</h3>
                    <p>We're committed to reducing our environmental impact through eco-friendly practices and partnerships.</p>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">10M+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Products Sold</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Satisfaction Rate</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Customer Support</div>
                </div>
            </div>
        </section>

        <!-- Team -->
        <section class="team-section">
            <h2>Meet Our Leadership</h2>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-photo">👨‍💼</div>
                    <div class="team-info">
                        <div class="team-name">Alex Chen</div>
                        <div class="team-role">CEO & Founder</div>
                        <p class="team-bio">Visionary leader with 15+ years in tech retail and e-commerce.</p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-photo">👩‍💼</div>
                    <div class="team-info">
                        <div class="team-name">Sarah Johnson</div>
                        <div class="team-role">Chief Technology Officer</div>
                        <p class="team-bio">Tech innovator driving our digital transformation initiatives.</p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-photo">👨‍💼</div>
                    <div class="team-info">
                        <div class="team-name">Marcus Williams</div>
                        <div class="team-role">Head of Operations</div>
                        <p class="team-bio">Logistics expert ensuring seamless delivery experiences.</p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-photo">👩‍💼</div>
                    <div class="team-info">
                        <div class="team-name">Emma Rodriguez</div>
                        <div class="team-role">Customer Experience Director</div>
                        <p class="team-bio">Passionate about creating exceptional customer journeys.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <h2>Join the Gadget Hub Family</h2>
            <p>Experience the future of electronics shopping with exclusive deals and premium service</p>
            <button class="cta-btn">Start Shopping</button>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <h3>About Gadget Hub</h3>
                <a href="#">About Us</a>
                <a href="#">Our Story</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
            </div>
            <div class="footer-col">
                <h3>Customer Service</h3>
                <a href="#">Contact Us</a>
                <a href="#">FAQ</a>
                <a href="#">Shipping Info</a>
                <a href="#">Track Order</a>
            </div>
            <div class="footer-col">
                <h3>Policies</h3>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Return Policy</a>
                <a href="#">Warranty</a>
            </div>
            <div class="footer-col">
                <h3>Follow Us</h3>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
                <a href="#">YouTube</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Gadget Hub. All rights reserved. | Premium Electronics & Accessories Store</p>
        </div>
    </footer>

    <script>
        document.querySelector('.search-btn').addEventListener('click', function() {
            const searchValue = document.querySelector('.search-container input').value;
            if(searchValue) {
                alert('Searching for: ' + searchValue);
            }
        });

        document.querySelector('.logo').addEventListener('click', function() {
            window.location.href = '#';
        });

        document.querySelector('.cta-btn').addEventListener('click', function() {
            alert('Redirecting to shop...');
        });
    </script>
</body>
</html>
