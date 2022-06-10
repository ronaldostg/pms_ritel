<script type="text/javascript">
$(document).ready(function(){
	
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		var smt = $("#smt").val();

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_mahasiswa/mata_kuliah/cari_data",
			data	: "smt="+smt,
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
            <form class="form-horizontal" name="my-form" id="my-form" action="<?php echo base_url();?>index.php/lap_mata_kuliah/cetak" method="post">
                    
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Semester</label>
                        <div class="controls">
                            <select name="smt" id="smt" class="span2">
                            	<option value="" selected="selected">-Pilih-</option>
                                <?php
								$data = $this->model_data->smt();
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