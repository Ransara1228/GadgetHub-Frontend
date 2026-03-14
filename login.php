<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GadgetHub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo h1 {
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .logo p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.85rem 1rem;
            padding-left: 2.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.1rem;
            color: #999;
        }

        .input-icon svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .message {
            margin-top: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            display: none;
        }

        .message.error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
            display: block;
        }

        .message.success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
            display: block;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: #999;
            font-size: 0.85rem;
            position: relative;
            z-index: 1;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e0e0e0;
        }

        .register-link p {
            color: #666;
            font-size: 0.95rem;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .logo h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>GadgetHub</h1>
            <p>Welcome back! Please login to your account</p>
        </div>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <input type="email" id="email" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </span>
                    <input type="password" id="password" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Login</button>

            <div class="message" id="message"></div>
        </form>

        <div class="register-link">
            <p>Don't have an account? <a href="Customer/register.php">Create an account</a></p>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById("loginForm");
        const messageEl = document.getElementById("message");
        const loginBtn = document.querySelector(".btn-login");

        // Reset form state when page loads (fixes back button issue)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || performance.getEntriesByType("navigation")[0].type === 'back_forward') {
                resetButton();
                messageEl.style.display = "none";
                loginForm.reset();
            }
        });

        // Also reset on page load
        document.addEventListener('DOMContentLoaded', function() {
            resetButton();
            messageEl.style.display = "none";
        });

        loginForm.addEventListener("submit", async function(e) {
            e.preventDefault();

            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            // Disable button during submission
            loginBtn.disabled = true;
            loginBtn.textContent = "Logging in...";
            messageEl.style.display = "none";
            messageEl.className = "message";

            try {
                // FIRST TRY USER LOGIN (Admin/Customer)
                let response = await fetch("https://localhost:7048/api/User/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ email, password })
                });

                let result = await response.json();

                // If user or admin found
                if (response.ok) {
                    sessionStorage.setItem("userId", result.userId);
                    sessionStorage.setItem("fullName", result.fullName);
                    sessionStorage.setItem("role", result.role);

                    messageEl.textContent = "Login successful! Redirecting...";
                    messageEl.className = "message success";
                    messageEl.style.display = "block";

                    setTimeout(() => {
                        if (result.role === "Customer") {
                            window.location.href = "Customer/userdashboard.php";
                        } 
                        else if (result.role === "Admin") {
                            window.location.href = "Admin/admindashboard.php";
                        } 
                        else {
                            messageEl.textContent = "Access denied: Unknown role";
                            messageEl.className = "message error";
                            resetButton();
                        }
                    }, 1000);
                } 
                else {
                    // If not a user/admin, TRY DISTRIBUTOR LOGIN
                    const distResponse = await fetch("https://localhost:7048/api/Distributor/login", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ email, password })
                    });

                    const distResult = await distResponse.json();

                    if (distResponse.ok) {
                        sessionStorage.setItem("distributorId", distResult.distributorId);
                        sessionStorage.setItem("distributorName", distResult.distributorName);

                        messageEl.textContent = "Login successful! Redirecting...";
                        messageEl.className = "message success";
                        messageEl.style.display = "block";

                        setTimeout(() => {
                            window.location.href = "Distributor/distributordashboard.php";
                        }, 1000);
                    } else {
                        messageEl.textContent = distResult.message || "Invalid email or password";
                        messageEl.className = "message error";
                        messageEl.style.display = "block";
                        resetButton();
                    }
                }
            } catch (error) {
                console.error("Login error:", error);
                messageEl.textContent = "Connection error. Please try again.";
                messageEl.className = "message error";
                messageEl.style.display = "block";
                resetButton();
            }
        });

        function resetButton() {
            loginBtn.disabled = false;
            loginBtn.textContent = "Login";
        }
    </script>
</body>
</html>