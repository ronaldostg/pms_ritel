<script type="text/javascript" src="<?php echo base_url();?>grafik/js/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url();?>grafik/js/highcharts.js"></script>
<script src="<?php echo base_url();?>grafik/js/exporting.js"></script>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Mahasiswa Aktif Th.Akademik <?php echo $th;?>'
            },
            subtitle: {
                text: 'Source: deddyrusdiansyah.blogspot.com'
            },
            xAxis: {
                categories: [
                    <?php echo $category;?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (Mahasiswa)'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' orang';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
					dataLabels: {
                        enabled: true
                    }
                }
            },
                series: [{
                name: 'Sisitem Informasi',
                data: <?php echo $si;?>
    
            }, {
                name: 'Teknik Informatika',
                data: <?php echo $ti;?>
    
            }]
			
        });
    });
    
});
</script>

<form name="my-form" id="my-form" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/grafik/mhs_aktif">		    <div class="control-group">    
    <label class="control-label"><small>Th. Akademik</small></label>
    <div class="controls">
    <select name="thak" id="thak" class="span2">
    <option value="">-Pilih-</option>
    <?php
    $this->db->group_by('th_akademik');	
    $data = $this->db->get('mahasiswa');
    foreach($data->result() as $dt){
    ?>
    <option value="<?php echo $dt->th_akademik;?>"><?php echo $dt->th_akademik;?></option>
    <?php } ?>        
    </select>
    <button type="submit" name="cari" id="cari" class="btn btn-small btn-info"><i class="icon-double-angle-right"></i></button>
    </div>
    </div>
</form>
<div id="container" style="min-width: 400px; height: 400px;"></div>
            
    
                   