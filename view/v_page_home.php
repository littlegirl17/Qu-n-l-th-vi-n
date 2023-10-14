
<!-- BOX LEFT '3' -->
 <div class="col-md-3 mt-3">
                <form action="index.php?mod=book&act=search" method="POST">
                    <!-- TÌM KIẾM -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sách" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline custom-btn" type="submit" id="button-addon2">Tìm kiếm</button>
                    </div>
                </form>
                    <!-- LIST DANH MỤC SÁCH -->
                <ul class="list-group">
                    <li class="list-group-item custom-backround" aria-current="true">Top 10 sách được mượn nhiều</li>
                    <?php
                        foreach($dsSachTop10 as $sach): 
                            extract($sach);
                    ?>
                    <li class="list-group-item"><?=$TuaSach?></li>
                    <?php
                        endforeach;
                    ?>
                </ul>
            </div>

<!-- BOX RIGHT '9' MAIN -->
<div class="col-md-9 mt-3">
                <!-- SACH NOI BAT -->
                <h2 class="border-bottom mb-4">SÁCH NỔI BẬT</h2>
                <div class="row">
                    <!-- trong này chia ra 4 cột 4*3=12 -->
                    <?php
                        foreach($dsSachMoi as $sach): 
                            
                    ?> 
                        <div class="col-md-3 ">
                            <div class="card h-100">
                                <img src="view/upload/product/<?=$sach['HinhAnh']?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="" class="text-decoration-none text-dark">
                                        <h5 class="card-title text-sm custom-h5"><?=$sach['TuaSach']?></h5>
                                    </a>
                                </div>
                                <h4><?=$sach['GiaTri']?></h4>
                                <a href="index.php?mod=book&act=detail&id=<?=$sach['MaSach']?>"><button type="button"  class="btn custom-btn w-50 m-3">Mượn</button></a>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>

                <!-- SÁCH NEW-->
                <h2 class="mt-5 border-bottom mb-4">SÁCH NEW</h2>
                <div class="row ">
                    <!-- trong này chia ra 4 cột 4*3=12 -->
                    <?php
                        foreach($dsSachMoi as $sach): 
                            extract($sach);
                    ?>
                        <div class="col-md-3 ">
                            <div class="card h-100">
                                <img src="view/upload/product/<?=$HinhAnh?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="text-decoration-none text-dark">
                                        <h5 class="card-title text-sm custom-h5"><?=$TuaSach?></h5>
                                    </a>
                                </div>
                                <h4><?=$GiaTri?></h4>
                                <a href="index.php?mod=book&act=detail&id=<?=$sach['MaSach']?>"><button type="button"  class="btn custom-btn w-50 m-3">Mượn</button></a>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                
                </div>

                <!-- SÁCH ĐƯỢC ĐỌC NHIỀU NHẤT -->
                <h2 class="mt-5 border-bottom mb-4">SÁCH ĐƯỢC ĐỌC NHIỀU NHẤT</h2>
                <div class="row ">
                    <!-- trong này chia ra 4 cột 4*3=12 -->
                    <div class="col-md-3 ">
                        <div class="card h-100">
                            <img src="img/ngungonnhepeppa.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-sm custom-h5">Thế Giới Của Peppa - Ngủ Ngon Nhé, Peppa!</h5>
                                </a>
                            </div>
                            <button type="button" class="btn custom-btn w-50 m-3">Mượn</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="img/peppadennhasach.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-sm custom-h5">Thế Giới Của Peppa - Peppa Đến Nhà Sách</h5>
                                </a>
                            </div>
                            <button type="button" class="btn custom-btn w-50 m-3">Mượn</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="img/peppayeubacsivayta.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-sm custom-h5"> Peppa Yêu Quý Bác Sĩ Và Y Tá</h5>
                                </a>
                            </div>
                            <button type="button" class="btn custom-btn w-50 m-3">Mượn</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="img/peppayeutraidat.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="text-decoration-none text-dark">
                                    <h5 class="card-title text-sm custom-h5">Thế Giới Của Peppa - Peppa Yêu Trái Đất</h5>
                                </a>
                            </div>
                            <button type="button" class="btn custom-btn w-50 m-3">Mượn</button>
                        </div>
                    </div>
                </div>
            </div>
            