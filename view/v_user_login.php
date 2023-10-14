
        <!-- MAIN -->
    <div class="col-md-3 mt-3">
        <form action="index.php?mod=book&act=search" method="POST">
        <!-- TÌM KIẾM -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sách" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline custom-btn" type="button" id="button-addon2">Tìm kiếm</button>
            </div>
        </form>
        <!-- LIST DANH MỤC SÁCH -->
        <ul class="list-group">
            <li class="list-group-item custom-backround" aria-current="true">Top 10 sách được mượn nhiều</li>
            <?php
                foreach($dsSachTop10 as $sach): 
                    extract($sach);
            ?>
            <li class="list-group-item"><?=$TuaSach?></li>
            <?php
                endforeach;
            ?>
        </ul>
    </div>
            <!-- BOX RIGHT '9' MAIN -->
            <div class="col-md-9 mt-5">
                <!-- LOGIN -->
                <h2>Đăng nhập</h2>
                <?php if(isset($_SESSION['loi'])):?><!--Kiểm tra biến thông báo lỗi-->
                    <div class="alert alert-danger" role="alert">
                        <?=$_SESSION['loi']?>
                    </div>
                <?php endif; unset($_SESSION['loi']); ?> <!--Và nếu nó thông báo lỗi xong rồi thì xóa nó đi, nếu ko nó sẽ hiện hoài như dậy á -->
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                        <input type="text"  name="SoDienThoai" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <input type="password" name="MatKhau" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn custom-btn">Đăng nhập</button>
                </form>
                
            </div>
        </div>

    