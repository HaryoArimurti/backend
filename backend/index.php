<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Realtime</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f4f6f9;
            min-height: 100vh;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 25px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .15);
        }

        .header h2 {
            font-size: 24px;
        }

        .logout-btn {
            text-decoration: none;
            background: white;
            color: #4f46e5;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: .3s;
        }

        .logout-btn:hover {
            background: #e5e7eb;
        }

        .card {
            background: white;
            margin-top: 25px;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
        }

        .card h3 {
            margin-bottom: 20px;
            color: #333;
        }

        #daftar-user {
            list-style: none;
        }

        #daftar-user li {
            background: #f8fafc;
            border-left: 5px solid #4f46e5;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 10px;
            transition: .3s;
        }

        #daftar-user li:hover {
            transform: translateX(5px);
            background: #eef2ff;
        }

        .loading {
            text-align: center;
            color: #666;
        }

        .count {
            margin-top: 10px;
            color: #666;
            font-size: 14px;
        }

        @media(max-width:600px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <div>
                <h2>👋 Selamat Datang, <?php echo $_SESSION['nama']; ?></h2>
                <p>Dashboard Monitoring User Realtime</p>
            </div>

            <a href="logout.php" class="logout-btn">
                Logout
            </a>
        </div>

        <div class="card">
            <h3>📋 Daftar User Terdaftar</h3>

            <ul id="daftar-user">
                <li class="loading">Memuat data...</li>
            </ul>

            <div class="count" id="jumlah-user">
                Total User: 0
            </div>
        </div>

    </div>

    <script>
        async function loadUsers() {
            try {
                const response = await fetch("get_user.php");
                const result = await response.json();

                const container = document.getElementById("daftar-user");
                const total = document.getElementById("jumlah-user");

                if (result.status) {
                    container.innerHTML = "";

                    result.data.forEach(user => {
                        const li = document.createElement("li");
                        li.innerHTML = `
                            <strong>${user.nama}</strong><br>
                            <small>${user.email}</small>
                        `;
                        container.appendChild(li);
                    });

                    total.innerHTML = `Total User: ${result.data.length}`;
                }
            } catch (error) {
                console.error(error);
            }
        }

        loadUsers();
        setInterval(loadUsers, 2000);
    </script>

</body>

</html>