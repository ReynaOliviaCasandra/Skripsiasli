<?php
session_start();
// Membuat koneksi database
$conn = mysqli_connect("localhost:3308","root","","db_stockcosmetic");
// $conn = mysqli_connect("localhost","coms2497_cosmetic","Rtx20601060","coms2497_db_stockcosmetic");
// Registrasi akun pengguna
if(isset($_POST['registrasi'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    // Cocokan dengan database, cari data
    $cekdatabase = mysqli_query($conn,"INSERT INTO login (username,email,password,role) VALUES ('$username','$email','$password','$role')");
    // Hitung jumlah data
    if($cekdatabase){
        // header('location:login.php');
        echo" <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= login.php'/>  ";
                ;
        
    }else{
        echo" <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= register.php'/>  ";
                ;
    }
}
// Menambah Data Sales 
if(isset($_POST['buttonsales'])){
    $namasales = $_POST['sales'];
    $supplier = $_POST['distributor'];
    $contact = $_POST['kontak'];
    $salessekarang = mysqli_query($conn,"INSERT INTO supplier (nama,supplier,kontak)VALUES('$namasales','$supplier','$contact')");
    // die(mysqli_error($conn));
    if($salessekarang){
        echo'<script>   
        alert("Sukses Memasukan Data !");
        window.location.href = "sales.php"
        </script>';
        
    }else{
        echo'<script>   
        alert("Data tidak berhasil !");
        window.location.href = "sales.php"
        </script>';
    }
}
// Barang Masuk ke Gudang
if(isset($_POST['addnewbarang'])){
    $namabarang= $_POST['namabarang'];
    $jenisbarang= $_POST['jenisbarang'];
    // $stock= $_POST['stock'];
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
                $addtotable = mysqli_query($conn,"INSERT INTO stock (namabarang,jenisbarang,gambar) VALUES ('$namabarang','$jenisbarang','$image')");
            if($addtotable){
                echo" <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= indexx.php'/>  ";
                ;
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
    $fakturnya = $_POST['fakturnya'];
    // $info = $_POST['keterangan'];
  
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;
    $addtomasuk = mysqli_query($conn,"INSERT INTO masuk (idbarang,penerima,qty,idfaktur) VALUES ('$barangnya','$penerima','$qty','$fakturnya')");
   
    $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtomasuk && $updatestokmasuk){
        echo'<script>   
        alert("Sukses Memasukan Barang !");
        window.location.href = "barangmasuk.php"
        </script>';
    } else {
        echo'<script>   
        alert(" Data tidak masuk !");
        window.location.href = "indexx.php"
        </script>';
    }
}

// Test
// if(isset($_POST['barangmasuk'])){
//     $barangnya = $_POST['barangnya'];
//     $penerima = $_POST['penerima'];
//     $qty = $_POST['qty'];
//     $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
//     $ambildatanya = mysqli_fetch_array($cekstocksekarang);
//     $stocksekarang = $ambildatanya['stock'];
//     $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;
    
//     if( $qty>=$stocksekarang ) {
//         $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang,penerima, qty) VALUES ('$barangnya','$penerima', '$qty')");
//         $updatestokmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        
//         if($addtomasuk && $updatestokmasuk){
//             // die(mysqli_error($conn));
//             echo'<script>
//             alert("Sukses Memasukan Barang !");
//             window.location.href = "barangmasuk.php";
//             </script>';
//         } else {
//             echo 'gagal';
//             header('location:indexx.php');
//         }
//     } else {
//         // Jika barang tidak cukup untuk keluar
//         echo '<script>
//         alert("Sebentar barang tidak boleh minus!");
//         window.location.href = "barangmasuk.php";
//         </script>';
//     }
// }


// Menambah faktur
if(isset($_POST['faktur'])){
    $fakturnya = $_POST['fakturnya'];
    $cekfaktur = mysqli_query($conn,"SELECT * FROM supplier WHERE idsupplier='$fakturnya'"); 
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
                // die(mysqli_error($conn));
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
// Hapus Faktur
if(isset($_POST['hapusfaktur'])){
    $idfaktur = $_POST['idfaktur'];
    $lihatstock = mysqli_query($conn,"SELECT * FROM faktur WHERE idfaktur='$idfaktur'");
    $del = mysqli_query($conn,"DELETE FROM faktur WHERE idfaktur='$idfaktur'");
    // die(mysqli_error($conn));
    //cek apakah berhasil
    if ($del){
        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= faktur.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= indexx.php'/> ";
        }
};
// Edit Faktur
if(isset($_POST['updatefaktur'])){
    $idfaktur = $_POST['idfaktur'];
    $fakturnya = $_POST['faktur'];
    $img   = 'img/'.$get['gambar'];
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
        $update = mysqli_query($conn,"UPDATE faktur set supplier='$fakturnya',gambar='$image' WHERE idfaktur='$idfaktur'");
        if($update){
        echo'<script>   
        alert("Sukses Memasukan Data !");
        window.location.href = "faktur.php"
        </script>';
        } else {
            echo'<script>   
            alert("Data tidak berhasil !");
            window.location.href = "indexx.php"
            </script>';
        }
    }else{
        // Jika ingin Upload
        move_uploaded_file($file_tmp,'img/'.$image);
        $update = mysqli_query($conn,"UPDATE faktur set  supplier='$fakturnya',gambar='$image' WHERE idfaktur='$idfaktur'");
    }if($update){
        //  die(mysqli_error($conn));
        header('location:faktur.php');
    } else {
        echo 'gagal';
        header('location:indexx.php');
    }
   
}

//Menambah Barang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    // $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    if($stocksekarang >= $qty){
        // Jika barangnya cukup untuk keluar
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;
        $addtokeluar = mysqli_query($conn," INSERT INTO keluar (idbarang,qty) VALUES ('$barangnya','$qty')");
        $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        // die(mysqli_error($conn));
        if($addtokeluar && $updatestokmasuk){
            // header('location: BARANGKELUARR.php');
            echo'
            <script>
                alert(" Selamat Barang Sudah keluar, Silahkan lakukan Aksi selanjutnya !");
                window.location.href = "barangkeluarr.php"; 
            </script>';
        } else {
            echo 'gagal';
            header('location:indexx.php');
        }
    }else{
        // Jika barang tidak cukup untuk keluar
        echo'
        <script>
            alert("Sebentar barang stock tidak mencukupi silahkan check lagi yaa !");
            window.location.href = "barangkeluarr.php"; 
        </script>';
    }
};

// Update Info  Stock Barang
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
// if(isset($_POST['updatehargabarang'])){
//     $idbarang = $_POST['idbarang'];
//     $namabarang =$_POST['namabarang'];
//     $jenisbarang =$_POST['jenisbarang'];
//     $hargabarang =$_POST['Harga'];
//     $update = mysqli_query($conn,"UPDATE stock set namabarang='$namabarang',jenisbarang='$jenisbarang',Harga='$hargabarang' WHERE idbarang='$idbarang'");
//     if($update<0){
//         echo'<script>
//         alert(" Selamat Harga barang Sudah ter-input!");
//         window.location.href = "stockharga.php"
//         </script>';
//     } else {
//         echo 'gagal';
//         header('location:indexx.php');
//     }
// }
// test
if(isset($_POST['updatehargabarang'])){
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $jenisbarang = $_POST['jenisbarang'];
    $hargabarang = $_POST['Harga'];

    // Validasi harga tidak boleh minus
    if($hargabarang < 0) {
        echo '<script>
            alert("Harga barang tidak boleh minus!");
            window.location.href = "stockharga.php";
        </script>';
        exit; // Hentikan eksekusi lebih lanjut jika harga minus
    }
    $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', jenisbarang='$jenisbarang', Harga='$hargabarang' WHERE idbarang='$idbarang'");
    if($update){
        echo '<script>
            alert("Harga barang berhasil diperbarui!");
            window.location.href = "stockharga.php";
        </script>';
    } else {
        echo 'gagal';
        header('location:indexx.php');
    }
}


// Update Sales atau supplier
if(isset($_POST['updatesales'])){
    $idsales = $_POST['idsupplier'];
    $nama =$_POST['nama'];
    $usaha =$_POST['supplier'];
    $kontak =$_POST['kontak'];
    $update = mysqli_query($conn,"UPDATE supplier set nama='$nama',supplier='$usaha',kontak='$kontak' WHERE idsupplier='$idsales'");
    // die(mysqli_error($conn));
    if($update){
        // header('location:sales.php');
        echo'<script>
        alert(" Selamat Data Sudah terupdate!");
        window.location.href = "sales.php"
        </script>';
    } else {
        echo 'gagal';
        header('location:indexx.php');
    }
}
// Barang Retur
//Menambah Barang Retur
if(isset($_POST['barangretur'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['penerima'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $fakturnya =$_POST['fakturnya'];
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    if($stocksekarang >= $qty){
        // Jika barangnya cukup untuk keluar
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;
        $addtokeluar = mysqli_query($conn," INSERT INTO retur (idbarang,idfaktur,qty,status,penerima) VALUES ('$barangnya','$fakturnya','$qty','$status','$keterangan')");
        $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        // die(mysqli_error($conn));
        if($addtokeluar && $updatestokmasuk){
        echo'<script>   
        alert("Sukses Memasukan Data !");
        window.location.href = "retur.php"
        </script>';
        } else {
            echo 'gagal';
            header('location:indexx.php');
        }
    }else{
        // Jika barang tidak cukup untuk keluar
        echo'
        <script>
            alert("Sebentar barang stock tidak mencukupi silahkan check lagi yaa !");
            window.location.href = "retur.php"; 
        </script>';
    }
};
// new Harga Barang
if(isset($_POST['hargabarang'])){
    $namabarang= $_POST['namabarang'];
    $jenisbarang= $_POST['jenisbarang'];
    $hargabarang = $_POST['Harga'];
    // $stock= $_POST['stock'];
    // $keterangan= $_POST['keterangan'];
    
    $addtotable = mysqli_query($conn,"INSERT INTO stock (namabarang,jenisbarang,harga) VALUES ('$namabarang','$jenisbarang','$harga')");
    if($addtotable){
        echo'<script>   
        alert("Sukses Memasukan Data !");
        window.location.href = "stockharga.php"
        </script>';
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

// Update barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idm = $_POST['idmasuk']; //iddatamasuk (PK)
    $idbarang = $_POST['idbarang']; //idbarang
    // $fakturnya = $_POST['fakturnya'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['penerima'];
    $lihatstock = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn,"SELECT * from masuk where idmasuk='$idm'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg
    
    //ternyata inputan baru lebih besar jumlah masuknya, maka tambahi lagi stock barang
    $updatestock=($stockskrg-$qtyskrg)+$qty;
    $queryx = mysqli_query($conn,"UPDATE stock set stock='$updatestock' WHERE idbarang='$idbarang'");
    $updatedata1 = mysqli_query($conn,"UPDATE masuk set qty='$qty',penerima='$keterangan' WHERE idmasuk='$idm'");
        //cek apakah berhasil
        if ($updatedata1 && $queryx){
            die(mysqli_error($conn));
            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Selamat Barang Sudah Masuk in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= barangmasuk.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };
}

if(isset($_POST['updatebarangreq'])){
    $idrq = $_POST['idreq']; // iddreq
    $idbarang = $_POST['idbarang']; // idbarang
    $qty = $_POST['qty'];

    $updateReq = mysqli_query($conn, "UPDATE req SET qty='$qty' WHERE idreq='$idrq'");
    if($updateReq){
        // Berhasil
        echo '<script>
            alert("Data berhasil diupdate");
            window.location.href = "reqbarang.php";
        </script>';
    } else {
        echo '<script>
            alert("Data tidak terupdate");
            window.location.href = "indexx.php";
        </script>';
    }
}

// Update barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idk = $_POST['idkeluar']; //idkeluar
    $idbarang= $_POST['idbarang']; //idbarang
    $qty = $_POST['qty'];
    // $keterangan = $_POST['penerima'];
    // $status = $_POST['status'];

    $lihatstock = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil data stock gudang
    $stockskrg = $stocknya['stock'];//jumlah stocknya sebelumnya digudang 

    $lihatdataskrg = mysqli_query($conn,"SELECT * from keluar where idkeluar='$idk'"); //lihat qty keluar saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah qty keluar sekarang

    $tambahstock = $stockskrg+$qtyskrg; //stock akhir halaman stock gudang  + qty yang lama di halaman keluar
    $updatestocklama = mysqli_query($conn,"UPDATE stock set stock='$tambahstock' where idbarang='$idbarang'"); // Update ke halaman stock gudang
    $lihatstocksebelumkeluar= mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat digudang
    $stocksebelumkeluar = mysqli_fetch_array($lihatstocksebelumkeluar); //ambil datanya
    $stockkeluar = $stocksebelumkeluar['stock'];//jumlah yang salah digudang

    if($stockkeluar >= $qty){ //stocknya yang lama lebih besar dari qty yang baru di input
        $updatestock=($stockskrg+$qtyskrg)-$qty;
        $queryx = mysqli_query($conn,"UPDATE stock set stock='$updatestock' where idbarang='$idbarang'");
        $updatedata1 = mysqli_query($conn,"UPDATE keluar set qty='$qty' where idkeluar='$idk'");
        //cek apakah berhasil
        // die(mysqli_error($conn));
        if ($updatedata1 && $queryx){
            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url=  'barangkeluarr.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };
    } else {
        // erorr jika barang melebihi di stock barang
        $lihatstockgagal = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang gudang + qty lama
        $stocknyaa = mysqli_fetch_array($lihatstockgagal); //ambil datanya
        $stocksaatini = $stocknyaa['stock'];//jumlah stocknya sebelumnya digudang + qty barang lama
        $tambahstocknya = $stocksaatini-$qtyskrg; //keluarin stock barang salah ke gudang
        $updatestocksebelumnya = mysqli_query($conn,"UPDATE stock set stock='$tambahstocknya' where idbarang='$idbarang'");        
        echo'<script>
        alert("Jumlah tidak mencukupi");
        window.location.href = "barangkeluarr.php"
        </script>';
    };
};
// Update barang retur
if(isset($_POST['updatebarangretur'])){
    $idr = $_POST['idretur']; //idretur
    $idbarang= $_POST['idbarang']; //idbarang
    $qty = $_POST['qty'];
    // $keterangan = $_POST['penerima'];
    // $status = $_POST['status'];

    $lihatstock = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil data stock gudang
    $stockskrg = $stocknya['stock'];//jumlah stocknya sebelumnya digudang 

    $lihatdataskrg = mysqli_query($conn,"SELECT * from retur where idretur='$idr'"); //lihat qty keluar saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah qty keluar sekarang

    $tambahstock = $stockskrg+$qtyskrg; //stock akhir halaman stock gudang  + qty yang lama di halaman keluar
    $updatestocklama = mysqli_query($conn,"UPDATE stock set stock='$tambahstock' where idbarang='$idbarang'"); // Update ke halaman stock gudang
    $lihatstocksebelumkeluar= mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat digudang
    $stocksebelumkeluar = mysqli_fetch_array($lihatstocksebelumkeluar); //ambil datanya
    $stockkeluar = $stocksebelumkeluar['stock'];//jumlah yang salah digudang

    if($stockkeluar >= $qty){ //stocknya yang lama lebih besar dari qty yang baru di input
        $updatestock=($stockskrg+$qtyskrg)-$qty;
        $queryx = mysqli_query($conn,"UPDATE stock set stock='$updatestock' where idbarang='$idbarang'");
        $updatedata1 = mysqli_query($conn,"UPDATE retur set qty='$qty' where idretur='$idr'");
        //cek apakah berhasil
        // die(mysqli_error($conn));
        if ($updatedata1 && $queryx){
            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url=  'retur.php'/>  ";
            } else { echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= indexx.php'/> ";
            };
    } else {
        // erorr jika barang melebihi di stock barang
        $lihatstockgagal = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang gudang + qty lama
        $stocknyaa = mysqli_fetch_array($lihatstockgagal); //ambil datanya
        $stocksaatini = $stocknyaa['stock'];//jumlah stocknya sebelumnya digudang + qty barang lama
        $tambahstocknya = $stocksaatini-$qtyskrg; //keluarin stock barang salah ke gudang
        $updatestocksebelumnya = mysqli_query($conn,"UPDATE stock set stock='$tambahstocknya' where idbarang='$idbarang'");        
        echo'<script>
        alert("Jumlah tidak mencukupi");
        window.location.href = "retur.php"
        </script>';
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
        <meta http-equiv='refresh' content='1; url= 'barangkeluarr.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= 'indexx.php'/> ";
        }
};

// Menghapus barang masuk 
if(isset($_POST['hapusbarangmasuk'])){
    $idbarang = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg
    $lihatdataskrg = mysqli_query($conn,"SELECT * FROM masuk WHERE idmasuk='$idm'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg
    $adjuststock = $stockskrg-$qtyskrg;
    $queryx = mysqli_query($conn,"UPDATE stock SET stock='$adjuststock' WHERE idbarang='$idbarang'");
    $del = mysqli_query($conn,"DELETE FROM masuk WHERE idmasuk='$idm'");
    //cek apakah berhasil
    if ($queryx && $del){
        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= 'barangmasuk.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= 'indexx.php'/> ";
        }
};
// Req order Barang Barang Masuk
if(isset($_POST['req'])){
    $barangnya = $_POST['barangnya'];
    // $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"INSERT INTO req (idbarang,qty) VALUES ('$barangnya','$qty')");
    // die(mysqli_error($conn));
    if($cekreq){
        // berhasil
        echo'<script>   
        alert(" Request Barang  telah Berhasil!");
        window.location.href = "reqbarang.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}

// Menghapus barang req
if(isset($_POST['hapusbarangreq'])){
    $idbarang = $_POST['idbarang'];
    $idrq = $_POST['idreq'];
    $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg
    $del = mysqli_query($conn,"DELETE FROM req WHERE idreq='$idrq'");
    // die(mysqli_error($conn));
    //cek apakah berhasil
    if ($queryx && $del){
        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= 'reqbarang.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= 'indexx.php'/> ";
        }
};

// Req Approval Barang 1
if(isset($_POST['approval'])){
    $idrq = $_POST['idreq'];
    $cekreq = mysqli_query($conn,"UPDATE req SET status=1 WHERE  idreq='$idrq'");
    // die(mysqli_error($conn));
    if($cekreq){    
        // berhasil
        echo'<script>
        alert(" Selamat Barang Sudah di approal, klick tombol ok untuk melanjutkan ");
        window.location.href = "approval.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}
// Req Approval Barang 2
if(isset($_POST['tolakbarang'])){
    // $barangnya = $_POST['barangnya'];
    // $penerima = $_POST['penerima'];
    $idrq = $_POST['idreq'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"UPDATE req SET status=2  WHERE  idreq='$idrq'");
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

if(isset($_POST['matikanrole'])){
    $iduser = $_POST['iduser'];
    $status = $_POST['status'];
    $role = $_POST['role'];
    $cekreq = mysqli_query($conn,"UPDATE login SET status=2  WHERE  iduser='$iduser'");
    die(mysqli_error($conn));
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert(" Status sudah berhasil, Silahkan klick tombol ok untuk melanjutkan ");
        window.location.href = "user.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}


if(isset($_POST['aktifrole'])){
    $iduser = $_POST['iduser'];
    $status = $_POST['status'];
    $role = $_POST['role'];
    $cekreq = mysqli_query($conn,"UPDATE login SET status=1  WHERE  iduser='$iduser'");
    die(mysqli_error($conn));
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert(" Status sudah berhasil, Silahkan klick tombol ok untuk melanjutkan ");
        window.location.href = "user.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}

// Proses barang sedang dikirim
if(isset($_POST['accbarangkeluar'])){
    // $barangnya = $_POST['barangnya'];
    // $penerima = $_POST['penerima'];
    $idk = $_POST['idkeluar'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"UPDATE keluar SET statusbarang=1 WHERE  idkeluar='$idk'");
    // die(mysqli_error($conn));
    if($cekreq){    
        // berhasil
        echo'<script>
        alert(" Barang Sedang Dikirim, klick tombol ok untuk melanjutkan ");
        window.location.href = "barangkeluarr.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}

// Proses barang sedang dikirim ke sales atau supplier
if(isset($_POST['kirimkesales'])){
    $idr = $_POST['idretur'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"UPDATE retur SET statusbarang=1 WHERE  idretur='$idr'");
    // die(mysqli_error($conn));
    if($cekreq){    
        // berhasil
        echo'<script>
        alert(" Barang Sedang Dikirim ke supplier, klick tombol ok untuk melanjutkan ");
        window.location.href = "retur.php"
        </script>';
    }else{
        header("Location:indexx.php");
    }
}
// Proses barang Sudah diterima 2
if(isset($_POST['barangditerima'])){
    $idk = $_POST['idkeluar'];
    // $qty = $_POST['qty'];
    $cekreq = mysqli_query($conn,"UPDATE keluar SET statusbarang=2  WHERE  idkeluar='$idk'");
    // die(mysqli_error($conn));
    if($cekreq){
        // berhasil
        // header("Location:approval.php");
        echo'<script>
        alert(" Barang Sudah Diterima Oleh toko, Silahkan klick tombol ok untuk melanjutkan ");
        window.location.href = "barangkeluarr.php"
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
if(isset($_POST['hapusales'])){
    $nama = $_POST['nama'];
    $usaha = $_POST['supplier'];
    $kontak = $_POST['kontak'];
    $idsales = $_POST['idsupplier'];
    // die(mysqli_error($conn));
    $hapus = mysqli_query($conn,"DELETE FROM supplier WHERE idsupplier='$idsales'");
    // die(mysqli_error($conn));
    if($hapus){
      // Berhasil
      echo'<script>
      alert("Data Barhasil dihapus");
      window.location.href = "sales.php"
      </script>';
    } 
}

function rupiah($angka)
{
    $hasilrupiah = "Rp". number_format($angka,3,',','.');
    return $hasilrupiah;
}

// Update User
if(isset($_POST['updateuser'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $iduser = $_POST['iduser'];
    $addtouser = mysqli_query($conn,"UPDATE login set username='$username',email='$email',password='$password',role='$role' WHERE iduser='$iduser'");
    // die(mysqli_error($conn));
    if($addtouser)
    {
        // Berhasil
        echo'<script>
        alert("Data Barhasil Update");
        window.location.href = "user.php"
        </script>';
    }else{
        echo'<script>
        alert("Data tidak terupdate");
        window.location.href = "indexx.php"
        </script>';
    }
}
// Delete User
if(isset($_POST['hapususer'])){
    $username = $_POST['username'];
    $role = $_POST['role'];
    $iduser = $_POST['iduser'];
    if($role ==='owner'){
        // Tampilkan pesan error jika pengguna adalah owner
        echo '<script>
        alert("Anda tidak diizinkan menghapus pengguna ini");
        window.location.href = "user.php";
        </script>';
        exit; // Menghentikan eksekusi lebih lanjut jika pengguna adalah owner
    }
    $hapususer = mysqli_query($conn,"DELETE FROM login WHERE iduser='$iduser'");
    // die(mysqli_error($conn));
    if($hapususer){
      // Berhasil
      echo'<script>
      alert("Data Barhasil dihapus");
      window.location.href = "user.php"
      </script>';
    }else{
        echo'<script>
        alert("Kamu tidak berhak hapus !!!");
        window.location.href = "user.php"
        </script>';
    }
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function forgot($data){
    global $conn;
    $email =htmlspecialchars($data["email"]);
    //$query= mysqli_query($conn,"SELECT iduser FROM login WHERE email='$email'");
    $result = mysqli_query($conn,"SELECT iduser FROM login WHERE email='$email'");
    if($result)
    {
        // die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);
        $id= $row["iduser"];

        //date exp
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);

        //token
        $key = md5(2418*2+(int)$email);
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $key = $key . $addKey;

        // Insert Temp Table
        $query = "INSERT INTO restart_token
                        VALUES 
                        ('', '$id', '$key', '$expDate')
                    ";
        mysqli_query($conn, $query);
        $output='<p>Dear user,</p>';
        $output.='<p>Please click on the following link to reset your password.</p>';
        $output.='<p>-------------------------------------------------------------</p>';
        // Buat halaman lupa password
        $output.='<p><a href="localhost/stockbarang-template/reset.php?key='.$key.'&id='.$id.'&action=reset" target="_blank">
        https://localhost/stockbarang-template/reset.php?key='.$key.'&id='.$id.'&action=reset</a></p>';
         // Buat halaman lupa password
        $output.='<p>-------------------------------------------------------------</p>';
        $output.='<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 day for security reason.</p>';
        $output.='<p>If you did not request this forgotten password email, no action 
        is needed, your password will not be reset. However, you may want to log into 
        your account and change your security password as someone may have guessed it.</p>';
        $output.='<p>Thanks,</p>';
        $output.='<p>LocalHost Team</p>';
        $body = $output; 
        $subject = "Password Recovery - LocalHost";

        //Load Composer's autoloader
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try 
        {
            //$fromserver = "noreply@localhost.com"; 
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = "smtp.mail.yahoo.com"; // Enter your host here
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = "pertusrafael@yahoo.com"; // Enter your email here
            $mail->Password = "llrtlkoibmdwpaqk"; //Enter your password here
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            $mail->setFrom('pertusrafael@yahoo.com', 'LocalHost');
            $mail->addAddress($email);
            //$mail->Sender = $fromserver; // indicates ReturnPath header

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            if(!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
                return false;
            }
            else
            {
                echo "<script> 
                        alert('Tolong verify email anda yang kami telah kirim!');
                        document.location.href = 'login.php';
                        </script>";
            }
        } 
        catch (Exception $e) 
        {
            echo "<script> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
            return false;
        }
    }
}

function change_password($data)
    {
        global $conn;

        $n_password = mysqli_real_escape_string($conn, $data["new_password"]);
        $r_password = mysqli_real_escape_string($conn, $data["confirm_password"]);

        if($data["email"]!="")
        {
            $id = htmlspecialchars($data["email"]);

            if($n_password == $r_password)
            {
                // enkripsi password
                //$n_password = password_hash($n_password, PASSWORD_DEFAULT);

                //$query insert data
                $query = "UPDATE login SET
                    password = '$n_password'
                    WHERE iduser = '$id'
                ";
                mysqli_query($conn, $query);
                mysqli_query($conn,"DELETE FROM restart_token WHERE email='$id'");
                
                return mysqli_affected_rows($conn);
            }
            else
            {
                echo "<script> alert('Password Tidak Sama!')</script>";
                return false;
            }
        }
        else
        {
            $username = $_SESSION["username"];
            // ambil data dari tial elemen dalam form
            $password = mysqli_real_escape_string($conn, $data["password"]);
            //cek username sudah ada atau belum
            $result = mysqli_query($conn, "SELECT PASSWORD FROM login WHERE username = '$username'");
            $row = mysqli_fetch_assoc($result);
            $o_password = $row["password"];

            if(password_verify($password, $o_password))
            {
                if(password_verify($password, $o_password))
                {
                    echo "<script> alert('Password Sudah Dipakai!')</script>";
                    return false;   
                }
                else
                {
                    if($password == $r_password)
                    {
                        // enkripsi password
                        // $password = password_hash($password, PASSWORD_DEFAULT);

                        //$query insert data
                        $query = "UPDATE login SET
                            password = '$password'
                            WHERE username = '$username'
                        ";
                        mysqli_query($conn, $query);

                        
                        return mysqli_affected_rows($conn);
                    }
                    else
                    {
                        echo "<script> alert('Password Tidak Sama!')</script>";
                        return false;
                    }
                }
            }
            else
            {
                echo "<script> alert('Password Salah!')</script>";
                return false;
            }

        }
    }
?>