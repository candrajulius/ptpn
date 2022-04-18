<?php
session_start();
require("../lib/database.php");
require("../lib/config.php");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data-karyawan.xls");
?>

<table border="1">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">NRP</th>
        <th scope="col">Nama Karyawan</th>
        <th scope="col">SMKBK</th>
        <th scope="col">Maping Competency</th>
        <th scope="col">CLI</th>
        <th scope="col">Pendidikan</th>
        <th scope="col">Sertifikat</th>
        <th scope="col">Perjalanan Karir</th>
        <th scope="col">Punishment</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Gambar</th>
        <th scope="col">tgl_ditambah</th>
        <th scope="col">Tgl_diupdate</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($connection, "SELECT * FROM karyawan ORDER BY id DESC");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
            <tr>
            <th scope="row"><?=$no;?></th>
            <td><?=$data['nrp'];?></td>
            <td><?=$data['nama_karyawan'];?></td>
            <td><?=number_format($data['smbk']);?></td>
            <td><?=number_format($data['mapping_competency']);?></td>
            <td><?=number_format($data['cli']);?></td>
            <td><?=number_format($data['pendidikan']);?></td>
            <td><?=number_format($data['sertifikat']);?></td>
            <td><?=number_format($data['perjalanan_karir']);?></td>
            <td><?=number_format($data['punishment']);?></td>
            <td><?=number_format($data['jumlah']);?></td>
            <td><img src="<?=$BASE.$data['gambar'];?>" width="50"></td>
            <td><?=$data['tgl_ditambah'];?></td>
            <td><?=$data['tgl_diupdate'];?></td>
            </tr>
        <?php
        $no++;
        }
        ?>
    </tbody>
</table>