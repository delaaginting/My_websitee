<?php
session_start();
$conn = mysqli_connect("localhost","root","","skincare_db");

if(isset($_POST['register'])){
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($cek) > 0){
        $error = "Email sudah terdaftar, silakan login.";
    } else {
        mysqli_query($conn,"
            INSERT INTO users (nama,email,password)
            VALUES ('$nama','$email','$pass')
        ");
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register | Skincare</title>

<style>
*{
    box-sizing:border-box;
    font-family:'Poppins','Segoe UI',sans-serif;
}
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:
        radial-gradient(circle at top right,#fce4ec,transparent 45%),
        radial-gradient(circle at bottom left,#e1f5fe,transparent 45%),
        linear-gradient(135deg,#f3e5f5,#e1f5fe,#fce4ec);
}

.card{
    width:400px;
    background:rgba(255,255,255,.95);
    padding:40px;
    border-radius:26px;
    box-shadow:0 30px 80px rgba(0,0,0,.18);
}

.card h2{
    text-align:center;
    margin-bottom:20px;
    color:#d81b60;
}

input{
    width:100%;
    padding:15px;
    margin-bottom:15px;
    border-radius:14px;
    border:1px solid #ddd;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:40px;
    background:linear-gradient(to right,#d81b60,#ab47bc,#5c6bc0);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
}

.error{
    background:#fdecea;
    color:#c62828;
    padding:12px;
    border-radius:12px;
    text-align:center;
    margin-bottom:15px;
}

.login-link{
    text-align:center;
    margin-top:18px;
}

.login-link a{
    color:#d81b60;
    font-weight:600;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="card">
    <h2>Create Account 💖</h2>

    <!-- PESAN ERROR -->
    <?php if(isset($error)){ ?>
        <div class="error">
            <?= $error ?><br>
            <a href="login.php">Klik di sini untuk Login</a>
        </div>
    <?php } ?>

    <form method="post">
        <input type="text" name="nama" placeholder="Nama lengkap" required>
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>
