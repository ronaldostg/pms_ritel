<script type="text/javascript">
$(document).ready(function(){
	
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		var th_ak = $("#th_ak").val();
		var kd_prodi = $("#kd_prodi").val();
		var status = $("#status").val();
		
		if(!$("#th_ak").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Th Akademik tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#th_ak").focus();
			return false();
		}
		

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_mahasiswa/cari_data",
			data	: "kd_prodi="+kd_prodi+"&th_ak="+th_ak+"&status="+status,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	$("#view_mhs_aktif").click(function(){
		var th_ak = $("#th_ak").val();
		var kd_prodi = $("#kd_prodi").val();
		

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_mahasiswa/cari_data_mhs_aktif",
			data	: "kd_prodi="+kd_prodi+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
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
            <form class="form-horizontal" name="my-form" id="my-form" action="<?php echo base_url();?>index.php/lap_mahasiswa/cetak" method="post">
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
                                </select> *) Tahun Masuk Mahasiswa
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
                        <label class="control-label" for="form-field-1">Status</label>
                        <div class="controls">
                            <select name="status" id="status" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->status_mhs();
								foreach($data as $dt){
								?>
                                <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
								<?php } ?>
                             </select>
                        </div>
                    </div>
			        
			
            <div class="alert alert-success"> 
            <center>                                     
                     <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                     <i class="icon-th"></i> Lihat Data
                     </button>
                     <button type="submit" name="cetak" id="cetak" class="btn btn-mini btn-primary">
                     <i class="icon-print"></i> Cetak PDF
                     </button>
                     
                     <button type="button" name="view_mhs_aktif" id="view_mhs_aktif" class="btn btn-mini btn-info">
                     <i class="icon-th"></i> View Mahasiswa Aktif
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