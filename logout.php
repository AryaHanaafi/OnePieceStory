<?php
session_start();
session_destroy();  // Hancurkan semua session
header("Location: login.php");  // Arahkan kembali ke halaman login
exit();
?>