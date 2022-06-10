<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#thak").focus();
	
	$("#thak").change(function(){
		var th_ak =$("#thak").val();
		var th = $("#thak").val().substr(4,1); 
		
		if(th==1){
			$("#smt").val("ganjil");
		}else{
			$("#smt").val("genap");
		}
		
	});
	
	cari_data();
	
	$("#nim").keyup(function(){
		cari_mhs();
	});
	
	function cari_mhs(){
		var nim = $("#nim").val();
		
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/mutasi_mhs/cari_mhs",
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
			url		: "<?php echo site_url(); ?>/mutasi_mhs/cari",
			data	: "id="+id,
			dataType: "json",
			success	: function(data){
				$('#thak').val(data.thak);
				$('#smt').val(data.smt);
				$('#tgl').val(data.tgl);
				$('#nim').val(data.nim);
				$('#status').val(data.status);
				$('#ket').val(data.ket);
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
		
		if(!$("#smt").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Semester tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#smt").focus();
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
		
		if(!$("#nim").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'NIM tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#nim").focus();
			return false();
		}
		
		if(!$("#nama_mhs").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'NIM tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#nama_mhs").focus();
			return false();
		}
		
		if(!$("#status").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mutasi_mhs/simpan",
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
<div class="row-fluid">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php echo $judul;?>
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
            	<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tahun Akademik</label>
                    <div class="controls">
                    	<select name="thak" id="thak" class="span2">
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
                    <label class="control-label" for="form-field-1">Semester</label>
                    <div class="controls">
                    	<input type="text" name="smt" id="smt" class="span2" readonly="readonly">
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
                    <label class="control-label" for="form-field-1">Status</label>
                    <div class="controls">
                    	<select name="status" id="status">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->status_mhs();
							foreach($data as $dt){
							?>
                            <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Keterangan</label>
                    <div class="controls">
                        <input type="text" name="ket" id="ket" class="span10"/>
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
        <a href="<?php echo base_url();?>index.php/mutasi_mhs/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/mutasi_mhs" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
		</div>
    </div>
</div>    
