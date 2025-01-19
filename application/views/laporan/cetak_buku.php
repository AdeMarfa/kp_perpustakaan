
        <h3 align="center"><?php echo $judul_lap; ?></h3>

        <table border="1" width="100%">

            <tr>
                <th width='1'>No.</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
            </tr>
            <?php 
                $i=1;
                foreach ($sql->result() as $key => $value): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo ucwords($value->judul); ?></td>
                    <td><?php echo $value->pengarang; ?></td>
                    <td><?php echo $value->penerbit; ?></td>
                    <td><?php echo $value->tahun; ?></td>
                    <td><?php echo $this->M_buku->cek_stok($value->id_buku); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>