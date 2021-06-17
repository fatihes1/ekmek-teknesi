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

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EkmekTeknesi: İş İlanları ve Başvurular</title>
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
          <li class="nav-item"><a class="nav-link active" href="applications.php">İş İlanları </a></li>
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
    <h2><i class="far fa-file-alt"></i>&nbsp;Başvuru Yapılmış İlanlar</h2>
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
    $adds = $db->query("SELECT * FROM application WHERE user_id = $user_id AND app_status <> '0'", PDO::FETCH_ASSOC);
    if ($adds->rowCount()) {  ?>

      <table class="table table-bordered table-striped table-light">
        <tr>
          <td>Başvuru Numarası</td>
          <td>İş Numarası</td>
          <td>Başvuru Durumu</td>
          <td>Ayrıntıları Görüntüle</td>
        </tr>

        <?php
        foreach ($adds as $row) { ?>
          <tr>
            <td><?= $row['app_id'] ?></td>
            <td><?= $row['job_id'] ?></td>
            <td>
              <?php if ($row['app_status'] === '1') { ?>
                <button class="btn rounded-pill btn-warning"><i class="far fa-clock"></i>&nbsp; Başvuru Yapıldı </button>
              <?php  } else { ?>
                <button class="btn rounded-pill btn-success "><i class="fas fa-check"></i>&nbsp;<p style="display: inline;" class="pe-4"> Kabul Edildi</p></button>
              <?php } ?>

            </td>
            <td><button type="button" class="btn rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#d<?= $row['job_id'] ?>">
                <i class="fas fa-search-plus"></i>&nbsp;Detayları Görüntüle
              </button></td>
            <!-- Modal -->

          </tr>
          <div class="modal fade" id="d<?= $row['job_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php
            $id = $row['job_id'];
            $query = $db->query("SELECT * FROM job WHERE job_id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
            if ($query) { ?>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $query['job_title'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h6 class="modal-body-title" style="display:inline;"> İş İlanı Numarası : </h6>
                    <p style="display:inline;"><?php echo $query['job_id'] ?></p>
                    <hr>
                    <h6 class="modal-body-title" style="display:inline;"> İş İlanı Oluşturan Şirket : </h6>
                    <p style="display:inline;"><?php echo $query['job_company'] ?></p>
                    <hr>
                    <h6 class="modal-body-title" style="display:inline;"> Şirket Konumu (İl) : </h6>
                    <p style="display:inline;"><?php echo $query['job_city'] ?></p>
                    <hr>
                    <h6 class="modal-body-title" style="display:inline;"> Beklenen Tecrübe : </h6>
                    <p style="display:inline;"><?php echo $query['job_experience'] ?> Yıl</p>
                    <hr>
                    <h6 class="modal-body-title" style="display:inline;"> İstihdam Türü : </h6>
                    <p style="display:inline;"><?php echo $query['job_kind'] ?> </p>
                    <hr>
                    <h6 class="modal-body-title" style="display:inline;"> Oluşturulma Tarihi : </h6>
                    <p style="display:inline;"><?php echo $query['job_create_date'] ?> </p>
                    <hr>
                    <h6 class="modal-body-title">Detaylı Açıklama : </h6>
                    <p><?php echo $query['job_detail'] ?></p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>

                  </div>
                </div>
              </div>
            <?php } ?>
          </div>

        <?php } ?>
      </table>
    <?php } else { ?>
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Hay aksi!</h4>
        <p>Henüz hiçbir ilana başvuru yapmadınız. Aşağıda bulunan başvuruya açık ilanları inceleyebilir ve hayalinizdeki işe bir adım daha yaklaşabilirsiniz.</p>
        <hr>
      </div>
    <?php } ?>

  </div>

  <!-- SHOW ADS -->
  <div class="container mt-5">
    <h2><i class="far fa-folder-open"></i>&nbsp; Başvuruya Açık İlanlar</h2>
    <small>İlanları inceleyebilir, istediğiniz alan veya şehire göre başvuruda bulunabilirsiniz.</small>
    <hr>
    <div class="filter">
      <?php
      $user_name = $_SESSION['user_name'];
      $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
      $user_id =  $query['user_id'];

      $applied_add = [];
      $count = $db->query("SELECT * FROM application WHERE user_id = $user_id AND app_status <> '0'", PDO::FETCH_ASSOC);
      if ($count->rowCount()) {
        foreach ($count as $say) {
          array_push($applied_add, $say['job_id']);
        }
      }


      ?>
      <?php
      $adds = $db->query("SELECT job.job_id, job.job_title, job.job_company, user.user_name FROM job LEFT JOIN user ON job.user_id = user.user_id", PDO::FETCH_ASSOC);
      if ($adds->rowCount()) {

      ?>
        <table class="table table-bordered table-striped table-light">
          <tr>
            <td>İlan Numarası</td>
            <td>Başlık</td>
            <td>Şirket</td>
            <td>Oluşturan Kişi</td>
            <td></td>
            <td></td>
          </tr>

          <?php
          foreach ($adds as $row) { ?>
            <?php if (($row['user_name'] != $_SESSION['user_name']) && !(in_array($row['job_id'], $applied_add))) { ?>

              <tr>
                <td><?= $row['job_id'] ?></td>
                <td><?= $row['job_title'] ?></td>
                <td><?= $row['job_company'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><button type="button" class="btn rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#det<?= $row['job_id'] ?>">
                    <i class="fas fa-search-plus"></i>&nbsp;Detayları Görüntüle
                  </button></td>
                <div class="modal fade" id="det<?= $row['job_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <?php
                  $id = $row['job_id'];
                  $query = $db->query("SELECT * FROM job WHERE job_id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
                  if ($query) { ?>
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><?php echo $query['job_title'] ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <h6 class="modal-body-title" style="display:inline;"> İş İlanı Numarası : </h6>
                          <p style="display:inline;"><?php echo $query['job_id'] ?></p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> İş İlanı Oluşturan Şirket : </h6>
                          <p style="display:inline;"><?php echo $query['job_company'] ?></p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> Şirket Konumu (İl) : </h6>
                          <p style="display:inline;"><?php echo $query['job_city'] ?></p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> Beklenen Tecrübe : </h6>
                          <p style="display:inline;"><?php echo $query['job_experience'] ?> Yıl</p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> İstihdam Türü : </h6>
                          <p style="display:inline;"><?php echo $query['job_kind'] ?> </p>
                          <hr>
                          <h6 class="modal-body-title" style="display:inline;"> Oluşturulma Tarihi : </h6>
                          <p style="display:inline;"><?php echo $query['job_create_date'] ?> </p>
                          <hr>
                          <h6 class="modal-body-title">Detaylı Açıklama : </h6>
                          <p><?php echo $query['job_detail'] ?></p>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>

                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <td><span id="<?php echo $query['job_id'] ?>" class="apply-job btn rounded-pill btn-outline-success"><i class="far fa-share-square"></i>&nbsp;Başvuru Yap</span></td>
              </tr>
            <?php } ?>
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
      $('.apply-job').click(function() {
        const id = $(this).attr('id');
        $.post("../app/apply.php", {
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


</body>

</html>