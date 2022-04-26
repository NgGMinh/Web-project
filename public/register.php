<?php

use CT275\Labs\Data;

require_once '../bootstrap.php';
$Data = new Data($PDO);
$Datas = $Data->selectKhachHang();
$data = [];
$errors = false;
$error;
if (isset($_POST['register'])) {
    $email      = $_POST['email_register'];
}

foreach ($Datas as $Data) {
    if ($Data->Email == $email) {
        $errors = true;
    }
}

if (isset($_POST['register'])) {
    $data['HoTenKH']        = $_POST['hoten_register'];
    $data['Email']          = $_POST['email_register'];
    $data['MatKhau']        = $_POST['matkhau_register'];
    $data['DiaChi']         = $_POST['diachi'];
    $data['SDT']            = $_POST['dienthoai'];

    if(!$errors){
    	$Data->fill($data);
    	$Data->register();
        header('Location: index.php');
    }else{
        $error = "Email đã tồn tại";
    }
}
