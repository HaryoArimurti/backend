<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .container {
            width: 350px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #4facfe;
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #4facfe;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2196f3;
        }

        #result {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #e53935;
        }

        .login-link {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }

        .login-link a {
            color: #2196f3;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Register User</h2>

        <div class="input-group">
            <input type="text" id="nama" placeholder="Masukkan Nama">
        </div>

        <div class="input-group">
            <input type="email" id="email" placeholder="Masukkan Email">
        </div>

        <div class="input-group">
            <input type="password" id="password" placeholder="Masukkan Password">
        </div>

        <button onclick="register()">Register</button>

        <div id="result"></div>

        <div class="login-link">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </div>
    </div>

    <script>
        async function register() {

            const payload = {
                nama: document.getElementById("nama").value,
                email: document.getElementById("email").value,
                password: document.getElementById("password").value
            };

            if (payload.nama == "" || payload.email == "" || payload.password == "") {
                document.getElementById("result").innerText =
                    "Semua field wajib diisi!";
                return;
            }

            try {

                const response = await fetch("register_api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                document.getElementById("result").innerText =
                    result.message;

                if (result.status) {
                    alert("Register berhasil!");

                    window.location.href = "login.php";
                }

            } catch (error) {

                document.getElementById("result").innerText =
                    "Gagal menghubungi server!";
            }
        }
    </script>

</body>

</html>