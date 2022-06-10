<!--
<script type="text/javascript" src="<?php echo base_url();?>grafik/js/jquery-1.8.2.min.js"></script>
-->
<script src="<?php echo base_url();?>grafik/js/highcharts.js"></script>
<script src="<?php echo base_url();?>grafik/js/exporting.js"></script>
<?php
/*
$kategori = $this->model_data->create_category_krs_nim($nim);
$data_chart = $this->model_data->create_data_krs_nim($nim);
*/
?>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Grafik Riwayat Indeks Prestasi (IP) Mahasiswa',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: deddyrusdiansyah.blogspot.com',
                x: -20
            },
            xAxis: {
                categories: [<?php echo $kategori;?>]
            },
            yAxis: {
                title: {
                    text: 'Indeks Prestasi'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y ;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Indeks Prestasi',
                data: <?php echo $data_chart;?>
            }]
        });
    });
    
});
		</script>



<div id="container" style="width: 80%; height: 400px;"></div>