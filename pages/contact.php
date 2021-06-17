<?php
include '../db_conn.php';
ob_start();
session_start();
$user_name = "";
if (!empty($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EkmekTeknesi: İletişim</title>
    <!-- TABS ICON -->
    <link rel="shortcut icon" href="../images/other/logo.png" type="image/x-icon" >
    <!-- FONTAWESOME LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- BOOTSTRAP LINK -->
    <link href="../styles/boostrap.css" rel="stylesheet" /> <!-- ANIMATION -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 " style="background-color: #fff;" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="<?php echo ($user_name) ? "home.php" : "../index.php" ?>"> <img src="../images/other/logo.png" alt="" width="30" /><span class="text-1000 fs-1 ms-2 fw-medium">Ekmek<span class="fw-bold">Teknesi</span></span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                    <li class="nav-item"><a class="nav-link " aria-current="page" href="<?php echo ($user_name) ? "home.php" : "../index.php" ?>">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($user_name) ? "" : "disabled" ?>" href="applications.php">İş İlanları </a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($user_name) ? "" : "disabled" ?>" href="advertise.php">İlan Ver</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">İletişim </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- NAVBAR END -->

    <div class="container" style="margin-top: 7rem;">
        <h2><i class="far fa-comment-dots"></i>&nbsp; Bize Ulaşın </h2>
        <hr style="opacity:0.4" />

        <div class="row ">
            <div class="col-6">
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfGGWoUkNj9YoPa_tO6LfT6A9XQQe6vlAPfaZvoJvQzLGdxQQ/viewform?embedded=true" width="600" height="778" frameborder="0" marginheight="0" marginwidth="0">Yükleniyor…</iframe>
            </div>



            <div class="col-6">
                <img style="width: 100%;" class="animate__animated animate__bounceIn" src="../images/illustrations/6.jpg" alt="">
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
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="<?php echo ($user_name) ? "home.php" : "../index.php" ?>"><i class="fas fa-home"></i>&nbsp;Anasayfa</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="about.php"><i class="fab fa-black-tie"></i>&nbsp;Hakkımızda</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill <?php echo ($user_name) ? "" : "disabled" ?>" style="color:black" href="applications.php"><i class="fas fa-server"></i>&nbsp;İlanlar</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill <?php echo ($user_name) ? "" : "disabled" ?>" style="color:black" href="advertise.php"><i class="fas fa-upload"></i>&nbsp;İlan Ver</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill" style="color:black" href="contact.php"><i class="fas fa-envelope"></i>&nbsp;İletişim</a></li>
                            <li style="display: inline-block;" class="lh-lg ms-3"><a class="text-decoration-none btn btn-outline-secondary rounded-pill <?php echo ($user_name) ? "" : "disabled" ?>" style="color:black" href="profile.php"><i class="fas fa-user"></i>&nbsp;Profil</a></li>
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