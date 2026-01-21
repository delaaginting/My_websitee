<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");

if(!$conn){
    die("Koneksi database gagal");
}

if(isset($_POST['login'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user  = mysqli_fetch_assoc($query);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['login'] = true;
        $_SESSION['nama']  = $user['nama'];
        header("Location: index.php");
        exit;
    }else{
        $error = "Email atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login | Skincare</title>
<style>
*<style>
*{
    box-sizing:border-box;
    font-family:'Poppins', 'Segoe UI', sans-serif;
}
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:
        radial-gradient(circle at top left,#fce4ec,transparent 40%),
        radial-gradient(circle at bottom right,#e1f5fe,transparent 40%),
        linear-gradient(135deg,#f8bbd0,#e1bee7,#bbdefb);
    overflow:hidden;
}

/* background bubble */
body::before,
body::after{
    content:"";
    position:absolute;
    width:400px;
    height:400px;
    background:linear-gradient(135deg,#f48fb1,#ce93d8);
    border-radius:50%;
    filter:blur(120px);
    opacity:.4;
}
body::before{
    top:-120px;
    left:-120px;
}
body::after{
    bottom:-120px;
    right:-120px;
}

.card{
    position:relative;
    z-index:10;
    width:380px;
    background:rgba(255,255,255,.92);
    backdrop-filter:blur(10px);
    padding:40px;
    border-radius:24px;
    box-shadow:0 30px 70px rgba(0,0,0,.18);
}

.card h2{
    text-align:center;
    font-size:26px;
    margin-bottom:8px;
    color:#6a1b9a;
}
.subtitle{
    text-align:center;
    color:#777;
    margin-bottom:30px;
}

input{
    width:100%;
    padding:15px;
    margin-bottom:16px;
    border-radius:14px;
    border:1px solid #ddd;
    background:#fafafa;
    font-size:15px;
}
input:focus{
    outline:none;
    border-color:#ba68c8;
    background:#fff;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:40px;
    background:linear-gradient(to right,#ec407a,#ab47bc,#7e57c2);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.4s;
}
button:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 30px rgba(236,64,122,.4);
}

.error{
    background:#fdecea;
    color:#c62828;
    padding:12px;
    border-radius:12px;
    text-align:center;
    margin-bottom:18px;
}

.link{
    text-align:center;
    margin-top:22px;
}
.link a{
    color:#8e24aa;
    font-weight:600;
    text-decoration:none;
}
</style>

</style>
</head>
<body>

<div class="card">
    <h2>Hello Skin Lover ✨</h2>
    <p class="subtitle">Login Dulu Ya</p>

    <?php if(isset($error)){ ?>
        <div class="error"><?= $error; ?></div>
    <?php } ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <div class="link">
        Belum punya akun? <a href="register.php">Register</a>
    </div>
</div>

</body>
</html>
