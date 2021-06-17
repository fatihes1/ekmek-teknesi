<?php require '../db_conn.php' ?>
<?php
ob_start();
session_start();
$message = "";
if (empty($_SESSION['user_name'])) {
    header('Location: ../index.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EkmekTeknesi: İlan Düzenle</title>
    <!-- TABS ICON -->
    <link rel="shortcut icon" href="../images/other/logo.png" type="image/x-icon" >
    <!-- FONTAWESOME LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- BOOTSTRAP LINK -->
    <link href="../styles/boostrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/card.css">

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
                    <a href="profile.php"> <button class="btn btn-link text-1000 fw-medium order-1 order-lg-0 text-decoration-none" type="button" style="color: grey;">Profil</button></a>
                    <a href="../app/logout.php"> <button class="btn btn-outline-danger rounded-pill order-0" type="button">Çıkış Yap</button></a>


                </form>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->
    <div class="container" style="margin-top: 7rem;">

        <h2><i class="far fa-file-word"></i>&nbsp;İlanınızı Güncelleyin</h2>
        <hr>
        <?php
        $user_name = $_SESSION['user_name'];
        $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
        $user_password = $query['user_password'];
        $user_id =  $query['user_id'];
        if (isset($_POST['edit_ads'])) {
            $ads_id = $_POST['adds_id'];
            $edit_adss = $db->query("SELECT * FROM job WHERE job_id = '{$ads_id}'", PDO::FETCH_ASSOC);

            if ($edit_adss->rowCount()) {
                foreach ($edit_adss as $row) {
        ?>

                    <div class="row">
                        <div class="col">
                            <div class="card card-middle mt-4" style="width: 90%;">
                                <div class="card-body">
                                    <h5 class="card-title">İlanınızı düzenleyin</h5>
                                    <h6 class="card-subtitle mb-2 text-muted mb-3">Aşağıdaki alanları eksiksiz doldurunuz.</h6>
                                    <form action="../app/update_job.php" id="" method="POST">
                                        <div class="row">
                                            <div class="col"><input type="text" class="form-control" value="<?php echo $row['job_id'] ?>" name="job_id" required readonly /></div>
                                            <div class="col"><input type="text" class="form-control" value="<?php echo $row['job_title'] ?>" name="job_title" required /></div>
                                            <div class="col"><input type="text" class="form-control" value="<?php echo $row['job_company'] ?>" name="job_company" required /></div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col"><select class="form-select" aria-label="Default select example" required name="job_category">
                                                    <option selected disabled>Kategori</option>
                                                    <option>Bilişim</option>
                                                    <option>Danışmanlık</option>
                                                    <option>Eğitim</option>
                                                    <option>Emlak</option>
                                                    <option>Finans</option>
                                                    <option>Haberleşme</option>
                                                    <option>Halka İlişkiler</option>
                                                    <option>Mimar</option>
                                                    <option>Muhassebe</option>
                                                    <option>Pazarlama</option>
                                                    <option>Reklam</option>
                                                    <option>Sigortacılık</option>
                                                    <option>Tasarım</option>
                                                    <option>Teknisyen</option>
                                                    <option>Yönetici</option>
                                                    <option>Diğer</option>
                                                </select></div>
                                            <div class="col"><input type="text" class="form-control" placeholder="Tecrübe (Yıl Olarak)" value="<?php echo $row['job_experience'] ?>" name="job_experience" required /></div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col"><select class="form-select" aria-label="Default select example" required name="job_kind">
                                                    <option selected disabled>İlan Türü</option>
                                                    <option>Stajyer</option>
                                                    <option>Part-time</option>
                                                    <option>Full-time</option>
                                                </select></div>
                                            <div class="col"><input type="text" class="form-control" value="<?php echo $row['job_city'] ?>" placeholder="Şehir" name="job_city" required /></div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="input-group-prepend">
                                                <input type="text" class="form-control" name="job_detail" value="<?php echo $row['job_detail'] ?>" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-outline-success rounded-pill order-0 mt-3" name="edit_ads"><i class="fas fa-redo-alt"></i></i>&nbsp;İlanı Güncelle.</button>
                                    </form>
                                </div>
                            </div>


                        </div>
                        <div class="col">
                            <img src="../images/illustrations/2.png" alt="">
                        </div>

                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Hay aksi :(</h4>
                <p>Bir ilan seçmediniz. Profil sayfasına dönün ve hangi ilanı düzenleme istediğinizi seçiniz.</p>
                <hr>
            </div>
        <?php } ?>

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


    <!-- FOOTER -->
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>




</body>

</html>