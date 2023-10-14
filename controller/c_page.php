<?php
    include_once 'config.php';
    include_once 'model/m_book.php';
    include_once 'model/m_history.php';
    
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'home':
                //lấy dữ liệu
                $dsSachMoi = book_getnew(4);
                $dsSachNoiBat = book_getinnew(4);
                $dsSachTop10 = book_getdocnhieu(10);
                //hiển thị dữ liệu
                $view_name = 'page_home';
                break;
            case 'cart':
                //lấy dữ liệu
                $MaTK = $_SESSION['user']['MaTK']; //Phải đăng nhập mới mượn được
                //gọi lại hàm để kiểm tra xem có gio-sach hay chưa
                $giosach = kiemtra_giohang($MaTK);
                if($giosach){
                    //Nếu giosach đúng, là giỏ sách này nó có -> có thì mới hiển thị ra được
                    $detailgiosach = lichsu_getcart($MaTK);//MATK lấy từ session user
                }else{
                    //nếu không có thì cho nó mảng rỗng
                    $detailgiosach = []; //Mình làm dầy lúc foreach ra nó ít lỗi hơn
                }
                //hiển thị dữ liệu
                $view_name = 'page_cart';
                break;
            case 'history':
                $MaTK = $_SESSION['user']['MaTK'];
                $giosach = kiemtra_giohang($MaTK);
                if($giosach){
                    $dslichsu = lichsu_getall($MaTK);
                }else{
                    $dslichsu = "";
                    header("location:index.php?mod=user&act=login");
                    $_SESSION['loi']="Bạn cần đăng nhập trước khi xem lịch sử mượn sách";
                }
                $view_name = 'page_history';
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