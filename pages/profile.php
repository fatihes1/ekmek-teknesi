<?php require '../db_conn.php' ?>
<?php
// ! BURASI DOĞRU

ob_start();
session_start();
$message = "";
if (empty($_SESSION['user_name'])) {
    header('Location: ../index.php');
    exit();
}
if (isset($_POST['edit_user'])) {
    $user_name = $_SESSION['user_name'];
    $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
    $user_password = $query['user_password'];
    $user_id =  $query['user_id'];

    $current_password = $_POST['current_password'];
    $current_password_sec = sha1($current_password);
    $new_password = $_POST['new_password'];
    $password_again = $_POST['password_again'];
    $new_password_sec = sha1($new_password);

    if ($current_password_sec != $user_password) {
        $message = "Mevcut şifrenizi hatalı girdiniz.";
    } elseif (!$new_password || !$password_again) {
        $message = "Şifre alanı boş bırakılamaz.";
    } elseif ($new_password != $password_again) {
        $message = "Yeni şifreler eşleşmiyor.";
    } else {

        $sorgu = $db->prepare("UPDATE user SET user_password = ? WHERE user_id = '{$user_id}'");
        $ekle = $sorgu->execute([
            $new_password_sec
        ]);
        if ($ekle) {
            $kullanici_sor =  $db->prepare('SELECT * FROM user WHERE user_name = ? && user_password = ?');
            $kullanici_sor->execute([
                $user_name, $new_password_sec
            ]);
            $say = $kullanici_sor->rowCount();
            if ($say) {
                $message = "Bilgileriniz güncellendi, ana sayfaya yönlendiriliyorsunuz.";
                header('Refresh:2, home.php');
            } else {
                $message = "Bir sorun oluştu.";
            }
        } else {
            $message = "Bir sorunla karşılaştık. Lütfen daha sonra tekrar deneyiniz.";
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
    <title>EkmekTeknesi: Profil</title>
    <!-- TABS ICON -->
    <link rel="shortcut icon" href="../images/other/logo.png" type="image/x-icon" >
    <!-- FONTAWESOME LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- BOOTSTRAP LINK -->
    <link href="../styles/boostrap.css" rel="stylesheet" />
    <style>
        .modal-body-title {
            color: #0275d8;
        }
    </style>

</head>

<body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 mb-4" style="background-color: #fff;" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="home.php"><img src="../images/other/logo.png" alt="" width="30" /><span class="text-1000 fs-1 ms-2 fw-medium">Ekmek<span class="fw-bold">Teknesi</span></span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                    <li class="nav-item"><a class="nav-link " aria-current="page" href="home.php">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link " href="applications.php">İş İlanları </a></li>
                    <li class="nav-item"><a class="nav-link " href="advertise.php">İlan Ver</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">İletişim </a></li>
                </ul>
                <form class="d-flex py-3 py-lg-0">
                    <a href="profile.php"> <button class="btn btn-link text-1000 fw-medium order-1 order-lg-0 text-decoration-none" type="button" style="color: black;">Profil</button></a>
                    <a href="../app/logout.php"> <button class="btn btn-outline-danger rounded-pill order-0" type="button">Çıkış Yap</button></a>


                </form>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->
    <div class="container" style="margin-top: 7rem;">
        <h2>Profil Bilgileriniz</h2>
        <hr>
        <div class="container">
            <h4><i class="fas fa-sign-in-alt"></i> &nbsp;Oluşturmuş Olduğunuz İlanlar</h4>
            <hr>
            <?php if ($message) {
                echo "<script type='text/javascript'>alert('$message');</script>";
            } ?>

            <?php
            $user_name = $_SESSION['user_name'];
            $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
            $user_id =  $query['user_id'];
            ?>
            <?php
            $adds = $db->query("SELECT * FROM job WHERE user_id = '{$user_id}'", PDO::FETCH_ASSOC);
            if ($adds->rowCount()) {




            ?>
                <table class="table table-bordered table-striped table-dark">
                    <tr>
                        <td>İlan Numarası</td>
                        <td>Başlık</td>
                        <td>Şirket</td>
                        <td>İlan Kategorisi</td>
                        <td>Oluşturulma Tarihi</td>

                    </tr>

                    <?php
                    foreach ($adds as $row) { ?>

                        <tr>
                            <td><?= $row['job_id'] ?></td>
                            <td><?= $row['job_title'] ?></td>
                            <td><?= $row['job_company'] ?></td>
                            <td><?= $row['job_category'] ?></td>
                            <td><?= $row['job_create_date'] ?></td>
                        </tr>

                    <?php } ?>
                </table>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Hay aksi!</h4>
                    <p>Henüz hiç ilan oluşturmadınız. İlan oluşturmak ve çalışma ekibinize yeni kişiler katmak için daha fazla beklemeyin.</p>
                    <hr>
                </div>
            <?php } ?>
        </div>
        <div class="container">
            <h4><i class="fas fa-edit "></i> &nbsp;İlan Düzenle</h4>
            <hr>
            <form action="edit.php" method="POST">
                <div class="row">
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" required name="adds_id">
                            <option selected disabled>Düzenlemek İstediğiniz İlan Numarası</option>
                            <?php
                            $adds = $db->query("SELECT * FROM job WHERE user_id = '{$user_id}'", PDO::FETCH_ASSOC);
                            foreach ($adds as $row) { ?>
                                <option><?= $row['job_id'] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="col">
                        <button type="submit" name="edit_ads" class="btn btn-outline-primary rounded-pill mb-3"><i class="fas fa-pen-nib"></i>&nbsp;İlanı Düzenle</button>
                    </div>
            </form>
        </div>

        <h4 class="mt-4"><i class="fas fa-user-edit"></i> &nbsp;Giriş Bilgilerinizi Güncelleyin</h4>
        <div class="container mt-3">
            <?php
            $user_name = $_SESSION['user_name'];
            $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
            $user_id =  $query['user_id'];
            $user_email = $query['user_email'];
            $user_password = $query['user_password'];
            ?>
            <div class="row">
                <div class="col mt-3">
                    <div class="card mt-4" style="width: 90%;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $user_name ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted mb-3"><?php echo $user_email ?></h6>
                            <form action="profile.php" id="" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating">
                                            <input type="password" name="current_password" class="form-control" id="floatingInputGrid" placeholder="Mevcut Şifre" required>
                                            <label for="floatingInputGrid">Mevcut Şifreniz</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-floating">
                                            <input type="password" name="new_password" class="form-control" id="floatingInputGrid" placeholder="Yeni Şifreniz" required />
                                            <label for="floatingInputGrid">Yeni Şifreniz</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-floating">
                                            <input type="password" name="password_again" class="form-control" id="floatingInputGrid" placeholder="Yeni Şifre Tekrar" required>
                                            <label for="floatingInputGrid">Yeni Şifre Tekrar</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success rounded-pill order-0 mt-3" name="edit_user"><i class="fas fa-tools"></i>&nbsp;Bilgileri Güncelle</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <img class="ms-4" style="width: 100%;" src="../images/illustrations/5.jpg" alt="">
                </div>
            </div>

        </div>

    </div>
    </div>






    </div>

    <!-- FOOTER -->
    <div class="bg-light mt-3">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-4">
                        <img class="d-inline-block align-middle" src="../images/other/logo.png" alt="" width="30" /><span class="d-inline-block text-1000 fs-1 ms-2 fw-medium lh-base">Ekmek<span class="fw-bold">Teknesi</span></span></a>
                        <p class="my-3"> <span class="text-secondary">EkmekTeknesi </span>Türkiye'nin yükselen iş ve <br />network bulma platformu. </p>

                    </div>
                    <div class="col">
                        <h5 class="lh-lg ms-4">Sayfalar </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="home.php"><i class="fas fa-home"></i>&nbsp;Anasayfa</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="about.php"><i class="fab fa-black-tie"></i>&nbsp;Hakkımızda</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="applications.php"><i class="fas fa-server"></i>&nbsp;İlanlar</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="advertise.php"><i class="fas fa-upload"></i>&nbsp;İlan Ver</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="contact.php"><i class="fas fa-envelope"></i>&nbsp;İletişim</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="profile.php"><i class="fas fa-user"></i>&nbsp;Profil</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <p class="text-400 my-3" style="text-align: center;">&copy; 2021 Ekmek<b>Teknesi</b></p>
                </div>
                <hr class="opacity-25" />
                <div class="text-400 text-center">
                    <p>&copy; &nbsp;Tüm hakları saklıdır,
                        Fatih Es tarafından hazırlanmıştır.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>




</body>

</html>