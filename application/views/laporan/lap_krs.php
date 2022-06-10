<script type="text/javascript">
$(document).ready(function(){
	
	$("#th_ak").change(function(){
		var th_ak =$("#th_ak").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_krs/cari_smt",
			data	: "th_ak="+th_ak,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#smt").val(data.semester);
			}
		});
		
	});
	
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
		
		if(!$("#th").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tahun Angkatan Masuk tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th").focus();
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
			url		: "<?php echo site_url(); ?>/lap_krs/cari_data",
			data	: string,
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
            <form class="form-horizontal" name="my-form" id="my-form" >
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
                            <input type="text" name="smt" id="smt" class="span2" readonly="readonly">
                        </div>
                    </div>
                    <hr />
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Tahun Angkatan</label>
                        <div class="controls">
                            <select name="th" id="th" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->th_akademik_jadwal();
								foreach($data->result() as $dt){
								?>
                                	<option value="<?php echo $dt->th_akademik;?>"><?php echo $dt->th_akademik;?></option>
                                <?php } ?>
                                </select> (* Th Akademik Masuk Mahasiswa
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
			        
			
            <div class="alert alert-success"> 
            <center>                                     
                     <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                     <i class="icon-th"></i> Lihat Data
                     </button>
           </center>       
           </div>
           </form>   
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>