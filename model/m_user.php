<?php
    include_once 'model/m_pdo.php';

    function user_login($phone,$pass){
        return pdo_query_one("SELECT * FROM taikhoan WHERE SoDienThoai = ? AND MatKhau = ?",$phone,$pass);
    }//Khi đăng nhập chỉ lấy được 1 tài khoản ra

    //admin - lay het tat ca du lieu trong bang tai khoan ra
    function user_getAlladmin(){
        return pdo_query("SELECT * FROM taikhoan");
    }

    //check phone - Kiem tra sdt co trung hay khong->minh moi truy van lay ra sdt do thu
    function user_checkphone($SoDienThoai){
        return pdo_query_one("SELECT * FROM taikhoan WHERE SoDienThoai=?",$SoDienThoai);
    }

    //add user 
    function user_add($SoDienThoai,$HoTen,$MatKhau,$ViTien,$Quyen,$HinhAnh){
        pdo_execute("INSERT INTO taikhoan (`SoDienThoai`,`HoTen`,`MatKhau`,`ViTien`,`Quyen`,`HinhAnh`) VALUES (?,?,?,?,?,?)",$SoDienThoai,$HoTen,$MatKhau,$ViTien,$Quyen,$HinhAnh);
    }

    //Lay thong tin user ve
    function user_getbyid($MaTK){
        return pdo_query_one("SELECT * FROM taikhoan WHERE MaTK=?",$MaTK);
    }

    //Cap nhat lai thong tin moi cua user
    function user_edit($MaTK,$SoDienThoai,$HoTen,$ViTien,$Quyen){
        pdo_execute("UPDATE taikhoan SET SoDienThoai=?, HoTen=?, ViTien=?, Quyen=? WHERE MaTK=?",$SoDienThoai,$HoTen,$ViTien,$Quyen,$MaTK);
    }

    //Xoa user
    function user_delete($MaTK){
        pdo_execute("DELETE FROM taikhoan WHERE MaTK=?",$MaTK);
    }

    //
    function user_count(){
        return pdo_query_value("SELECT COUNT(*) FROM taikhoan WHERE Quyen=0");
    }
?>