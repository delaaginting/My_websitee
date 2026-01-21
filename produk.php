<?php
$conn = mysqli_connect("localhost","root","","kosmetik");
$data = mysqli_query($conn,"SELECT * FROM produk");
?>
<!DOCTYPE html>
<html>
<head>
<title>Our Products | Luxury Skincare</title>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#fafafa;
    color:#333;
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 70px;
    background:#ffffff;
    box-shadow:0 2px 12px rgba(0,0,0,.05);
    position:sticky;
    top:0;
}

.brand{
    font-size:22px;
    font-weight:700;
    letter-spacing:2px;
}

.nav-menu a{
    margin-left:35px;
    text-decoration:none;
    color:#333;
    font-weight:600;
    position:relative;
}

.nav-menu a::after{
    content:'';
    width:0;
    height:2px;
    background:#e91e63;
    position:absolute;
    left:0;
    bottom:-6px;
    transition:.3s;
}

.nav-menu a:hover::after{
    width:100%;
}

/* HEADER */
.header{
    text-align:center;
    padding:80px 70px 40px;
}

.header h1{
    font-size:42px;
    margin-bottom:10px;
}

.header p{
    font-size:18px;
    color:#666;
}

/* GRID */
.container{
    padding:0 70px 80px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:35px;
}

/* CARD */
.card{
    background:white;
    border-radius:18px;
    box-shadow:0 5px 25px rgba(0,0,0,.06);
    overflow:hidden;
    transition:.3s;
}

.card:hover{
    transform:translateY(-8px);
}

/* IMAGE */
.card img{
    width:100%;
    height:260px;
    object-fit:cover;
}

/* CONTENT */
.card-content{
    padding:22px;
    text-align:center;
}

.card-content h3{
    margin-bottom:8px;
}

.card-content p{
    font-size:15px;
    line-height:1.6;
    color:#555;
}

.card-content b{
    display:block;
    margin-top:12px;
    font-size:18px;
    color:#e91e63;
}

.card-content a{
    display:inline-block;
    margin-top:15px;
    padding:10px 22px;
    border:1px solid #e91e63;
    border-radius:30px;
    text-decoration:none;
    color:#e91e63;
    font-weight:600;
}

.card-content a:hover{
    background:#e91e63;
    color:white;
}

/* FOOTER */
.footer{
    background:#111;
    color:white;
    text-align:center;
    padding:25px;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="brand">SKINCARE</div>
    <div class="nav-menu">
        <a href="index.php">Home</a>
        <a href="produk.php">Produk</a>
        <a href="aboutus.php">About Us</a>
    </div>
</div>

<!-- HEADER -->
<div class="header">
    <h1>Our Best Seller Products</h1>
    <p>Only three premium skincare essentials</p>
</div>

<!-- PRODUK -->
<div class="container">
    <div class="grid">

        <?php
        $images = ['serum.jpg','toner.jpg','moisturizer.jpg'];
        $i = 0;
        while($p = mysqli_fetch_array($data) AND $i < 3){
        ?>
        <div class="card">
            <img src="<?= $images[$i]; ?>">
            <div class="card-content">
                <h3><?= $p['nama_produk']; ?></h3>
                <p><?= $p['deskripsi']; ?></p>
                <b>Rp <?= number_format($p['harga']); ?></b>
                <a href="#">View Detail</a>
            </div>
        </div>
        <?php $i++; } ?>

    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    © 2025 Luxury Skincare. All Rights Reserved.
</div>

</body>
</html>
