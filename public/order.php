<?php
require_once '../bootstrap.php';
require_once 'function/format-money.php';

ob_start();

use CT275\Labs\Data;

$Data = new Data($PDO);
$Datas = $Data->all();

if (session_id() === '')
    session_start();

if (isset($_SESSION["user"])) {
    $conn = new mysqli("localhost", "root", "", "ct275_btlon");
    mysqli_set_charset($conn, "utf8");
    $sql = 'select * from khachhang where HoTenKH = "' . $_SESSION["user"] . '"';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, 1);
    $khachhang = $row;
    if ($khachhang != null) {
        $IDKH = $khachhang['IDKH'];
        $tenkhachhang = $khachhang['HoTenKH'];
        $email = $khachhang['Email'];
        $dienthoai = $khachhang['SDT'];
        $diachi = $khachhang['DiaChi'];
    }
}

if (!empty($_POST['soluong'])) {
    foreach ($_POST['soluong'] as $id => $soluong) {
        $_SESSION['cart'][$id] = $soluong;
    };
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KM Shop - Thanh Toán</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/cart.css" rel=" stylesheet">
    <link href="css/basic.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/order.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/img-public/img-background.jpg');
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body>
    <?php include('../partials/navbar.php') ?>

    <!-- Product NAV-- START -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded mb-1 p-1">
            <div class="navbar-toggler p-0 border-0">
                <button class="navbar-toggler p-0 mr-1" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <span class="text-navbar text-white mr-auto text-list" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    Danh Sách Sản Phẩm
                </span>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item text-nav-item ">
                        <a class="nav-link text-white hover-btn" href="smartphone.php">
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                            Điện Thoại
                        </a>
                    </li>
                    <li class="nav-item text-nav-item ">
                        <a class="nav-link text-white hover-btn" href="headphone.php">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                            Tai Nghe
                        </a>
                    </li>
                    <li class="nav-item text-nav-item ">
                        <a class="nav-link text-white hover-btn" href="phonecase.php">
                            <i class="fa fa-tablet" aria-hidden="true"></i>
                            Ốp Lưng
                        </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse mr-0" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item text-nav-item ">
                        <a class="nav-link text-white hover-btn" href="Data.html">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Liên hệ
                        </a>
                    </li>
                    <li class="nav-item text-nav-item ">
                        <a class="nav-link text-white hover-btn" href="tel:123456789">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            CSKH: 123 456789
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Product NAV-- END -->

    <nav class="container" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-3">
            <li class="breadcrumb-item " aria-current="page">
                <a href="index.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a href="cart.php" class="active text-dark">
                    Giỏ hàng
                </a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a href="order.php" class="active text-dark">
                    Thanh toán
                </a>
            </li>
        </ol>
    </nav>

    <!-- Order & Check Out -- START -->
    <div class="container">
        <div class="container p-3 bg-white rounded mb-1">
            <!-- Cart Detail -- START -->
            <div class="row">
                <div class="col-12" id="cart-table">
                    <div class="bg-white rounded p-2">
                        <h5 class="text-center pb-3">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Giỏ hàng của bạn
                        </h5>
                        <table class="table table-hover text-cart-table">
                            <thead>
                                <tr>
                                    <th class="p-1 text-center">STT</th>
                                    <th class="p-1 text-center product-name-width">Hình Ảnh</th>
                                    <th class="p-1 text-center product-name-width">Tên Sản Phẩm</th>
                                    <th class="py-1 px-0 p-md-1 text-center product-number-width">Số Lượng</th>
                                    <th class="p-1 text-center d-none d-md-table-cell product-price-width">Giá</th>
                                    <th class="p-1 text-center text-md-right product-price-width">Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $index = 1;
                                $sql = 'SELECT * FROM `hanghoa` WHERE `IDHangHoa` IN (' . implode(",", array_keys($_SESSION["cart"])) . ')';
                                $conn = new mysqli("localhost", "root", "", "CT275_btlon");
                                mysqli_set_charset($conn, "utf8");
                                $tong = 0;
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result, 1)) {
                                    $tong++;
                                }
                                $total = 0;
                                $result = mysqli_query($conn, $sql);
                                for ($i = 0; $i < $tong; $i++) {
                                    $item = mysqli_fetch_array($result, 1);
                                    echo '<tr id="product-1">
                                            <th class="p-1 align-middle text-center">
                                            ' . ($index++) . '
                                            </th>
                                            <td class="p-1 p-md-2 p-lg-4 align-middle">
                                                <center>
                                                    <img src="img/img-product/thumbnail/' . $item['Thumbnail'] . '" class="d-block w-75 img-fluid rounded">
                                                </center>
                                                
                                            </td>
                                            <td class="p-1 align-middle text-center">
                                            ' . $item['TenHangHoa'] . '
                                            </td>
                                            <td class="p-1 align-middle text-center">
                                            ' . $_SESSION["cart"][$item['IDHangHoa']] . '
                                            </td>
                                            <td class="p-1 align-middle text-center d-none d-md-table-cell">
                                            ' . money_format($item['Gia']) . ' VNĐ
                                            </td>
                                            <td class="p-1 align-middle text-center text-md-right">
                                                <small class="d-md-none text-price-old">15.490.000</small>
                                                <br class="d-md-none" />
                                                ' . money_format($item['Gia'] * $_SESSION["cart"][$item['IDHangHoa']]) . ' VNĐ
                                            </td>
                                        </tr>';
                                    $total = $total + ($item['Gia'] * $_SESSION["cart"][$item['IDHangHoa']]);
                                }

                                ?>
                                <tr>
                                    <td colspan="6" class="pt-3 px-1 align-middle text-right d-none d-md-table-cell">
                                        <b>
                                            Tổng Tiền:&ensp; <?= money_format($total) ?> VNĐ
                                        </b>
                                    </td>
                                    <td colspan="5" class="pt-3 px-1 align-middle text-right d-md-none">
                                        <b>
                                            Tổng Tiền:&ensp; <?= money_format($total) ?> VNĐ
                                            <b>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Cart Detail -- END -->

            <!-- Check Out -- START -->
            <div class="w-75 mx-auto text-check-out" style="min-height: 200px;">
                <h5 class="text-center text-check-out-tittle">Thông Tin Thanh Toán</h5>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <form action="order.php" method="post">
                        <div class="form-group mb-4">
                            <label for="order-fullname" class="col-form-label">Họ tên khách hàng</label>
                            <input type="text" class="form-control order-input" aria-label="Small" id="order-name" name="order-name" value="<?= $tenkhachhang ?>">
                            <small id="order-name-error" class="form-text text-error mb-1"></small>

                            <label for="order-email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control order-input" aria-label="Small" id="order-email" value="<?= $email ?>">
                            <small id="order-email-error" class="form-text text-error mb-1"></small>

                            <label for="order-address" class="col-form-label">Địa chỉ:</label>
                            <input type="text" class="form-control order-input" aria-label="Small" id="order-address" name="order-address" value="<?= $diachi ?>">
                            <small id="order-address-error" class="form-text text-error mb-1"></small>

                            <label for="order-phone-number" class="col-form-label">Số Điện Thoại:</label>
                            <input type="text" class="form-control order-input" aria-label="Small" id="order-phone" name="order-phone" value="<?= $dienthoai ?>">
                            <small id="order-phone-error" class="form-text text-error mb-3"></small>

                            <div class="pt-3 pb-2">
                                <button id="btn-order" name="btn-order" type="submit" class="btn btn-primary w-100 p-1 text-check-out">Mua Hàng</button>
                            </div>
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <div>
                        <h4 class="text-center mt-3">Vui lòng đăng nhập trước khi thanh toán.</h4>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- Check Out -- END -->
            <?php

            $sql = 'SELECT * FROM `hanghoa` WHERE `IDHangHoa` IN (' . implode(",", array_keys($_SESSION["cart"])) . ')';
            $conn = new mysqli("localhost", "root", "", "CT275_btlon");
            mysqli_set_charset($conn, "utf8");
            $data = [];
            $result = mysqli_query($conn, $sql);

            if (isset($_POST['btn-order'])) {
                $tenkhachhang = $_POST['order-name'];
                $dienthoai      = $_POST['order-phone'];
                $diachi         = $_POST['order-address'];

                foreach ($result as $item) {
                    $sql2 = "INSERT INTO `hoadon`(`IDHangHoa`, `IDKH`, `SoLuongMua`, `TongTien`, `DiaChi`) VALUES ('" . $item['IDHangHoa'] . "','" . $IDKH . "','" . $_SESSION['cart'][$item['IDHangHoa']] . "','" . $_SESSION['cart'][$item['IDHangHoa']] * $item['Gia'] . "','" . $diachi . "')";
                    mysqli_query($conn, $sql2);

                    $sql3 = 'Update HangHoa set SoLuong = SoLuong - ' . $_SESSION["cart"][$item['IDHangHoa']] . ' Where IDHangHoa = "' . $item['IDHangHoa'] . '"';
                    mysqli_query($conn, $sql3);
                }

                unset($_SESSION["cart"]);
                header('location: ./index.php');
            }
            ob_end_flush();

            ?>
        </div>
    </div>
    <!-- Order & Check Out -- END -->

    <?php include('../partials/footer.php') ?>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/checkInput.js"></script>
    <script src="./js/order.js"></script>

</body>

</html>