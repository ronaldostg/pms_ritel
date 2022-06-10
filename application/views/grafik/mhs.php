<script type="text/javascript" src="<?php echo base_url();?>grafik/js/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url();?>grafik/js/highcharts.js"></script>
<script src="<?php echo base_url();?>grafik/js/exporting.js"></script>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = $.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Mahasiswa Th.Akademik <?php echo $th;?><br>Total <?php echo $mhs_total;?> Mahasiswa'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Mahasiswa',
                data: [
                    ['Mhs Aktif ',   <?php echo $mhs_aktif;?>],
                    ['Mhs Cuti',    <?php echo $mhs_cuti;?>],
					['Mhs DO',       <?php echo $mhs_do;?>],
					['Mhs Meninggal',       <?php echo $mhs_meninggal;?>],
                    {
                        name: 'Lulus',
                        y: <?php echo $mhs_lulus;?>,
                        sliced: true,
                        selected: true
                    }
                ]
            }]
        });
    });
    
});
		</script>

<form name="my-form" id="my-form" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/grafik/mhs">		    <div class="control-group">    
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
            
    
                   