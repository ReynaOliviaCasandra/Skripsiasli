<?php
     include 'function.php';
     include 'cek.php';
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
        <link href="css/custom.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="" rel="shortcut icon"/>
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
                        <!-- <a class="dropdown-item" href="#">Settings</a> -->
                        <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
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
                                    <a class="nav-link" href="laporanharga.php">Laporan Harga Barang</a>
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
                        <h1 class="mt-4">Daftar User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
                                 Tambah Barang Masuk
                                </button> -->
                                <!-- End Notifikasi warning -->
                                <!-- <a href="laporanbarangmasuk.php" id="exportmasuk" class="btn btn-info mb-2">Cetak Laporan</a>
                                <br> -->
                                <!-- Validasi Tanggal -->
                                <!-- <br>
                                <form method="POST">
                                    <input type="date" name="tglmulai" class="form-control" placeholder="Tanggal Masuk">
                                    <br>
                                    <input type="date" name="tglselesai" class="form-control">
                                    <br>
                                    <button type="submit" name="filter" class="btn btn-info">Cari Tanggal</button>
                                </form>
                                <br> -->
                                <!-- End Validasi Tanggal -->
                                <!-- end Button to Open the Modal  -->
                                <i class="fas fa-table mr-1"></i>
                                Data User Cosmetic Modern
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <!-- <th>Id_MasukBarang</th> -->
                                                <th>ID_user</th>
                                                <th>User</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>role</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM login");
                                        $i=1;
                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $iduser = $data['iduser'];
                                            $namauser = $data['username'];
                                            $email =$data['email'];
                                            $password = $data['password'];
                                            $role = $data['role'];
                                            $status = $data['status'];
                                        ?>
                                        <tr>
                                            <td><?=$iduser;?></td>
                                            <td><?=$namauser;?></td>
                                            <td><?=$email;?></td>
                                            <td ><?=$password;?></td>
                                            <td><?=$role;?></td>
                                            <td><?php
                                            if($status == '1'){
                                                echo "aktif";
                                            }elseif($status == '2'){
                                                echo "akun tidak aktif";
                                            }
                                            ?></td>   
                                            <td>
                                            <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#edit<?=$iduser;?>">
                                            EDIT
                                            </button>
                                            <!-- Fungsi  Hak Akes Halaman -->
                                            <?php
                                            if($role !="owner"){
                                                    if($status==2){?>
                                            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#acc<?=$iduser;?>">
                                            Aktive
                                            </button>
                                            <?php } elseif($status==1){?>
                                            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#dec<?=$iduser;?>">
                                            Non-Aktive
                                            </button>
                                            <?php 
                                            }}; ?>            
                                             <!-- Fungsi Hak akses user -->
                                            
                                            </td> 
                                        </tr>
                                        <!-- END Selesai Field Table -->
                                        <!-- Aksi CRUD -->
                                        <!-- Modal stock Gudang -->
                                        <!-- The  Edit Modal -->
                                        <div class="modal fade" id="acc<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Status User</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group">
                                                Apakah anda yakin ingin aktifkan role <?=$role;?>
                                                <input type="hidden" name="role" value="<?=$role;?>">
                                                <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                                <input type="hidden" name="status" value="<?=$status;?>">
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="aktifrole" >Submit</button>
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
                                        <div class="modal fade" id="dec<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Status User</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group">
                                                Apakah anda yakin ingin Matikan role <?=$role;?>
                                                <input type="hidden" name="role" value="<?=$role;?>">
                                                <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                                <input type="hidden" name="status" value="<?=$status;?>">
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="matikanrole" >Submit</button>
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
                                                <!-- The  Edit Modal -->
                                                <div class="modal fade" id="edit<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit User Cosmetic Modern</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="post">
                                                <div class="modal-body">
                                                <div class="form-group">
                                                <input  type="text"  name="username"class="form-control mb-2  "placeholder="userName" required value="<?=$namauser;?>"/>
                                                <input  type="text"  name="email"class="form-control mb-2  "placeholder="email" required value="<?=$email;?>"/>
                                                <input  type="text"  name="password"class="form-control mb-2  "placeholder="Password" required value="<?=$password;?>"/>
                                                <input  type="text"  name="role"class="form-control mb-2  "placeholder="role" required value="<?=$role;?>"/>
                                                <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                                <button type="submit" class="btn btn-primary" name="updateuser" >Submit</button>
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
                                                <!-- Modal User -->
                                                <!-- The  delete Modal -->
                                                <div class="modal fade" id="delete<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus User !</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <!-- Content 1 -->
                                                <form method="POST">
                                                <div class="modal-body mb-2">
                                                Apakah anda yakin ingin menghapus User <?=$namauser;?> Dengan Role <?=$role;?> ?
                                                <input type="hidden" name="iduser"    value="<?=$iduser;?>">
                                                <input type="hidden" name="username"  value="<?=$username;?>">
                                                <input type="hidden" name="role"     value="<?=$role;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapususer" >Hapus</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
                                        <!-- End aksi Crud -->
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
    </body>
