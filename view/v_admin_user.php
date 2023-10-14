
<a href="index.php?mod=admin&act=user-add" class="btn custom-btn float-end">Thêm tài khoản</a>
                <h2 class="my-3">TÀI KHOẢN</h2>
                <div class="row">
                    <table class="table text-center">
                        <thead>
                            <tr >
                                <th>Mã</th>
                                <th>ẢNH SÁCH</th>
                                <th >HỌ TÊN</th>
                                <th>PHONE</th>
                                <th>QUYỀN</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($dstk as $ds): ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><img src="view/upload/avatar/<?=$ds['HinhAnh']?>" alt="" style="width:50px;"></td>
                                <td><?=$ds['HoTen']?></td>
                                <td><?=$ds['SoDienThoai']?></td>
                                <td class="">
                                    <?php switch ($ds['Quyen']){
                                        case '2':
                                            echo '<span class="badge text-bg-danger my-3">Quan ly cap cao</span>';
                                            break;
                                        case '1':
                                            echo '<span class="badge text-bg-success my-3">Quan ly </span>';
                                            break;
                                        case '0':
                                            echo '<span class="badge text-bg-primary my-3">Ban doc</span>';
                                            break;
                                    }
                                    ?>
                                <td>
                                    <a href="index.php?mod=admin&act=user-edit&id=<?=$ds['MaTK']?>" class=" btn btn-danger">sua</a> 
                                    <button onclick="delete_user(<?=$tk['MaTK']?>)" class=" btn btn-warning">xoa</button>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <script>
                    function delete_user($MaTK){ //Tham so MATK nay duoc lay tu $ds['MaTk]
                        var kq = confirm("Ban co muon xoa tai khoa nay khong?"); //Form duoc hien ra , neu nguoi ta bam XOA
                        if(kq){//Neu bam CHON OK la ket qua dung thif no se chuyen den cai case nay va xoa, bien MaTk duoc lay tu o tren Tham so truyen vao
                            window.location = 'index.php?mod=admin&act=user-delete&id='+MaTK;
                        }
                    }
                </script>