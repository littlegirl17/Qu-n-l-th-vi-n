<!-- BOX LEFT '3' -->
<div class="col-md-3 mt-3">
                <form action="index.php?mod=book&act=search" method="POST">
                    <!-- TÌM KIẾM -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sách" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline custom-btn" type="button" id="button-addon2">Tìm kiếm</button>
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

<div class="col-md-9 mt-3">
    <!-- SACH NOI BAT -->
    <h2 class="border-bottom mb-4">Kết quả tìm kiếm "<?=$_GET['keyword']?>"<!--</h2>chuyển POST thành GET -->
    <div class="row">
        <!-- trong này chia ra 4 cột 4*3=12 -->
        <?php
            foreach($ketquasearch as $sach): 
                
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
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item <?=($page<=1)?'disabled':'' ?>">
        <a class="page-link" href="index.php?mod=book&act=search&keyword=<?=$_GET['keyword']?>&page=<?=$page-1?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php for ($i=1; $i < $sotrang; $i++):?>
            <li class="page-item <?=($page==$i)?'active':'' ?>" >
                <a class="page-link" href="index.php?mod=book&act=search&keyword=<?=$_GET['keyword']?>&page=<?=$i?>"><?=$i?></a>
            </li>
        <?php endfor; ?>
        
        <li class="page-item <?=($page>=$sotrang)?'disabled':'' ?>">
        <a class="page-link" href="index.php?mod=book&act=search&keyword=<?=$_GET['keyword']?>&page=<?=$page+1?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
</nav>