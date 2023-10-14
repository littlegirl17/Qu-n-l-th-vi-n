
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

<form action="" method="POST">
    <div class="container">
        <h2 class="my-3">CHỈNH SỬA TÀI KHOẢN</h2>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="SoDienThoai" id="" value="<?=$tk['SoDienThoai']?>"  >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
            <input type="text" class="form-control" name="MatKhau" id="" value="<?=$tk['MatKhau']?>" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="HoTen" id=""  value="<?=$tk['HoTen']?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ví tiền</label>
            <input type="text" class="form-control" name="ViTien" id=""  value="<?=$tk['ViTien']?>">
        </div>
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Quyền truy cập</label>
            <select class="form-select" aria-label="Default select example" name="Quyen"> <!--Cai nao selected la cai do lua chon -->
                <option value="0" <?= ($tk['Quyen']==0)?'selected':''?> >Người đọc</option>
                <option value="1" <?= ($tk['Quyen']==1)?'selected':''?>>Quản lý</option>
                <option value="2" <?= ($tk['Quyen']==2)?'selected':''?>>Quản lý cc</option>
            </select>
        </div>
        <input type="submit" name="submit" class="btn custom-btn  " value="Xác nhận">
    </div>
</form>