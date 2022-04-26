$(function(){
    $('#register').on('click', function (e) {
        var email_register = $('#email_register').val();
        var hoten_register = $('#hoten_register').val();
        var diachi = $('#diachi').val();
        var dienthoai = $('#dienthoai').val();
        var matkhau_register = $('#matkhau_register').val();
        var nhaplaimatkhau_register = $('#nhaplaimatkhau_register').val();
        var btcq_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
        var btcq_matkhau = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        var btcq_sodienthoai = /^[0-9]{10,12}$/;
        if (hoten_register == "") {
            e.preventDefault();
            alert('Bạn chưa nhập họ tên');
        } else if (email_register == "") {
            e.preventDefault();
            alert('Bạn chưa nhập Email');
        } else if (btcq_email.test(email_register) == false) {
            e.preventDefault();
            alert('Email chưa hợp lệ');
        } else if (diachi == "") {
            e.preventDefault();
            alert('Bạn chưa nhập địa chỉ');
        }  else if (dienthoai == "") {
            e.preventDefault();
            alert('Bạn chưa nhập ngày sinh');
        } else if (btcq_sodienthoai.test(dienthoai) == false) {
            e.preventDefault();
            alert('Số điện thoại bạnz nhập chưa đúng');
        } else if (matkhau_register == "") {
            e.preventDefault();
            alert('Bạn chưa nhập mật khẩu');
        } else if (btcq_matkhau.test(matkhau_register) == false) {
            e.preventDefault();
            alert('Mật khẩu bạn nhập ít nhất phải có 8 ký tự và có một chữ cái và một chữ số');
        } else if (nhaplaimatkhau_register == "") {
            e.preventDefault();
            alert('Bạn chưa nhập lại mật khẩu');
        } else {
            alert('Bạn đã đăng ký thành công');
            window.location = ("index.php")
        }
    })
    $('#dangky').on('click', function () {
        $("#modal-close").trigger("click");
    })

    $('#login').on('click', function (e) {
        var email_login = $('#email').val();
        var matkhau_login = $('#matkhau').val();
        if (email_login == "") {
            e.preventDefault();
            alert('Bạn chưa nhập email');
        } else if (matkhau_login == "") {
            e.preventDefault();
            alert('Bạn chưa nhập mật khẩu');
        } else{
            alert('Đăng nhập thành công');

        }

    })

})
