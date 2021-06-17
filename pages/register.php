<?php
require '../db_conn.php';
ob_start();
session_start();
$message = '';
if (isset($_POST['register'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];
    $user_email = $_POST['user_email'];

    $kullanici_sor =  $db->prepare('SELECT * FROM user WHERE user_name = ? || user_email = ?');
    $kullanici_sor->execute([
        $user_name, $user_email
    ]);
    $say = $kullanici_sor->rowCount();


    if (!$user_name) {
        $message = "Lütfen bir kullanıcı adı giriniz.";
    } elseif (!$password || !$password_again) {
        $message = "Şifre alanı boş bırakılamaz.";
    } elseif ($password != $password_again) {
        $message = "Şifreleriniz birbiriyle eşleşmiyor.";
    } elseif ($say) {
        $message = "Bu email adresi veya kullanıcı adı daha önce kullanılmış. Lütfen farklı bir kullanıcı adı veya email adresi deneyiniz.";
    } else {
        $sec_pass = sha1($password);
        $sorgu = $db->prepare('INSERT INTO user SET user_name = ?, user_email = ? ,user_password = ?');
        $ekle = $sorgu->execute([
            $user_name, $user_email, $sec_pass
        ]);
        if ($ekle) {
            $kullanici_sor =  $db->prepare('SELECT * FROM user WHERE user_name = ? && user_password = ?');
            $kullanici_sor->execute([
                $user_name, $sec_pass
            ]);
            $say = $kullanici_sor->rowCount();
            if ($say) {
                $_SESSION['user_name'] = $user_name;
                $message = "Kayıt başarılı, otomatik giriş yaptırılıyorsunuz."; 
                header('Refresh:2, home.php');
            } else {
                $message = "bir hata oluştu dene yav";
            }
        } else {
            $message = "Bir sorunla karşılaştık. Lütfen daha sonra tekrar deneyiniz.";
        }
    }
}


if (isset($_POST['login'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $sec_pass = sha1($password);
    if (!$user_name) {
        $message = "Kullanıcı adı alanı boş bırakılamaz.";
    } elseif (!$password) {
        $message =  "Şifre alanı boş bırakılamaz.";
    } else {
        $kullanici_sor =  $db->prepare('SELECT * FROM user WHERE user_name = ? && user_password = ?');
        $kullanici_sor->execute([
            $user_name, $sec_pass
        ]);
        $say = $kullanici_sor->rowCount();

        if ($say) {
            $_SESSION['user_name'] = $user_name;
            $message = "Başarıyla giriş yapıldı. Anasayfaya yönlendiriliyorsunuz...";
            header('Refresh:2, ../pages/home.php');
        } else {
            $message = "Kullanıcı adı veya şifreniz hatalı. Doğru girdiğinzden emin olunuz.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EkmekTeknesi: Giriş Yap & Kaydol</title>
    <!-- TABS ICON -->
    <link rel="shortcut icon" href="../images/other/logo.png" type="image/x-icon" >


    <!-- CSS LINK-->
    <link rel="stylesheet" type="text/css" href="../styles/register.css">

</head>

<body>
    <?php if ($message) {
        echo "<script type='text/javascript'>alert('$message');</script>";
    } ?>

    <div class="hero">
        <div class="form-box">

                <div class="button-box">
                    <div class="" id="btn"></div>
                    <button style="font-size: 12px;" type="button" class="toggle-btn" onclick="login()">Giriş Yap</button>
                    <button style="font-size: 12px;" type="button" class="toggle-btn" onclick="register()">Kayıt Ol</button>
                </div>
                <div class="form-title">

                    <h2>Ekmek <b>Teknesi</b></h2>
                </div>


                <form id="login" action="register.php" class="input-group" method="POST">
                    <input type="text" class="input-field" placeholder="Kullanıcı Adı" autocomplete="off" required name="user_name">
                    <input type="password" class="input-field" placeholder="Şifre" autocomplete="off" required name="password">
                    <button type="submit" class="submit-btn-login" name="login">Giriş Yap</button>
                </form>

                <form id="register" action="register.php" class="input-group" method="POST">
                    <input type="text" class="input-field" placeholder="Kullanıcı Adı" autocomplete="off" required name="user_name">
                    <input type="email" class="input-field" placeholder="Mail Adresi" autocomplete="off" required name="user_email">
                    <input type="password" class="input-field" placeholder="Şifre" autocomplete="off" required name="password">
                    <input type="password" class="input-field" placeholder="Şifre Tekrar" autocomplete="off" required name="password_again">
                    <input type="checkbox" class="check-box" required><span>Kayıt sözleşmesini okudum,
                        onaylıyorum.</span>
                    <button type="submit" class="submit-btn" name="register">Kayıt Ol</button>

                </form>
        </div>


    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");


        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";

        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";

        }
    </script>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>