<script type="text/javascript">
$(document).ready(function(){
	
	cari_mata_kuliah();
	cari_data();
	
	function cari_mata_kuliah(){
		var th_ak = $("#thak").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#semester").val();
		
		//alert(th_ak.'-'.kd_prodi.'-'.smt);
		var string = $("#my-form").serialize();
		//alert(string);
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_mahasiswa/isi_krs/cari_mata_kuliah",
			data	: string, //"kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#id_jadwal").html(data);
			}
		});
	}
	
	
	function cari_data(){
		var string = $("#my-form").serialize();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_mahasiswa/isi_krs/cari_data",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	$("#simpan").click(function(){
		var string = $("#my-form").serialize();
		
		
		if(!$("#id_jadwal").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Mata Kuliah tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#id_jadwal").focus();
			return false();
		}
		
		//alert(string);
		
		$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/site_mahasiswa/isi_krs/simpan",
				data	: string,
				cache	: false,
				success	: function(data){
					$.gritter.add({
						title: 'Info..!!',
						text: data,
						class_name: 'gritter-info' 
					});
					cari_data();
				}
			});
		
	});
	
	$("#cetak").click(function(){
		
		var string = $("#my-form").serialize();
		
		//alert(string);
		
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
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_mahasiswa/isi_krs/cetak_krs",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>/site_mahasiswa/isi_krs/print_krs");
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
                 <fieldset>   
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Tahun Akademik</label>
                        <div class="controls">
                            <input type="text" name="thak" id="thak" readonly="readonly" class="span2" value="<?php echo $thak;?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Semester</label>
                        <div class="controls">
                        	<input type="text" name="semester" id="semester" readonly="readonly" class="span2" value="<?php echo $semester;?>" /> / 
                            <input type="text" name="smt" id="smt" readonly="readonly" class="span1" value="<?php echo $smt;?>" />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">IP smt Lalu</label>
                        <div class="controls">
                            <input type="text" name="ip" id="ip" readonly="readonly" class="span1" value="<?php echo $ip;?>" />
                            &nbsp; Max
                            <input type="text" name="max_sks" id="max_sks" readonly="readonly" class="span1" value="<?php echo $max_sks;?>" /> SKS.
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">NIM</label>
                        <div class="controls">
                            <input type="text" name="nim" id="nim" readonly="readonly" class="span2" value="<?php echo $nim;?>" />
                            <input type="text" name="nama" id="nama" readonly="readonly" class="span5" value="<?php echo $nama;?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Program Studi</label>
                        <div class="controls">
                            <input type="text" name="kd_prodi" id="kd_prodi" readonly="readonly" class="span2" value="<?php echo $kd_prodi;?>" />
                            <input type="text" name="nama_prodi" id="nama_prodi" readonly="readonly" class="span5" value="<?php echo $nama_prodi;?>" />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Mata Kuliah</label>
                        <div class="controls">
                            <select name="id_jadwal" id="id_jadwal" class="span11">
                                <option value="">- Pilih Mata Kuliah -</option>
                            </select>
                        </div>
                    </div>
                    
			<div class="alert alert-success"> 
            <center>
                      <button type="button" name="simpan" id="simpan" class="btn btn-mini btn-primary">
                     <i class="icon-save"></i> Ambil Mata Kuliah
                     </button>
                      <button type="button" name="cetak" id="cetak" class="btn btn-mini btn-info">
                     <i class="icon-download"></i> Download KRS
                     </button>
           </center>       
           </div>
           </fieldset>
           </form>   
           </div>
           <?php
		  	echo  $this->session->flashdata('result_info');
		   ?>
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>