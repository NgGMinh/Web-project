$(function () {
    $('#btn-order').on('click', function (e) {
        var name = $('#order-name').val();
        var email = $('#order-email').val();
        var address = $('#order-address').val();
        var phone = $('#order-phone').val();
        var error_point = 0;
        var regexp_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        var error_name = error_email = error_address = error_phone = "";
        if (name == "") {
            error_name = "Xin hãy nhập họ tên";
            error_point = 1;
        }
        if (email == "") {
            error_email = "Xin hãy nhập Email";
            error_point = 1;
        }
        else if (!regexp_email.test(email)) {
            error_email = "Email không hợp lệ";
            error_point = 1;
        }
        if (address == "") {
            error_address = "Xin hãy nhập địa chỉ";
            error_point = 1;
        }
        if (phone == "") {
            error_phone = "Xin hãy nhập số điện thoại";
            error_point = 1;
        }
        else if (isNaN(phone) || phone.length < 9 || phone.length > 11 ) {
            error_phone = "Số điện thoại không hợp lệ";
            error_point = 1;
        }
        if (error_point == 1){
            e.preventDefault(e);
            $('#order-name-error').text(error_name);
            $('#order-email-error').text(error_email);
            $('#order-address-error').text(error_address);
            $('#order-phone-error').text(error_phone);
        }
        else {
            alert('Đặt hàng thành công !!');
        }
    })
})




