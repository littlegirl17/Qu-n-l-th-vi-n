<?php
    //Điều hướng đến controller
    include_once 'config.php';
    include_once 'model/m_book.php';
    include_once 'model/m_category.php';
    $dsSachTop10 = book_getdocnhieu(10);
    $danhsachchude = get_allchude(); //Tại vì trang này nó hiển thị cho hết các controlller
    if(isset($_GET['mod'])){
        switch ($_GET['mod']) {
            case 'page':
                $controller_name = 'page';
                break;
            case 'book':
                $controller_name = 'book';
                break;
            case 'user':
                $controller_name = 'user';
                break;
            case 'category':
                $controller_name = 'category';
                break;
            case 'admin':
                $controller_name = 'admin';
                break;
                
            default:
            
            header('location: index.php?mod=page&act=home');
                break;
        }
        include_once 'controller/c_'.$controller_name.'.php';//Mình chỉ cần include 1 lần, còn ở trên mimhf chỉ cần gọi biến và tên nó ra
    }else{
        header('location: index.php?mod=page&act=home');
    }
?>