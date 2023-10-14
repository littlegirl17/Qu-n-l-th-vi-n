<h2 class="my-3">Tổng quan</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Sách</h5>
                    <p class="card-text text-center fs-1"><?=$sosach?></p>
                </div>
                </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Chủ đề</h5>
                    <p class="card-text text-center fs-1"><?=$sochude?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tài khoản</h5>
                    <p class="card-text text-center fs-1"><?=$sobandoc?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger  mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Sách mượn</h5>
                    <p class="card-text text-center fs-1"><?=$solichsu?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Thống kê sách theo chủ đề</strong>
                </div>
                <div class="card-body">
                    <div id="myChart" style="height:400px"></div>
                    <table class="table text-end">
                        <thead>
                            <tr>
                                <th class="text-start">Chủ đề</th>
                                <th>Số lượng</th>
                                <th>Gía trung bình</th>
                                <th>Giá cao nhất</th>
                                <th>Giá thấp nhất</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($thongkechude as $tkcd): ?>
                            <tr>
                                <td class="text-start"><?=$tkcd['TenChuDe']?></td>
                                <td><?=$tkcd['SoLuong']?></td>
                                <td><?=number_format(round(max($tkcd['TrungBinh']*0.5/100,500)))?></td> <!-- Vì mình đang tính theo giá mượn -->
                                <td><?=number_format(round(max($tkcd['CaoNhat']*0.5/100,500)))?></td> <!-- Vì mình đang tính theo giá mượn -->
                                <td><?=number_format(round(max($tkcd['ThapNhat']*0.5/100,500)))?></td> <!-- Vì mình đang tính theo giá mượn -->
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Your Function
    function drawChart() {
        
        // Set Data
        const data = google.visualization.arrayToDataTable([
        ['Chủ đề', 'Số lượng sách'], //Tên, đơn vị số liệu
        <?php foreach($thongkechude as $tkcd){
            echo "['".$tkcd['TenChuDe']."',".$tkcd['SoLuong']."],";
        } ?>
        
        ]);

        // Set Options
        const options = {
        title:'Biểu đồ thống kê sách theo chủ đề',
        is3D: true
        };

        // Draw
        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
    </script>

    