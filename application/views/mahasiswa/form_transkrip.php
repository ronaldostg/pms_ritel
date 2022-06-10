<script type="text/javascript">
$(document).ready(function(){
	cari_data();
	
	function cari_data(){
		var nim = $("#nim").val();
		
		var string = "nim="+nim;


		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/cari_transkrip",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_transkrip").html(data);
			}
		});
	}
});
</script>
<div class="row-fluid">
    <div class="span12">           
    <div id="view_transkrip"></div>
    </div><!--/span-->
</div><!--/row-fluid-->
