<?php
session_start();
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// helper cek index aman
function cart_has_index($idx){
    return isset($_SESSION['cart'][$idx]) && is_array($_SESSION['cart'][$idx]);
}

// ========================
// PROSES TAMBAH / KURANG
// ========================
if(isset($_GET['add'])){
    $idx = (int)$_GET['add'];
    if(cart_has_index($idx)){
        $_SESSION['cart'][$idx]['qty']++;
    }
    header("Location: cart.php");
    exit;
}

if(isset($_GET['min'])){
    $idx = (int)$_GET['min'];
    if(cart_has_index($idx)){
        $_SESSION['cart'][$idx]['qty']--;
        if($_SESSION['cart'][$idx]['qty'] <= 0){
            unset($_SESSION['cart'][$idx]);
            // rapikan index biar tidak bolong (PENTING)
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
    header("Location: cart.php");
    exit;
}

// tombol hapus
if(isset($_GET['del'])){
    $idx = (int)$_GET['del'];
    if(cart_has_index($idx)){
        unset($_SESSION['cart'][$idx]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Keranjang | PureBliss</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{font-family:Segoe UI;background:#fff0f6;padding:40px;color:#333}
h2{margin-bottom:18px;color:#e91e63}
.top-actions{display:flex;gap:12px;margin-bottom:18px;flex-wrap:wrap}
a.link{
    display:inline-flex;align-items:center;gap:8px;
    padding:10px 18px;border-radius:30px;
    text-decoration:none;font-weight:700;
    border:2px solid #e91e63;color:#e91e63;background:#fff
}
a.link:hover{background:#e91e63;color:#fff}

table{
    width:100%;
    background:white;
    border-radius:14px;
    box-shadow:0 8px 30px rgba(0,0,0,.1);
    overflow:hidden;
    border-collapse:collapse;
}
th,td{padding:15px;text-align:center}
th{background:#e91e63;color:white}
tr:nth-child(even){background:#fff7fb}

img{width:80px;height:80px;object-fit:cover;border-radius:12px;background:#fff}

.qtybox{display:flex;gap:10px;justify-content:center;align-items:center}
a.btn{
    display:inline-flex;align-items:center;justify-content:center;
    width:32px;height:32px;
    background:#e91e63;color:white;border-radius:50%;
    text-decoration:none;font-weight:800;
}
a.btn:hover{opacity:.9}

a.del{
    display:inline-flex;align-items:center;gap:8px;
    padding:8px 14px;border-radius:22px;
    background:#111;color:#fff;text-decoration:none;font-weight:700;
}
a.del:hover{opacity:.9}

.total{font-size:18px;font-weight:800;color:#e91e63}
.checkout{
    display:inline-flex;align-items:center;gap:10px;
    margin-top:22px;padding:12px 26px;
    background:#e91e63;color:white;border-radius:30px;
    text-decoration:none;font-weight:800;
}
.checkout:hover{opacity:.95}

.empty{
    background:white;padding:30px;border-radius:14px;
    box-shadow:0 8px 30px rgba(0,0,0,.08);
}
</style>
</head>
<body>

<h2><i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja</h2>

<div class="top-actions">
    <a class="link" href="index.php"><i class="fa-solid fa-arrow-left"></i> Kembali Belanja</a>
    <a class="link" href="best_seller.php"><i class="fa-solid fa-fire"></i> Lihat Best Seller</a>
</div>

<?php if(empty($_SESSION['cart'])): ?>
    <div class="empty">
        Keranjang kamu masih kosong 🥹<br><br>
        <a class="link" href="index.php"><i class="fa-solid fa-bag-shopping"></i> Mulai Belanja</a>
    </div>
<?php else: ?>

<table>
<tr>
    <th>Produk</th>
    <th>Gambar</th>
    <th>Size</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php
$total = 0;
foreach($_SESSION['cart'] as $key => $item){
    $nama  = $item['nama'] ?? '-';
    $harga = (int)($item['harga'] ?? 0);
    $qty   = (int)($item['qty'] ?? 0);
    $size  = $item['size'] ?? '-';
    $img   = $item['gambar'] ?? 'https://via.placeholder.com/80?text=No+Image';

    $subtotal = $harga * $qty;
    $total += $subtotal;
?>
<tr>
    <td><?= htmlspecialchars($nama) ?></td>
    <td><img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($nama) ?>"></td>
    <td><?= htmlspecialchars($size) ?></td>
    <td>Rp <?= number_format($harga,0,',','.') ?></td>

    <td>
        <div class="qtybox">
            <a class="btn" href="cart.php?min=<?= $key ?>">-</a>
            <b><?= $qty ?></b>
            <a class="btn" href="cart.php?add=<?= $key ?>">+</a>
        </div>
    </td>

    <td>Rp <?= number_format($subtotal,0,',','.') ?></td>

    <td>
        <a class="del" href="cart.php?del=<?= $key ?>">
            <i class="fa-solid fa-trash"></i> Hapus
        </a>
    </td>
</tr>
<?php } ?>

<tr>
    <td colspan="7" class="total">Total : Rp <?= number_format($total,0,',','.') ?></td>
</tr>
</table>

<a class="checkout" href="checkout.php">
    <i class="fa-solid fa-credit-card"></i> Checkout
</a>

<?php endif; ?>

</body>
</html>
