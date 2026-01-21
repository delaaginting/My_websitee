<?php
session_start();
$total = 0;
foreach($_SESSION['cart'] as $item){
    $total += $item['harga'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout | PureBliss</title>
<style>
body{
    font-family:Segoe UI;
    background:#fff0f6;
    padding:40px;
}
.box{
    background:white;
    padding:30px;
    border-radius:20px;
    max-width:700px;
    margin:auto;
    box-shadow:0 8px 30px rgba(0,0,0,.1)
}
h2{text-align:center;color:#e91e63;margin-bottom:20px;}

/* PRODUK */
.item{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:15px;
}
.item img{width:80px;border-radius:12px;}
hr{margin:20px 0}

/* PAYMENT */
.payment-group{
    margin-bottom:20px;
}
.payment-group h4{
    margin-bottom:12px;
    color:#e91e63;
}
.payment{
    display:flex;
    flex-wrap:wrap;
    gap:15px;
}
.pay-box{
    border:2px solid #eee;
    border-radius:15px;
    padding:15px;
    width:48%;
    cursor:pointer;
    display:flex;
    align-items:center;
    gap:15px;
    transition:.3s;
}
.pay-box img{width:50px;}
.pay-box input[type="radio"]{
    margin-right:10px;
}
.pay-box.active{
    border-color:#e91e63;
    background:#ffe3ec;
}

/* BUTTON */
button{
    width:100%;
    padding:14px;
    margin-top:25px;
    border-radius:30px;
    border:none;
    background:#e91e63;
    color:white;
    font-size:16px;
}
</style>

<script>
// menambahkan highlight saat klik
function selectPay(groupName, id){
    document.querySelectorAll('.pay-box[data-group="'+groupName+'"]').forEach(el=>{
        el.classList.remove('active');
    });
    const el = document.getElementById(id);
    el.classList.add('active');
    el.querySelector('input').checked = true;
}
</script>
</head>
<body>

<div class="box">
<h2>Checkout</h2>

<!-- LIST PRODUK -->
<?php foreach($_SESSION['cart'] as $item): ?>
<div class="item">
    <img src="<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>">
    <div>
        <b><?= $item['nama'] ?></b><br>
        Size: <?= $item['size'] ?> |
        Qty: <?= $item['qty'] ?><br>
        Rp <?= number_format($item['harga'] * $item['qty']) ?>
    </div>
</div>
<?php endforeach; ?>

<hr>
<p><b>Total Bayar:</b> Rp <?= number_format($total) ?></p>

<form action="proses_checkout.php" method="POST">

<!-- BANK -->
<div class="payment-group">
<h4>Bank</h4>
<div class="payment">
    <label class="pay-box" id="bca" data-group="bank" onclick="selectPay('bank','bca')">
        <input type="radio" name="bank" value="BCA">
        <img src="images payment/bca.png">
        <b>BCA</b>
    </label>
    <label class="pay-box" id="bri" data-group="bank" onclick="selectPay('bank','bri')">
        <input type="radio" name="bank" value="BRI">
        <img src="images payment/bri.png">
        <b>BRI</b>
    </label>
    <label class="pay-box" id="mandiri" data-group="bank" onclick="selectPay('bank','mandiri')">
        <input type="radio" name="bank" value="Mandiri">
        <img src="images payment/mandiri.png">
        <b>Mandiri</b>
    </label>
</div>
</div>

<!-- E-WALLET -->
<div class="payment-group">
<h4>E-Wallet</h4>
<div class="payment">
    <label class="pay-box" id="dana" data-group="ewallet" onclick="selectPay('ewallet','dana')">
        <input type="radio" name="ewallet" value="Dana">
        <img src="images payment/dana.png">
        <b>Dana</b>
    </label>
    <label class="pay-box" id="ovo" data-group="ewallet" onclick="selectPay('ewallet','ovo')">
        <input type="radio" name="ewallet" value="OVO">
        <img src="images payment/ovo.png">
        <b>OVO</b>
    </label>
    <label class="pay-box" id="gopay" data-group="ewallet" onclick="selectPay('ewallet','gopay')">
        <input type="radio" name="ewallet" value="Gopay">
        <img src="images payment/gopay.png">
        <b>Gopay</b>
    </label>
</div>
</div>

<!-- COD -->
<div class="payment-group">
<h4>Cash on Delivery</h4>
<div class="payment">
    <label class="pay-box" id="cod" data-group="cod" onclick="selectPay('cod','cod')">
        <input type="radio" name="cod" value="COD">
        <img src="images payment/cod.png">
        <b>Bayar di Tempat (COD)</b>
    </label>
</div>
</div>

<button type="submit">Bayar Sekarang</button>
</form>

</div>
</body>
</html>
