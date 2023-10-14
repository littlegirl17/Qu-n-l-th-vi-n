<!-- MAIN -->
<div class="row mt-5">
            <!-- LEFT -->
            <div class="col-md-2 " >
                <div class="custom-height">
                    <img src="view/upload/product/<?=$chitiet['HinhAnh']?>" alt="Ảnh 1" width="100" class="img-fluid">
                </div>
                <div class="custom-height">
                    <img src="view/upload/product/<?=$chitiet['HinhAnh']?>" alt="Ảnh 2" width="100" class="img-fluid">
                </div>
                <div class=" custom-height">
                    <img src="view/upload/product/<?=$chitiet['HinhAnh']?>" alt="Ảnh 3" width="100" class="img-fluid">
                </div>
                <div class="custom-height">
                    <img src="view/upload/product/<?=$chitiet['HinhAnh']?>" alt="Ảnh 4" width="100" class="img-fluid">
                </div>
            </div>
            <!-- CENTER -->
            <div class="col-md-3 custom-height-large">
                <img src="view/upload/product/<?=$chitiet['HinhAnh']?>" alt="Ảnh 4" class="img-fluid ">
            </div>
            <!-- RIGHT -->
            <div class="col-md-7 px-5">
                <h5 class=" "><?=$chitiet['TuaSach']?></h5>
                <p class="text-danger fw-bold fs-3"><?=$chitiet['GiaTri']?> đ</p>
                <div class="row ">
                    <div class="col-md-6 ">
                        Tac gia:
                        <strong><?=$chitiet['TacGia']?></strong>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Chu de:
                            <strong><?=$chitiet['TenChuDe']?></strong>
                        </div> 
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6 ">
                        Lượt đọc:
                        <strong></strong>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Lượt xem:
                            <strong><?=$chitiet['LuotXem']?></strong>
                        </div> 
                    </div>
                </div>
                <div class="input-group my-3">
                    <input type="text" aria-label="First name" class="form-control custom-input" value="-">
                    <input type="text" aria-label="First name" class="form-control custom-input" value="1">
                    <input type="text" aria-label="First name" class="form-control custom-input" value="+">
                </div>
                <small >Còn <strong><?=$chitiet['SoLuong']?></strong> quyển trong thư viện</small><br>
                <a href="index.php?mod=book&act=addtocart&id=<?=$chitiet['MaSach']?>" class="btn btn-outline btn-lg mt-1 custom-btn" type="submit">Mượn sách</a>
                <?php if(isset($_SESSION['thongbao'])):?>
                    <div class="alert alert-success" role="alert">
                        <?=$_SESSION['thongbao']?>
                    </div>
                <?php endif; unset($_SESSION['thongbao']); ?>

                <?php if(isset($_SESSION['loi'])):?>
                    <div class="alert alert-danger" role="alert">
                        <?=$_SESSION['loi']?>
                    </div>
                <?php endif; unset($_SESSION['loi']); ?>
                <hr>
                <p class="my-3">
                <?=$chitiet['MoTa']?>
                </p>
            </div>
        </div>

        <!--CẢM NGHĨ CỦA BẠN ĐỌC-->
        <h2 class="mt-5 border-bottom">Cảm nghĩ của bạn đọc</h2>
        <?php foreach($danhsachcamnghi as $dscn): ?>
        <div class="row"><!--  mỗi bình luận sẽ là một row -->
            <div class="col-md-3">
                <strong><?=$dscn['HoTen']?></strong><br>
                <?=$dscn['NgayGui']?><br>
                Da muon 1 lan
            </div>
            <div class="col-md-9">
                <p><?=$dscn['NoiDung']?></p>
            </div>
            
        </div>
        <?php endforeach; ?>
            <form action="index.php?mod=book&act=comment" method="post">
                <input type="hidden" name="MaSach" value="<?=$chitiet['MaSach']?>" maxlength="255">
                <input type="text" name="NoiDung" placeholder="Bạn nghĩ gì về cuốn sách bạn đã mượn" class="form-control form-control-lg mt-3">
                <button type="submit" name="submit" class="btn btn-primary mt-3">Gửi cảm nghĩ</button>
            </form>
        <!--SẢN PHẨM LIÊN QUAN-->
        <h2 class="mt-5 border-bottom ">Sản phẩm liên quan</h2>
        <div class="row mt-3">
            <!-- col-sm-4: có nghĩa là ở màn hình nhỏ mình muốn nó hiện 3-box(12/4=3) -->
            
            <?php
                foreach($sachlienquan as $lq): extract($lq);
            ?>
            <div class="col-md-2 col-sm-4">
                <div class="card h-100">
                    <img src="view/upload/product/<?=$HinhAnh?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="#" class="text-decoration-none text-dark">
                            <h5 class="card-title text-sm"><?=$TuaSach?></h5>
                        </a>
                        <p class="text-danger fw-bold"><?=$GiaTri?> đ</p>
                        <a href="index.php?mod=book&act=detail&id=<?=$sach['MaSach']?>"><button type="button"  class="btn custom-btn w-50 m-3">Mượn</button></a>

                    </div>
                </div>
            </div>
            <?php
                endforeach;
            ?>
            
            
        </div>