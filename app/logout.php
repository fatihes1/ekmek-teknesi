<?php
    session_start();
    session_destroy();
    echo "Çıkış işlemi yapılıyor. Birazdan yönlendirileceksiniz.";
    header('Location: ../index.php');
?>