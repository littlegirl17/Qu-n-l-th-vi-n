<?php
    include_once 'model/m_pdo.php';
    function commnet_add($MaTK,$MaSach,$NoiDung){
        pdo_execute("INSERT INTO camnghi(`MaTK`,`MaSach`,`NoiDung`) VALUES(?,?,?)",$MaTK,$MaSach,$NoiDung);
    }

    function get_bybookcomment($MaSach){
        return pdo_query("SELECT * FROM camnghi cn INNER JOIN taikhoan tk ON cn.MaTK = tk.MaTK WHERE cn.MaSach=?",$MaSach);
    }
?>