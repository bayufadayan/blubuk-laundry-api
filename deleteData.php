<?php
    include 'conn.php';
    
    $invoice = $_POST['invoice'];
    $connect -> query("DELETE FROM transaksi WHERE invoice =" .$invoice);



?>