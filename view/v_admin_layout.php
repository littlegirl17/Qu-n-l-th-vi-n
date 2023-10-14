<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thu vien city</title>
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <!--Font awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body class="container-fluid">
    <div class="row justify-content-center">
      <!-- CỘT 1 LEFT -->
        <div class="col-md-2 p-0 collapse collapse-horizontal show custom-backround-admin" id="openmenu" style="min-height: 100vh;">
          <a class="navbar-brand d-block fs-5 px-4 mt-5 mb-2" href="#" style="color: white;"><i class="fa-solid fa-house"></i> TRANG QUẢN LÝ</a>
          <table class="table border-top">
              <tr>
                <td scope="col" class="border-0 px-4"><i class="fa-solid fa-gauge"></i> <a href="index.php?mod=admin&act=dashboard" class="text-decoration-none <?=(strpos("$view_name","dashboard")>0) ? 'active':''?>">TỔNG QUAN</a></td>
              </tr>
              <tr>
                <td scope="col" class="border-0 px-4"><i class="fa-solid fa-user"></i><a href="index.php?mod=admin&act=user" class="text-decoration-none <?=(strpos("$view_name","user")>0) ? 'active':''?>"> TÀI KHOẢN</a></td>
              </tr>
              <tr>
                <td scope="col" class="border-0 px-4"><i class="fa-solid fa-list"></i><a href="index.php?mod=admin&act=catagory" class="text-decoration-none <?=(strpos("$view_name","catagory")>0) ? 'active':''?>"> CHỦ ĐỀ</a></td>
              </tr>
              <tr>
                <td scope="col" class="border-0 px-4"><i class="fa-solid fa-book"></i><a href="index.php?mod=admin&act=book" class="text-decoration-none <?=(strpos("$view_name","book")>0) ? 'active':''?>"> SÁCH</a></td>
              </tr>
              <tr>
                <td scope="col" class="border-0 px-4"><i class="fa-solid fa-book"></i><a href="index.php?mod=admin&act=history" class="text-decoration-none <?=(strpos("$view_name","history")>0) ? 'active':''?>"> Muon/Tra</a></td>
              </tr>
          </table>
        </div>
      <!-- CỘT 2 MAIN -->
        <div class="col-md-10 p-0 ">
            <nav class="navbar navbar-expand-lg  custom-backround-admin ">
                <div class="container-fluid ">
                    <button class="btn btn-outline-light " type="button" data-bs-toggle="collapse" data-bs-target="#openmenu" aria-expanded="false" aria-controls="collapseExample">
                      <i class="fa-solid fa-bars"></i>
                    </button>
                    <a class="navbar-brand px-3 text-light" href="#">ADMIN THƯ VIỆN THÀNH PHỐ HCMLIB</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            xin chao, <?=$_SESSION['user']['HoTen'] ?>
                          </a>
                          <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="index.php?mod=page&act=home"><i class="fa-solid fa-house"></i> Xem trang chủ</a></li>
                            <li><a class="dropdown-item" href="index.php?mod=user&act=logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                            <li><hr class="dropdown-divider"></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <?php
                    include_once "view/v_".$view_name.".php";
                ?>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


