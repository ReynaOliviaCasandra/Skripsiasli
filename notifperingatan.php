<h2 class="text-center">History Sisa Barang Anda !</h2>
<?php
    include 'function.php';
    include 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="img/Logofix.png" rel="shortcut icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/custom.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
                                <!-- Notifikasi succes-->
                                <?php 
                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM stock WHERE stock <20");
                                while($fetch=mysqli_fetch_array($ambilsemuadatastock)){
                                    $barang = $fetch['namabarang'];
                                    $jumlah = $fetch['stock'];
                                
                                ?>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Warning!</strong> Mohon dilihat <?=$barang;?> tinggal segiini <?=$jumlah;?>
                            </div>
                                <?php 
                                };
                                ?>
                                <!-- End Notifikasi succes -->
</body>
</html>
                                   
                                   
                                   