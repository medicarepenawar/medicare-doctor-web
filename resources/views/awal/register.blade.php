<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Doctor Registration</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --card: #fff;
            --accent: #2563eb;
            --muted: #6b7280;
            font-family: Inter, ui-sans-serif, system-ui;
        }

        body {
            margin: 0;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 700px;
            background: var(--card);
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 22px;
        }

        p {
            text-align: center;
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 24px;
        }

        form {
            display: grid;
            gap: 16px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 13px;
            margin-bottom: 4px;
            color: #374151;
        }

        input,
        select {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .btn {
            background: var(--accent);
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
        }

        .btn:hover {
            background: #1e4ed8;
        }

        .error {
            color: #ef4444;
            font-size: 13px;
        }

        @media(max-width: 600px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Doctor Registration</h1>
        <p>Please fill out the form below to register a new doctor account</p>
        <form id="registerForm" novalidate enctype="multipart/form-data">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" required placeholder="doctor@clinic.com" />
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" required placeholder="At least 6 characters" />
                </div>
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" required />
                </div>
            </div>

            <hr>

            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" required />
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="nric">NRIC</label>
                    <input type="text" id="nric" required />
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" required>
                        <option value="">Select...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="specialist">Specialist</label>
                <input type="text" id="specialist" required placeholder="e.g. General Doctor, Dentist" />
            </div>

            <div class="input-group">
                <label for="experience">Experience (years / brief description)</label>
                <input type="text" id="experience" required placeholder="e.g. 10 years at Mojokerto Hospital" />
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" required placeholder="+62..." />
                </div>
                <div class="input-group">
                    <label for="passport">Passport Number (optional)</label>
                    <input type="text" id="passport" />
                </div>
            </div>

            <div class="input-group">
                <label for="university">Medical Degree University</label>
                <input type="text" id="university" required />
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="mmc">MMC Number</label>
                    <input type="text" id="mmc" required />
                </div>
                <div class="input-group">
                    <label for="apc">APC Number</label>
                    <input type="text" id="apc" required />
                </div>
            </div>

            <div class="input-group">
                <label for="apcExpired">APC Expiration Date</label>
                <input type="date" id="apcExpired" required />
            </div>

            <hr>

            <div class="input-group">
                <label for="photo">Profile Photo</label>
                <input type="file" id="photo" accept="image/*" required />
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="frontNric">NRIC Front Photo</label>
                    <input type="file" id="frontNric" accept="image/*" required />
                </div>
                <div class="input-group">
                    <label for="backNric">NRIC Back Photo</label>
                    <input type="file" id="backNric" accept="image/*" required />
                </div>
            </div>

            <div class="grid-2">
                <div class="input-group">
                    <label for="apcFile">APC Certificate File</label>
                    <input type="file" id="apcFile" accept=".pdf,.jpg,.png" required />
                </div>
                <div class="input-group">
                    <label for="mmcFile">MMC Certificate File</label>
                    <input type="file" id="mmcFile" accept=".pdf,.jpg,.png" required />
                </div>
            </div>

            <button type="submit" class="btn">Register Now</button>
            <div id="errorMsg" class="error" style="display:none;"></div>
        </form>
    </div>

    <script>
        const form = document.getElementById("registerForm");
        const errorMsg = document.getElementById("errorMsg");

        form.addEventListener("submit", (e) => {
            e.preventDefault();
            errorMsg.style.display = "none";

            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (!email || !password || !confirmPassword) {
                return showError("All fields are required.");
            }
            if (password.length < 6) {
                return showError("Password must be at least 6 characters.");
            }
            if (password !== confirmPassword) {
                return showError("Password confirmation does not match.");
            }

            const doctorData = new FormData(form);

            console.log("Submitted data:", Object.fromEntries(doctorData.entries()));
            alert("Registration successful! (Simulation)");
            form.reset();
        });

        function showError(msg) {
            errorMsg.textContent = msg;
            errorMsg.style.display = "block";
        }
    </script>
</body>

</html>