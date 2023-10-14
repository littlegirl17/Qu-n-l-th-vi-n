<?php
    include_once 'config.php';
    include_once 'model/m_book.php';
    include_once 'model/m_category.php';
    //print_r($_GET);
    //Điều hướng đến controller
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'detail':
                $namedetailcata = detail_catagorybyid($_GET['id']); //Này dựa vào MaCD(chude) lấy ra TenChuDe 
                $sachtheocatagoryid = book_getcatagoryid($_GET['id']); //Dựa vào MaCD(sach) để lấy ra toàn bộ sách cùng danh mục
                $view_name = 'category_detail';
                break;
            
            default:
                // header('location: index.php');
            
                break;
        }
        include_once 'view/v_user_layout.php';
    }else{
        header('location: index.php');
    }
?>