<?php
require_once '../bootstrap.php';
require_once 'function/format-money.php';

use CT275\Labs\Data;

$id = $_GET['idhh'];
if (empty($_GET['idhh'])) {
    header('location:index.php');
}

$Data = new Data($PDO);
$Datas = $Data->selectOne($id);

$DatasImg = $Data->selectOneImg($id);

if (session_id() === '')
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KM Shop</title>

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
    <link href="css/product-details.css" rel=" stylesheet">
    <link href="css/basic.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/img-public/img-background.jpg');
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body>
    <?php include('../partials/navbar.php') ?>

    <!-- Modal Add Cart -- START -->
    <div class="modal fade" id="modal-add-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center d-block ">
                    <span class="modal-title pl-4" id="exampleModalLongTitle">
                        <b style="font-size: 1.3rem;">Đã thêm hàng hóa</b>
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p><b>"Điện thoại Samsung Galaxy S21 FE 5G (8GB/128GB)"</b> đã được thêm vào giỏ hàng của bạn. Xin hãy vào giỏ hàng để kiểm tra.</p>
                </div>
                <div class="modal-footer text-center">
                    <a href="cart.html" class="btn btn-primary">
                        Đến giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Cart -- END -->

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

    <!-- Breadcrumb -- START -->
    <nav class="container mb-1" aria-label="breadcrumb">
        <ol class="breadcrumb mb-1 p-2 pl-4">
            <li class="breadcrumb-item " aria-current="page">
                <a href="index.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a href="index.html" class="active text-dark">
                    Chi Tiết Sản Phẩm
                </a>
            </li>
        </ol>
    </nav>
    <!-- Breadcrumb -- END -->

    <!-- Product Details -- START -->
    <div class="container mb-2">
        <div class="bg-white pt-3 rounded container">
            <div class="row">

                <!-- Product Image -- START -->
                <div class="col-md-7 pr-md-0">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner rounded">
                            <?php foreach ($Datas as $Data) : ?>
                                <div class="carousel-item active">
                                    <img class="d-block w-100 object-fit-contain product-detail-img" src="img/img-product/thumbnail/<?php echo $Data->Thumbnail ?>" alt="First slide">
                                </div>
                            <?php endforeach ?>

                            <?php foreach ($DatasImg as $DataImg) : ?>
                                <div class="carousel-item">
                                    <img class="d-block w-100 object-fit-contain product-detail-img" src="img/img-product/img-detail/<?php echo $DataImg->TenHinhAnh ?>">
                                </div>
                            <?php endforeach ?>

                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <hr>
                    <div class="mt-4 row mb-2">
                        <div class="col-6 mb-3">
                            <i class="fa fa-check-circle-o text-primary text-large" aria-hidden="true"></i>
                            Hư gì đổi nấy <b>12 tháng</b>.
                        </div>
                        <div class="col-6 mb-3 text-right">
                            <i class="fa fa-shirtsinbulk text-primary text-large" aria-hidden="true"></i>
                            Bảo hành chính hãng <b>12 tháng</b>.
                        </div>
                        <div class="col-6 mb-3">
                            <i class="fa fa-archive text-primary text-large" aria-hidden="true"></i>
                            Bộ sản phẩm gồm: Hộp, Sách hướng dẫn, Cây lấy sim, Cáp Type C.
                        </div>
                    </div>
                </div>
                <!-- Product Image -- END -->

                <!-- Product Name & Price -- START -->
                <?php foreach ($Datas as $Data) : ?>
                    <div class="col-md-5 mb-2">
                        <div class="bg-white">
                            <p class="text-product-name"><?php echo $Data->TenHangHoa ?></p>
                            <p class="text-warning">
                                <i class="fa fa-star " aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            </p>
                            <p class="text-muted text-old-price"><del><?php echo money_format($Data->Gia)  ?>VNĐ</del></p>
                            <p class="text-danger text-new-price"><?php echo money_format($Data->KhuyenMai)  ?>VNĐ</p>
                            <div class="mb-2">
                                <form action="cart.php" method="POST">
                                    <div class="form-group">
                                        <label for="soluong" style="font-size: 18px;">Số lượng :</label>
                                        <div class="row">
                                            <div class="col-lg-12" style="padding-right: 30px;">
                                                <input type="number" name="soluong[<?= $id ?>]" id="soluong" class="form-control" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top:5px ;">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-primary" name="datmua" style="width: 100%;">
                                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;Đặt Mua
                                            </button>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-danger" name="giohang" style="width: 100%;">
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;Thêm Vào Giỏ Hàng
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="border border-warning mt-4">
                                <div class="bg-warning text-white text-center py-1">
                                    Khuyến mãi
                                </div>
                                <p class="p-3 mb-0"> <i class="fa fa-gift text-danger" aria-hidden="true"></i>
                                    Tặng cho khách lần đầu mua hàng online tại web GMShop.com:
                                <ul class="mb-0 px-5">
                                    <li>Mã giảm 20% tối đa 100.000đ</li>
                                    <li>FREEship đơn hàng từ 300.000đ</li>
                                </ul>
                                </p>
                                <p class="p-3 mb-0"> <i class="fa fa-gift text-success" aria-hidden="true"></i>
                                    Áp dụng tại Tp.HCM và 1 số khu vực, 1 SĐT nhận 1 lần.
                                    Tặng suất mua xe đạp Giảm đến 30% (không kèm KM khác).
                                </p>
                            </div>

                        </div>
                    </div>
                <?php endforeach ?>
                <!-- Product Name & Price -- END -->

                <!-- Product Infomation -- START -->
                <div class="col-12 my-2">
                    <button class="btn btn-primary btn-product-detail shadow-none" type="button" data-toggle="collapse" data-target="#product-introduction" aria-expanded="false" aria-controls="collapse-one" id="btn-introduction">
                        Giới thiệu sản phẩm
                    </button>

                    <!-- Product Introduction -- START -->
                    <div class="collapse show" id="product-introduction">
                        <div class="card card-body pb-0 mb-3" style="border-top-left-radius: 0;">
                            <div class="text-product-intro">
                                <h5 class="text-title"><b><span class="text-primary"><?= $Data->TenHangHoa ?></span>
                                    </b></h5>
                                <p><?= $Data->MoTa ?></p>

                                <img src="img/img-product/thumbnail/<?php echo $Data->Thumbnail ?>" class="d-block w-100 product-info-img object-fit-contain py-3">

                                <img src="img/img-product/img-detail/<?php echo $DataImg->TenHinhAnh ?>" class="d-block w-100 product-info-img object-fit-contain py-3">
                                </p>


                            </div>
                        </div>
                    </div>
                    <!-- Product Introduction -- END -->

                </div>
                <!-- Product Infomation -- END -->

            </div>
        </div>
    </div>
    <!-- Product Details -- END -->

    <?php include('../partials/footer.php') ?>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/checkInput.js"></script>

</body>

</html>