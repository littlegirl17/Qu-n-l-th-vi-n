<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện Thành Phố</title>
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <!--Font awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="view/css/style.css ">
</head>
<body>
    <nav class="navbar navbar-expand-lg  custom-navbar-bg">
        <div class="container">
            <a class="navbar-brand" href="index.php?mod=page&act=home">logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- left -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?mod=page&act=home">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Chủ đề
                        </a>
                        <ul class="dropdown-menu">
                        <?php
                            foreach($danhsachchude as $chude): 
                                extract($chude);
                        ?>
                            <li><a class="dropdown-item" href="index.php?mod=category&act=detail&id=<?=$chude['MaCD']?>"><?=$TenChuDe?></a></li>
                        <?php
                            endforeach;
                        ?>
                        </ul>
                    </li>
                </ul>

                <!-- right -->
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " href="?mod=page&act=cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <div class="mb-1">Giỏ sách</div> <!--margin-bottom -->
                        </a>
                    </li>
                    
                    <?php if(!isset($_SESSION['user']) && empty($_SESSION['user'])): ?> <!-- Nếu mà nó chưa tồn tại session['user'] thì mình cho nó hiện "Đăng Nhạp lên cho mình đăng nhập vào" -->
                        <a class="nav-link dropdown-toggle" href="?mod=user&act=login" >Đăng nhập</a>     <!-- <a class="nav-link dropdown-toggle" href="?mod=user&act=login" role="button" data-bs-toggle="dropdown" aria-expanded="false">Đăng nhập</a> -->
                    <?php else: ?> <!-- chỗ này là else (nếu nó tồn tại thì hiện lên -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(isset($_SESSION['user'])): ?>
                        xinchao,<?=$_SESSION['user']['HoTen']?></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">thong tin taikhoan</a></li>
                            <li><a class="dropdown-item" href="#">lich su muon sach</a></li>
                            <!-- Chỉ hiện ra khi nó co quyền là quản lý -->
                                <?php if($_SESSION['user']['Quyen']>=1): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-warning" href="index.php?mod=admin&act=dashboard">Trang quản lý </a></li>
                                <?php endif; ?>
                            <!-- END -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?mod=user&act=logout">Đăng xuất</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <?php if($view_name=='page_home' || $view_name=='user_login'): ?>
            <div class="col-md-8">
                <div id="carouselExample" class="carousel slide my-3 ">
                    <div class="carousel-inner mt-5">
                        <div class="carousel-item active ">
                            <img src="view/upload/slide/slide1.png" class="d-block w-100 " alt="...">
                        </div>
                        <div class="carousel-item ">
                            <img src="view/upload/slide/slide3.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item ">
                            <img src="view/upload/slide/slide2.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="carousel-item-banneritem mt-5">
                    <img src="view/upload/slide/slide3.png" class="" alt="...">
                </div>
                <div class="carousel-item-banneritem mt-3">
                    <img src="view/upload/slide/slide2.png" class="" alt="...">
                </div>
            </div>
            <?php endif; ?>
        </div>
        <!-- MAIN -->
        <div class="row">
            <?php //mình sẽ truyền vào cái biến để bên kia nó truyền vào cái biến nào thì nó sẽ auto điền cái tên đó vào biến trong này
                include_once 'view/v_'.$view_name.'.php'; //để cho dữ liệu chính của box sản phẩm đổ vào đây
            ?>
        </div>
        <!-- FOOTER -->
        <div class="row border-top mt-5">
            <div class="col-md-3 mt-3">
                <div class="card w-100 border-0" >
                    <img src="view/upload/slide/logo.png" class="card-img-top w-50" alt="...">
                    <div class="card-body">
                        <p class="card-text">HCMlibrary.com nhận đặt hàng trực tuyến và giao hàng tận nơi. KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại văn phòng cũng như tất cả Hệ Thống Fahasa trên toàn quốc.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9 mt-3">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">DỊCH VỤ</th>
                            <th scope="col">HỖ TRỢ</th>
                            <th scope="col">TÀI KHOẢN CỦA TÔI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Điều khoản sử dụng</td>
                            <td>Chính sách đổi - trả - hoàn tiền</td>
                            <td>Đăng nhập/Tạo mới tài khoản</td>
                        </tr>
                        <tr>
                            <td>Giới thiệu Fahasa</td>
                            <td>Chính sách bảo hành - bồi hoàn</td>
                            <td>Chi tiết tài khoản</td>
                        </tr>
                        <tr>
                            <td>Hệ thống trung tâm - nhà sách</td>
                            <td>Chính sách vận chuyển</td>
                            <td>Lịch sử </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="text-center border-top p-3">ban quyen &copy; 2023, thuoc ve thu vien thanh pho</footer>
    </div>
    <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

