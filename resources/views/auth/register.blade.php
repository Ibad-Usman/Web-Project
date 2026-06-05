<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Property Booking</title>
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

        .register-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 18px;
        }

        .password-requirements {
            background: #f8f9fa;
            border-left: 3px solid #667eea;
            padding: 12px;
            margin-top: 10px;
            border-radius: 4px;
            font-size: 12px;
            color: #666;
        }

        .password-requirements ul {
            margin-left: 20px;
            margin-top: 8px;
        }

        .password-requirements li {
            margin: 4px 0;
        }

        .password-requirements .valid {
            color: #27ae60;
        }

        .password-requirements .invalid {
            color: #e74c3c;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            font-size: 13px;
            color: #666;
        }

        .terms-checkbox input {
            margin-right: 10px;
            margin-top: 2px;
            cursor: pointer;
        }

        .terms-checkbox a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s;
        }

        .terms-checkbox a:hover {
            color: #764ba2;
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Create Account</h1>
            <p>Join us to start booking properties</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required 
                        autofocus
                        placeholder="John Doe"
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        placeholder="+1 (555) 000-0000"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    placeholder="you@example.com"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="At least 8 characters"
                >
                <div class="password-requirements">
                    <strong>Password must contain:</strong>
                    <ul>
                        <li id="length">✓ At least 8 characters</li>
                        <li id="uppercase">✓ One uppercase letter</li>
                        <li id="lowercase">✓ One lowercase letter</li>
                        <li id="number">✓ One number</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                    placeholder="Re-enter your password"
                >
            </div>

            <div class="terms-checkbox">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="register-btn">Create Account</button>

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const requirementsList = {
            length: document.getElementById('length'),
            uppercase: document.getElementById('uppercase'),
            lowercase: document.getElementById('lowercase'),
            number: document.getElementById('number')
        };

        passwordInput.addEventListener('input', function() {
            const password = this.value;

            if (password.length >= 8) {
                requirementsList.length.className = 'valid';
                requirementsList.length.textContent = '✓ At least 8 characters';
            } else {
                requirementsList.length.className = 'invalid';
                requirementsList.length.textContent = '✗ At least 8 characters';
            }

            if (/[A-Z]/.test(password)) {
                requirementsList.uppercase.className = 'valid';
                requirementsList.uppercase.textContent = '✓ One uppercase letter';
            } else {
                requirementsList.uppercase.className = 'invalid';
                requirementsList.uppercase.textContent = '✗ One uppercase letter';
            }

            if (/[a-z]/.test(password)) {
                requirementsList.lowercase.className = 'valid';
                requirementsList.lowercase.textContent = '✓ One lowercase letter';
            } else {
                requirementsList.lowercase.className = 'invalid';
                requirementsList.lowercase.textContent = '✗ One lowercase letter';
            }

            if (/[0-9]/.test(password)) {
                requirementsList.number.className = 'valid';
                requirementsList.number.textContent = '✓ One number';
            } else {
                requirementsList.number.className = 'invalid';
                requirementsList.number.textContent = '✗ One number';
            }
        });
    </script>
</body>
</html>