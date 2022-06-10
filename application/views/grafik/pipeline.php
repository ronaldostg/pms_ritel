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
                text: 'Pipeline'
            },
            subtitle: {
                text: 'Source: www.banksumut.com'
            },
            xAxis: {
                categories: ['Pipeline']
            },
            yAxis: {
//                min: 0,
                title: {
                    text: 'Jumlah (Rp)'
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
                    return '<b>'+
                        this.x +'</b>: '+  Highcharts.numberFormat(this.y, 2, '.') +' Rupiah';
                }
            },
			plotOptions: {
                column: {
                    pointPadding: 0.2,
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						formatter: function () {
							return Highcharts.numberFormat(this.y,2);
						}
					}					
                }
            },

                series: [{
                name: 'Target Tumbuh',
//				data: [96,75]
                data: <?php echo $rp_target_tumbuh;?>
				
    
            }, {
                name: 'Eksisting Debitur',
//				data: [43,85]
                data: <?php echo $rp_existing_debitur;?>
				
            }, {
                name: 'Pelunasan',
//				data: [43,85]
                data: <?php echo $rp_pelunasan;?>
				
            }, {
                name: 'Wajib Ekspansi',
//				data: [43,85]
                data: <?php echo $rp_wajib_expansi;?>
				
            }, {
                name: 'Terget OS',
//				data: [43,85]
                data: <?php echo $rp_target_os;?>

            }, {
                name: 'Potensi On Book',
//				data: [43,85]
                data: <?php echo $rp_potensi_on_book;?>

            }, {
                name: 'Lebih / Kurang',
//				data: [43,85]
                data: <?php echo $rp_lebih_kurang;?>

																        
            }]
			
        });
    });
    
});



</script>

<div id="container" style="min-width: 400px; height: 400px;"></div>
            
    
                   