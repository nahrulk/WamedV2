<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>    

<!-- NavBar -->
<nav class="navbar navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>

                <!-- jika sudah login -->
                <?php if(isset($_SESSION['pelanggan'])) : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else : ?>
                <!-- Jika belum login -->
                    <li><a href="login.php">Logit</a></li>
                <?php endif; ?>

                <li><a href="checkout.php">Checkout</a></li>               
            </ul>          
        </div>
    </nav>
<!-- Closing NavBar -->


<section class="konten">
    <div class="container">

    <h2>Detail Pembelian </h2>

<?php

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]'");

$detail = $ambil->fetch_assoc();

?>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No Pembelian: <?php echo $detail['id_pembelian']; ?></strong>
        <p>
            Tanggal :<?php echo $detail['tanggal_pembelian']; ?> <br>
            Total : Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
        </p>
    </div>
    <div class="col-md-4">
    <h3>Pelanggan</h3>
    <strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
    <p>
        <?php echo $detail['telepon_pelanggan']; ?> <br>
        <?php echo $detail['email_pelanggan']; ?> <br>
    </p>
    </div>
    <div class="col-md-4">
    <h3>Pengiriman</h3>
    <strong><?php echo $detail['nama_kota']; ?></strong><br>
    <p>
        Tarif: Rp.  <?php echo number_format($detail['tarif']); ?> <br>
        Alamat :<?php echo $detail['alamat_pengiriman']; ?>
    </p>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Produk</td>
            <td>Harga</td>
            <td>Jumlah</td>
            <td>Subtotal</td>
        </tr>
    </thead>
    <tbody>

        <?php $ambil =  $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'"); ?>
        <?php $nomor = 1; ?>
        <?php while($pecah= $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama'];?></td>
            <td>Rp. <?php echo number_format($pecah['harga']);?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
        </tr>
        <?php $nomor++;?>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>Silahkan Melakukan pembayaran sebanyak Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br> <strong>BANK BRI 135-9866788-9987 AN. Warung Media</strong></p>
        </div>
    </div>
</div>


    </div>
</section>
    
</body>
</html>