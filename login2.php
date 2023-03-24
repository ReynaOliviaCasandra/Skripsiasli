<?php
include ("function.php");
// session_start();

// $_SESSION['isLoggedin']= '1';
// $username = $_POST['username'];
// $password = $_POST['password'];
// // $password2 = sha1($password);
//     // die(mysqli_error($conn));

// $username = mysqli_real_escape_string($conn, $username);
// $password = mysqli_real_escape_string($conn, $password);

// if (empty($username) && empty($password)) {
// 	header('location:index.php?error=Username dan Password Kosong!');
// } else if (empty($username)) {
// 	header('location:indexx.php?error=Username Kosong!');
// } else if (empty($password)) {
// 	header('location:indexx.php?error=Password Kosong!');
// }

// $q = mysqli_query($conn, "select * from login where username='$username' and password='$password'");
// $row = mysqli_fetch_array ($q);

// if (mysqli_num_rows($q) == 1) {
//     $_SESSION['id'] = $row['id'];
// 	$_SESSION['username'] = $username;
//     $_SESSION['fullname'] = $row['fullname'];
//     $_SESSION['role']    = $row['role'];
    
//     if ($_SESSION['role'] == 'owner'){
//         header('location:indexx.php');
//     } else if ($_SESSION['role'] == 'manager'){
//         header('location:homemanager.php');
//     } else if ($_SESSION['role'] == 'kepalagudang'){
//         header('location:kepalagudang.php');
//     }

	
// } else {
// 	header('location:login.php?error=Anda Belum Terdaftar!');
// }
?>