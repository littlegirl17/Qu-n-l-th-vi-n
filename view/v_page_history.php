<h2>Lịch sử</h2>
<table class="table">
    <thead>
        <tr>
            <th>Mã mượn sách</th>
            <th>Ngày mượn</th>
            <th>Ngày trả</th>
            <th>Số sách mượn</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dslichsu as $dsls):?>
        <tr>
            <td><?=$dsls['MaLS']?></td>
            <td><?=$dsls['NgayMuon']?></td>
            <td><?=$dsls['NgayTra']?></td>
            <td><?=$dsls['SoSachMuon']?></td>
            <td><?=$dsls['TongTien']?></td>
            <td>
                <?php switch ($dsls['TrangThai']) {
                    case 'chuan-bi':
                        echo '<span class="badge text-bg-primary">Đã tiếp nhận yêu cầu mượn</span>';
                        break;
                    case 'cho-giao':
                        echo '<span class="badge text-bg-success">Đã nhận được sách mượn</span>';
                        break;
                    default:
                        # code...
                        break;
                } ?>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>