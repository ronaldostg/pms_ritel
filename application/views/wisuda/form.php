<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#thak").focus();
	
	cari_data();
	
	$("#nim").keyup(function(){
		cari_mhs();
	});
	
	function cari_mhs(){
		var nim = $("#nim").val();
		
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/wisuda/cari_mhs",
			data	: "nim="+nim,
			dataType: "json",
			success	: function(data){
				$('#nama_mhs').val(data.nama);
				$('#sex').val(data.sex);
			}
		});
	}
	
	function cari_data(){
		var id	= $("#id").val();	
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/wisuda/cari",
			data	: "id="+id,
			dataType: "json",
			success	: function(data){
				$('#thak').val(data.thak);
				$('#tgl').val(data.tgl);
				$('#nim').val(data.nim);
				$('#skripsi').val(data.skripsi);
				$('#ipk').val(data.ipk);
				$('#valid').val(data.valid);
				cari_mhs();
			}
		});
		
	}
	
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
		
		if(!$("#thak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tahun Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#thak").focus();
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
		
		if(!$("#tgl").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#tgl").focus();
			return false();
		}
		
		if(!$("#skripsi").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Judul Skripsi tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#skripsi").focus();
			return false();
		}
		
		if(!$("#ipk").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'IPK tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#ipk").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/wisuda/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Peringatan..!!',
					text: data,
					class_name: 'gritter-success' 
				});
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
            	<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tahun Akademik</label>
                    <div class="controls">
                    	<select name="thak" id="thak">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->th_akademik_jadwal();
							foreach($data->result() as $dt){
							?>
                            <option value="<?php echo $dt->th_akademik;?>"><?php echo $dt->th_akademik;?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal</label>

                    <div class="controls">
                    	<div class="input-append">
                            <input type="text" name="tgl" id="tgl" class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">NIM</label>

                    <div class="controls">
                        <input type="text" name="nim" id="nim" placeholder="nim" class="span3" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Mahasiswa</label>

                    <div class="controls">
                        <input type="text" name="nama_mhs" id="nama_mhs" readonly="readonly" class="span7"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Jenis Kelamin</label>
                    <div class="controls">
                        <input type="text" name="sex" id="sex" readonly="readonly" class="span1" />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Judul Skripsi</label>
                    <div class="controls">
                        <textarea name="skripsi" id="skripsi" rows="3" class="span7"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">IPK</label>
                    <div class="controls">
                        <input type="text" name="ipk" id="ipk" class="span1"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Validasi</label>
                    <div class="controls">
                        <select name="valid" id="valid" class="span2">
                        	<option value="Y">Ya</option>
                            <option value="T">Tidak</option>
						</select>                            
                    </div>
                </div>
			</form>                
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination no-margin">
        <center>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success">
            <i class="icon-save"></i>
            Simpan
        </button>
        <a href="<?php echo base_url();?>index.php/wisuda/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/wisuda" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
		</div>
    </div>
</div>    
