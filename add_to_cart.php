<?php
session_start();
$conn = mysqli_connect("localhost","root","","kosmetik");

if(!$conn){
    die("Koneksi gagal: ".mysqli_connect_error());
}

$id = $_POST['id'];
$qty = $_POST['qty'] ?? 1;

// Ambil data produk dari database
$result = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
$p = mysqli_fetch_assoc($result);

if($p){
    $item = [
        'id' => $p['id'],
        'nama' => $p['nama_produk'],
        'harga' => $p['harga'],
        'gambar' => $p['gambar'],
        'qty' => $qty,
        'size' => $p['size'] ?? 'Standard'
    ];

    // tambahkan ke session cart
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    // cek apakah sudah ada di cart
    $found = false;
    foreach($_SESSION['cart'] as &$cart_item){
        if($cart_item['id'] == $id){
            $cart_item['qty'] += $qty;
            $found = true;
            break;
        }
    }
    if(!$found){
        $_SESSION['cart'][] = $item;
    }
}

header("Location: kategori.php?kategori=" . urlencode($p['kategori']));
exit;
?>
