<?php
//import koneksi ke database
include 'function.php';
include 'cek.php';
?>
<html>
<head>
  <title>Laporan Barang Rusak / Retur</title>
  <link href="img/Logofix.png" rel="shortcut icon">
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
			<h2>Stock Barang Retur Cosmetic Modern</h2>
			<h4>(Inventory Management)</h4>
				<div class="data-tables datatable-dark">
                <table class="table table-bordered" id="exportretur" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>id_Retur</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Tanggal</th>
                                                <th>QTY</th>
                                                <th>Status Barang</th>
                                                <th>Penerima</th>
                                                <!-- <th>Status Barang</th> --> 
                                            </tr>
                                        </thead>
                                        <!-- Mulai Field Table -->
                                        <tbody>
                                        <?php
                                         $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM retur k, stock s, supplier r WHERE r.idsupplier = k.penerima and s.idbarang = k.idbarang");
                                         $i=1;
                                         while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                             $idr =$data['idretur'];
                                             $tanggal = $data['tanggal'];
                                             $namabarang = $data['namabarang'];
                                             $jenisbarang =$data['jenisbarang'];
                                             $qty = $data['qty'];
                                             $keterangan = $data['nama'];
                                             $status = $data['status'];
                                         ?>
                                         <tr>
                                             <td><?=$i++;?></td>
                                             <td><?php echo $namabarang;?></td>
                                             <td><?php echo $jenisbarang;?></td>
                                             <td><?php echo $tanggal;?></td>
                                             <td><?php echo $qty;?></td>
                                             <td><?php echo $status;?></td>
                                             <td><?php echo $keterangan;?></td>
                                        </tr>
                                        </div>
                                        <!--  -->
                                        <?php
                                        };
                                        ?>
                                        </tbody>
                                    </table>
				                    </div>
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
            $('#exportretur').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy','csv','excel', 'pdf', 'print'
                ]
            } );
        } );
        </script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>