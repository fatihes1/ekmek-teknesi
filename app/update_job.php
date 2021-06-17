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
<?php


?>

<?php
// EDIT ADS CONTROL
if (isset($_POST['edit_ads'])) {
    $user_name = $_SESSION['user_name'];
    $query = $db->query("SELECT * FROM user WHERE user_name = '{$user_name}'")->fetch(PDO::FETCH_ASSOC);
    $user_id =  $query['user_id'];

    $job_id = $_POST['job_id'];
    $job_title = $_POST['job_title'];
    $job_company = $_POST['job_company'];
    $job_experience = $_POST['job_experience'];
    $job_kind = $_POST['job_kind'];
    $job_category = $_POST['job_category'];
    $job_city = $_POST['job_city'];
    $job_detail = $_POST['job_detail'];


    $sorgu = $db->prepare("UPDATE job SET job_title = ?, job_company = ?, job_experience = ?, job_kind = ?, job_category = ?, job_city = ?, job_detail = ?, user_id = ?  WHERE job_id = '{$job_id}'");
    $ekle = $sorgu->execute([
        $job_title, $job_company, $job_experience, $job_kind, $job_category, $job_city, $job_detail, $user_id
    ]);
    if ($ekle) {
        $ads_sor =  $db->prepare('SELECT * FROM job WHERE job_title = ? && job_id = ?');
        $ads_sor->execute([
            $job_title, $job_id
        ]);
        header('Location: ../pages/advertise.php');
    } else {
        $message = "Bir sorunla karşılaştık. Lütfen daha sonra tekrar deneyiniz.";
    }
}

?>