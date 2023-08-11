<?php
//import koneksi ke database
include 'function.php';
include 'cek.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link href="img/Logofix.png" rel="shortcut icon">
    <title>Laporan Barang Expired</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
    <h2>Laporan Detail Barang</h2>
    <h4>(Inventory Management Cosmetic Modern)</h4>
    <div class="data-tables datatable-dark">
        <table class="table table-bordered" id="exportharga" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Detail</th>
                    <th>ID Faktur</th>
                    <th>Tanggal EXP</th>
                    <th>Tanggal</th>
                    <th>QTY</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock s, faktur f, detail d WHERE d.idproduk=s.idbarang and d.idnota=f.idfaktur and d.idproduk");
                $i=1;
                while($data = mysqli_fetch_array($ambilsemuadatastock)){
                    $iddetail = $data['iddetail'];
                    $idbarang = $data['idbarang'];
                    $idfaktur = $data['idfaktur'];
                    $tanggalexpired = $data['tanggalex'];
                    $tanggal = $data['tanggal'];
                    $qty = $data['qty'];

                    // Periksa apakah tanggal kadarluasa sudah tiba
                    $tanggalSekarang = date('Y-m-d');
                    if ($tanggalexpired <= $tanggalSekarang) {
                ?>
                    <tr>
                        <td><?= $iddetail; ?></td>
                        <td><?= $idfaktur; ?></td>
                        <td><?= $tanggalexpired; ?></td>
                        <td><?= $tanggal; ?></td>
                        <td><?= $qty; ?></td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary" onclick="goBack()">Kembali</button>
    </div>
    <!-- Function kembali -->
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
    <!--  -->
    <script>
        $(document).ready(function() {
            $('#exportharga').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</div>
</body>
</html>
