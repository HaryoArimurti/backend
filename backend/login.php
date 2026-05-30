<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <style>
        body{ font-family: Arial; background:#f5f5f5; }
        .container{ width:350px; background:white; padding:25px; margin:100px auto; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
        input{ width:100%; padding:12px; margin-top:10px; border:1px solid #ccc; border-radius:5px; box-sizing:border-box; }
        button{ width:100%; padding:12px; margin-top:15px; background:#007bff; color:white; border:none; border-radius:5px; }
        .message{ margin-top:15px; text-align:center; }
        a{ display:block; text-align:center; margin-top:15px; }
    </style>
</head>
<body>
<div class="container">
    <h2 align="center">Login User</h2>
    <?php
    include 'koneksi.php';
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            echo "<div class='message'>Login berhasil</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        } else {
            echo "<div class='message'>Email atau password salah</div>";
        }
    }
    ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Masukkan Email" required>
        <input type="password" name="password" placeholder="Masukkan Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <a href="register.php">Belum punya akun? Register</a>
</div>
</body>
</html>