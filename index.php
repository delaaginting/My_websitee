<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");
if(!$conn) die("Koneksi gagal");

$data = mysqli_query($conn,"SELECT * FROM produk");
$namaUser = $_SESSION['nama'] ?? 'Guest';
$jumlahCart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>PureBliss Skincare</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins}
body{background:linear-gradient(180deg,#fff0f6,#fdfdfd);color:#333}

/* NAVBAR */
.navbar{
 display:flex;justify-content:space-between;align-items:center;
 padding:22px 90px;
 background:linear-gradient(135deg,#e91e63,#ff7aa8);
 color:white;position:sticky;top:0;z-index:100;
 box-shadow:0 12px 30px rgba(233,30,99,.35);
}
.brand{display:flex;align-items:center;gap:10px;font-size:26px;font-weight:700}
.nav-menu a{
 color:white;margin-left:28px;text-decoration:none;font-weight:600;
 display:inline-flex;align-items:center;gap:8px
}
.cart{position:relative;font-size:20px}
.cart span{
 position:absolute;top:-8px;right:-12px;
 background:white;color:#e91e63;
 font-size:12px;padding:3px 6px;border-radius:50%
}

/* HERO */
.hero{
 text-align:center;padding:120px 80px;
 background:
  radial-gradient(circle at top right,#ffe3ec,#fff),
  linear-gradient(135deg,#fff,#ffeef5);
}
.hero h1{font-size:52px;color:#e91e63}
.hero p{margin:16px 0;color:#666;font-size:18px}
.hero a{
 display:inline-flex;align-items:center;gap:10px;
 padding:14px 40px;background:#e91e63;color:white;
 border-radius:30px;text-decoration:none;font-weight:700;
 box-shadow:0 15px 35px rgba(233,30,99,.45);
 transition:.3s
}
.hero a:hover{transform:translateY(-3px)}

/* GREETING */
.greeting{
 text-align:center;margin:50px 0 10px;
 color:#e91e63;font-size:24px;font-weight:600
}

/* GRID */
.container{padding:60px 80px}
.grid{
 display:grid;
 grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
 gap:40px
}
.card{
 background:white;border-radius:24px;
 box-shadow:0 12px 30px rgba(0,0,0,.1);
 overflow:hidden;transition:.3s;position:relative;
 cursor:pointer
}
.card:hover{transform:translateY(-10px)}
.card img{width:100%;height:260px;object-fit:cover}
.badge{
 position:absolute;top:14px;left:14px;
 background:linear-gradient(135deg,#ff9800,#ff5722);
 color:white;padding:6px 14px;border-radius:20px;
 font-size:12px;font-weight:700;
 display:inline-flex;align-items:center;gap:6px
}
.card-content{text-align:center;padding:22px}
.card-content h3{font-size:20px}
.price{
 color:#e91e63;font-weight:700;margin:12px 0;
 display:flex;align-items:center;justify-content:center;gap:6px
}
.card-content a{
 display:inline-flex;align-items:center;gap:8px;
 padding:10px 28px;border-radius:25px;
 border:2px solid #e91e63;color:#e91e63;
 text-decoration:none;font-weight:700;transition:.3s
}
.card-content a:hover{background:#e91e63;color:white}

/* ABOUT */
.about{
 padding:90px 80px;
 background:linear-gradient(135deg,#fff,#fff0f6);
 text-align:center;
}
.about h2{
 color:#e91e63;
 font-size:40px;
 margin-bottom:20px;
}
.about p{
 max-width:800px;
 margin:auto;
 font-size:17px;
 color:#555;
 line-height:1.8;
}
.about .features{
 display:grid;
 grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
 gap:30px;
 margin-top:50px;
}
.feature{
 background:white;
 padding:30px;
 border-radius:22px;
 box-shadow:0 12px 30px rgba(0,0,0,.08);
}
.feature i{
 font-size:30px;
 color:#e91e63;
 margin-bottom:14px;
}

/* FOOTER */
.footer{
 background:#111;color:#bbb;text-align:center;
 padding:30px;margin-top:60px;font-size:14px
}
.footer .social{
 margin-top:10px;display:flex;justify-content:center;gap:16px
}
.footer .social i{font-size:18px;color:#ff8fb1}

/* RESPONSIVE */
@media(max-width:768px){
 .navbar,.hero,.container,.about{
  padding-left:30px;padding-right:30px
 }
 .hero h1{font-size:40px}
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
 <div class="brand">
  <i class="fa-solid fa-spa"></i> PureBliss
 </div>
 <div class="nav-menu">
  <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
  <a href="best_seller.php"><i class="fa-solid fa-fire"></i> Best Seller</a>
  <a href="#about"><i class="fa-solid fa-circle-info"></i> About</a>
  <a href="cart.php" class="cart">
   <i class="fa-solid fa-cart-shopping"></i>
   <?php if($jumlahCart>0): ?><span><?= $jumlahCart ?></span><?php endif; ?>
  </a>
 </div>
</div>

<!-- HERO -->
<div class="hero">
 <h1>Reveal Your Natural Glow ✨</h1>
 <p>Premium skincare untuk kesehatan dan kecantikan kulitmu</p>
 <a href="best_seller.php">
  <i class="fa-solid fa-fire"></i> Lihat Best Seller
 </a>
</div>

<!-- GREETING -->
<div class="greeting">
 <i class="fa-solid fa-hand-sparkles"></i>
 Halo, <?= htmlspecialchars($namaUser); ?> 👋
</div>

<!-- PRODUCT GRID -->
<div class="container">
 <div class="grid">
 <?php while($p=mysqli_fetch_assoc($data)): ?>
  <div class="card" onclick="location.href='detail.php?id=<?= $p['id']; ?>'">
   <?php if($p['best_seller']==1): ?>
    <div class="badge">
     <i class="fa-solid fa-fire"></i> Best Seller
    </div>
   <?php endif; ?>

   <img loading="lazy" src="<?= htmlspecialchars($p['gambar_url']); ?>"
        alt="<?= htmlspecialchars($p['nama_produk']); ?>">

   <div class="card-content">
    <h3><?= htmlspecialchars($p['nama_produk']); ?></h3>
    <div class="price">
     <i class="fa-solid fa-tag"></i>
     Rp <?= number_format($p['harga'],0,',','.'); ?>
    </div>
    <a href="detail.php?id=<?= $p['id']; ?>">
     <i class="fa-solid fa-eye"></i> Detail
    </a>
   </div>
  </div>
 <?php endwhile; ?>
 </div>
</div>

<!-- ABOUT -->
<div id="about" class="about">
 <h2><i class="fa-solid fa-spa"></i> About PureBliss</h2>
 <p>
  PureBliss Skincare adalah brand perawatan kulit yang menghadirkan
  produk berkualitas tinggi dengan formula aman, lembut, dan efektif
  untuk semua jenis kulit. Kami percaya bahwa setiap orang berhak
  memiliki kulit sehat dan bercahaya secara alami.
 </p>

 <div class="features">
  <div class="feature">
   <i class="fa-solid fa-leaf"></i>
   <h4>Natural Formula</h4>
   <p>Bahan pilihan yang aman dan ramah kulit.</p>
  </div>
  <div class="feature">
   <i class="fa-solid fa-flask"></i>
   <h4>Dermatology Tested</h4>
   <p>Diuji dan diformulasikan oleh ahli.</p>
  </div>
  <div class="feature">
   <i class="fa-solid fa-heart"></i>
   <h4>Loved by Customers</h4>
   <p>Dipercaya ribuan pelanggan.</p>
  </div>
 </div>
</div>

<!-- FOOTER -->
<div class="footer">
 <div>© 2025 <b>PureBliss Skincare</b></div>
 <div class="social">
  <i class="fa-brands fa-instagram"></i>
  <i class="fa-brands fa-tiktok"></i>
  <i class="fa-brands fa-facebook"></i>
 </div>
</div>

</body>
</html>
