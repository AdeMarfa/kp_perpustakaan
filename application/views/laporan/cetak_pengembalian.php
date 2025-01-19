
        <h3 align="center"><?php echo $judul_lap; ?></h3>

        <table border="1" width="100%">

            <tr>
                <th width='1'>No.</th>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Tanggal Kembali</th>
                <th>Peminjam</th>
            </tr>
            <?php 
                $i=1;
                foreach ($sql->result() as $key => $value): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo ucwords($value->judul); ?></td>
                    <td><?php echo $value->jml_pinjam; ?></td>
                    <td><?php echo $value->tgl_kembali; ?></td>
                    <td><?php echo $value->nama_anggota; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>