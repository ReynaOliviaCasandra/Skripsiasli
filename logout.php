<?php
session_start();
session_unset();
session_destroy();
echo'<script>
alert("Sesi Kamu telah ber-akhir silahkan login kembali");
window.location.href = "login.php"
</script>';
// header('location:login.php');
?>