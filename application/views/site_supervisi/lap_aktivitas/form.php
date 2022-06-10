<script type="text/javascript">
$(document).ready(function(){

	$("#posisi_data").change(function(){
		cari_data();
	});
	
	$("#status_prospek").change(function(){
		cari_data();
	});
	$("#status_kondisi_data").change(function(){
		cari_data();
	});
		
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		var posisi_data = $("#posisi_data").val();
		var status_prospek = $("#status_prospek").val();
		var status_kondisi_data = $("#status_kondisi_data").val();
		
		if(!$("#posisi_data").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Posisi tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#posisi_data").focus();
			return false();
		}

		if(!$("#status_prospek").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status Prospek tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status_prospek").focus();
			return false();
		}

		if(!$("#status_kondisi_data").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status Data tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status_kondisi_data").focus();
			return false();
		}


		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>site_supervisi/lap_aktivitas/cari_data",
			data	: "status_kondisi_data="+status_kondisi_data+"&status_prospek="+status_prospek+"&posisi_data="+posisi_data,
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
			url		: "<?php echo site_url(); ?>site_supervisi/lap_aktivitas/cari_semua_data_prospek",
			data	: "",
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
		
			
	});
		

	$("#cetak_pdf").click(function(){
		var string = $("#my-form").serialize();
		
		var posisi_data = $("#posisi_data").val();
		var status_prospek = $("#status_prospek").val();
		var status_kondisi_data = $("#status_kondisi_data").val();
		
		if(!$("#posisi_data").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Posisi tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#posisi_data").focus();
			return false();
		}

		if(!$("#status_prospek").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status Prospek tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status_prospek").focus();
			return false();
		}
		
		if(!$("#status_kondisi_data").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status Data tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status_kondisi_data").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>site_supervisi/lap_aktivitas/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>site_supervisi/lap_aktivitas/print_pdf");
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
		
		var posisi_data = $("#posisi_data").val();
		var status_prospek = $("#status_prospek").val();
		var status_kondisi_data = $("#status_kondisi_data").val();
		
		if(!$("#posisi_data").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Posisi tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#posisi_data").focus();
			return false();
		}

		if(!$("#status_prospek").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status Prospek tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status_prospek").focus();
			return false();
		}
		
		if(!$("#status_kondisi_data").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status Data tidak Data boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status_kondisi_data").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>site_supervisi/lap_aktivitas/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>site_supervisi/lap_aktivitas/print_excel");
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
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Posisi Data</label>
                        <div class="controls">
                            <select name="posisi_data" id="posisi_data" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->posisi_data_prospek();
								foreach($data as $dt){
								?>
                                <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
								<?php } ?>
                             </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Status Prospek</label>
                        <div class="controls">
                            <select name="status_prospek" id="status_prospek" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->status_prospek();
								foreach($data as $dt){
								?>
                                <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
								<?php } ?>
                             </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Status Data</label>
                        <div class="controls">
                            <select name="status_kondisi_data" id="status_kondisi_data" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->status_data_prospek();
								foreach($data as $dt){
								?>
                                <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
								<?php } ?>
                             </select>
                              <?php echo "*Pilih (Laporan Pipeline) untuk melihat detail Laporan Data Pipeline";?> 
                        </div>
                    </div>
			                    
            
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