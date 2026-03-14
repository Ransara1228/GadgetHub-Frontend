<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Gadget Hub</title>
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
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            font-size: 24px;
            font-weight: 900;
            background: linear-gradient(135deg, #00d4ff, #00f0ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
            cursor: pointer;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 5px;
        }

        .search-container {
            flex: 1;
            max-width: 600px;
            min-width: 200px;
            position: relative;
            display: flex;
            gap: 0;
        }

        .search-container select {
            padding: 10px 15px;
            background: white;
            border: none;
            border-radius: 5px 0 0 5px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
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
            gap: 20px;
            align-items: center;
        }

        .header-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s;
            font-size: 11px;
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
            padding: 0 20px;
            display: flex;
            gap: 30px;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-items a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: color 0.3s;
            white-space: nowrap;
        }

        .nav-items a:hover {
            color: #00d4ff;
        }

        .nav-more {
            margin-left: auto;
            display: flex;
            gap: 20px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #3d4a8f 0%, #5a3fb0 50%, #8b2d5a 100%);
            padding: 60px 20px;
            text-align: center;
            color: white;
        }

        .page-header h1 {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Contact Section */
        .contact-section {
            max-width: 1600px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .contact-form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .contact-form-container h2 {
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 10px;
            color: #1a1a1a;
        }

        .contact-form-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00d4ff;
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #00d4ff, #00a8cc);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .info-card-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .info-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1a1a1a;
        }

        .info-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .info-card a {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
        }

        .info-card a:hover {
            text-decoration: underline;
        }

        /* Quick Contact Cards */
        .quick-contact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 60px;
        }

        .quick-card {
            background: linear-gradient(135deg, #6a4cff, #9c27b0);
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .quick-card:nth-child(2) {
            background: linear-gradient(135deg, #00d4ff, #00a8cc);
        }

        .quick-card:nth-child(3) {
            background: linear-gradient(135deg, #ffc107, #ff9800);
        }

        .quick-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        .quick-card-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .quick-card h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .quick-card p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 20px 30px;
            margin-top: 80px;
        }

        .footer-content {
            max-width: 1600px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header-top {
                padding: 0 15px;
            }

            .logo {
                font-size: 20px;
            }

            .mobile-menu-btn {
                display: block;
                order: 3;
            }

            .search-container {
                order: 4;
                width: 100%;
                flex-basis: 100%;
            }

            .search-container select {
                font-size: 12px;
                padding: 8px 10px;
                display: none;
            }

            .search-container input {
                font-size: 12px;
                padding: 8px 10px;
                border-radius: 5px 0 0 5px;
            }

            .header-icons {
                gap: 15px;
            }

            .header-icon small {
                display: none;
            }

            .nav-items {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                display: none;
            }

            .nav-items.active {
                display: flex;
            }

            .nav-more {
                margin-left: 0;
                width: 100%;
            }

            .page-header {
                padding: 40px 20px;
            }

            .page-header h1 {
                font-size: 32px;
            }

            .page-header p {
                font-size: 14px;
            }

            .contact-section {
                margin: 40px auto;
            }

            .quick-contact {
                grid-template-columns: 1fr;
                gap: 15px;
                margin-bottom: 40px;
            }

            .quick-card {
                padding: 30px 20px;
            }

            .quick-card-icon {
                font-size: 40px;
            }

            .quick-card h3 {
                font-size: 18px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .contact-form-container {
                padding: 30px 20px;
            }

            .contact-form-container h2 {
                font-size: 24px;
            }

            .info-card {
                padding: 25px 20px;
            }

            .info-card-icon {
                font-size: 35px;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            footer {
                padding: 40px 20px 20px;
                margin-top: 60px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 18px;
            }

            .header-icon span {
                font-size: 18px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .quick-card {
                padding: 25px 15px;
            }

            .contact-form-container {
                padding: 25px 15px;
            }

            .contact-form-container h2 {
                font-size: 20px;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                padding: 10px 12px;
                font-size: 13px;
            }

            .submit-btn {
                padding: 12px;
                font-size: 14px;
            }

            .info-card {
                padding: 20px 15px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .footer-col h3 {
                font-size: 13px;
            }

            .footer-col a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-top">
            <div class="logo">Gadget<span style="color: #ffc107;">Hub+</span></div>
            <button class="mobile-menu-btn">☰</button>
        </div>
    </header>

    <!-- Navigation -->
    <nav>
        <div class="nav-items">
            <a href="Homepage.php">Back to homepage</a>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <h1>Contact Us</h1>
        <p>We're here to help! Get in touch with our customer support team</p>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <!-- Quick Contact Cards -->
        <div class="quick-contact">
            <div class="quick-card">
                <div class="quick-card-icon">💬</div>
                <h3>Live Chat</h3>
                <p>Chat with our support team</p>
            </div>
            <div class="quick-card">
                <div class="quick-card-icon">📞</div>
                <h3>Call Us</h3>
                <p>Mon-Fri, 9AM-6PM EST</p>
            </div>
            <div class="quick-card">
                <div class="quick-card-icon">📧</div>
                <h3>Email Support</h3>
                <p>Response within 24 hours</p>
            </div>
        </div>

        <!-- Contact Form & Info -->
        <div class="contact-grid">
            <div class="contact-form-container">
                <h2>Send Us a Message</h2>
                <p>Fill out the form below and we'll get back to you as soon as possible</p>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="order">Order Inquiry</option>
                            <option value="product">Product Question</option>
                            <option value="technical">Technical Support</option>
                            <option value="return">Return/Refund</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>

            <div class="contact-info">
                <div class="info-card">
                    <div class="info-card-icon">📍</div>
                    <h3>Visit Our Store</h3>
                    <p>123 Tech Avenue<br>San Francisco, CA 94102<br>United States</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">📞</div>
                    <h3>Phone</h3>
                    <p>Customer Service:<br><a href="tel:+18005551234">+1 (800) 555-1234</a></p>
                    <p>Technical Support:<br><a href="tel:+18005555678">+1 (800) 555-5678</a></p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">✉</div>
                    <h3>Email</h3>
                    <p>General Inquiries:<br><a href="mailto:info@gadgethub.com">info@gadgethub.com</a></p>
                    <p>Support:<br><a href="mailto:support@gadgethub.com">support@gadgethub.com</a></p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">⏰</div>
                    <h3>Business Hours</h3>
                    <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <h3>About Gadget Hub</h3>
                <a href="about.html">About Us</a>
                <a href="#">Our Story</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
            </div>
            <div class="footer-col">
                <h3>Customer Service</h3>
                <a href="contact.html">Contact Us</a>
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
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            if(name && email && subject && message) {
                alert('Thank you for contacting us! We\'ll get back to you soon.');
                this.reset();
            }
        });

        document.querySelector('.search-btn').addEventListener('click', function() {
            const searchValue = document.querySelector('.search-container input').value;
            if(searchValue) {
                alert('Searching for: ' + searchValue);
            }
        });

        document.querySelectorAll('.quick-card').forEach(card => {
            card.addEventListener('click', function() {
                const title = this.querySelector('h3').textContent;
                alert('Opening ' + title + '...');
            });
        });

        document.querySelector('.logo').addEventListener('click', function() {
            window.location.href = 'index.html';
        });

        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const nav = document.querySelector('nav .nav-items');
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>
