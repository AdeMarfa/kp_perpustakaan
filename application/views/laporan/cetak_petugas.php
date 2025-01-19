
        <h3 align="center"><?php echo $judul_lap; ?></h3>

        <table border="1" width="100%">

            <tr>
                <th width='1'>No.</th>
                <th>Username</th>
                <th>Nama Petugas</th>
                <th>Jenis Kelamin</th>
                <th>No. Hp</th>
                <th width='10%'>Tgl. Terdaftar</th>
            </tr>
            <?php 
                $i=1;
                foreach ($sql->result() as $key => $value): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value->username; ?></td>
                    <td><?php echo $value->nama_petugas; ?></td>
                    <td><?php echo $value->jk; ?></td>
                    <td><?php echo $value->no_hp; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($value->tgl_daftar)); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>