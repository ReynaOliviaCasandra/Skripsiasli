<?php
include 'function.php';
include 'cek.php';

//Check login owner, terdaftar atau tidak
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    // die(mysqli_error($conn));
    // Cocokan dengan database, cari data
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where username='$username' and password='$password'");
    // Hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);
    if ($hitung > 0) {
        // Kalau data ditemukan
        // $_SESSION['log']= 'TRUE';
        $ambildatrole = mysqli_fetch_array($cekdatabase);
        $role = $ambildatrole['role'];
        if ($role == 'owner') {
            // Kalau dia owner
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'owner';
            // header('location: indexx.php'); //halaman utama
            echo'<script>
            alert("Selamat Datang Owner !!");
            window.location.href = "indexx.php"
            </script>';
        } else if ($role == 'manager') {
            // Kalau bukan owner
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'manager';
            // header('location: homemanager.php');
            echo'<script>
            alert("Selamat Datang Manager !!");
            window.location.href = "homemanager.php"
            </script>';
        } else if ($role == 'kepalagudang') {
            //Kalau bukan manager
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = 'kepalagudang';
            // header('location:homegudang.php');
            echo'<script>
            alert("Selamat Datang Kepala gudang,semoga harimu menyenangkan !!");
            window.location.href = "homekepalagudang.php"
            </script>';
        } else {
            echo'<script>
            alert("Data Tidak ditemukan !!");
            window.location.href = "login.php"
            </script>';
        }
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="login2.php">
                                        <div class="form-group">
                                            <label class="small mb-1">Username</label>
                                            <input class="form-control py-4" type="text" placeholder="Username" name="username" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Status</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="role" type="text" placeholder="Enter Ur Status" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" required />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; EdricSuryady 31190013 Thn 2022</div>
                    </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>