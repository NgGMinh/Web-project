<?php
require_once '../bootstrap.php';
require_once 'function/format-money.php';

use CT275\Labs\Data;

$Data = new Data($PDO);
$Datas = $Data->selectPhone();

if (session_id() === '')
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Datas</title>

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
    <link href="css/sticky-footer.css" rel=" stylesheet">
    <link href="css/basic.css" rel=" stylesheet">
    <link href="css/font-awesome.min.css" rel=" stylesheet">
    <link href="css/animate.css" rel=" stylesheet">
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
                        <a class="nav-link text-white hover-btn active-btn" href="smartphone.php">
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
                <a href="smartphone.php" class="active text-dark">
                    Điện Thoại
                </a>
            </li>
        </ol>
    </nav>

    <!-- List Product -- START -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bg-primary p-2 rounded">
                    <h5 class="m-0 p-0 text-white text-center text-md-left">Danh Sách Sản Phẩm</h5>
                </div>
            </div>
        </div>
    </div>

    <div id="show_list_product" class="container mb-1 px-md-3 py-1">
        <div class="container bg-change rounded px-4 px-md-2 py-0">
            <div class="row padding-change">
                <?php foreach ($Datas as $Data) : ?>
                    <div class="col-12 col-sm-6 col-md-3 card p-0 hover-product rounded" style="width: 18rem;">
                        <a href="product-detail.php?idhh=<?php echo $Data->getIDHangHoa() ?>" class="a-product text-center">
                            <img class="card-img-top mx-auto image-top-product object-fit-contain w-100 pt-4" src="img/img-product/thumbnail/<?php echo $Data->Thumbnail ?>" alt="Card image cap">
                            <hr class="mt-4" />
                            <div class="card-body pt-0 mb-5">
                                <div class="div-discount">
                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                    <span>Khuyến mãi</span>

                                </div>
                                <div class="text-center">
                                    <span class="text-name-product py-0 px-2">
                                        <?php echo $Data->TenHangHoa ?>
                                    </span>
                                    <br />
                                    <p class="text-warning my-1">
                                        <i class="fa fa-star " aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    </p>
                                    <small class="text-price-old text-muted">
                                        <?php echo money_format($Data->Gia)  ?>
                                    </small>
                                    <p class="text-price-new">
                                        <?php echo money_format($Data->KhuyenMai)  ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <!-- List Product -- END -->



    <?php include('../partials/footer.php') ?>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/checkInput.js"></script>
</body>

</html>