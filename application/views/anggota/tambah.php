
<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title">Form <?php echo $judul_web; ?></h3>
        <hr>
        <?php echo $this->session->flashdata('msg'); ?>
        <form action="" Method="post" data-parsley-validate="true">
            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" name="nis" class="form-control" id="nis" onkeypress="return hanyaAngka(event);" maxlength="20" placeholder="Masukan NIS" required autofocus>
            </div>
            <div class="form-group">
                <label for="nama_anggota">Nama Anggota</label>
                <input type="text" name="nama_anggota" class="form-control" id="nama_anggota" placeholder="Masukan Nama Anggota" required>
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <br>
                <label>
                    <input type="radio" name="jk" value="Laki-Laki" required>Laki-Laki
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="jk" value="Perempuan" required>Perempuan
                </label>
            </div>
            <div class="form-group">
                <label for="no_hp">No Hp</label>
                <input type="text" name="no_hp" class="form-control" id="no_hp" onkeypress="return hanyaAngka(event);" maxlength="14" placeholder="Masukan No Hp" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" placeholder="Masukan Alamat" cols="80" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" required>
            </div>

            <a href="index.php/anggota" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
        </form>
            
    </div>
    <br>
</div>

</div>