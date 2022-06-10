<script type="text/javascript">
$(document).ready(function(){
	
	function cari_jadwal(){
		var th_ak = $("#th_akademik").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#smt").val();
		
		if(smt.length==0){
			alert('Semester tidak boleh kosong');
			$("#smt").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jadwal/cari_jadwal",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#view_data").html(data);
			}
		});
	}
	
	
	$("#kd_prodi").change(function(){
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#smt").val();
		
		if(smt.length==0){
			alert('Semester tidak boleh kosong');
			$("#smt").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jadwal/mata_kuliah",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt,
			cache	: false,
			success	: function(data){
				$("#mk").html(data);
				cari_jadwal();
			}
		});
	});
	
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
		//alert(string);
		
		if(!$("#smt").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#smt").focus();
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
		
		if(!$("#hari").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Hari tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#hari").focus();
			return false();
		}
		
		if(!$("#pukul").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Pukul tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#pukul").focus();
			return false();
		}
		
		if(!$("#ruang").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Ruang tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#ruang").focus();
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
		
		if(!$("#kd_dosen").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Dosen tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#kd_dosen").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jadwal/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Info..!!',
					text: data,
					class_name: 'gritter-info' 
				});
				cari_jadwal();
			}
		});
		
	});
	
	$("#tambah").click(function(){
		$("#hari").val('');
		$("#pukul").val('');
		$("#ruang").val('');
		$("#mk").val('');
		$("#kd_dosen").val('');
		
		$("#hari").focus();
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
            <div class="control-group">
            <form name="my-form" id="my-form">
            <table width="100%">
            <tr>
            	<td width="50%" valign="top">
                    <label class="control-label" for="form-field-1">Tahun Akademik</label>
                    <div class="controls">
                    	<input type="text" name="th_akademik" id="th_akademik" value="<?php echo $th_akademik;?>" class="span1" readonly="readonly" />
                    </div>
                    <label class="control-label" for="form-field-1">Semester</label>
                    <div class="controls">
                    <input type="text" name="smt" id="smt" value="<?php echo $semester;?>" class="span1" readonly="readonly" />
                    </div>
                    
                    <label class="control-label" for="form-field-1">Jurusan</label>
                    <div class="controls">
                    <select name="kd_prodi" id="kd_prodi">
                    	<option value="" selected="selected">-Pilih Prodi-</option>
                        <?php
                        $data = $this->model_data->data_jurusan();
                        foreach($data->result() as $dt){
                        ?>
                        <option value="<?php echo $dt->kd_prodi;?>"><?php echo $dt->prodi;?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
               </td>
               <td width="50%" valign="top">
                    <label class="control-label" for="form-field-1">Hari</label>
                    <div class="controls">
                    <select name="hari" id="hari" class="span2">
                    	<option value="">-Pilih Hari-</option>
                         <?php
						$data = $this->model_data->hari_kuliah();
						foreach($data as $dt){
						?>
                        <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <label class="control-label" for="form-field-1">Pukul</label>
                    <div class="controls">
                    <select name="pukul" id="pukul" class="span2">
                    	<option value="">-Pilih Pukul-</option>
                         <?php
						$data = $this->model_data->jam_kuliah();
						foreach($data as $dt){
						?>
                        <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <label class="control-label" for="form-field-1">Ruang</label>
                    <div class="controls">
                    <select name="ruang" id="ruang" class="span2">
                    	<option value="">-Pilih Ruang-</option>
                         <?php
						$data = $this->model_data->ruang_kuliah();
						foreach($data as $dt){
						?>
                        <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <label class="control-label" for="form-field-1">Mata Kuliah</label>
                    <div class="controls">
                    <select name="mk" id="mk" class="span5">
                    	<option value="">-Pilih Mata Kuliah-</option>
                    </select>
                    </div>
                    <label class="control-label" for="form-field-1">Kode Dosen</label>
                    <div class="controls">
                    <select name="kd_dosen" id="kd_dosen" class="span4">
                    	<option value="">-Pilih Dosen-</option>
                        <?php
						$data = $this->model_data->data('dosen');
						foreach($data as $dt){
						?>
                        <option value="<?php echo $dt->kd_dosen;?>"><?php echo $dt->kd_dosen;?> - <?php echo $dt->nama_dosen;?></option>
                        <?php } ?>
                    </select>
                    </div>
               </td>
			</tr>
            </table>                    
               <div class="alert alert-error" align="center">
                 <button type="button" name="simpan" id="simpan" class="btn btn-mini btn-primary">
                 <i class="icon-save"></i> Simpan
                 </button>
                 <button type="button" name="tambah" id="tambah" class="btn btn-mini btn-info">
                 <i class="icon-check"></i> Tambah
                 </button>
                  <a href="<?php echo base_url();?>index.php/jadwal" class="btn btn-mini btn-success">
                 <i class="icon-double-angle-right"></i> Kembali
                 </a>
            </div>       
             </form>       
			</div>                    
        </div>
        <div id="view_data"></div>
    </div>
</div>    