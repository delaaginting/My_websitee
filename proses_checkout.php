<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");

if(!$conn){
    die("Koneksi gagal: ".mysqli_connect_error());
}

// cek apakah cart kosong
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "<script>alert('Keranjang kosong!'); window.location='index.php';</script>";
    exit;
}

// ambil metode pembayaran
$pembayaran = "";
if(isset($_POST['bank'])) $pembayaran = $_POST['bank'];
elseif(isset($_POST['ewallet'])) $pembayaran = $_POST['ewallet'];
elseif(isset($_POST['cod'])) $pembayaran = $_POST['cod'];
else {
    echo "<script>alert('Pilih metode pembayaran!'); window.history.back();</script>";
    exit;
}

// total
$total = 0;
foreach($_SESSION['cart'] as $item){
    $total += $item['harga'] * $item['qty'];
}

// nama user (sederhana)
$user = isset($_SESSION['nama']) ? $_SESSION['nama'] : "Guest";

// simpan transaksi
mysqli_query($conn, "INSERT INTO transaksi(user, total, pembayaran) VALUES('$user', $total, '$pembayaran')");
$transaksi_id = mysqli_insert_id($conn);

// simpan detail transaksi
foreach($_SESSION['cart'] as $item){
    $nama = $item['nama'];
    $size = $item['size'];
    $qty = $item['qty'];
    $harga = $item['harga'];
    mysqli_query($conn, "INSERT INTO transaksi_detail(transaksi_id, produk, size, qty, harga) VALUES($transaksi_id,'$nama','$size',$qty,$harga)");
}

// hapus cart
unset($_SESSION['cart']);

// tampilkan struk pembayaran
?>
<!DOCTYPE html>
<html>
<head>
<title>Bukti Pembayaran | PureBliss</title>
<style>
body{font-family:Segoe UI;background:#fff0f6;padding:40px;}
.box{background:white;padding:30px;border-radius:20px;max-width:700px;margin:auto;box-shadow:0 8px 30px rgba(0,0,0,.1);}
h2{text-align:center;color:#e91e63;margin-bottom:20px;}
table{width:100%;border-collapse:collapse;}
table, th, td{border:1px solid #ddd;}
th, td{padding:12px;text-align:left;}
th{background:#ffe3ec;}
button{
    padding:12px 20px;
    border:none;
    border-radius:30px;
    background:#e91e63;
    color:white;
    font-size:16px;
    cursor:pointer;
}
</style>
</head>
<body>
<div class="box">
<h2>Bukti Pembayaran</h2>
<p><b>Nama:</b> <?= $user ?></p>
<p><b>Metode Pembayaran:</b> <?= $pembayaran ?></p>
<p><b>Tanggal:</b> <?= date("d-m-Y H:i") ?></p>

<table>
<tr>
<th>Produk</th>
<th>Size</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>
</tr>
<?php
$details = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id=$transaksi_id");
while($d = mysqli_fetch_assoc($details)):
?>
<tr>
<td><?= $d['produk'] ?></td>
<td><?= $d['size'] ?></td>
<td><?= $d['qty'] ?></td>
<td>Rp <?= number_format($d['harga']) ?></td>
<td>Rp <?= number_format($d['harga'] * $d['qty']) ?></td>
</tr>
<?php endwhile; ?>
<tr>
<td colspan="4"><b>Total Bayar</b></td>
<td><b>Rp <?= number_format($total) ?></b></td>
</tr>
</table>

<br>
<button onclick="window.location='index.php'">Kembali ke Beranda</button>
</div>
</body>
</html>
 