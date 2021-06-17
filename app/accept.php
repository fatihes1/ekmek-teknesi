<?php
if (isset($_POST['id'])) {
    require '../db_conn.php';
    session_start();
    $id = $_POST['id']; // Html kod içerisindeki yer

    $user_name = $_SESSION['user_name'];
    $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
    $user_id =  $query['user_id'];
    $app_status = 2;
    if (empty($id)) {
        echo 0;
    } else {
        
        $sorgu = $db->prepare("UPDATE application SET app_status = ? WHERE app_id = '{$id}'");
        $ekle = $sorgu->execute([
            $app_status
        
        ]);
        
        if ($ekle) {
            $ads_sor =  $db->prepare('SELECT * FROM app WHERE app_id = ? AND app_status = ?');
            $ads_sor->execute([
                $id, $app_status
            ]);
            header('Location: ../pages/advertise.php');
            echo 1;
            header("Location: ../pages/home.php");
        } else {
            echo 0;
        }
        header("Location: ../pages/home.php");
    }
    
} else {
    header('Refresh:2, ../pages/applications.php');
    //header("Location: ../pages/home.php");
}

?>
