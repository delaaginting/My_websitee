<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");
if(!$conn) die("Koneksi gagal");

$data = mysqli_query($conn,"SELECT * FROM produk WHERE best_seller=1");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Best Seller | PureBliss</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{font-family:Segoe UI;background:#fff0f6;padding:60px}
h1{text-align:center;color:#e91e63;margin-bottom:40px}
.grid{
 display:grid;
 grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
 gap:40px
}
.card{
 background:white;border-radius:24px;
 padding:30px;text-align:center;
 box-shadow:0 12px 30px rgba(0,0,0,.1);
 cursor:pointer;transition:.3s
}
.card:hover{transform:translateY(-10px)}
.card img{width:180px;height:220px;object-fit:contain}
.price{color:#e91e63;font-weight:700;margin:12px 0}
.back{
 display:inline-block;margin-bottom:30px;
 text-decoration:none;color:#e91e63;font-weight:700
}
</style>
</head>

<body>

<a class="back" href="index.php">
 <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
</a>

<h1>🔥 Best Seller</h1>

<div class="grid">
<?php while($p=mysqli_fetch_assoc($data)): ?>
 <div class="card" onclick="location.href='detail.php?id=<?= $p['id']; ?>'">
  <img src="<?= htmlspecialchars($p['gambar_url']); ?>">
  <h3><?= htmlspecialchars($p['nama_produk']); ?></h3>
  <div class="price">Rp <?= number_format($p['harga'],0,',','.'); ?></div>
  <i class="fa-solid fa-cart-shopping"></i> Shop Now
 </div>
<?php endwhile; ?>
</div>

</body>
</html>
