<?php
    include 'function.php';
    require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link href="img/Logofix.png" rel="shortcut icon">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cosmetic Modern</title>
        <link href="css/custom.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <img src="./img/Logofix.png" width="100" height="40" alt="" class="ml-4">
            <a class="navbar-brand" href="indexx.php"> Semangat Kerjanya</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="indexx.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-warehouse"></i></div>
                                Stock Gudang
                            </a>
                             <!-- Fungsi  Hak Akes Halaman -->
                            <?php
                                 if($_SESSION['role'] == "owner" || $_SESSION['role'] == "manager"){
                            ?>
                                <a class="nav-link" href="stockharga.php"><i class="fa-solid fa-money-check-dollar"></i> &nbsp; List Harga barang
                            <?php
                                } 
                            ?>
                            <!-- Fungsi Hak akses user -->
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="laporanbarangmasuk.php">Laporan  Barang Masuk</a>
                                    <a class="nav-link" href="laporanstockbarangkeluar.php">Laporan Barang Keluar</a>
                                    <a class="nav-link" href="laporanstockgudang.php">Laporan Barang Gudang</a>
                                </nav>
                            </div>
                            <!-- Req Barang -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsreq" aria-expanded="false" aria-controls="collapseLayouts">   
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Permission
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsreq" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <?php
                                if($_SESSION['role'] == "manager"){
                                ?>
                                <a class="nav-link" href="reqbarang.php"><i class="fa-solid fa-code-pull-request"></i>Req Barang </a>
                                <?php
                                } 
                                ?>
                                <?php
                                if($_SESSION['role'] == "owner"){
                                ?>
                                <a class="nav-link" href="user.php"><i class="fa-solid fa-user-tie"></i></i> &nbsp; User</a>
                                <a class="nav-link" href="approval.php"><i class="fa-solid fa-thumbs-up"></i> &nbsp; Approval Barang</a>
                                <?php
                                } 
                                ?>
                                    <!-- <a class="nav-link" href="#!">Laporan Barang Gudang</a> -->
                                </nav>
                            </div>
                            <!-- End Req Barang -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Master Main
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <?php
                                            if($_SESSION['role'] == "owner"){
                                                ?>
                                                 <a class="nav-link" href="login.php">Login</a>
                                            <?php
                                        } 
                                            ?>
                                            <!-- Fungsi Hak akses user -->
                                                <!-- Fungsi  Hak Akes Halaman -->
                                        <?php
                                            if($_SESSION['role'] == "owner"){
                                                ?>
                                                <a class="nav-link" href="register.php">Register</a>
                                            <?php
                                        } 
                                            ?>
                                            <!-- Fungsi Hak akses user -->
                                            <a class="nav-link" href="logout.php">logout</a>
                                            <!-- <a class="nav-link" href="password.html">Forgot Password</a> -->
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Data Master
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <!-- Fungsi  Hak Akes Halaman -->
                                            <?php
                                            if($_SESSION['role'] == "owner" || $_SESSION['role'] == "kepalagudang"){
                                            ?>
                                            <a class="nav-link" href="barangmasuk.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp; Barang Masuk</a> 
                                            <?php
                                        } 
                                            ?>
                                            <!-- Fungsi Hak akses user -->
                                            <a class="nav-link" href="barangkeluarr.php"><i class="fa-solid fa-tent-arrow-turn-left"></i>&nbsp; Barang Keluar </a>
                                            <a class="nav-link" href="retur.php"><i class="fa-solid fa-arrow-right-arrow-left"></i>&nbsp; Retur Barang </a>
                                            <a class="nav-link" href="sales.php"><i class="fa-solid fa-universal-access"></i></i>&nbsp;  Daftar Sales </a>
                                            <a class="nav-link" href="faktur.php"><i class="fa-solid fa-file-invoice"></i>&nbsp; Faktur </a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                    <div class="sb-sidenav-footer">
                    <div class="High">Logged in as 
                        <?php
                        if($_SESSION['role'] == "owner"){
                            echo"Owner Cosmetic Modern";
                        }elseif( $_SESSION['role'] == "manager"){
                            echo "Manager Cosmetic Modern";
                        }elseif($_SESSION['role']== "kepalagudang"){
                            echo"Kepala Gudang Cosmetic Modern";
                        }
                        ?></div>
                        <!-- Start Bootstrap -->
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Halaman Retur Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
                                Tambah
                                </button>
                                <a href="laporanretur.php" id="" class="btn btn-info mb-2">Cetak Laporan</a>
                                <!-- END Button to Open the Modal -->
                                <i class="fas fa-table mr-1"></i>
                                DataTable Retur Barang
                                <!-- Validasi Tanggal -->
                                <br>
                                <form method="POST">
                                    <input type="date" name="tglmulai" class="form-control" placeholder="Tanggal Masuk">
                                    <br>
                                    <input type="date" name="tglselesai" class="form-control">
                                    <br>
                                    <button type="submit" name="filter" class="btn btn-info">Cari Tanggal</button>
                                </form>
                                <br>
                                <!-- End Validasi Tanggal -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Retur</th>
                                                <th>ID Barang</th>
                                                <th>ID Faktur</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Tanggal</th>
                                                <th>QTY</th>
                                                <th>Status</th>
                                                <th>StatusBarang</th>
                                                <th>Penerima</th>
                                                <th>Aksi</th>   
                                            </tr>
                                        </thead>
                                        <!-- Mulai Field Table -->
                                        <tbody>
                                        <?php
                                        // Fungsi Filter tanggal
                                        if(isset($_POST['filter'])){
                                            $mulaitanggal = $_POST['tglmulai'];
                                            $selesaitanggal = $_POST['tglselesai'];
                                            if($mulaitanggal!=null || $selesaitanggal!=null){
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM retur k, stock s WHERE s.idbarang = k.idbarang AND tanggal BETWEEN '$mulaitanggal' AND DATE_ADD('$selesaitanggal',INTERVAL 1 DAY) ORDER BY idretur DESC");
                                            }else{
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM retur k, stock s WHERE s.idbarang = k.idbarang AND tanggal BETWEEN '$mulaitanggal' AND DATE_ADD('$selesaitanggal',INTERVAL 1 DAY) ORDER BY idretur DESC");
                                            }
                                        }
                                        else{
                                            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM retur k, stock s, supplier r, faktur f WHERE f.idfaktur=k.idfaktur and r.idsupplier = k.penerima and s.idbarang = k.idbarang");
                                        }
                                        // $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang = k.idbarang");
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idr =$data['idretur'];
                                            $idbarang = $data['idbarang'];
                                            $idfaktur = $data['idfaktur'];
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $jenisbarang =$data['jenisbarang'];
                                            $qty = $data['qty'];
                                            $keterangan = $data['nama'];
                                            $status = $data['status'];
                                            $statusbarang =$data['statusbarang'];
                                        ?>
                                        <tr>
                                        <td><?=$i++;?></td>
                                            <td><?=$idbarang?></td>
                                            <td><?=$idfaktur?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$jenisbarang;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$status;?></td>
                                            <td><?php
                                            if($statusbarang ==0){
                                                echo "Menunggu Dikirimkan";
                                            }elseif($statusbarang == 1){
                                                 echo "Barang Sedang dikirim ke sales";
                                            };
                                            ?>
                                            </td>
                                            <td><?=$keterangan;?></td>
                                            <td>
                                            <button type="button" class="btn btn-success mb-1 ml-2"  data-toggle="modal" onclick="window.location.href='https://wa.me/';">whatshapp</button>
                                            <!-- Aksi Pembatasan akses role -->
                                            <?php
                                            if($_SESSION ['role'] == "owner" || $_SESSION ['role'] == "kepalagudang"){
                                            ?> 
                                            <!-- Batasan yang boleh chat -->
                                            <button type="button" class="btn btn-secondary mb-1 ml-2" data-toggle="modal" data-target="#kirimsales<?=$idr;?>">
                                            KirimSales
                                            </button>
                                            <?php
                                            };
                                            ?>
                                            <?php
                                            if($_SESSION ['role'] == "owner" || $_SESSION ['role'] == "kepalagudang" || $_SESSION ['role'] == "manager"){
                                            ?> 
                                            <!-- Batasan yang boleh chat -->
                                            <button type="button" class="btn btn-warning mb-1 ml-2" data-toggle="modal" data-target="#edit<?=$idr;?>">
                                            Edit
                                            </button>
                                            <?php
                                            };
                                            ?>
                                             <!-- Selesai Aksi Rolenya -->
                                             </td>
                                             </tr>
                                            <!-- Selesai Aksi Rolenya -->
                                             <!-- End barang rusak ke sales -->
                                                <!-- The  Edit Modal -->
                                                <div class="modal fade" id="edit<?=$idr;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Barang</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group">
                                                <p>Masukan Jumlah Qty</p>
                                                <input class="form-control py-4 mb-2"  name="qty"  type="number" min="1"   placeholder="Jumlah Stock"  value="<?=$qty;?>"required/>
                                                <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                                                <input type="hidden" name="idretur" value="<?=$idr;?>">
                                                <button type="submit" class="btn btn-primary" name="updatebarangretur" >Submit</button>
                                                </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                            <!-- Kirim Barang rusak Ke sales -->
                                             <div class="modal fade" id="kirimsales<?=$idr;?>">
                                             <div class="modal-dialog">
                                             <div class="modal-content">
                                             <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title"> Sudah Siap Kirim Barang ke Supplier?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="POST">
                                                <div class="modal-body mb-2">
                                                Apakah anda  ingin  Memgirim Barang ini <?=$namabarang;?> Jenis <?=$jenisbarang;?> dengan jumlah <?=$qty;?> Kondisi <?=$status;?>
                                                <input type="hidden" name="idretur" value="<?=$idr;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-success" name="kirimkesales" >Siap Kirim</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        </td>
                                        </tr>
                                        <?php
                                        };
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#pesananr').change(function() { 
                    var selectedBarang = $(this).val(); 
                    $.ajax({
                        type: 'POST', 
                        url: 'ajax.php',
                        data: 'idbarang=' + selectedBarang, 
                        success: function(response) { 
                            $('#tanggalex').html(response); 
                        }
                    });
                });
            });
        </script>
    </body>
    <!-- Modal Barang keluar -->    
                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Masukan Data Barang Rusak</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST">
                    <div class="modal-body">
                    <p>Pilih Fakturnya</p>
                    <select name="fakturnya" class="form-control mb-2">
                       <?php
                       $ambilsemuadatanya = mysqli_query($conn,"SELECT * FROM faktur");
                       while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                            // $supplier = $fetcharray['supplier'];
                            $idfaktur = $fetcharray['idfaktur'];
                        ?>
                        <option value="<?=$idfaktur;?>"><?=$idfaktur;?></option> 
                        <?php
                        };
                       ?>
                    </select>
                    <select name="barangnya" class="form-control mb-2">
                       <?php
                       $ambilsemuadatanya = mysqli_query($conn,"SELECT * FROM stock  ORDER BY namabarang ASC");
                       while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                            $namabarangnya = $fetcharray['namabarang']; 
                            $idbarangnya = $fetcharray['idbarang'];
                        ?>
                        <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option> 
                        <?php
                            }
                       ?>
                    </select>
                    <input type="number"  name="qty" min="1" class="form-control mb-2" placeholder="Quantity" required />
                    <label>Pilih Tanggal:</label>
                    <br>
                    <select class="form-control" name="tanggalex" id="tanggalex"></select>
                    <br>
                    <input class="form-control py-4 mb-2"  name="status" type="text" placeholder="Status Barang" required />
                    <!-- <input class="form-control py-4 mb-2"  name="penerima" type="text" placeholder="Sales" required  /> -->
                    <select name="penerima" class="form-control mb-2">
                    <?php
                       $ambilsemuadatanya = mysqli_query($conn,"SELECT * FROM supplier");
                       while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                            $namasales = $fetcharray['nama'];
                            $idsupplier = $fetcharray['idsupplier'];
                        ?>
                        <option value="<?=$idsupplier;?>"><?=$namasales;?></option> 
                        <?php
                            };
                       ?>
                    </select>
                    <input type="hidden" name="idretur" value="<?=$idr;?>">
                    <input type="hidden" name="idbarang" value="<?=$idbarang;?>">
                    <input type="hidden" name="fakturnya" value="<?=$idfaktur;?>">
                    <button type="submit" name="barangretur"class="btn btn-primary" >Submit</button>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
            <!-- Selesai modal barang Keluar -->
            <!-- End barang sedang dikirim -->
</html>
