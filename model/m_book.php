<?php
    //dùng để gửi nhận csdl
    include_once 'm_pdo.php';

    //Lấy ra sách mới
    function book_getnew($limit){
        return pdo_query("SELECT * FROM sach s INNER JOIN chude cd ON s.MaCD = cd.MaCD ORDER BY s.MaSach DESC LIMIT $limit");
    }

    //Lấy ra sách nổi bật
    function book_getinnew($limit){
        return pdo_query("SELECT * FROM sach s INNER JOIN chude cd ON s.MaCD = cd.MaCD WHERE GhimTrangChu = 1 LIMIT $limit");
    }

    //Lấy ra 10 quyển sách có lượt đọc nhiều nhất
    function book_getdocnhieu($limit){
        return pdo_query("SELECT * FROM sach s INNER JOIN chude cd ON s.MaCD = cd.MaCD ORDER BY LuotDoc DESC LIMIT $limit");
    }

    //Sản phẩm chi tiết
    function book_getchitiet($id){
        return pdo_query_one("SELECT * FROM sach s INNER JOIN chude cd ON s.MaCD = cd.MaCD WHERE MaSach = ? ", $id);
    }

    //Là lấy ngẫu nhiên sách cùng chủ đề sau mỗi lần reset chứ nó không cố đinh(tĩnh)
    function book_getRandomBycata($id){
        return pdo_query("SELECT * FROM sach WHERE MaCD = $id ORDER BY rand() LIMIT 6");
    }

    //Tăng lượt xem sau mỗi lần xem chi tiết của 1 quyển sách
    function book_viewplus($id){
        pdo_execute("UPDATE sach SET LuotXem = LuotXem + 1 WHERE MaSach = ? ", $id);
    }

    //Lấy ra sách cùng chủ đề// nó nằm bên controller catagory
    function book_getcatagoryid($id){
        return pdo_query("SELECT * FROM sach WHERE MaCD = ?",$id); //MaCD đây nằm trong bảng sach
    }

    //Tìm kiếm
    function book_search($keyword, $page=1){ //Mặc định nó sẽ gọi trang 1
        //Limit 0,5 nghĩa là bắt đầu từ 0 lấy 5 quyển sách , và trong DB thì LIMIT lấy từ số 0 đầu tiên
        //Trang 1 bắt đầu từ 0 : 0,1,2,3,4,5,6,7 (lấy 8 quyển)
        //Trang 2 bắt đầu từ 8 
        //Trang 3 bắt đầu từ 16
        //Thuật toán: (n-1)*8 ->(số trang - 1) * (số lượng sách cố định) = ra sự bắt đầu của số lượng trang
        $batdau = ($page - 1) * 8;
        return pdo_query("SELECT * FROM sach WHERE TuaSach LIKE '%$keyword%' LIMIT $batdau,8");
    }

    //Hàm này dùng để đếm tất cả sản phẩm, để nó biết mà nó chia sản phẩm đó cho các trang
    function book_searchCount($keyword){
        return pdo_query_value("SELECT COUNT(*) FROM sach WHERE TuaSach LIKE '%$keyword%'");//Đếm hết tất cả cuốn sách giống với cái Keyword của mình
    }

    //Hàm giả số lượng sách khi người dùng đã mượn thì nó phải giảm xuống
    function book_giamsl($MaSach){//giảm số lượng của cuốn sách nào đó
        pdo_execute("UPDATE sach SET SoLuong = SoLuong - 1 WHERE MaSach=?",$MaSach);
    }

    //Hàm tăng khi người ta trả cuốn sách lại thì mình tăng số lượng nó lên lại
    function book_tangsl($MaSach){
        pdo_execute("UPDATE sach SET SoLuong = SoLuong + 1 WHERE MaSach=?",$MaSach);
    }

    //
    function book_count(){
        return pdo_query_value("SELECT COUNT(*) FROM sach");
    }
?>