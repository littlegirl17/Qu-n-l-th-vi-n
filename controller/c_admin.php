<?php
    include_once 'config.php';
    include_once 'model/m_book.php';
    include_once 'model/m_history.php';
    include_once 'model/m_user.php';
    include_once 'model/m_category.php';
    
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'dashboard':
                $sosach = book_count();
                $sobandoc = user_count();
                $sochude = category_count();
                $solichsu = history_count();

                $thongkechude = catagory_thongkebook();
                $view_name = 'admin_dashboard';
                break;
            case 'user':
                $dstk = user_getAlladmin();
                $view_name = 'admin_user';
                break;
            //ADD USER
            case 'user-add':
                //Kiem tra nguoi ta da submit du lieu len chua
                if(isset($_POST['submit'])){
                    $SoDienThoai = $_POST['SoDienThoai'];
                    $HoTen = $_POST['HoTen'];
                    $ViTien = $_POST['ViTien'];
                    $Quyen = $_POST['Quyen'];
                    $kq = user_checkphone($SoDienThoai); //Check trung sdt , nghia la nguoi dung them tai khhoan thi khong duoc trung voi sdt da co trong database
                    if($kq){ // vi day la kq cua sdt
                        //ddungs, sdt da co, sdt bi trung, khong duoc them user
                        $_SESSION['loi'] = 'So dien thoai'.$SoDienThoai.'da duoc su dung';
                    }else{
                        $MatKhau='12345'; //Tại vì mình là admin, mình tạo tài khoản mình sẽ không nhập mật ,Mình để 12345 để người ta tự đăng nhập vào người ta đổi 
                        $HinhAnh = 'ava_user.jpeg'; //Hình ảnh: mình cũng để cho người ta hình mặc định luôn , sau này người ta tự vào sửa lại
                        //sai,khong trung, co the dang ky
                        user_add($SoDienThoai,$HoTen,$MatKhau,$ViTien,$Quyen,$HinhAnh);
                        $_SESSION['thongbao'] = 'Da tao tai khoan voi sdt<strong>'.$SoDienThoai.'</strong>vaf mat khau mac dinh<strong>'.$MatKhau.'</strong>';
                    }
                }
                $view_name = 'admin_user_add';
                break;
                
            case 'user-edit':
                $MaTK = $_GET['id'];
                if(isset($_POST['submit'])){
                    $SoDienThoai = $_POST['SoDienThoai'];
                    $HoTen = $_POST['HoTen'];
                    $ViTien = $_POST['ViTien'];
                    $Quyen = $_POST['Quyen'];
                    $kq = user_checkphone($SoDienThoai); //Check trung sdt , nghia la nguoi dung them tai khhoan thi khong duoc trung voi sdt da co trong database
                    if($kq && $kq['MaTK'] != $MaTK){//Số đó co rồi VÀ số đó(là số của người nào dó trong DB của mình) KHÁC VỚI số của MaTk mình đang sửa (true-Người ta- Của Mình)
                        //ddungs, sdt da co, sdt bi trung, khong duoc sua user
                        $_SESSION['loi'] = 'Đã tồn tại số điện thoại'.$SoDienThoai;
                    }else{
                        $ee=user_edit($MaTK,$SoDienThoai,$HoTen,$ViTien,$Quyen);
                        $_SESSION['thongbao'] = 'Thông tin thay đổi đã được lưu lại';
                        //header("index.php?mod=admin&act=user");

                    }
                }
                $tk = user_getbyid($MaTK);
                $view_name = 'admin_user_edit';
                break;

            case 'user-delete':
                $MaTK = $_GET['id'];
                user_delete($MaTK);
                header("location: index.php?mod=admin&act=user");
                break;
            case 'catagory':
                $view_name = 'admin_catagory';
                break;
            case 'book':
                $view_name = 'admin_book';
                break;
            case 'history':
                $view_name = 'admin_history';
                break;
                               
            default:
                header('location: index.php?mod=page&act=home');
                break;
        }
        include_once 'view/v_admin_layout.php';
    }else{
        header('location: index.php?mod=page&act=home');
    }

?>