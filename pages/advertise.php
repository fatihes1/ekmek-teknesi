<?php require '../db_conn.php' ?>
<?php
// ! BURASI DOĞRU
ob_start();
session_start();
if (empty($_SESSION['user_name'])){
    header('Location: ../index.php');
    exit();
}


?>
<?php


$message = '';
if (isset($_POST['create_ads'])) {
    $job_title = $_POST['job_title'];
    $job_company = $_POST['job_company'];
    $job_experience = $_POST['job_experience'];
    $job_kind = $_POST['job_kind'];
    $job_category = $_POST['job_category'];
    $job_city = $_POST['job_city'];
    $job_detail = $_POST['job_detail'];
    $user_name = $_SESSION['user_name'];
    $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
    $user_id =  $query['user_id'];


    $sorgu = $db->prepare('INSERT INTO job SET job_title = ?, job_company = ? ,job_experience = ?, job_kind = ?, job_category = ?, job_city = ?,job_detail = ?, user_id = ?');
    $ekle = $sorgu->execute([
        $job_title, $job_company, $job_experience, $job_kind, $job_category, $job_city, $job_detail, $user_id
    ]);

    if ($ekle) {
        $kayit_sor =  $db->prepare('SELECT * FROM job WHERE job_city = ? && job_title = ?');
        $kayit_sor->execute([
            $job_city, $job_title
        ]);
        $say = $kayit_sor->rowCount();
        if ($say) {
            $message = "İlan başarıyla oluşturuldu.";
            header('Refresh:2, advertise.php');
        } else {
            $message = "İlan oluşturulurken bir hata ile karşılaştık.";
        }
    } else {
        $message = "İlanı şu an oluşturamıyoruz. Lütfen daha sonra tekrar deneyin.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EkmekTeknesi: İlanlarınız</title>
    <!-- TABS ICON -->
    <link rel="shortcut icon" href="../images/other/logo.png" type="image/x-icon" >
    <!-- FONTAWESOME LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- BOOTSTRAP LINK -->
    <link href="../styles/boostrap.css" rel="stylesheet" /> 

</head>

<body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 mb-4" style="background-color: #fff;" data-navbar-on-scroll="data-navbar-on-scroll">
    <!-- LOGO UPDATE-->
        <div class="container"><a class="navbar-brand" href="home.php"><img src="../images/other/logo.png" alt="" width="30" /><span class="text-1000 fs-1 ms-2 fw-medium">Ekmek<span class="fw-bold">Teknesi</span></span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                    <li class="nav-item"><a class="nav-link " aria-current="page" href="home.php">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link" href="applications.php">İş İlanları</a></li>
                    <li class="nav-item"><a class="nav-link active" href="advertise.php">İlan Ver</a></li>
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
        <h2><i class="far fa-file-archive"></i>&nbsp;Oluşturmuş Olduğunuz İlanlar</h2>
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
            <table class="table table-bordered table-striped table-light">
                <tr>
                    <td>İlan Numarası</td>
                    <td>Başlık</td>
                    <td>Şirket</td>
                    <td>Oluşturulma Tarihi</td>
                    <td></td>
                </tr>

                <?php
                foreach ($adds as $row) { ?>

                    <tr>
                        <td><?= $row['job_id'] ?></td>
                        <td><?= $row['job_title'] ?></td>
                        <td><?= $row['job_company'] ?></td>
                        <td><?= $row['job_create_date'] ?></td>
                        <td><span id="<?php echo $row['job_id'] ?>" class="del-job btn rounded-pill btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;İlanı Sil</span></td>
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
    <!-- BAŞVURULAN İLANLAR -->
    <div class="container">
    <h2><i class="far fa-folder-open"></i>&nbsp;Başvuru Yapılan İlanlarınız</h2><hr>
    <?php
    $user_name = $_SESSION['user_name'];
    $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
    $user_id =  $query['user_id'];
    
    $created_job = [];
    $count = $db->query("SELECT * FROM job WHERE user_id = $user_id", PDO::FETCH_ASSOC);
    if($count->rowCount()){
      foreach ($count as $say){
        array_push($created_job, $say['job_id']);
      }
    }
    

    $sor = $db->query("SELECT * FROM application INNER JOIN user ON application.user_id = user.user_id AND application.app_status <>  '0'", PDO::FETCH_ASSOC);
    if ($sor->rowCount()) {
        
    ?>
           <table class="table table-bordered table-striped table-light">
          <tr>
            <td>Başvuru Numarası</td>
            <td>İş Numarası</td>
            <td>Başvuran Kişi</td>
            <td>Başvuran Mail</td>
            <td></td>
            <td></td>
          </tr>

          <?php
          foreach ($sor as $row) { ?>
            <?php if ((in_array($row['job_id'], $created_job))) { ?>

              <tr>
                <td><?= $row['app_id'] ?></td>
                <td><?= $row['job_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['user_email'] ?></td>
                <td><button type="button" class="btn rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#de<?= $row['job_id'] ?>">
                    <i class="fas fa-search-plus"></i>&nbsp;Detayları Görüntüle
                  </button></td>
                  <div class="modal fade" id="de<?= $row['job_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <?php
                  $id = $row['job_id'];
                  $query = $db->query("SELECT * FROM job WHERE job_id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
                  if ($query) { ?>
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><?php echo $query['job_title']." " ?>İlanına Başvuru</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <h6 class="modal-body-title" style="display:inline;"> İş İlanı Numarası : </h6>
                          <p style="display:inline;"><?php echo $query['job_id'] ?></p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> Oluşturulma Tarihi : </h6>
                          <p style="display:inline;"><?php echo $query['job_create_date'] ?> </p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> İstihdam Türü : </h6>
                          <p style="display:inline;"><?php echo $query['job_kind'] ?> </p>
                          <hr>
                          <h6 class="modal-body-title">Detaylı Açıklama : </h6>
                          <p><?php echo $query['job_detail'] ?></p>
                          <hr>
                          <h5 style="display: block;" class="mt-2"><i class="fas fa-user-friends"></i>&nbsp;Başvuru Yapan Kişi Bilgileri</h5>
                          <h6 class="modal-body-title" style="display:inline;"> Kullanıcı Adı : </h6>
                          <p style="display:inline;"><?php echo $row['user_name'] ?> </p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;">E-Mail Adresi: </h6>
                          <p style="display:inline;"><?php echo $row['user_email'] ?> </p>
                          <hr>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                        
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <?php if($row['app_status'] === '2' ) {  ?>
                <td><span id="" class=" btn rounded-pill btn-success"><i class="fas fa-trophy"></i> Başvuruyu Kabul Edildi</span></td>
                <?php } else {?>
                    <td><span id="<?php echo $row['app_id'] ?>" class="accept-job rounded-pill btn btn-outline-success"> <i class="fas fa-check"></i> Başvuruyu Kabul Et</span></td>
                    <?php } ?>
                
              </tr>
            <?php } ?>
          <?php } ?>
        </table>
        <?php } ?>
    
    </div>
    <!-- CREATE ADS -->
    <div class="container mt-5">
        <h2><i class="far fa-edit"></i>&nbsp;İlan Oluştur</h2>
        <hr>
        <div class="row">
            <div class="col ms-3 mt-5">
                <img style="width: 100%; height:90%;"  src="../images/illustrations/3.jpg" alt="">
            </div>
            <div class="col">

                <div class="row">
                    <div class="card mt-4" style="width: 90%;">
                        <div class="card-body">
                            <h5 class="card-title">Yeni Bir İş İlanı Oluşturun</h5>
                            <h6 class="card-subtitle mb-2 text-muted mb-3">Aşağıdaki alanları eksiksiz doldurunuz.</h6>
                            <form action="advertise.php" id="new" method="POST">
                                <div class="row">
                                    <div class="col"><input type="text" class="form-control" placeholder="İlan Başlığı" name="job_title" required /></div>
                                    <div class="col"><input type="text" class="form-control" placeholder="Şirket" name="job_company" required /></div>
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
                                    <div class="col"><input type="text" class="form-control" placeholder="Tecrübe (Yıl Olarak)" name="job_experience" required /></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col"><select class="form-select" aria-label="Default select example" required name="job_kind">
                                            <option selected disabled>İlan Türü</option>
                                            <option>Stajyer</option>
                                            <option>Part-time</option>
                                            <option>Full-time</option>
                                        </select></div>
                                    <div class="col"><input type="text" class="form-control" placeholder="Şehir" name="job_city" required /></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col"> <textarea name="job_detail" id="" class="form-control" cols="30" rows="8" placeholder="Detaylı Açıklama" form="new" required></textarea> </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary rounded-pill order-0 mt-3" name="create_ads"><i class="fas fa-plus"></i>&nbsp;İlanı Oluştur</button>
                            </form>
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

    <script src="../JsFiles/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.del-job').click(function() {
                const id = $(this).attr('id');
                $.post("../app/delete_ads.php", {
                        id: id
                    },
                    (data) => {
                        if (data) {
                            location.replace("home.php")
                        }
                    }
                );
            })
        })
    </script>
      <script src="../JsFiles/jquery-3.2.1.min.js"></script>

<script>
  $(document).ready(function(){
    $('.accept-job').click(function(){
      const id = $(this).attr('id');
      $.post("../app/accept.php", 
      {
        id :id
      },
      (data) => {
        if(data){
          location.replace("home.php")
        }
      }
      ); 
    })
  })

</script>  

</body>

</html>