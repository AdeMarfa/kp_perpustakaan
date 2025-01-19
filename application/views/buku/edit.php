
<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title">Form <?php echo $judul_web; ?></h3>
        <hr>
        <?php echo $this->session->flashdata('msg'); ?>
        <form action="" Method="post" data-parsley-validate="true">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul" value="<?php echo $query->judul; ?>" placeholder="Masukan Judul Buku" required autofocus>
            </div>
            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" class="form-control" id="pengarang" value="<?php echo $query->pengarang; ?>" placeholder="Masukan Pengarang Buku" required autofocus>
            </div>
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" id="penerbit" value="<?php echo $query->penerbit; ?>" placeholder="Masukan penerbit Buku" required autofocus>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <br>
                <select class="form-control select2-single col-md-3" name="tahun" required>
                    <option value="">- Pilih -</option>
                    <?php
                    for ($i=date('Y'); $i >= 1990 ; $i--) {?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                    }
                    ?>
                </select>
                
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <br>
                <input type="text" name="stok" class="form-control col-md-3" id="stok" onkeypress="return hanyaAngka(event);" maxlength="4" value="<?php echo $this->M_buku->cek_stok($query->id_buku); ?>" placeholder="Masukan Stok" required autofocus>
            </div>

            <a href="index.php/buku" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
        </form>
            
    </div>
    <br>
</div>

</div>