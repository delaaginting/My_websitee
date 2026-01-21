<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>About Us | PureBliss Skincare</title>

<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ================= RESET ================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(180deg,#fff0f6,#fafafa);
    color:#333;
}

/* ================= NAVBAR ================= */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:22px 80px;
    background:linear-gradient(135deg,#e91e63,#ff8fb1);
    box-shadow:0 10px 35px rgba(233,30,99,.4);
    position:sticky;
    top:0;
    z-index:100;
}

.brand{
    font-size:28px;
    font-weight:900;
    letter-spacing:1.8px;
    color:white;
}

.brand span{
    font-weight:500;
    font-size:17px;
    margin-left:6px;
    opacity:.9;
}

.nav-menu{
    display:flex;
    align-items:center;
}

.nav-menu a{
    margin-left:38px;
    text-decoration:none;
    color:white;
    font-weight:600;
    position:relative;
}

.nav-menu a i{
    margin-right:6px;
}

.nav-menu a::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-8px;
    width:0;
    height:2px;
    background:white;
    transition:.3s;
}

.nav-menu a:hover::after{
    width:100%;
}

/* ================= HEADER ================= */
.header{
    text-align:center;
    padding:110px 80px 60px;
    background:
        radial-gradient(circle at top right,#ffe3ec,#fff),
        linear-gradient(135deg,#fff,#ffeef5);
}

.header h1{
    font-size:46px;
    color:#e91e63;
    margin-bottom:14px;
}

.header p{
    font-size:18px;
    color:#555;
    max-width:720px;
    margin:auto;
    line-height:1.7;
}

/* ================= CONTENT ================= */
.container{
    padding:0 80px 90px;
}

.about-box{
    background:white;
    padding:55px;
    border-radius:28px;
    box-shadow:0 14px 40px rgba(0,0,0,.08);
    max-width:950px;
    margin:auto;
}

.about-box h2{
    font-size:28px;
    color:#e91e63;
    margin:35px 0 14px;
}

.about-box h2 i{
    margin-right:8px;
}

.about-box p{
    line-height:1.9;
    font-size:16px;
    color:#555;
    margin-bottom:18px;
}

/* ================= VALUES ================= */
.values{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:30px;
    margin-top:45px;
}

.value-card{
    background:#fff;
    padding:32px;
    border-radius:22px;
    text-align:center;
    box-shadow:0 10px 28px rgba(0,0,0,.08);
    transition:.3s;
}

.value-card:hover{
    transform:translateY(-8px);
    box-shadow:0 16px 40px rgba(233,30,99,.25);
}

.value-card i{
    font-size:32px;
    color:#e91e63;
    margin-bottom:12px;
}

.value-card h3{
    margin-bottom:10px;
    color:#e91e63;
    font-size:20px;
}

.value-card p{
    font-size:15px;
    color:#666;
}

/* ================= FOOTER ================= */
.footer{
    background:#111;
    color:#bbb;
    text-align:center;
    padding:28px;
    font-size:14px;
}

.footer i{
    margin:0 8px;
    font-size:18px;
    color:#ff8fb1;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .navbar,.header,.container{
        padding-left:30px;
        padding-right:30px;
    }
    .header h1{font-size:38px;}
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="brand">
        <i class="fa-solid fa-spa"></i> PureBliss <span>Skincare</span>
    </div>
    <div class="nav-menu">
        <a href="index.php"><i class="fa-solid fa-house"></i>Home</a>
        <a href="best_seller.php"><i class="fa-solid fa-fire"></i>Best Seller</a>
        <a href="aboutus.php"><i class="fa-solid fa-circle-info"></i>About</a>
    </div>
</div>

<!-- HEADER -->
<div class="header">
    <h1>About PureBliss</h1>
    <p>
        <i class="fa-solid fa-leaf"></i>
        Komitmen kami adalah menghadirkan skincare premium
        yang aman, efektif, dan mendukung kecantikan alami kulitmu.
    </p>
</div>

<!-- CONTENT -->
<div class="container">
    <div class="about-box">

        <h2><i class="fa-solid fa-user-group"></i> Who We Are</h2>
        <p>
            <b>PureBliss Skincare</b> adalah brand skincare modern yang
            mengutamakan kualitas, kesederhanaan, dan efektivitas.
            Kami percaya bahwa perawatan kulit harus lembut,
            aman, dan berbasis formulasi yang terpercaya.
        </p>

        <p>
            Setiap produk kami dikembangkan dengan bahan pilihan
            dan terinspirasi oleh standar skincare global,
            untuk memberikan hasil nyata tanpa mengorbankan
            kesehatan kulit.
        </p>

        <h2><i class="fa-solid fa-eye"></i> Our Vision</h2>
        <p>
            Menjadi brand skincare terpercaya yang membantu setiap
            orang merasa percaya diri dengan kulit sehat alami mereka.
        </p>

        <h2><i class="fa-solid fa-heart"></i> Our Values</h2>
        <div class="values">
            <div class="value-card">
                <i class="fa-solid fa-award"></i>
                <h3>Quality</h3>
                <p>Bahan premium dan kontrol kualitas ketat di setiap produk.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-flask"></i>
                <h3>Innovation</h3>
                <p>Teknologi skincare modern dengan formulasi terpercaya.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-shield-heart"></i>
                <h3>Trust</h3>
                <p>Aman, transparan, dan terinspirasi dermatologi.</p>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <i class="fa-solid fa-spa"></i>
    © 2025 <b>PureBliss Skincare</b>
    <br><br>
    <i class="fa-brands fa-instagram"></i>
    <i class="fa-brands fa-tiktok"></i>
    <i class="fa-brands fa-facebook"></i>
</div>

</body>
</html>
