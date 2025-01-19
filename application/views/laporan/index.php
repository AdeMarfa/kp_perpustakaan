

<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title"><?php echo $judul_web; ?></h3>
        <hr>
        <form action="" Method="post" data-parsley-validate="true">
            <div class="form-group">
                <label>Jenis Laporan</label>
                <select class="form-control select2-single" name="lap" required>
                    <option value="">- Pilih -</option>
                    <option value="petugas">Petugas</option>
                    <option value="anggota">Anggota</option>
                    <option value="buku">Buku</option>
                    <option value="peminjaman">Peminjaman</option>
                    <option value="pengembalian">Pengembalian</option>
                </select>
            </div>
            <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="text" name="tgl1" id="tgl" class="form-control col-md-4" value="<?php echo date('d-m-Y'); ?>" required>
            </div>
            <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="text" name="tgl2" id="tgl2" class="form-control col-md-4" value="<?php echo date('d-m-Y'); ?>" required>
            </div>
            <button type="submit" name="btncetak" class="btn btn-primary">Cetak</button>
        </form>
    </div>
    <br>
</div>

</div>