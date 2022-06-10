<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#judul_skripsi").focus();
	
	cari_data();
	
	
	function cari_data(){
		var id	= $("#id").val();	
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/site_mahasiswa/wisuda/cari",
			data	: "id="+id,
			dataType: "json",
			success	: function(data){
				$('#thak').val(data.thak);
				$('#tgl').val(data.tgl);
				$('#nim').val(data.nim);
				$('#tgl_sidang').val(data.tgl_sidang);
				$('#skripsi').val(data.skripsi);
				$('#ipk').val(data.ipk);
				if(data.validasi=='T'){
					$('#validasi').html("Belum di Validasi");
					$("#simpan").show();
				}else{
					$('#validasi').html("Sudah di Validasi");
					$("#simpan").hide();
				}
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
		
		if(!$("#tgl_sidang").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal Sidang tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#tgl_sidang").focus();
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
			url		: "<?php echo site_url(); ?>/site_mahasiswa/wisuda/simpan",
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
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tahun Akademik</label>
                    <div class="controls">
                    	<input type="text" name="thak" id="thak" class="span2" value="<?php echo $thak;?>" readonly="readonly" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal</label>

                    <div class="controls">
                    	<div class="input-append">
                            <input type="text" name="tgl" id="tgl" class="span6" value="<?php echo $tgl;?>" readonly="readonly"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">NIM</label>

                    <div class="controls">
                        <input type="text" name="nim" id="nim" placeholder="nim" value="<?php echo $nim;?>" class="span3" readonly="readonly" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Mahasiswa</label>

                    <div class="controls">
                        <input type="text" name="nama_mhs" id="nama_mhs" readonly="readonly" class="span7" value="<?php echo $nama_mhs;?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal Sidang</label>
                    <div class="controls">
                    	<div class="input-append">
                        <input type="text" name="tgl_sidang" id="tgl_sidang" class="span7 date-picker"  data-date-format="dd-mm-yyyy"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
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
                        <input type="text" name="ipk" id="ipk" class="span1" readonly="readonly"/> (* Apabila ada perbedaan silahkan Hubungi Bag. Akademik.
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Validasi</label>
                    <div class="controls">
                        <span class="label label-large label-pink arrowed-right" id="validasi"></span>
                    </div>
                </div>
			</form>                
        </div>
    </div>
	<?php 
	echo $this->session->flashdata('result_info');
	?>
    <div class="modal-footer">
        <div class="pagination no-margin">
        <center>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success">
            <i class="icon-save"></i>
            Simpan
        </button>
        
        <a href="<?php echo base_url();?>index.php/site_mahasiswa/wisuda/cetak" class="btn btn-small btn-info">
            <i class="icon-download-alt"></i>
            Download Formulir
        </a>
        
        <a href="<?php echo base_url();?>index.php/site_mahasiswa/home" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
		</div>
    </div>
</div>    
