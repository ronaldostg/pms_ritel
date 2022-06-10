<script type="text/javascript">
$(document).ready(function(){

			
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>lap_pipeline/cari_data",
			data	: "status_kondisi_data=2",
			//data	: "posisi_data="+posisi_data+"&status_data="+status_data+"&status_prospek="+status_prospek,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}

				
	$("#view_semua_data_prospek").click(function(){
		

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>lap_pipeline/cari_semua_data_prospek",
			data	: "",
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
		
			
	});
		

	$("#cetak_pdf").click(function(){
		var string = $("#my-form").serialize();

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>lap_pipeline/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>lap_pipeline/print_pdf");
				}else{
					$.gritter.add({
						title: 'Peringatan..!!',
						text: data,
						class_name: 'gritter-error' 
					});
				}
			}
		});
	});
	
	$("#cetak_excel").click(function(){
		var string = $("#my-form").serialize();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>lap_pipeline/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>lap_pipeline/print_excel");
				}else{
					$.gritter.add({
						title: 'Peringatan..!!',
						text: data,
						class_name: 'gritter-error' 
					});
				}
			}
		});
	});
		
});

</script>

<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-desktop blue"></i>
            <?php echo $judul;?>
        </h4>
    </div>

    <div class="widget-body">
    	<div class="widget-main">
            <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
			                    
            
            <div class="alert alert-success"> 
            <center>                                     
                     <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                     <i class="icon-th"></i> Lihat Data
                     </button>
                     <button type="button" name="cetak_pdf" id="cetak_pdf" class="btn btn-mini btn-primary">
                     <i class="icon-print"></i> Cetak PDF
                     </button>
                     <button type="button" name="cetak_excel" id="cetak_excel" class="btn btn-mini btn-success">
                     <i class="icon-print"></i> Cetak EXCEL
                     </button>

  
                                                       
           </center>       
           </div>
           </form>   
           </div>
           <?php
		  	echo  $this->session->flashdata('result_info');
		   ?>
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>