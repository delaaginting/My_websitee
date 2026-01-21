<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");
if(!$conn) die("Koneksi gagal");

$id = $_GET['id'] ?? 0;

// Ambil produk
$q = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
$p = mysqli_fetch_assoc($q);

if(!$p){
    echo "Produk tidak ditemukan";
    exit;
}

// INIT CART
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// AUTO ADD TO CART (1x saja)
$found = false;
foreach($_SESSION['cart'] as &$item){
    if($item['id'] == $p['id']){
        $item['qty']++;
        $found = true;
        break;
    }
}
unset($item);

if(!$found){
    $_SESSION['cart'][] = [
        'id'    => $p['id'],
        'nama'  => $p['nama_produk'],
        'harga' => $p['harga'],
        'qty'   => 1,
        'gambar'=> $p['gambar_url'] // URL gambar
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($p['nama_produk']); ?> | Best Seller</title>

<style>
body{
    background:#000000aa;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    font-family:'Segoe UI',sans-serif;
}
.popup{
    background:linear-gradient(180deg,#fff0f6,#ffffff);
    width:720px;
    border-radius:30px;
    padding:30px;
    position:relative;
    box-shadow:0 15px 40px rgba(0,0,0,.4);
}
.badge{
    background:#e91e63;
    color:white;
    padding:8px 22px;
    border-radius:30px;
    font-weight:700;
    display:inline-block;
}
.content{
    display:flex;
    gap:30px;
    margin-top:20px;
}
.content img{
    width:260px;
    object-fit:contain;
}
.desc{
    flex:1;
}
.desc h2{
    color:#e91e63;
    margin-bottom:10px;
}
.desc p{
    color:#555;
    line-height:1.7;
}
.price{
    font-size:22px;
    color:#e91e63;
    font-weight:700;
    margin:15px 0;
}
.actions{
    display:flex;
    gap:15px;
    margin-top:22px;
}
.actions a{
    flex:1;
    text-align:center;
    padding:14px;
    border-radius:30px;
    text-decoration:none;
    font-weight:700;
}
.cart{
    background:#e91e63;
    color:white;
}
.shop{
    border:2px solid #e91e63;
    color:#e91e63;
}
.note{
    margin-top:8px;
    font-size:13px;
    color:#4caf50;
}
</style>
</head>

<body>

<div class="popup">
    <span class="badge">🔥 BEST SELLER</span>

    <div class="content">
        <img src="<?= htmlspecialchars($p['gambar_url']); ?>"
             alt="<?= htmlspecialchars($p['nama_produk']); ?>">

        <div class="desc">
            <h2><?= htmlspecialchars($p['nama_produk']); ?></h2>
            <p><?= htmlspecialchars($p['deskripsi']); ?></p>

            <div class="price">
                Rp <?= number_format($p['harga'],0,',','.'); ?>
            </div>

            <div class="note">
                ✅ Produk otomatis masuk ke keranjang
            </div>

            <div class="actions">
                <a href="cart.php" class="cart">Lihat Keranjang</a>
                <a href="index.php" class="shop">Lanjut Belanja</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
