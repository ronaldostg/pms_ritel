<script type="text/javascript">
$(document).ready(function(){
	
	$("#thak").change(function(){
		var th_ak =$("#thak").val();
		var th = $("#thak").val().substr(4,1); 
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_dosen/jadwal/cari_smt",
			data	: "th_ak="+th_ak,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#semester").val(data.semester);
				//$("#smt").val(data.smt);
			}
		});
		
	});
	
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
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
			url		: "<?php echo site_url(); ?>/site_dosen/jadwal/cari_data",
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
            <i class="icon-desktop blue"></i>
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
                            <select name="thak" id="thak" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$key = $this->session->userdata('username');
								$data = $this->model_data->th_akademik_krs_dosen($key);
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
			        
			
            <div class="alert alert-success"> 
            <center>                                     
                     <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                     <i class="icon-th"></i> Lihat Data
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