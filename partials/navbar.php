<nav id="nav-header" class="navbar navbar-expand-lg navbar-dark bg-primary mb-1 p-1">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fa fa-bandcamp" aria-hidden="true"></i> KM Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <form class="form-inline my-2 my-lg-0" method="GET" action="search.php">
                <div class="input-group w-100">
                    <div class="input-group-append">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." name="name">
                            <button class="btn btn-primary active-btn rounded-0" type="submit" name="search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item text-nav-item ">
                    <a class="nav-link text-white hover-btn" href="about.html">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        Giới Thiệu
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white hover-btn" href="cart.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng
                    </a>
                </li>
                <li class="nav-item active">
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<li class="dropdown" ><a href="#" class="dropdown-toggle nav-link text-white hover-btn" data-toggle="dropdown">' . $_SESSION['user'] . '<span class="caret"></span></a>
                                            <ul class="dropdown-menu" style="font-size: 15px;">
                                                <li align= "center" ><a href="logout.php" style="text-decoration:none">ĐĂNG XUẤT</a></li>
                                            </ul>
                                           </li>';
                    } else if (empty($_SESSION['email'])) {
                        echo '<a class="nav-link text-white hover-btn" href="#" data-toggle="modal" data-target="#modal-login">
                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span>Đăng nhập</span>
                    </a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Login -- START -->
<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block ">
                <span class="modal-title pl-4" id="exampleModalLongTitle">
                    <b style="font-size: 1.4rem;" class="text-primary">Đăng Nhập</b>
                </span>
                <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmDangNhap" action="login.php" method="POST">
                    <div class="form-group mb-2">
                        <label for="email" class="col-form-label text-content-modal">
                            Email
                        </label>
                        <input type="text" class="form-control input-login" name="email" id="email">
                        <small id="login-email-error" class="form-text text-error"></small>

                        <label for="matkhau" class="col-form-label text-content-modal">
                            Mật Khẩu
                        </label>
                        <input type="password" class="form-control input-login" name="matkhau" id="matkhau">
                        <small id="login-password-error" class="form-text text-error mb-3"></small>

                        <input type="checkbox" name="chkRemember" id="chkRemember">
                        <label for="chkRemember" class="text-content-modal">
                            &nbsp;Nhớ mật khẩu
                        </label>
                    </div>
                    <div class="text-center mb-3">
                        <button id="login" name='login' type="submit" class="btn btn-primary w-100 p-1">
                            Đăng Nhập
                        </button>
                    </div>
                    <div class="text-right mb-2">
                        Chưa có tài khoản?
                        <a class="text-content-modal" id="dangky" data-toggle="modal" data-target="#modal-register" style="cursor: pointer">
                            Đăng ký
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal Login -- END -->

<div class="modal fade" id="modal-register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center d-block ">
                <span class="modal-title pl-4" id="exampleModalLongTitle">
                    <b style="font-size: 1.4rem;" class="text-warning">Đăng Ký</b>
                </span>
                <button type="button" class="close" id="modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="register.php">
                    <div class="form-group" id="hienthihoten_register">
                        <label for="hoten_register">Họ tên</label>
                        <input type="hoten_register" name="hoten_register" id="hoten_register" class="form-control" placeholder="Nhập họ tên của bạn">
                        <span id="x_hoten_register"></span>
                    </div>
                    <div class="form-group" id="hienthiemail_register">
                        <label for="email_register">Email</label>
                        <input type="email_register" name="email_register" id="email_register" class="form-control" placeholder="Nhập Email của bạn">
                        <span id="x_email_register"></span>
                    </div>
                    <div class="form-group" id="hienthimatkhau_register">
                        <label for="matkhau_register">Mật khẩu</label>
                        <input type="password" name="matkhau_register" id="matkhau_register" class="form-control" placeholder="Mật khẩu phải chứa ít nhất một chữ cái và một chữ số">
                        <span id="x_matkhau_register"></span>
                    </div>
                    <div class="form-group" id="hienthinhaplaimatkhau_register">
                        <label for="nhaplaimatkhau_register">Nhập lại mật khẩu</label>
                        <input type="password" name="nhaplaimatkhau_register" id="nhaplaimatkhau_register" class="form-control">
                        <span id="x_nhaplaimatkhau_register"></span>
                    </div>

                    <div class="form-group" id="hienthidiachi">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" name="diachi" id="diachi" class="form-control" placeholder="Nhập địa chỉ của bạn">
                        <span id="x_diachi"></span>
                    </div>

                    <div class="form-group" id="hienthidienthoai">
                        <label for="dienthoai">Điện thoại</label>
                        <input type="text" name="dienthoai" id="dienthoai" class="form-control" placeholder="Nhập số điện thoại của bạn">
                        <span id="x_dienthoai"></span>
                    </div>
                    <button type="submit" class="btn btn-warning text-white" name="register" id="register" style="width: 100%;">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>