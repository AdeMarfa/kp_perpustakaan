

<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title"><?php echo $judul_web; ?></h3>
        <hr>
        <a href="index.php/buku/tambah" class="btn btn-primary btn-xs">+ <?php echo $judul_web; ?></a>
        <br>
        <br>
        <?php echo $this->session->flashdata('msg'); ?>

        <table id="table_id" class="table table-stripped table-bordered" width="100%">
            <thead>
            <tr>
                <th width="1">No.</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
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
                <td><?php echo $value->pengarang; ?></td>
                <td><?php echo $value->penerbit; ?></td>
                <td><?php echo $value->tahun; ?></td>
                <td><?php echo $this->M_buku->cek_stok($value->id_buku); ?></td>
                <td align="center">
                    <a href="index.php/buku/edit/<?php echo $value->id_buku; ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="index.php/buku/hapus/<?php echo $value->id_buku; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin?')">hapus</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
            
    </div>
    <br>
</div>

</div>