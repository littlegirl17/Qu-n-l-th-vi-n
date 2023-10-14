<?php
    include_once 'model/m_pdo.php';

    function get_allchude(){
       return pdo_query("SELECT * FROM chude ORDER BY MaCD DESC");
    }
    
    //Lấy ra tên chủ đề thông qua điều kiện mã chủ đề
    function detail_catagorybyid($id){
        return pdo_query_one("SELECT * FROM chude WHERE MaCD = ?", $id);
    }

    // Thống kê chủ đề theo số lượng trong dashboard
    function category_count(){
        return pdo_query_value("SELECT COUNT(*) FROM chude ");
    }

    //Thống kê theo danh mục 
    function catagory_thongkebook(){
        return pdo_query("SELECT cd.MaCD, cd.TenChuDe, COUNT(s.MaSach) AS SoLuong, AVG(s.GiaTri) AS TrungBinh, MIN(s.GiaTri) AS ThapNhat, MAX(s.GiaTri) AS CaoNhat FROM chude cd LEFT JOIN sach s ON cd.MaCD = s.MaCD GROUP BY cd.MaCD, cd.TenChuDe");
    }
?>
