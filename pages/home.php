<?php require '../db_conn.php' ?>
<?php
// ! BURASI DOĞRU
ob_start();
session_start();
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
    <title>EkmekTeknesi: İş Bulmanın Kolay Yolu</title>
    <!-- TABS ICON -->
    <link rel="shortcut icon" href="../images/other/logo.png" type="image/x-icon" >
    <!-- FONTAWESOME LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- BOOTSTRAP LINK -->
    <link href="../styles/boostrap.css" rel="stylesheet" />
    <link href="styles/theme.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- ANIMATION -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 " style="background-color: #fff;" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="home.php"><img src="../images/other/logo.png" alt="" width="30" /><span class="text-1000 fs-1 ms-2 fw-medium">Ekmek<span class="fw-bold">Teknesi</span></span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link" href="applications.php">İş İlanları </a></li>
                    <li class="nav-item"><a class="nav-link" href="advertise.php">İlan Ver</a></li>
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

    <!-- JUMBOTRON -->

    <div class="container">
        <div class="row flex-center ms-3">
            <div class="col-lg-6 col-md-5 order-md-1 mt-5"><img class="img-fluid mt-5 animate__animated animate__backInUp" src="../images/illustrations/1.jpg" alt="" /></div>
            <div class="col-md-7 col-lg-6 mt-5 text-center text-md-start">
                <h1 class="fw-medium mt-5" style="font-family: 'Yellowtail', cursive; font-size:3.8rem;">Rüyalarınızdaki is<br />bir tık uzakta : <span style="font-family: sans-serif; font-size:2.7rem">Ekmek<b>Teknesi</b></span></h1>
                <p class="mt-3 mb-4" style="font-size: 2rem;font-family: 'Quicksand', sans-serif;">Türkiye'nin dört bir yanında bulunan kişiler Ekmek<b>Teknesi</b> ile bir araya geliyor. İş bulmakta zorlanan, CV gönderip cevap alamayan, iş ilanı açıp istediği insanlara ulaşamayan iş verenler. Hepsi burada ...</p>
                <a class="btn btn-lg btn-outline-danger  btn-glow rounded-pill" href="applications.php">Keşfetmeye Başla &nbsp;<i class="far fa-paper-plane"></i> </a>
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->

    <!-- INFO CARDS -->
    <div class="container mt-5">
        <div class="card py-5 border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="border-end d-flex justify-content-md-center">
                            <div class="mx-2 mx-md-0 me-md-5">
                                <span style="color: Tomato;"><i class="fas fa-user fa-lg"></i></span>
                            </div>
                            <div>
                                <p class="fw-bolder text-1000 mb-0">
                                    <!-- php ile data çek -->
                                    <?php $sorgu = $db->prepare('SELECT COUNT(*) FROM user');
                                    $sorgu->execute();
                                    $say = $sorgu->fetchColumn();
                                    echo $say;
                                    ?>


                                </p>
                                <p class="mb-0">Üye </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border-end d-flex justify-content-md-center">
                            <div class="mx-2 mx-md-0 me-md-5">
                                <span style="color: Tomato;"><i class="fas fa-map-marker-alt fa-lg"></i></span>
                            </div>
                            <div>
                                <p class="fw-bolder text-1000 mb-0">
                                    <!-- php ile şehir -->
                                    <?php $sorgu = $db->prepare('SELECT distinct job_city FROM job');
                                    $sorgu->execute();
                                    $say = $sorgu->rowCount();
                                    echo $say;
                                    ?>


                                </p>
                                <p class="mb-0">Farklı Şehir </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-md-center">
                            <div class="mx-2 mx-md-0 me-md-5">
                                <span style="color: Tomato;"><i class="fas fa-server fa-lg"></i></span>
                            </div>
                            <div>
                                <p class="fw-bolder text-1000 mb-0">
                                    <!-- php ile şehir -->
                                    <?php $sorgu = $db->prepare('SELECT COUNT(*) FROM application');
                                    $sorgu->execute();
                                    $say = $sorgu->fetchColumn();
                                    echo $say;
                                    ?>
                                </p>
                                <p class="mb-0">Başvuru </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END INFO CARDS-->

    <!-- ABOUT US -->
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-7 text-lg-center"><img class="img-fluid mb-5 mb-md-0" src="../images/illustrations/2.jpg" alt="" /></div>
            <div class="col-md-7 col-lg-5 text-center text-md-start">
                <h2>Türkiye'nin En Büyük<br />Online İş Bulma Platformu</h2>
                <p> İş bulmanın kolay yolu. Geleceğinize önem veriyor ve bu yolda size <br>yardım etmek istiyoruz.</p>
                <div class="d-flex">
                    <span style="color: green;"><i class="fas fa-check-circle"></i></span>
                    <p class="ms-2">
                        <?php $sorgu = $db->prepare('SELECT distinct job_category FROM job');
                        $sorgu->execute();
                        $say = $sorgu->rowCount();
                        echo $say;
                        ?> farklı kategoride ilanlar.
                    </p>
                </div>
                <div class="d-flex">
                    <span style="color: green;"><i class="fas fa-check-circle"></i></span>
                    <p class="ms-2">Kolay başvuru ve başvuru takip sistemi.</p>
                </div>
                <div class="d-flex">
                    <span style="color: green;"><i class="fas fa-check-circle"></i></span>
                    <p class="ms-2">
                        <?php $sorgu = $db->prepare('SELECT distinct job_company FROM job');
                        $sorgu->execute();
                        $say = $sorgu->rowCount();
                        echo $say;
                        ?> farklı şirket.
                    </p>
                </div>
                <div class="d-flex">
                    <span style="color: green;"><i class="fas fa-check-circle"></i></span>
                    <p class="ms-2">Stajyer, part-time ve full time iş imkanları.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END ABOUT US -->

    <!-- USER COMMENT -->
    <div class="container mt-5">
        <div class="row d-flex justify-content-center mb-3">
            <div class="col-md-8 col-lg-5">
                <h2 style="text-align: center;">Mutlu Üyelerimize<br />Güvenin</h2>
                <p style="text-align: center;"> Ekmek Teknesi sayesinde iş bulan ve şu bu mutluluğunu bizlerle paylaşan müşterilerimizin yorumlarına kulak verin.</p>
            </div>
        </div>
        <div class="carousel slide pt-6" id="carouselExampleDark" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <div class="row h-100">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_6.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Kadir Çelik</h6>
                                                <p class="fs--2 fw-normal mb-0">Endüstri Mühendisi, İzmir</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">4.5</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Böyle bir platformun olması herkes için kurtarıcı nitelikte! Teşekkürler EkmekTeknesi ekibi.”.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_9.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Tolgahan Teneke</h6>
                                                <p class="fs--2 fw-normal mb-0">Elektrik Elektronik Mühendisi, Ankara</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">5</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Henüz üniversiteden mezun olmadan iş sahibi olmak çok güzel bir his! Bu fırsatı bulduğum için çok mutluyum.”</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_4.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Sevgim Gürcanlar</h6>
                                                <p class="fs--2 fw-normal mb-0">Ar-Ge Uzmanı, İstanbul</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">4.8</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Yıllar önce zorunlu stajımı bu site sayesinde bulmuştum. Teşekkürler EkmekTeknesi”.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <div class="row h-100">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_1.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Yiğit Karakuş</h6>
                                                <p class="fs--2 fw-normal mb-0">Biyomedikal, Bursa</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">4.5</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Üniversite okuduğum şehirde part-time iş fırsatı bulmak cidden muzzam bir his”.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_5.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Gamze Nur Türkmen</h6>
                                                <p class="fs--2 fw-normal mb-0">Tasarımcı, Adana</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">5</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Hobi olarak yaptığım tasarımlardan para kazanmaya başladım. Ek gelire kim hayır der ki?”</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_3.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Yılmaz Kalınlı</h6>
                                                <p class="fs--2 fw-normal mb-0">Lojistik, Mersin</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">4.8</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Üniversiteden mezun olup yaşadığım ile geldiğimde bu ilde bir iş bulacağım aklımın ucundan bile geçmezdi. Teşekkürler :) ”.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row h-100">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_2.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Cumhur Aksu</h6>
                                                <p class="fs--2 fw-normal mb-0">Danışmanlık, Gaziantep</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">4.5</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Vay! Danışmanlık sektöründe bu kadar kolay iş bulacağım aklıma gelmezdi. Teşekkürler EkmekTeknesi”.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_7.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">İbrahim Değirmenci</h6>
                                                <p class="fs--2 fw-normal mb-0">Java Geliştirici, Hatay</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">5</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Hatayda okurken bilişim sektöründe para kazanacağım söylense inanmazdım. Ama gerçek oldu!”</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center"><img class="img-fluid" style="width: 50px; height:50px;" src="../images/other/user_8.png" alt="" />
                                            <div class="flex-1 ms-3">
                                                <h6 class="mb-0 fs--1 text-1000 fw-medium">Şahin Mert Hız</h6>
                                                <p class="fs--2 fw-normal mb-0">Solist, Ankara</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center"><span class="text-900 me-3">4.8</span>
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        </div>
                                    </div>
                                    <p class="card-text pt-3">“Bu tarz sitelerde böyle işler olmaz diyordum. Son iki yıldır yeni ekibimizle beraber çalıyoruz!”.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-3 px-md-0 mt-2" style="z-index: -1;">
                <div class="col-12 position-relative ">
                    <ul class=" mt-3 ul-class" style="list-style: none;text-align:center;cursor:pointer ">
                        <li style="display:inline-block" class="li-class" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"> <span style="color: tomato;"><i class="fas fa-lg fa-grip-lines"></i> </span> </li>
                        <li style="display:inline-block" class="ms-3" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"> <span style="color: tomato;"><i class="fas fa-lg fa-grip-lines"></i> </span></i> </li>
                        <li style="display:inline-block" class="ms-3" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"> <span style="color: tomato;"><i class="fas fa-lg fa-grip-lines"></i> </span></i> </li>
                    </ul>
                </div>
                <div class="col-6 position-relative"><a class="carousel-control-prev carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next carousel-icon z-index-2" href="#carouselExampleDark" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
            </div>
        </div>
    </div>
    <!-- END USER COMMENT -->

    <!-- SHOW MAPS -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5 align-content-center mb-3">
                <h2 style="display: block; text-align:center;">Büyük yerel network ağımıza<br />siz de katılın.</h2>
                <p style="display: block; text-align:center;">Türkiy'nin dört bir yanından üyelerimizin oluşturuğu ilanlara bakmak içim üye olmayı unutmayın.</p>
            </div>
            <div class="pt-8 d-flex justify-content-center"><img class="img-fluid" src="../images/other/map_2.png" style="width: 70%;opacity:0.8" alt="" /></div>
        </div>
    </div>
    <!-- END SHOW MAPS -->


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