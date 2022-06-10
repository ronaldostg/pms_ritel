<script type="text/javascript">
$(document).ready(function(){
	$("#cari_nilai").change(function(){
		var thak = $("#cari_nilai").val();
		var nim = $("#nim").val();
		
		var string = "thak="+thak+"&nim="+nim;

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/cari_nilai",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_nilai").html(data);
			}
		});
	});
});
</script>
<div class="row-fluid">
    <div class="span12">       
    	<div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name">Tahun Akademik</div>
                <div class="profile-info-value">
                    <select name="cari_nilai" id="cari_nilai" class="span2">
                    	<option value="">-Pilih-</option>
                        <?php
						$data = $this->model_data->th_akademik_krs_mhs($nim);
						foreach($data->result() as $dt){
						?>
                        	<option value="<?php echo $dt->th_akademik;?>"><?php echo $dt->th_akademik;?></option>
                        <?php } ?>
					</select>                        
                </div>
            </div>
		</div>            
	
    <div id="view_nilai"></div>
    </div><!--/span-->
</div><!--/row-fluid-->
