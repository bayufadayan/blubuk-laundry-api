<?php
    include 'conn.php';

    $waktu = $_POST['waktu'];
    $tanggal = $_POST['tanggal'];
    $metodeambil = $_POST['metodeambil'];
    $jenislayanan = $_POST['jenislayanan'];
    $jenisbahan = $_POST['jenisbahan'];
    $berat = $_POST['berat'];
    $hargapokok = $_POST['hargapokok'];

    $connect->query("INSERT INTO transaksi (waktu, tanggal, metode_ambil, jenis_layanan, jenis_bahan, berat, harga_pokok) VALUES('".$waktu."','".$tanggal."','".$metodeambil."','".$jenislayanan."','".$jenisbahan."','".$berat."','".$hargapokok."')");



?>