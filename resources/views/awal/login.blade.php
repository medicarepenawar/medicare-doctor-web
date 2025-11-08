<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Doctor Login</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --card: #ffffff;
            --accent: #2563eb;
            --accent-2: #0ea5a0;
            --muted: #6b7280;
            --danger: #ef4444;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            background: linear-gradient(180deg, rgba(37, 99, 235, 0.06), rgba(14, 165, 160, 0.03)), var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            width: 100%;
            max-width: 420px;
            background: var(--card);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
            padding: 28px;
            position: relative;
            overflow: hidden;
        }

        .brand {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 18px;
        }

        .logo {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            display: grid;
            place-items: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.14)
        }

        h1 {
            margin: 0;
            font-size: 20px
        }

        p.lead {
            margin: 6px 0 18px;
            color: var(--muted);
            font-size: 13px
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px
        }

        label {
            font-size: 13px;
            color: #374151;
            display: block;
            margin-bottom: 6px
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        input[type="email"],
        input[type="password"] {
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #e6e9ef;
            background: transparent;
            font-size: 14px;
            outline: none;
            transition: box-shadow .15s, border-color .15s;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.08)
        }

        .meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 6px
        }

        .checkbox {
            display: flex;
            gap: 8px;
            align-items: center;
            font-size: 13px;
            color: var(--muted)
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 14px;
            border-radius: 10px;
            border: 0;
            background: var(--accent);
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px
        }

        .btn.secondary {
            background: transparent;
            border: 1px solid #e6e9ef;
            color: #111
        }

        .footer-note {
            margin-top: 16px;
            font-size: 13px;
            color: var(--muted);
            text-align: center
        }

        .error {
            color: var(--danger);
            font-size: 13px;
            margin-top: 6px
        }

        .pw-toggle {
            background: transparent;
            border: 0;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 8px
        }

        @media (max-width:420px) {
            body {
                padding: 16px
            }

            .container {
                padding: 20px
            }
        }
    </style>
</head>

<body>
    <main class="container" role="main">
        <div class="brand">
            <div>
                <h1>Doctor Login</h1>
                <p class="lead">Sign in using your registered clinic email</p>
            </div>
        </div>

        <form id="loginForm" novalidate>
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="doctor@clinic.com" required
                    autocomplete="email" />
                <div id="emailError" class="error" aria-live="polite" style="display:none"></div>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div style="display:flex;gap:8px;align-items:center">
                    <input id="password" name="password" type="password" placeholder="Enter your password" required
                        autocomplete="current-password" style="flex:1" />
                    <button type="button" class="pw-toggle" id="togglePw" aria-label="Show password">👁️</button>
                </div>
                <div id="passwordError" class="error" aria-live="polite" style="display:none"></div>
            </div>

            <div class="meta">
                <label class="checkbox"><input type="checkbox" id="remember" name="remember" /> Remember me</label>
                <a href="#" class="muted">Forgot password?</a>
            </div>

            <div style="margin-top:8px;display:flex;gap:10px">
                <button class="btn" type="submit">Sign In</button>
                <button type="button" class="btn secondary" id="demoBtn">Demo</button>
            </div>

            <div id="serverError" class="error" aria-live="polite" style="display:none"></div>
        </form>

        <p class="footer-note">Don't have an account? <a href="#">Register here</a></p>
    </main>

    <script>
        const form = document.getElementById('loginForm');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const serverError = document.getElementById('serverError');
        const togglePw = document.getElementById('togglePw');
        const demoBtn = document.getElementById('demoBtn');

        togglePw.addEventListener('click', () => {
            const t = password.type === 'password' ? 'text' : 'password';
            password.type = t;
            togglePw.textContent = t === 'password' ? '👁️' : '🙈';
            togglePw.setAttribute('aria-label', t === 'password' ? 'Show password' : 'Hide password');
        });

        demoBtn.addEventListener('click', () => {
            email.value = 'doctor@example.com';
            password.value = 'password123';
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            serverError.style.display = 'none';
        });

        function validateEmailValue(v) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            serverError.style.display = 'none';

            let valid = true;
            if (!email.value.trim()) {
                emailError.textContent = 'Email is required.';
                emailError.style.display = 'block';
                valid = false;
            } else if (!validateEmailValue(email.value.trim())) {
                emailError.textContent = 'Invalid email format.';
                emailError.style.display = 'block';
                valid = false;
            }

            if (!password.value) {
                passwordError.textContent = 'Password is required.';
                passwordError.style.display = 'block';
                valid = false;
            } else if (password.value.length < 6) {
                passwordError.textContent = 'Password must be at least 6 characters.';
                passwordError.style.display = 'block';
                valid = false;
            }

            if (!valid) return;

            simulateLogin(email.value.trim(), password.value).then(res => {
                if (res.ok) {
                    window.location.href = '/doctor/dashboard';
                } else {
                    serverError.textContent = res.message || 'Login failed. Please check your credentials.';
                    serverError.style.display = 'block';
                }
            }).catch(() => {
                serverError.textContent = 'Network error occurred.';
                serverError.style.display = 'block';
            });
        });

        function simulateLogin(email, password) {
            return new Promise((resolve) => {
                setTimeout(() => {
                    if (email === 'doctor@example.com' && password === 'password123') {
                        resolve({ ok: true });
                    } else {
                        resolve({ ok: false, message: 'Invalid email or password.' });
                    }
                }, 800);
            });
        }
    </script>
</body>

</html>