<?php
session_start();
session_unset();
session_destroy();
echo'<script>
alert("SELAMAT TINGGAL");
window.location.href = "login.php"
</script>';
// header('location:login.php');
?>