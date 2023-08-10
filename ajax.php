<?php 
require_once "function.php";
$selected = $_POST['idbarang'];
$tampil=mysqli_query($conn,"SELECT * FROM detail WHERE idproduk='$selected'");
$jml=mysqli_num_rows($tampil);
 
if($jml > 0){    
    while($r=mysqli_fetch_array($tampil)){
        ?>
        <option value="<?php echo $r['iddetail'] ?>"><?php echo $r['tanggalex'] ?></option>     
        <?php        
    }
    //   die(mysqli_error($conn));
}else{
    echo "<option selected>- Maaf Data Tidak Ada -</option>";
}
?>