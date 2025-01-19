

<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title"><?php echo $judul_web; ?></h3>
        <hr>
        <a href="index.php/peminjaman/tambah" class="btn btn-primary btn-xs">+ <?php echo $judul_web; ?></a>
        <br>
        <br>
        <?php echo $this->session->flashdata('msg'); ?>

        <table id="table_id" class="table table-stripped table-bordered" width="100%">
            <thead>
            <tr>
                <th width="1">No.</th>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Peminjam</th>
                <th width="100">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                foreach ($query->result() as $key => $value): ?>
                <tr>
                <th><?php echo $i++; ?></th>
                <td><?php echo ucwords($value->judul); ?></td>
                <td><?php echo $value->jml_pinjam; ?></td>
                <td><?php echo $value->tgl_pinjam; ?></td>
                <td><?php echo $value->nama_anggota; ?></td>
                <td align="center">
                    <a href="index.php/peminjaman/detail/<?php echo $value->id_peminjaman; ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="index.php/peminjaman/hapus/<?php echo $value->id_peminjaman; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin?')">hapus</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
            
    </div>
    <br>
</div>

</div>