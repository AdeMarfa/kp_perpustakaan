
<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title"> <?php echo $judul_web; ?></h3>
        <hr>
        <table class="table table-bordered table-striped">
            <tr>
                <th width="160">Nama Peminjam</th>
                <th width="1">:</th>
                <th><?php echo ucwords($query->nama_anggota); ?></th>
            </tr>
            <tr>
                <th>Buku</th>
                <th>:</th>
                <th><?php echo ucwords($query->judul); ?></th>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <th>:</th>
                <th><?php echo date('d-m-Y',strtotime($query->tgl_pinjam)); ?></th>
            </tr>
            <tr>
                <th>Batas Pinjam</th>
                <th>:</th>
                <th><?php echo $query->batas_pinjam; ?> Hari</th>
            </tr>
            <tr>
                <th>Jumlah Pinjam</th>
                <th>:</th>
                <th><?php echo $query->jml_pinjam; ?></th>
            </tr>
        </table>
        <a href="index.php/peminjaman" class="btn btn-secondary"><< Kembali</a>
    </div>
    <br>
</div>

</div>