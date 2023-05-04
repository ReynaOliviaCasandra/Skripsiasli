<?php
session_start();
// Membuat koneksi database
// $conn = mysqli_connect("localhost:33013","root","","db_stockcosmetic");
$conn = mysqli_connect("localhost","coms2497_cosmetic","Rtx20601060","coms2497_db_stockcosmetic");
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
        header('location:login.php');
        
    }else{
        header('location:register.php');
    }
}
// Menambah Data Sales 
if(isset($_POST['buttonsales'])){
    $namasales = $_POST['sales'];
    $supplier = $_POST['distributor'];
    $contact = $_POST['kontak'];
    $salessekarang = mysqli_query($conn,"INSERT INTO supplier (nama,supplier,kontak)VALUES('$namasales','$supplier','$contact')");
    die(mysqli_error($conn));
    if($salessekarang){
        header('location:sales.php');
        
    }else{
        header('location:indexx.php');
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
    // $info = $_POST['keterangan'];
    $exp = $_POST['kadarluasa'];
  
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"INSERT INTO masuk (idbarang,kadarluasa,penerima,qty) VALUES ('$barangnya','$exp','$penerima','$qty')");
    $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtomasuk && $updatestokmasuk){
        // die(mysqli_error($conn));
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
            header('location:faktur.php');
        } else {
            echo 'gagal';
            header('location:indexx.php');
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
        window.location.href = "Sales.php"
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
    $cekstocksekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$barangnya'"); 
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang= $ambildatanya['stock'];
    if($stocksekarang >= $qty){
        // Jika barangnya cukup untuk keluar
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;
        $addtokeluar = mysqli_query($conn," INSERT INTO retur (idbarang,qty,status,penerima) VALUES ('$barangnya','$qty','$status','$keterangan')");
        $updatestokmasuk = mysqli_query($conn," UPDATE stock set stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        die(mysqli_error($conn));
        if($addtokeluar && $updatestokmasuk){
            header('location: retur.php');
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

// Update barang masuk
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

// Update Barang Req
if(isset($_POST['updatebarangreq'])){
    $idrq = $_POST['idreq']; //iddata
    $idbarang = $_POST['idbarang']; //idbarang
    $qty = $_POST['qty'];
    $exp = $_POST['kadarluasa'];
    $keterangan = $_POST['penerima'];
    $lihatstock = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg


}
// Update barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idk = $_POST['idkeluar']; //iddata
    $idbarang= $_POST['idbarang']; //idbarang
    $qty = $_POST['qty'];
    $keterangan = $_POST['penerima'];
    $status = $_POST['status'];

    $lihatstock = mysqli_query($conn,"SELECT * from stock where idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

    $lihatdataskrg = mysqli_query($conn,"SELECT * from keluar where idkeluar='$idk'"); //lihat qty saat ini
    $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
    $qtyskrg = $preqtyskrg['qty'];//jumlah skrg

    if($qty >= $qtyskrg){
        //ternyata inputan baru lebih besar jumlah keluarnya, maka kurangi lagi stock barang
        $hitungselisih = $qty-$qtyskrg;
        $kurangistock = $stockskrg-$hitungselisih;

        $queryx = mysqli_query($conn,"UPDATE stock set stock='$kurangistock' where idbarang='$idbarang'");
        $updatedata1 = mysqli_query($conn,"UPDATE keluar set qty='$qty',penerima='$keterangan',status='$status' where idkeluar='$idk'");
        
        //cek apakah berhasil
        if ($updatedata1 && $queryx){

            echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url=  barangkeluarr.php'/>  ";
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
        <meta http-equiv='refresh' content='1; url= barangkeluarr.php'/>  ";
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

// Menghapus barang req
if(isset($_POST['hapusbarangreq'])){
    $idbarang = $_POST['idbarang'];
    $idrq = $_POST['idreq'];
    $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idbarang'"); //lihat stock barang itu saat ini
    $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
    $stockskrg = $stocknya['stock'];//jumlah stocknya skrg
    $del = mysqli_query($conn,"DELETE FROM req WHERE idreq='$idrq'");
    die(mysqli_error($conn));
    //cek apakah berhasil
    if ($queryx && $del){
        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= reqbarang.php'/>  ";
        } else { echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= indexx.php'/> ";
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
    die(mysqli_error($conn));
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
        window.location.href = "BARANGKELUARR.php"
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
    die(mysqli_error($conn));
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
    $hasilrupiah = "Rp". number_format($angka,2,',','.');
    return $hasilrupiah;
}
?>