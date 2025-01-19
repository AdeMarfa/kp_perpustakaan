
<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title">Form <?php echo $judul_web; ?></h3>
        <hr>
        <?php echo $this->session->flashdata('msg'); ?>
        <form action="" Method="post" data-parsley-validate="true">
            <div class="form-group">
                <label for="anggota">Anggota</label>
                <select class="form-control select2-single" name="id_anggota" required>
                    <?php echo $this->M_pengembalian->sel_anggota(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="keterangan" cols="80" rows="4" required></textarea>

            </div>
            

            <a href="index.php/pengembalian" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
        </form>
            
    </div>
    <br>
</div>

</div>