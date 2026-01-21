<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");
if(!$conn) die("Koneksi database gagal");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0) die("ID produk tidak valid");

// Ambil data produk
$q = mysqli_query($conn,"SELECT * FROM produk WHERE id=$id");
$p = mysqli_fetch_assoc($q);
if(!$p) die("Produk tidak ditemukan");

// Pastikan cart ada
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Handle ADD TO CART
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_cart'])){
    $size = $_POST['size'] ?? '-';

    // cek apakah produk + size sudah ada
    $found = false;
    foreach($_SESSION['cart'] as &$item){
        if($item['id'] == $p['id'] && $item['size'] == $size){
            $item['qty']++;
            $found = true;
            break;
        }
    }
    unset($item);

    if(!$found){
        $_SESSION['cart'][] = [
            'id'     => $p['id'],
            'nama'   => $p['nama_produk'],
            'harga'  => $p['harga'],
            'gambar' => $p['gambar_url'], // URL langsung
            'size'   => $size,
            'qty'    => 1
        ];
    }

    header("Location: cart.php");
    exit;
}

// Fallback gambar
$img = !empty($p['gambar_url'])
    ? $p['gambar_url']
    : 'https://via.placeholder.com/400x400?text=No+Image';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($p['nama_produk']); ?> | PureBliss</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#fff0f6;
    padding:60px;
}
.box{
    max-width:900px;
    margin:auto;
    background:white;
    padding:40px;
    border-radius:28px;
    display:flex;
    gap:40px;
    box-shadow:0 15px 45px rgba(0,0,0,.12);
}
.box img{
    width:340px;
    height:340px;
    border-radius:22px;
    object-fit:contain;
    background:#fff;
}
h2{color:#e91e63;margin-bottom:10px}
.desc{flex:1}
.desc p{line-height:1.7;color:#555}
.price{
    font-size:24px;
    color:#e91e63;
    font-weight:800;
    margin:16px 0;
}
select,button{
    width:100%;
    padding:14px;
    margin-top:14px;
    border-radius:30px;
    border:1px solid #ccc;
    font-size:15px;
}
button{
    background:#e91e63;
    color:white;
    border:none;
    font-weight:700;
    cursor:pointer;
}
button:hover{opacity:.9}
.back{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:16px;
    text-decoration:none;
    color:#e91e63;
    font-weight:700;
}
</style>
</head>

<body>

<div class="box">
    <img src="<?= htmlspecialchars($img); ?>"
         alt="<?= htmlspecialchars($p['nama_produk']); ?>">

    <div class="desc">
        <h2><?= htmlspecialchars($p['nama_produk']); ?></h2>
        <p><?= nl2br(htmlspecialchars($p['deskripsi'])); ?></p>

        <div class="price">
            <i class="fa-solid fa-tag"></i>
            Rp <?= number_format($p['harga'],0,',','.'); ?>
        </div>

        <form method="POST">
            <label><b>Pilih Size</b></label>
            <select name="size" required>
                <option value="">-- Pilih --</option>
                <option value="100 ml">100 ml</option>
                <option value="300 ml">300 ml</option>
            </select>

            <button type="submit" name="add_cart">
                <i class="fa-solid fa-cart-shopping"></i> Tambah ke Keranjang
            </button>
        </form>

        <a href="index.php" class="back">
            <i class="fa-solid fa-arrow-left"></i> Kembali Belanja
        </a>
    </div>
</div>

</body>
</html>
