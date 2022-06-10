<script type="text/javascript">
$(document).ready(function(){
	
	$("#th_ak").change(function(){
		cari_mata_kuliah();
	});
	
	$("#smt").change(function(){
		cari_mata_kuliah();
	});
	$("#kd_prodi").change(function(){
		cari_mata_kuliah();
	});
	
	function cari_mata_kuliah(){
		var th_ak = $("#th_ak").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#smt").val();
		
		if(!$("#th_ak").val()){
			alert('Tahun Akademik tidak boleh kosong');
			$("#th_ak").focus();
			return false();
		}
		if(!$("#smt").val()){
			alert('Semester tidak boleh kosong');
			$("#smt").focus();
			return false();
		}
		if(!$("#kd_prodi").val()){
			alert('Kode Prodi tidak boleh kosong');
			$("#kd_prodi").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_absen/cari_mata_kuliah",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#mk").html(data);
			}
		});
	}
	
	
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		var string = $("#my-form").serialize();
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Th Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th_ak").focus();
			return false();
		}
		
		if(!$("#smt").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#smt").focus();
			return false();
		}
		
		if(!$("#mk").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Mata Kuliah tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#mk").focus();
			return false();
		}
		
		if(!$("#kd_prodi").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'PRODI tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#kd_prodi").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_absen/cari_data",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	$("#cetak_pdf").click(function(){
		var string = $("#my-form").serialize();
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Th Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th_ak").focus();
			return false();
		}
		
		if(!$("#smt").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#smt").focus();
			return false();
		}
		
		if(!$("#mk").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Mata Kuliah tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#mk").focus();
			return false();
		}
		
		if(!$("#kd_prodi").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'PRODI tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#kd_prodi").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_absen/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>/lap_absen/print_pdf");
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
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Th Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th_ak").focus();
			return false();
		}
		
		if(!$("#smt").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#smt").focus();
			return false();
		}
		
		if(!$("#mk").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Mata Kuliah tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#mk").focus();
			return false();
		}
		
		if(!$("#kd_prodi").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'PRODI tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#kd_prodi").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_absen/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>/lap_absen/print_excel");
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
            <i class="icon-book blue"></i>
            <?php echo $judul;?>
        </h4>
    </div>

    <div class="widget-body">
    	<div class="widget-main">
            <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Tahun Akademik</label>
                        <div class="controls">
                            <select name="th_ak" id="th_ak" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->th_akademik_jadwal();
								foreach($data->result() as $dt){
								?>
                                	<option value="<?php echo $dt->th_akademik;?>"><?php echo $dt->th_akademik;?></option>
                                <?php } ?>
                                </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Semester</label>
                        <div class="controls">
                            <select name="smt" id="smt" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                                </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Program Studi</label>
                        <div class="controls">
                            <select name="kd_prodi" id="kd_prodi" class="span4">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->data_jurusan();
								foreach($data->result() as $dt){
								?>
                                <option value="<?php echo $dt->kd_prodi;?>"><?php echo $dt->prodi;?></option>
								<?php } ?>
                             </select>
                        </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="form-field-1">Mata Kuliah</label>
                        <div class="controls">
                            <select name="mk" id="mk" class="span10">
                            	<option value="" selected="selected">-Pilih-</option>
                                </select>
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
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>