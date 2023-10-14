<h2 class="my-3">THÊM TÀI KHOẢN</h2>
<?php if(isset($_SESSION['loi'])):?>
    <div class="alert alert-danger" role="alert">
        <?=$_SESSION['loi']?>
    </div>
<?php endif; unset($_SESSION['loi']); ?>
<?php if(isset($_SESSION['thongbao'])):?>
    <div class="alert alert-success" role="alert">
        <?=$_SESSION['thongbao']?>
    </div>
<?php endif; unset($_SESSION['thongbao']); ?>

<form action="" method="post">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" name="SoDienThoai" id=""  >
        </div>
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
        <input type="text" class="form-control" name="MatKhau" id=""  >
        </div>
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Họ tên</label>
        <input type="text" class="form-control" name="HoTen" id=""  >
        </div>
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Ví tiền</label>
        <input type="text" class="form-control" name="ViTien" id=""  >
        </div>
        
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Quyền truy cập</label>
        <select class="form-select" aria-label="Default select example" name="Quyen">
            <option value="0" selected>Người đọc</option>
            <option value="1">Quản lý</option>
            <option value="2">Quản lý cAP cao</option>
        </select>
    </div>
    <input type="submit" name="submit" class="btn custom-btn  " value="Xác nhận">
</form>