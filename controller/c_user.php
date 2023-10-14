<?php
    include_once 'config.php';
    include_once 'model/m_book.php';
    include_once 'model/m_user.php';
    
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'login':
                //Kiểm tra người ta có gửi sđt với mật khẩu lên form của mình không
                if(isset($_POST['SoDienThoai']) && isset($_POST['MatKhau'])){
                    $kq = user_login($_POST['SoDienThoai'],$_POST['MatKhau']); 

                    if($kq){
                        //nếu kết quả đúng, thì đăng nhập thành công chuyển về trang chủ
                        $_SESSION['user'] = $kq;//Lưu lại thông tin đăng nhập(Mình đã lấy được)
                        header("location: index.php?mod=page&act=home");
                    }else{
                        //Nếu kết quả trả về sai thì hiện thông báo lỗi
                        $_SESSION['loi'] = "Số điện thoại hoặc mật khẩu không đúng ";
                    }
                }
                $view_name = 'user_login';
                
                break;
            case 'logout':
                unset($_SESSION['user']);
                header("location: index.php?mod=page&act=home");
                $view_name = '';
                break;
            case '':
                $view_name = '';
                break;
            case '':
                $view_name = '';
                break;
            case '':
                $view_name = '';
                break;
            default:
                header('location: index.php?mod=page&act=home');
                break;
        }
        include_once 'view/v_user_layout.php';
    }else{
        header('location: index.php?mod=page&act=home');
    }

?>