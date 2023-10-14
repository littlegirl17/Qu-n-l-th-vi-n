<div class="container">
    <h2>Gior hàng</h2>
    <?php if(isset($_SESSION['thongbao'])):?>
        <div class="alert alert-success" role="alert">
            <?=$_SESSION['thongbao']?>
        </div>
    <?php endif; unset($_SESSION['thongbao']); ?>
    
    <form action="index.php?mod=book&act=updatecart" method="post">
        <!-- tại vì mình chưa tính nên nó chưa câp nhaạt được giá trị -->
        <input type="hidden" name="SoSachMuon" id="SoSachMuon"> <!-- Mình sẽ thục hiện đếm các TR  -->
        <input type="hidden" name="TongTien" id="TongTien"> <!-- Đã có trong quá trình tính tổng tiền  -->

        <div class="row">
            <div class="col-md-6">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Ngày dự kiến mượn</span>
                    <input type="datetime-local" name="NgayMuon" id="NgayMuon" onchange="tinhthanhtien()" value="<?=$giosach['NgayMuon']?>" class="form-control" >
                </div> <!--datetime-local: nó sẽ ra ngày giờ luôn // Đổ dữ liệu ra bằng value-->
            </div>
            <div class="col-md-6">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Ngày dự kiến trả</span>
                    <input type="datetime-local" name="NgayTra" id="NgayTra" onchange="tinhthanhtien()" value="<?=$giosach['NgayTra']?>" class="form-control" >
                </div>
            </div>
        </div> 
        <!-- MAIN -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <table class="table table-borderless text-center" id="giosach">
                        <thead class="border-bottom">
                            <tr>
                            <th>STT</th>
                            <th>ẢNH</th>
                            <th>TÊN</th>
                            <th>GIÁ SÁCH</th>
                            <th>GIÁ MƯỢN</th>
                            <th>THÀNH TIỀN</th>
                            <th>XÓA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($detailgiosach as $item): ?>
                            <tr>
                                <td ><?=$i?></td>
                                <td><img src="view/upload/product/<?=$item['HinhAnh']?>" alt="Ảnh 1" width="100" class="img-fluid"></td>
                                <td><?=$item['TuaSach']?></td>
                                <td><?=$item['GiaTri']?></td>
                                <td><?=max($item['GiaTri']*0.5/100,500)?></td> <!-- giá mượn = 0.5% giá trị quyển sách -->
                                <!-- Nó kêu tối thiểu là 500đ
                                    vd  max(1000,500): nếu nó tính ra 1000, thì nó sẽ lấy 1000
                                        max(450,500): thì nó vẫn lấy 500d, vì TỐI THIỂU CỦA THƯ VIÊN ĐƯA RA KHI MƯỢN LÀ 500, nên dù tính là 450, nhưng tối thiểu là 500, ĐÓ LÀ LÝ DO SỬ DUGJ HÀM MAX
                                -->
                                <td></td>
                                <td ><a href="?mod=book&act=removeformcart&id=<?=$item['MaSach']?>" class="btn custom-btn ">Xóa</a></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">TỔNG THÀNH TIỀN</th>
                                <th ></th>
                                <th ><a href="?mod=book&act=removeformcartall" class="btn custom-btn " >Xóa hết giỏ hàng</a></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        

        <!-- Button trigger modal -->
        <a class="btn custom-btn text-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Xác nhận mượn sách
        </a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bằng việc xác nhận mượn sách, toi đồng ý với qui định và chi phí mượn sách của thư viện
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</div> 

<script>
    //Tính thành tiền
    function tinhthanhtien(){
        var dssp = document.querySelectorAll('#giosach tbody tr'); //lấy ra các dòng TR tương đương 1 cuốn sách(Mỗi TR là 1 cuốn sách)
        var ngaymuon = document.querySelector('#NgayMuon').value;
        var ngaytra = document.querySelector('#NgayTra').value;
        var songaymuon = (new Date(ngaytra) - new Date(ngaymuon))/(24*60*60*1000);// giờ phút giây miligiây //(24 * 60 * 60 * 1000) tổng số miligiseconds trong một ngày //miligiseconds chia cho miligiseconds để ra được số ngày
        var TongTien = 0;
        //console.log(dssp);
        for(const sach of dssp){
            //lấy cái về cái giá mượn
            var giamuon = Number(sach.querySelector('td:nth-child(5)').innerText.replace('đ',''));//td:nth-child(5): đây là cách viết của css(start 1) //nth: số bất kì(n) //replace : bỏ đi chữ đ
            //Tính thành tiền
            var thanhtien = giamuon * songaymuon; 
            // Truyền thành tiền vào bên trong TD
            sach.querySelector('td:nth-child(6)').innerHTML = thanhtien +'đ';
            //Tính tổng tiền của từng sản phẩm
            TongTien = TongTien + thanhtien;
            
        }
        //tổng tiên hiện tại footer th 2   
        document.querySelector('tfoot th:nth-child(2)').innerText=TongTien+'đ';
        document.querySelector('#SoSachMuon').value=dssp.length; //làm cho hidden
        document.querySelector('#TongTien').value=TongTien; //làm cho hidden
    }
    tinhthanhtien(); //bạn muốn chạy hàm tinhthanhtien() ngay khi trang web được tải lên -> là khi mình thay đổi ngày là nó cập nhật tiền luôn ,không cần LOAD LẠI TRANG
</script>