<?php
    include_once 'config.php';
    include_once 'model/m_book.php';
    include_once 'model/m_user.php';
    include_once 'model/m_history.php';
    include_once 'model/m_comment.php';
    //print_r($_GET);
    //Điều hướng đến controller
    if(isset($_GET['act'])){
        switch ($_GET['act']) {
            case 'detail':
                $luotxemchitietbook = book_viewplus($_GET['id']); //Cập nhật lượt xem, sau khi người dùng xem chi tiết 1 quyển sách nào đó thì nó tự cập nhật lượt xem// Và phải để lên đầu tiên
                $chitiet = book_getchitiet($_GET['id']); //Lấy ra chi tiết của 1 quyển sách
                $sachlienquan = book_getRandomBycata($chitiet['MaCD'],6); //Sách liên quan đến nhau, nhưng random, khi load lại trạng thì sách liên quan đến nhau sẽ được xếp vào
                $danhsachcamnghi = get_bybookcomment($_GET['id']);
                $view_name = 'book_detail';
                break;
            case 'search': //search sẽ cố định trong c_book, và khi dùng nhiều chỉ cần đặt FORMSEARCH ở nơi muốn đặt là được(vì khi tìm thì câu truy vấn nó sẽ lục và tìm ra kết quả, và trả kết quả về 1 trang search cho user )
                if(isset($_POST['keyword'])){
                    //Tác dụng là đổi từ POST sang GET
                    header("location: index.php?mod=book&act=search&keyword=".$_POST['keyword']);// chuyển POST thành GET: tại vì GET nó thường hiển thị dữ liệu -> dùng để hiện kết quả tì kiếm trên URL
                }
                //Chuyển trang
                $page = 1; //nếu chưa truyền thì mặc định cho ns bằng 1
                if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
                    $page = $_GET['page'];
                }
                $ketquasearch = book_search($_GET['keyword'],$page); //chuyển POST thành GET
                $sotrang = ceil(book_searchCount($_GET['keyword'])/8);

                $view_name = 'book_search'; //khi mình tiềm kiếm nó trả về trang kết quả search
                break;

            case 'addtocart':
                //Kiểm tra người dùng xem ông này đăng nhập chưa
                if(!isset($_SESSION['user'])){ 
                    //Nếu chưa đăng nhập
                    $_SESSION['loi'] = "Bạn cần đăng nhập trước khi mượn sách";
                    header("location: index.php?mod=user&act=login");
                    return;
                }

                $MaSach = $_GET['id']; //lấy từ link nãy mình truyền vào trong V_book_detail -> tại bắt cái id sẽ được mã sách (id=72) 
                $MaTK = $_SESSION['user']['MaTK']; //MãTK lấy từ session , nếu chưa đăng nhập thì kích ra
                
                //Hướng dẫn xử lý trùng khóa chính
                try { //ở trên là thử , không có lỗi thì ok
                    // Kiểm tra có giỏ hàng hay chưa?
                    $kq = kiemtra_giohang($MaTK);
                    if($kq){
                        //Đúng, và đã có giỏ sách ->Và tiến hành THÊM sách vào
                        add_booktocart($kq['MaLS'],$MaSach);//MaLS lấy ra từ kiemtra_giohang (vì lấy được thì nó có MaLS) //MaSach đã khai báo ở trên rồi
                    }else{
                        //Sai, chưa có giỏ sách -> Thì mình thêm cho user cái gio-sach
                        add_giohang($MaTK);
                        //Add giỏ sách xong thì mình add cuốn sách dô
                        $kq = kiemtra_giohang($MaTK);//Gọi lại lệnh này lần nữa để lấy được cái MaLS
                        add_booktocart($kq['MaLS'],$MaSach);//MaLS lấy ra từ kiemtra_giohang (vì lấy được thì nó có MaLS) //MaSach đã khai báo ở trên rồi
                    }
                    $_SESSION['thongbao'] = 'Đã thêm sách vào giỏ';
                } catch (\Throwable $th) { //Nếu có lỗi thì bắt lỗi
                    $_SESSION['loi']='Sách này đã có trong giỏ, vui lòng chọn sách khác';
                }
                
                header("location: index.php?mod=book&act=detail&id=$MaSach"); //Lỗi hay không lỗi gì mình cũng phải chuyển trang
                break;
            case 'updatecart': 
                //lấy dữ liệu
                $MaTK = $_SESSION['user']['MaTK']; //Phải đăng nhập mới mượn được
                //gọi lại hàm để kiểm tra xem có gio-sach hay chưa
                $giosach = kiemtra_giohang($MaTK);
                if($giosach){
                    //láy về từ form
                    $NgayMuon = date_format(date_create($_POST['NgayMuon']),"Y-m-d H:i:s"); //Ngày cũ là print ra nó có chữ T nên phải dùng 2 hàm date //date_creata, biến ngày mượn thành cái ngày, dùng date_format để định dạng lại theo chuẩn của csdl
                    $NgayTra = date_format(date_create($_POST['NgayTra']),"Y-m-d H:i:s");
                    $SoSachMuon = $_POST['SoSachMuon'];
                    $TongTien = $_POST['TongTien'];
                    $TrangThai = 'chuan-bi';
                    //Số sách sẽ được giẩm khi mình chuyển trạng thái ở đây
                    $detailgiosach = lichsu_getcart($MaTK);//Trong chi tiết này sẽ có tất cả các cuôn sách
                    //Lấy ra từng cuốn sách trong giỏ
                    foreach($detailgiosach as $sach){
                        book_giamsl($sach['MaSach']); //Giam từng cuôn sách trong giỏ
                        //print_r($detailgiosach); return;
                    }
                    lichsu_updatecart($giosach['MaLS'],$NgayMuon,$NgayTra,$SoSachMuon,$TongTien,$TrangThai);
                    $_SESSION['thongbao']='Yêu cầu mượn sách của bạn đã được tiếp nhận';
                }
                header("location: index.php?mod=page&act=cart");
                break;
            case 'removeformcart':
                //Kiểm tra có LOGIN chưa //kiểm tra có giỏ sách chưa
                $MaTK = $_SESSION['user']['MaTK'];
                $giosach = kiemtra_giohang($MaTK); 
                $MaSach = $_GET['id']; //Mã sách mà mình muốn sách
                if($giosach){
                    //Nếu có gio-sach thì thực hiện lệnh xóa
                    removeformcart($giosach['MaLS'],$MaSach);
                }
                header("location: index.php?mod=page&act=cart");

                break;
            case 'removeformcartall':
                $MaTK = $_SESSION['user']['MaTK'];
                $giosach = kiemtra_giohang($MaTK); 
                if($giosach){
                    removeformcartall($giosach['MaLS']);
                }
                header("location: index.php?mod=page&act=cart");
                break;
            case 'comment':
                $MaTK = $_SESSION['user']['MaTK'];
                $giosach = kiemtra_giohang($MaTK);
                if(isset($_POST['submit'])){
                    $MaSach = $_POST['MaSach'];
                    $NoiDung = $_POST['NoiDung'];
                    commnet_add($MaTK,$MaSach,$NoiDung);
                    header("location:index.php?mod=book&act=detail&id=$MaSach");
                }
                
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