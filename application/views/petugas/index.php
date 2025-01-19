

<div class="col-lg-9">

    
<div class="card mt-4">
    
    <div class="card-body">
        <h3 class="card-title"><?php echo $judul_web; ?></h3>
        <hr>
        <a href="index.php/petugas/tambah" class="btn btn-primary btn-xs">+ <?php echo $judul_web; ?></a>
        <br>
        <br>
        <?php echo $this->session->flashdata('msg'); ?>

        <table id="table_id" class="table table-stripped table-bordered" width="100%">
            <thead>
            <tr>
                <th width="1">No.</th>
                <th>Nama Petugas</th>
                <th>Jenis Kelamin</th>
                <th>No. Hp</th>
                <th width="100">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
            foreach ($query->result() as $key => $value): ?>
            <tr>
            <th><?php echo $i++; ?></th>
            <td><?php echo $value->nama_petugas; ?></td>
            <td><?php echo $value->jk; ?></td>
            <td><?php echo $value->no_hp; ?></td>
            <td align="center">
                <a href="index.php/petugas/edit/<?php echo $value->id_petugas; ?>" class="btn btn-success btn-sm">Edit</a>
                <a href="index.php/petugas/hapus/<?php echo $value->id_petugas; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin?')">hapus</a>
            </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
       
            
    </div>
    <br>
</div>

</div>