<script type="text/javascript">
$(document).ready(function(){
	$(".chzn-select").chosen(); 
	
	$("#smt").change(function(){
		$("#nim").val('');
		$("#nim").focus;
	});
	
	$("#th_ak").change(function(){
		var th_ak =$("#th_ak").val();
		var th = $("#th_ak").val().substr(4,1); 
		
		if(th==1){
			$("#semester").val("ganjil");
		}else{
			$("#semester").val("genap");
		}
		
	});
	
	$("#nim").change(function(){
		var th_ak =$("#th_ak").val();
		var nim = $("#nim").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/krs/cari_nim",
			data	: "nim="+nim+"&th_ak="+th_ak,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#nama").val(data.nama);
				$("#kd_prodi").val(data.kd_prodi);
				$("#nm_prodi").val(data.nm_prodi);
				$("#smt").val(data.smt);
				$("#max_sks").val(24);
				
				cari_mata_kuliah();
				cari_krs();
			}
		});
	});
	
	function cari_mata_kuliah(){
		var th_ak = $("#th_ak").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#semester").val();
		
		if(!$("#th_ak").val()){
			//alert('Tahun Akademik tidak boleh kosong');
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tahun Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th_ak").focus();
			return false();
		}
		if(!$("#semester").val()){
			//alert('Semester tidak boleh kosong');
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#semester").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/krs/cari_mata_kuliah",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#id_jadwal").html(data);
			}
		});
	}
	
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
		//alert(string);
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tahun Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#th_ak").focus();
			return false();
		}
		
		if(!$("#nim").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'NIM tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nim").focus();
			return false();
		}
		
		if(!$("#semester").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#semester").focus();
			return false();
		}
		
		if(!$("#id_jadwal").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Anda belum memilih mata kuliah',
				class_name: 'gritter-error' 
			});
	
			$("#id_jadwal").focus();
			return false();
		}
		
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/krs/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Info..!!',
					text: data,
					class_name: 'gritter-info' 
				});
				cari_krs();
			}
		});
		
	});
	
	function cari_krs(){
		var th_ak = $("#th_ak").val();
		var nim = $("#nim").val();
		var smt = $("#semester").val();
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/krs/cari_krs",
			data	: "nim="+nim+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	$("#cetak").click(function(){
		
		var string = $("#my-form").serialize();
		
		//alert(string);
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tahun Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#th_ak").focus();
			return false();
		}
		
		if(!$("#nim").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'NIM tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nim").focus();
			return false();
		}
		
		if(!$("#semester").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#semester").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/krs/cetak_krs",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>/krs/print_krs");
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
            <table width="100%">
            	<tr>
                	<td width="30%" valign="top">
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Tahun Akademik</label>
                        <div class="controls">
                            <select name="th_ak" id="th_ak" class="span6">
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
                            <input type="text" name="semester" id="semester" class="span5" readonly="readonly" />
                        </div>
                    </div>
			
                   <div class="control-group">
                        <label class="control-label" for="nim">NIM</label>
                        <div class="controls">
                        	<select class="chzn-select" name="nim" id="nim" data-placeholder="pilih NIM...">
                            	<option value="" selected="selected"> Pilih NIM ....</option>
                            	 <?php
								$data = $this->model_data->data_all_mhs();
								foreach($data->result() as $dt){
								?>
								<option value="<?php echo $dt->nim;?>"><?php echo $dt->nim;?></option>
								<?php
								}
								?>
                            </select>
                            <!--
                            <input type="text" name="nim" id="nim" placeholder="NIM" />
                            -->
                       </div>     
                    </div>        
                    </td>
                    <td width="70%" valign="top">
                    	<div class="control-group">
                            <label class="control-label" for="form-field-1">Nama</label>
                            <div class="controls">
                                <input type="text" name="nama" id="nama" class="span10" readonly="readonly" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Prodi</label>
                            <div class="controls">
                                <input type="text" name="kd_prodi" id="kd_prodi" class="span3" readonly="readonly" />
                                <input type="text" name="nm_prodi" id="nm_prodi" class="span8" readonly="readonly" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Semester</label>
                            <div class="controls">
                                <input type="text" name="smt" id="smt" class="span2" readonly="readonly" />
                                Max SKS <input type="text" name="max_sks" id="max_sks" class="span2" readonly="readonly" />
                            </div>
                        </div>
                    	
                    </td>
                    </tr>
				</table>    
			
            <div class="alert alert-success"> 
            <center>                
                <div class="control-group">
                        <label class="control-label" for="form-field-1">Mata Kuliah</label>

                        <div class="controls">
                            <select name="id_jadwal" id="id_jadwal" class="span12">
                            	<option value="" selected="selected">-Pilih Mata Kuliah-</option>
                             </select>
                        </div>
                    </div>
                                    
                     <button type="button" name="simpan" id="simpan" class="btn btn-mini btn-info">
                     <i class="icon-save"></i> Simpan
                     </button>
                     
                     <button type="button" name="cetak" id="cetak" class="btn btn-mini btn-warning">
                     <i class="icon-print"></i> Cetak
                     </button>
                     
                     <a href="<?php echo base_url();?>index.php/krs" class="btn btn-mini btn-success">
                     <i class="icon-arrow-left"></i> Kembali
                     </a>
           </center>       
           </div>
           Ket : KRS dicetak oleh mahasiswa 
           </div> 
           </form>   
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>