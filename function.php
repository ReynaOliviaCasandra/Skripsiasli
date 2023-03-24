<?php
session_start();
// Membuat koneksi database
$conn = mysqli_connect("localhost:3308","root","","db_stockcosmetic");
// Registrasi akun Owner
if(isset($_POST['registrasi'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    // Cocokan dengan database, cari data
    $cekdatabase = mysqli_query($conn,"INSERT INTO login (username,email,password,role) VALUES ('$username','$email','$password','$role')");
    // Hitung jumlah data
    if($cekdatabase){
        header('location:login.php');
        
    }else{
        header('location:register.php');
    }
}
//Check login owner, terdaftar atau tidak
// if (isset($_POST['login'])) {
//     $email = $_POST['email'];
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $role = $_POST['role'];
//     // Cocokan dengan database, cari data
//     $cekdatabase = mysqli_query($conn, "SELECT * FROM login where username='$username' and password='$password'");
//     // Hitung jumlah data
//     $hitung = mysqli_num_rows($cekdatabase);
//     if ($hitung > 0) {
//         // Kalau data ditemukan
//         // $_SESSION['log']= 'TRUE';
//         $ambildatrole = mysqli_fetch_array($cekdatabase);
//         $role = $ambildatrole['role'];
//         if ($role == 'owner') {
//             // Kalau dia owner
//             $_SESSION['log'] = 'Logged';
//             $_SESSION['role'] = 'owner';
//             header('location: index.php'); //halaman utama
//         } else if ($role == 'manager') {
//             // Kalau bukan owner
//             $_SESSION['log'] = 'Logged';
//             $_SESSION['role'] = 'manager';
//             header('location: homemanager.php');
//         } else if ($role == 'kepalagudang') {
//             //Kalau bukan manager
//             $_SESSION['log'] = 'Logged';
//             $_SESSION['role'] = 'kepalagudang';
//             header('location: homegudang.php');
//         } else {
//             echo 'Data tidak ada';
//         }
//         }
//     }

// Menambah Data Sales 
if(isset($_POST['buttonsales'])){
    $namasales = $_POST['sales'];
    $supplier = $_POST['distributor'];
    $contact = $_POST['kontak'];
    $salessekarang = mysqli_query($conn,"INSERT INTO sales (nama,perusahaan,kontak)VALUES('$namasales','$supplier','$contact')");
    if($salessekarang){
        header('location:sales.php');
        
    }else{
        header('location:index.php');
    }
}

// Barang Masuk ke Gudang
if(isset($_POST['addnewbarang'])){
    $namabarang= $_POST['namabarang'];
    $jenisbarang= $_POST['jenisbarang'];
    $stock= $_POST['stock'];
    // $keterangan= $_POST['keterangan'];

    // Fungsi Menambah Gambar
    $allowed_extensions= array('png','jpg','jpeg');
    $nama= $_FILES['file']['name']; //gambilnama gambar
    $dot = explode(".",$nama);
    $ekstensi = strtolower(end($dot)); //mengambil extensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp= $_FILES['file']['tmp_name']; //ngamil lokasi filenya

    // Penamaan file untuk di encryption
    $image = md5(uniqid($nama,true)). time().'.'.$ekstensi; //mengabungkan nama file yang di enyrip dnegna ekstensinya

    if($hitung<1){
    // // Jika belom ada
    // Proses Upload Gambar
        if(in_array($ekstensi,$allowed_extensions)===true){
            // Validasi ukuran file
            if($ukuran <15000000){
            move_uploaded_file($file_tmp,'img/'.$image);
                $addtotable = mysqli_query($conn,"INSERT INTO stock (namabarang,jenisbarang,stock,gambar) VALUES ('$namabarang','$jenisbarang','$stock','$image')");
            if($addtotable){
                echo'<script>
                alert("Barang Sukses Masuk");
                window.location.href = "indexx.php"
                </script>';
             }else{
                echo'<script>
                alert("Barang tidak bisa masuk silahkan check lagi");
                window.location.href = "indexx.php"
                </script>';
                }
            }else{
                // Jika filenya >= 1,5 mb
            echo'<script>
            alert("Ukuranya terlalu besar");
            window.location.href = "indexx.php"
            </script>';
            }
        } else{
            // Kalau formatnya bukan PNG
            echo'<script>
            alert("Harus  PNG &jpg !!");
            window.location.href = "indexx.php"
            </script>';
        }

    }else{
        // Jika Sudah ada
        echo'<script>
        alert("Nama barang sudah ada !!");
        window.location.href = "indexx.php"
        </script>';
    }
    
};

//Menambah Barang Masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $info = $_POST['keterangan'];
    $exp = $_POST['kadarluasa'];
   
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"INSERT INTO masuk (idbarang,kadarluasa,penerima,qty) VALUES ('$barangnya','$exp','$penerima','$qty')");
    $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtomasuk && $updatestokmasuk){
        echo'<script>
        alert("Sukses Memasukan Barang !");
        window.location.href = "barangmasuk.php"
        </script>';
    } else {
        echo 'gagal';
        header('location:indexx.php');
    } 
}

// Menambah faktur
if(isset($_POST['faktur'])){
    $fakturnya = $_POST['fakturnya'];
    $cekfaktur = mysqli_query($conn,"SELECT * FROM sales WHERE idsales='$fakturnya'"); 
    // $addtomasuk = mysqli_query($conn,"INSERT INTO faktur where idsales='$fakturnya'(supplier) VALUES('$fakturnya')");
    // // Fungsi Menambah Gambar
    $allowed_extensions= array('png','jpg');
    $nama= $_FILES['file']['name']; //gambilnama gambar
    $dot = explode(".",$nama);
    $ekstensi = strtolower(end($dot)); //mengambil extensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp= $_FILES['file']['tmp_name']; //ngamil lokasi filenya

    // Penamaan file untuk di encryption
    $image = md5(uniqid($nama,true)). time().'.'.$ekstensi; //mengabungkan nama file yang di enyrip dnegna ekstensinya

    if($hitung<1){
    // // Jika belom ada
    // Proses Upload Gambar
        if(in_array($ekstensi,$allowed_extensions)===true){
            // Validasi ukuran file
            if($ukuran <15000000){
            move_uploaded_file($file_tmp,'img/'.$image);
                $addtotable = mysqli_query($conn,"INSERT INTO faktur (supplier,gambar) VALUES ('$fakturnya','$image')");
            if($addtotable){
                echo'<script>
                alert("faktur Sukses Masuk");
                window.location.href = "faktur.php"
                </script>';
             }else{
                echo'<script>
                alert("faktur tidak bisa masuk silahkan check lagi");
                window.location.href = "faktur.php"
                </script>';
                }
            }else{
                // Jika filenya >= 1,5 mb
            echo'<script>
            alert("Ukuranya terlalu besar");
            window.location.href = "faktur.php"
            </script>';
            }
        } else{
            // Kalau formatnya bukan PNG
            echo'<script>
            alert("Harus  PNG &jpg !!");
            window.location.href = "faktur.php"
            </script>';
        }

    }else{
        // Jika Sudah ada
        echo'<script>
        alert("Nama faktur sudah ada !!");
        window.location.href = "faktur.php"
        </script>';
    }
    
};

// if(isset($_POST['daftarbarang'])){
//     $barangnya = $_POST['barangnya'];
//     $penerima = $_POST['penerima'];
//     $harga = $_POST['harga'];
//     $qty = $_POST['qty'];
   
//     $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
//     $ambildatanya = mysqli_fetch_array($cekstocksekarang);
//     $stocksekarang= $ambildatanya['stock'];
//     $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

//     $addtomasuk = mysqli_query($conn," INSERT INTO masuk (idbarang,penerima,harga) VALUES ('$barangnya','$penerima','$harga')");
//     $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
//     if($addtomasuk && $updatestokmasuk){
//         header('location:barangmasuk.php');
//     } else {
//         echo 'gagal';
//         header('location:index.php');
//     }
// }

//Menambah Barang keluar

if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
   
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    
    if($stocksekarang >= $qty){
        // Jika barangnya cukup untuk keluar
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;
        $addtokeluar = mysqli_query($conn," INSERT INTO keluar (idbarang,penerima,qty,status) VALUES ('$barangnya','$penerima','$qty','$status')");
        $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        if($addtokeluar && $updatestokmasuk){
            header('location: BARANGKELUARR.php');
        } else {
            echo 'gagal';
            header('location:indexx.php');
        }
    }else{
        // Jika barang tidak cukup untuk keluar
        echo'
        <script>
            alert("Sebentar barang stock tidak mencukupi silahkan check lagi yaa !");
            window.location.href = "BARANGKELUARR.php"; 
        </script>';
    }
};

// Update Info Barang

if(isset($_POST['updatebarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang =$_POST['namabarang'];
    $jenisbarang =$_POST['jenisbarang'];

    // Fungsi Menambah Gambar
    $allowed_extensions= array('png','jpg');
    $nama= $_FILES['file']['name']; //gambilnama gambar
    $dot = explode(".",$nama);
    $ekstensi = strtolower(end($dot)); //mengambil extensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp= $_FILES['file']['tmp_name']; //ngamil lokasi filenya
    // Penamaan file untuk di encryption
    $image = md5(uniqid($nama,true)). time().'.'.$ekstensi; //mengabungkan nama file yang di enyrip dnegna ekstensinya
    if($ukuran==0){
        // Jika tidak ingin upload
        $update = mysqli_query($conn,"UPDATE stock set namabarang='$namabarang',jenisbarang='$jenisbarang' WHERE idbarang='$idbarang'");
        if($update){
        header('location:indexx.php');
        } else {
            echo 'gagal';
            header('location:indexx.php');
        }
    }else{
        // Jika ingin Upload
        move_uploaded_file($file_tmp,'img/'.$image);
        $update = mysqli_query($conn,"UPDATE stock set namabarang='$namabarang',jenisbarang='$jenisbarang',gambar='$image' WHERE idbarang='$idbarang'");
        }if($update){
            header('location:indexx.php');
            } else {
                echo 'gagal';
                header('location:indexx.php');
            }
}

// Update Harga Barang

if(isset($_POST['updatehargabarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang =$_POST['namabarang'];
    $jenisbarang =$_POST['jenisbarang'];
    $hargabarang =$_POST['Harga'];
    $update = mysqli_query($conn,"UPDATE stock set namabarang='$namabarang',jenisbarang='$jenisbarang',Harga='$hargabarang' WHERE idbarang='$idbarang'");
    if($update){
        echo'<script>
        alert(" Selamat Harga barang Sudah ter-input!");
        window.location.href = "stockharga.php"
        </script>';
    } else {
        echo 'gagal';
        header('location:indexx.php');
    }
}

// Update Sales
if(isset($_POST['updatesales'])){
    $idsales = $_POST['idsales'];
    $nama =$_POST['nama'];
    $usaha =$_POST['perusahaan'];
    $kontak =$_POST['kontak'];

    $update = mysqli_query($conn,"UPDATE sales set nama='$nama',perusahaan='$usaha',kontak='$kontak' WHERE idsales='$idsales'");
    if($update){
        header('location:sales.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
}

// new Harga Barang
if(isset($_POST['hargabarang'])){
    $namabarang= $_POST['namabarang'];
    $jenisbarang= $_POST['jenisbarang'];
    $hargabarang = $_POST['Harga'];
    // $stock= $_POST['stock'];
    // $keterangan= $_POST['keterangan'];

    $addtotable = mysqli_query($conn,"INSERT INTO stock (namabarang,jenisbarang,harga) VALUES ('$namabarang','$jenisbarang','$harga')");
    if($addtotable){
       header('location :stockharga.php');
    }else{
        echo "Error";
        header('location:indexx.php');
    }
}
// Menghapus Barang stock gudang
if(isset($_POST['hapusbarang'])){
    $idbarang = $_POST['idbarang'];
    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idbarang'");
    $image = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idbarang'");
    $get   = mysqli_fetch_array($image);
    $img   = 'img/'.$get['gambar'];
    unlink($img);
    
    if($hapus){
        header('location:indexx.php');
    } else {
        echo 'gagal';
    }
}

// //Mengubah Data Barang Masuk
// if(isset($_POST['updatebarangmasuk']))
// {
//     $idbarang = $_POST ['idbarang'];
//     $idm = $_POST ['idmasuk'];
//     $namabarang = $_POST ['namabarang'];
//     $jenisbarang= $_POST ['jenisbarang'];
//     $keterangan= $_POST ['penerima'];
//     $qty = $_POST ['qty'];

//     $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idbarang'"); //lihat stock
//     $stocknya = mysqli_fetch_array($lihatstock);// ambil datanya
//     $stockskrg= $stocknya['stock']; //jumlah stock sekarang
    
//     $lihatdataskrg= mysqli_query($conn,"SELECT * FROM masuk WHERE idmasuk='$idm'");//lihat qty saat ini
//     $qtynya = mysqli_fetch_array($lihatdataskrg);
//     $qtyskrg = $qtynya['qty']; //jumlah sekarang

//     if($qty >= $qtyskrg){ 
//         //ternyata inputan baru lebih besar jumlah masuknya, maka tambahi lagi stock barang
//         $selisih= $qty - $qtyskrg;
//         $tambahinstocknya= $stockskrg + $selisih;
//         $updatenya = mysqli_query($conn, "UPDATE stock set stock='$tambahinstocknya' WHERE idbarang='$idbarang'");
//         $kurangistocknya = mysqli_query($conn,"UPDATE masuk set qty='$qty',penerima='$keterangan' WHERE idmasuk='$idm'");

//         // Check apak ini berhasil
//         if($kurangistocknya&&$updatenya){
//             header('location :barangmasuk.php');
//         }else{
//             echo 'gagal say';
//             header('location:indexx.php');
//         };

//     }else {
//         //ternyata inputan baru lebih kecil jumlah masuknya, maka kurangi lagi stock barang
//         $selisih = $qtyskrg-$qty;
//         $kurangin = $stockskrg - $selisih;
//         $kurangistocknya = mysqli_query($conn,"UPDATE stock set stock='$kurangistocknya' WHERE idbarang='$idbarang'");
//         $updatenya = mysqli_query($conn, "UPDATE masuk set qty='$qty', penerima='$keterangan' WHERE idmasuk='$idm'");

//         if($kurangistocknya&&$updatenya){
//             header(' location:barangmasuk.php');
//         }else{
//             echo 'gagal say';
//             header(' location:indexx.php');
//         };
//     };
// };


// Test Update barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idm = $_POST['idmasuk']; //iddata
    $idbarang = $_POST['idbarang']; //idbarang
    $qty = $_POST['qty'];
    $exp = $_POST['kadarluasa'];
    $keterangan = $_POST['penerima'];
    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn,"select * from masuk where idmasuk='$idm'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg

    if($qty >= $qtyskrg){
        //ternyata inputan baru lebih besar jumlah masuknya, maka tambahi lagi stock barang
        $hitungselisih = $qty-$qtyskrg;
        $tambahistock = $stockskrg+$hitungselisih;
        $queryx = mysqli_query($conn,"UPDATE stock set stock='$tambahistock' WHERE idbarang='$idbarang'");
        $updatedata1 = mysqli_query($conn,"UPDATE masuk set qty='$qty',penerima='$keterangan',kadarluasa='$exp' WHERE idmasuk='$idm'");
        //cek apakah berhasil
        if ($updatedata1 && $queryx){
            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= barangmasuk.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };

    } else {
        //ternyata inputan baru lebih kecil jumlah masuknya, maka kurangi lagi stock barang
        $hitungselisih = $qtyskrg-$qty;
        $kurangistock = $stockskrg-$hitungselisih;

        $query1 = mysqli_query($conn,"UPDATE stock set stock='$kurangistock' where idbarang='$idbarang'");

        $updatedata = mysqli_query($conn,"UPDATE masuk set  qty='$qty', penerima='$keterangan',kadarluasa='$exp' WHERE idmasuk='$idm'");
        
        //cek apakah berhasil
        if ($query1 && $updatedata){

            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= barangmasuk.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };

    };
    
};

// //Mengubah Data Barang keluar
// if(isset($_POST['updatebarangkeluar']))
// {
//     $idbarang = $_POST ['idbarang'];
//     $idk = $_POST ['idkeluar'];
//     $namabarang = $_POST ['namabarang'];
//     $jenisbarang= $_POST ['jenisbarang'];
//     $keterangan= $_POST ['penerima'];
//     $qty = $_POST ['qty'];
//     $info = $_POST ['keterangan'];
//     $idm = $_POST ['idmasuk'];

//     $lihatstock = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idbarang'"); //lihat stock
//     $stocknya = mysqli_fetch_array($lihatstock);// ambil datanya
//     $stockskrg=$stocknya['stock']; //jumlah stocknya sekarang
    
//     $qtyskrg= mysqli_query($conn,"SELECT * FROM keluar WHERE idkeluar='$idk'");//lihat qty saat ini
//     $qtynya = mysqli_fetch_array($qtyskrg);
//     $qtyskrg = $qtynya['qty']; //jumlah sekarang

//     if($qty>=$qtyskrg){ 
//         //ternyata inputan baru lebih besar jumlah masuknya, maka tambahi lagi stock barang
//         $selisih=$qty-$qtyskrg;
//         $kuranginstock= $stockskrg - $selisih;
//         $updatenya = mysqli_query($conn, "UPDATE stock set stock='$kuranginstock', penerima='$keterangan' WHERE idkeluar='$idk'");
//         $kurangistocknya = mysqli_query($conn,"UPDATE keluar set qty='$qty',penerima='$keterangan' WHERE idbarang='$idbarang'");

//         if($kurangistocknya&&$updatenya){
//             header('location :TEST.php');
//         }else{
//             echo 'gagal say';
//             header('location:indexx.php');
//         } 

//     }else {
//         //ternyata inputan baru lebih kecil jumlah keluarnya, maka tambahin lagi stock barang
//         $selisih = $qtyskrg-$qty;
//         $tambahinstock = $stockskrg + $selisih;
//         $kurangistocknya = mysqli_query($conn,"UPDATE stock set stock='$tambahinstock' WHERE idbarang='$idbarang'");
//         $updatenya = mysqli_query($conn, "UPDATE masuk set qty='$qty', penerima='$keterangan' WHERE idkeluar='$idk'");

//         if($kurangistocknya&&$updatenya){
//             header(' location:TEST.php');
//         }else{
//             echo 'gagal say';
//             header(' location:indexx.php');
//         }
//     }
// }


// TEST barang keluar


if(isset($_POST['updatebarangkeluar'])){
    $idk = $_POST['idkeluar']; //iddata
    $idbarang= $_POST['idbarang']; //idbarang
    $qty = $_POST['qty'];
    $keterangan = $_POST['penerima'];
    $status = $_POST['status'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn,"select * from keluar where idkeluar='$idk'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg

    if($qty >= $qtyskrg){
        //ternyata inputan baru lebih besar jumlah keluarnya, maka kurangi lagi stock barang
        $hitungselisih = $qty-$qtyskrg;
        $kurangistock = $stockskrg-$hitungselisih;

        $queryx = mysqli_query($conn,"update stock set stock='$kurangistock' where idbarang='$idbarang'");
        $updatedata1 = mysqli_query($conn,"update keluar set qty='$qty',penerima='$keterangan',status='$status' where idkeluar='$idk'");
        
        //cek apakah berhasil
        if ($updatedata1 && $queryx){

            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url=  BARANGKELUARR.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };

    } else {
        //ternyata inputan baru lebih kecil jumlah keluarnya, maka tambahi lagi stock barang
        $hitungselisih = $qtyskrg-$qty;
        $tambahistock = $stockskrg+$hitungselisih;

        $query1 = mysqli_query($conn,"update stock set stock='$tambahistock' where idbarang='$idbarang'");

        $updatedata = mysqli_query($conn,"update keluar set  qty='$qty', penerima='$keterangan',status='$status' where idkeluar='$idk'");
        
        //cek apakah berhasil
        if ($query1 && $updatedata){

            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url=  BARANGKELUARR.ph'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };

    };        
};

if(isset($_POST['hapusbarangkeluar'])){
    $idk = $_POST['idkeluar'];
    $idbarang = $_POST['idbarang'];

    $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn,"SELECT * FROM keluar WHERE idkeluar='$idk'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg

    $adjuststock = $stockskrg+$qtyskrg;

    $queryx = mysqli_query($conn,"UPDATE stock set stock='$adjuststock' WHERE idbarang='$idbarang'");
    $del = mysqli_query($conn,"DELETE FROM keluar WHERE idkeluar='$idk'");

    
    //cek apakah berhasil
    if ($queryx && $del){

        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= BARANGKELUARR.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= indexx.php'/> ";
        }
};

// Menghapus barang masuk 
if(isset($_POST['hapusbarangmasuk'])){
    $idbarang = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];

    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn,"select * from masuk where idmasuk='$idm'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg

    $adjuststock = $stockskrg-$qtyskrg;

    $queryx = mysqli_query($conn,"update stock set stock='$adjuststock' where idbarang='$idbarang'");
    $del = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    
    //cek apakah berhasil
    if ($queryx && $del){

        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= barangmasuk.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= indexx.php'/> ";
        }
};

// Req order Barang Barang Masuk

if(isset($_POST['req'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"INSERT INTO req (idbarang,penerima,qty) VALUES ('$barangnya','$penerima','$qty')");
    // die(mysqli_error($conn));
    if($cekreq){
        // berhasil
        header("Location:reqbarang.php");
    }else{
        header("Location:indexx.php");
    }
}

// Req Approval Barang 1
if(isset($_POST['approval'])){
    // $barangnya = $_POST['barangnya'];
    // $penerima = $_POST['penerima'];
    $idm = $_POST['idmasuk'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"UPDATE req SET status=1 WHERE  idmasuk='$idm'");
    // die(mysqli_error($conn));
    if($cekreq){    
        // berhasil
        echo'<script>
        alert(" Selamat Barang Sudah di approal, klick tombol ok untuk melanjutkan ");
        window.location.href = "stockharga.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}
// Req Approval Barang 2
if(isset($_POST['tolakbarang'])){
    // $barangnya = $_POST['barangnya'];
    // $penerima = $_POST['penerima'];
    $idm = $_POST['idmasuk'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"UPDATE req SET status=2  WHERE  idmasuk='$idm'");
    // die(mysqli_error($conn));
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert(" Status Barang ditolah, Silahkan klick tombol ok untuk melanjutkan ");
        window.location.href = "approval.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}

// Edit Sales
if(isset($_POST['updatesales'])){
    $nama = $_POST['nama'];
    $usaha = $_POST['perusahaan'];
    $kontak = $_POST['kontak'];
    $addtosales = mysqli_query($conn,"UPDATE sales set nama='$nama',perusahaan='$usaha',kontak='$kontak' WHERE idsales='$idsales'");
    if($addtosales)
    {
        // Berhasil
        echo'<script>
        alert("Data Barhasil Update");
        window.location.href = "sales.php"
        </script>';
    }else{
        echo'<script>
        alert("Data tidak terupdate");
        window.location.href = "indexx.php"
        </script>';
    }
}
// Delete Sales
// Menghapus Barang stock gudang
if(isset($_POST['hapusales'])){
    $nama = $_POST['nama'];
    $usaha = $_POST['perusahaan'];
    $kontak = $_POST['kontak'];
    $idsales = $_POST['idsales'];
    $hapus = mysqli_query($conn,"DELETE FROM sales WHERE idsales='$idsales'");
    // die(mysqli_error($conn));
    if($hapus){
      // Berhasil
      echo'<script>
      alert("Data Barhasil dihapus");
      window.location.href = "sales.php"
      </script>';
    } 
}
?>