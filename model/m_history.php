<?php
    include_once 'model/m_pdo.php';

    //Bước 1: Viết hàm đầu tiên để kiểm tra xem NGƯỜI đó đã có cái giỏ hàng hay chưa
        function kiemtra_giohang($MaTK){
            return pdo_query_one("SELECT * FROM lichsu WHERE MaTK=? AND TrangThai=?",$MaTK,'gio-sach'); //1 người chỉ có 1 cái giỏ hàng-> lấy ra 1
        }

    //Bước 2:Thêm giỏ hàng vào(nếu chưa có giỏ hàng)
        function add_giohang($MaTK) {
            pdo_execute("INSERT INTO lichsu(`MaTK`, `NgayMuon`, `NgayTra`, `TrangThai`) VALUES(?, ?, ?, ?)", $MaTK, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 'gio-sach');
        }

    //Bước 3: Có giỏ hàng rồi thì mình sẽ thêm cuốn sách vào giỏ hàng
        function add_booktocart($MaLS,$MaSach){//Cụ thể là thêm vào bảng chi tiết lịch sử
            pdo_execute("INSERT INTO chitietlichsumuon(`MaLS`,`MaSach`) VALUES(?,?)", $MaLS,$MaSach);
        }

    //Bước 4:(buổi5)lấy ra hết tất cả cuốn sách-trong cái giỏ sách-của 1 tài khoản nào đó
    function lichsu_getcart($MaTK){ //lấy ra nhiều cuốn sách dựa trên MaTk
        return pdo_query("SELECT * FROM lichsu ls INNER JOIN chitietlichsumuon ct ON ls.MaLS = ct.MaLS INNER JOIN sach s ON ct.MaSach = s.MaSach WHERE ls.MaTK=? AND ls.TrangThai=?",$MaTK,'gio-sach');
    }

    //Xóa 1 sản phẩm -> Cần có mã sách để nó biết nó nhanajthoong tin về là xóa cuốn nào
    function removeformcart($MaLS,$MaSach){
        pdo_execute("DELETE FROM chitietlichsumuon WHERE MaLS=? AND MaSach=?",$MaLS,$MaSach);
    }
    
    //Vì nó là xóa hết nên nó không cần mã sách
    function removeformcartall($MaLS){
        pdo_execute("DELETE FROM chitietlichsumuon WHERE MaLS=? ",$MaLS);
    }

    //Hàm cập nhật bảng lịch sử
    function lichsu_updatecart($MaLS,$NgayMuon,$NgayTra,$SoSachMuon,$TongTien,$TrangThai){
        pdo_execute("UPDATE lichsu SET NgayMuon=?, NgayTra=?, SoSachMuon=?, TongTien=?, TrangThai=? WHERE MaLS=?",$NgayMuon,$NgayTra,$SoSachMuon,$TongTien,$TrangThai,$MaLS);
    }

    //Lấy ra tất cả thông tin bảng lịch sử theo cái tài khoản đó
    function lichsu_getall($MaTK){
        return pdo_query("SELECT * FROM lichsu WHERE MaTK=?",$MaTK);
    }

    //
    function history_count(){
        return pdo_query_value("SELECT COUNT(*) FROM lichsu ");
    }
?>  