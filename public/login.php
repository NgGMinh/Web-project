<?php
session_start();

use CT275\Labs\Data;

require_once '../bootstrap.php';
$Data = new Data($PDO);
$Datas = $Data->selectKhachHang();

// $Data = new Data($PDO);
if (isset($_POST['login'])) {
    $email      = $_POST['email'];
    $matkhau    = $_POST['matkhau'];
}
foreach ($Datas as $Data) {
    if ($Data->Email == $email && $Data->MatKhau == $matkhau) {
        $_SESSION['user'] = $Data->HoTenKH;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
