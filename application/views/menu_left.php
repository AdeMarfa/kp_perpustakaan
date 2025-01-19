<div class="container">

      <div class="row">
<?php
$id_user = $this->session->userdata('id_user');
$username = $this->session->userdata('username');
$level = $this->session->userdata('level');
if ($id_user!='') {
?>
        <div class="col-lg-3 ">
        <h1 class="my-4"></h1>
          <div class="list-group">
            <a href="index.php/web" class="list-group-item active ">Beranda</a>
            <?php if ($level=='admin'){ ?>
            <a href="index.php/petugas" class="list-group-item bg-warning">Data Petugas</a>
            <a href="index.php/anggota" class="list-group-item bg-warning">Data Anggota</a>
            <a href="index.php/buku" class="list-group-item bg-warning">Data Buku</a>
            <?php }
            
            if($level!='anggota'){ ?>
            <a href="index.php/peminjaman" class="list-group-item bg-warning">Data Peminjaman</a>
            <a href="index.php/pengembalian" class="list-group-item bg-warning">Data Pengembalian</a>
            <?php } ?>
           <!--  <a href="index.php/booking" class="list-group-item bg-warning">Data Booking</a>
            <?php if ($level!='anggota'): ?> -->
            <a href="index.php/laporan" class="list-group-item bg-warning">Data Laporan</a>
            <?php endif; ?>
          </div>
        </div>
<?php } ?>