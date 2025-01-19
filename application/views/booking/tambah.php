
<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title">Form <?php echo $judul_web; ?></h3>
        <hr>
        <?php echo $this->session->flashdata('msg'); ?>
        <form action="" Method="post" data-parsley-validate="true">
            <div class="form-group">
                <label for="batas_pinjam">Batas Pinjam</label>
                <input type="text" name="batas_pinjam" class="form-control col-md-3" id="batas_pinjam" onkeypress="return hanyaAngka(event);" maxlength="4" placeholder="Masukan Batas Pinjam /Hari" required autofocus>
            </div>
            <div class="form-group">
                <label for="buku">Buku</label>
                <select class="form-control select2-single" name="id_buku" required>
                    <?php echo $this->M_peminjaman->sel_buku(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jml_pinjam">Jumlah Pinjam</label>
                <br>
                <input type="text" name="jml_pinjam" class="form-control col-md-4" id="jml_pinjam" onkeypress="return hanyaAngka(event);" maxlength="2" placeholder="Masukan Jumlah Pinjam" required autofocus>
            </div>

            <a href="index.php/booking" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
        </form>
            
    </div>
    <br>
</div>

</div>