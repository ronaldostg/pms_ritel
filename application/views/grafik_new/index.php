<style>
    tspan {
        color : red !important;
    }
</style>
<script type="text/javascript" src="<?php echo base_url();?>grafik/js/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url();?>grafik/js/highcharts.js"></script>
<script src="<?php echo base_url();?>grafik/js/exporting.js"></script>
<script type="text/javascript">
$(function() {
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
                    return '<b>' +
                        this.x + '</b>: ' + Highcharts.numberFormat(this.y, 2, '.') +
                        ' Rupiah';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return Highcharts.numberFormat(this.y, 2);
                        }
                    }
                }
            },

            series: [
            {
                name: "<?php if($title1 == ''){ echo "-";}else{ echo $title1;}?>",
                data: [<?php echo $value1?>]

            }, 
            {
                name: "<?php if($title2 == ''){ echo "-";}else{ echo $title2;}?>",
                data: [<?php echo $value2?>]

            }, 
            {
                name: "<?php if($title3 == ''){ echo "-";}else{ echo $title3;}?>",
                data: [<?php echo $value3?>]

            }, 
            {
                name: "<?php if($title4 == ''){ echo "-";}else{ echo $title4;}?>",
                data: [<?php echo $value4?>]

            }, 
            {
                name: "<?php if($title5 == ''){ echo "-";}else{ echo $title5;}?>",
                data: [<?php echo $value5?>]

            }, 
            {
                name: "<?php if($title6 == ''){ echo "-";}else{ echo $title6;}?>",
                data: [<?php echo $value6?>]

            }, 
            {
                name: "<?php if($title7 == ''){ echo "-";}else{ echo $title7;}?>",
                data: [<?php echo $value7?>]

            }, 
            {
                name: "<?php if($title8 == ''){ echo "-";}else{ echo $title8;}?>",
                data: [<?php echo $value8?>]

            }, 
            {
                name: "<?php if($title9 == ''){ echo "-";}else{ echo $title9;}?>",
                data: [<?php echo $value9?>]

            }, 
            {
                name: "<?php if($title10 == ''){ echo "-";}else{ echo $title10;}?>",
                data: [<?php echo $value10?>]

            }, 
            
            ]

        });
    });

});
</script>

<div id="container" style="min-width: 400px; height: 400px;"></div>