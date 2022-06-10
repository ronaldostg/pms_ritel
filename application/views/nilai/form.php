<script type="text/javascript">
$(document).ready(function(){
	
	$("#th_ak").change(function(){
		var th_ak =$("#th_ak").val();
		var th = $("#th_ak").val().substr(4,1); 
		
		if(th==1){
			$("#semester").val("ganjil");
		}else{
			$("#semester").val("genap");
		}
		
	});
	
	/*
	$("#smt").change(function(){
		cari_mata_kuliah();
	});
	*/
	$("#kd_prodi").change(function(){
		cari_mata_kuliah();
	});
	
	$("#kd_mk").change(function(){
		cari_nilai();
	});
	
	
	function cari_mata_kuliah(){
		var th_ak = $("#th_ak").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#semester").val();
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Th Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th_ak").focus();
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
			url		: "<?php echo site_url(); ?>/nilai/cari_mata_kuliah",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#kd_mk").html(data);
			}
		});
	}
	
	$("#simpan").click(function(){
		var jml_data = $("#jml_data").val();
		/*
		var th_ak = $("#th_ak").val();
		var smt = $("#semester").val();
		var kd_prodi = $("#kd_prodi").val();
		*/
		
		var string = $("#my-form").serialize();
		
		//alert('Jumlah data '+jml_data);
		
		
		if(jml_data==0){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tidak Ada Nilai yang harus diisi',
				class_name: 'gritter-error' 
			});
			return false();	
		}
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tahun Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#th_ak").focus();
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
		
		if(!$("#kd_prodi").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Program Studi tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#kd_prodi").focus();
			return false();
		}
		
		if(!$("#kd_mk").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Anda belum memilih mata kuliah',
				class_name: 'gritter-error' 
			});
	
			$("#kd_mk").focus();
			return false();
		}
		
		
		//alert($("#nim_2").val());
		
		for(var i=1;i<=jml_data;i++){
			var nim = $("#nim_"+i).val();
			var n = $("#nilai_"+i).val();
			var nilai = n.replace('+','*');
			
			//alert(string+"&nim="+nim+"&nilai="+nilai);
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/nilai/simpan",
				data	: string+"&nim="+nim+"&nilai="+nilai,
				cache	: false
			});
			if( i == jml_data){
				$.gritter.add({
					title: 'Info..!!',
					text: 'Sukses disimpan',
					class_name: 'gritter-warning' 
				});
			}
		}
		
		
	});
	
	function cari_nilai(){
		var th_ak = $("#th_ak").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#semester").val();
		var kd_mk = $("#kd_mk").val();
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/nilai/cari_nilai",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak+"&kd_mk="+kd_mk,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	
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
                            <input type="text" name="semester" id="semester" class="span2" readonly="readonly">
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
                            <select name="kd_mk" id="kd_mk" class="span10">
                            	<option value="" selected="selected">-Pilih Mata Kuliah-</option>
                             </select>
                        </div>
                    </div>
                         
			        
			
            <div class="alert alert-success"> 
            <center>                                     
                     <button type="button" name="simpan" id="simpan" class="btn btn-mini btn-info">
                     <i class="icon-save"></i> Simpan
                     </button>
                     
                     <a href="<?php echo base_url();?>index.php/nilai" class="btn btn-mini btn-success">
                     <i class="icon-double-angle-right"></i> Kembali
                     </a>
           </center>       
           </div>
           </form>   
           </div>
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>