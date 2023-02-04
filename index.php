<!DOCTYPE html>
<html>

<head>
    <title> BN 666 - Buku Tamu </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    require_once 'koneksi.php'
    ?>
<center>
        <h1>CRUD  SEDERHANA BUKU TAMU </h1>
</center>
<!--Menghitung Tamu -->
<?php
$no =1;
$SQL = "SELECT COUNT(id) AS jumlahTamu FROM tamu";
$data = mysqli_query($MySQli, $SQL);
$hasil = mysqli_fetch_assoc($data);

//Menghitung Jumlah tamu LAKI LAKI 
$SQL_Lelaki = "SELECT COUNT(jenis_kelamin) AS jumlah from tamu WHERE
jenis_kelamin = 'L'";
$data_Lelaki = mysqli_query($MySQli, $SQL_Lelaki);
$hasil_Lelaki = mysqli_fetch_all($data_Lelaki, MYSQLI_ASSOC);

//Menhitung jumlah tamu perempuan 
$SQL_Perempuan = "SELECT COUNT(jenis_kelamin) AS jumlah from tamu WHERE
jenis_kelamin = 'P'";
$data_Perempuan = mysqli_query($MySQli, $SQL_Perempuan);
$hasil_Perempuan = mysqli_fetch_all($data_Perempuan, MYSQLI_ASSOC);

//Menhitung tamu prioritas
$SQL_Prio = "SELECT prioritas.keterangan, COUNT(tamu.id) AS jumlah FROM tamu INNER JOIN
 prioritas ON tamu.id_prioritas = Prioritas.id GROUP BY tamu.id_prioritas";
 $data_Prio = mysqli_query($MySQli, $SQL_Prio);
 $hasil_Prio = mysqli_fetch_all($data_Prio, MYSQLI_ASSOC);
 
 ?>
 <center>
    <h5>Jumlah Tamu Sekarang : <?=$hasil['jumlahTamu'] ?></h5>
</center>
<center>
    <h5>Tamu Lelaki : <?= $hasil_Lelaki[0]['jumlah'] ?> ||
        Tamu Perempuan : <?=$hasil_Perempuan[0]['jumlah'] ?> </h5>
</center>
<center>
    <h5>
    <?php
    foreach ($hasil_Prio as $key => $value) {
        echo $value['keterangan'] , " : " , $value
        ['jumlah'] , " ";
    }
    ?>
    </h5>
</center>
<center class="nt-4">
    <a class="button" href="?page-list">Lihat Data </a>
    <a class="button" href="?page-add">Tambah Data </a>
</center>
<hr>
<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : 'add';


switch ($page) {
    case 'add':
        require_once 'add.php';
        break;
    case 'list':
        require_once 'list.php';
        break;
    case 'edit':
        require_once 'edit.php';
        break;
    case 'hapus':
        require_once 'delete.php';
        break;
    case 'detail':
        require_once 'detail.php';
        break;
    default:
    require_once 'add.php';
    break;
}
?>