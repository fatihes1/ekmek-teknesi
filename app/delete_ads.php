<?php
if (isset($_POST['id'])) {
    require '../db_conn.php';
    session_start();
    $id = $_POST['id']; // Html kod içerisindeki yer

    $user_name = $_SESSION['user_name'];
    $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
    $user_id =  $query['user_id'];
    $app_status = 1;
    if (empty($id)) {
        echo 0;
    } else {
        
        $sorgu = $db->prepare('DELETE FROM job WHERE job_id = ?');
        $sil = $sorgu->execute([
             $id
        
        ]);
        
        if ($sil) {
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
