<?php 
    require '../db_conn.php';
    ob_start();
    session_start();
    if(isset($_POST['register'])){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $password_again = $_POST['password_again'];
        $user_email = $_POST['user_email'];

        if(!$user_name){
            echo "";
        }elseif (!$password || !$password_again){
            echo "Lütfen şifrenizi giriniz !";
        } elseif ($password != $password_again){
            echo "Şifreler uyuşmuyor !";
        } else {
            $sec_pass = sha1($password);
            $sorgu = $db->prepare('INSERT INTO user SET user_name = ?, user_email = ? ,user_password = ?');
            $ekle = $sorgu->execute([
                $user_name, $user_email, $sec_pass
            ]);
            if($ekle){
                echo "Kayıt başarılı !";
                header('Refresh:2, ../index.php');
            } else {
                echo "Bir sorun oluştu anam !";
            }
        }
    }


    if(isset($_POST['login'])){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $sec_pass = sha1($password);
        if(!$user_name){
            echo "Kullanıcı adı gir yavrukuş";
        }elseif(!$password){
            echo "Şifreyi untmuşke sen :( ";
        } else {
            $kullanici_sor =  $db->prepare('SELECT * FROM user WHERE user_name = ? || user_password = ?');
            $kullanici_sor->execute([
                $user_name, $password
            ]);
            $say = $kullanici_sor->rowCount();

            if($say){
                $_SESSION['user_name'] = $user_name;
                echo "Giriş yaptınız anammmm";
                header('Refresh:2, ../index.php');
            } else {
                echo "bir hata oluştu dene yav";
            }


        }
    }
    ?>