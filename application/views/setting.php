<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#simpan_krs").click(function(){
		var tgl_krs = $("#isi_krs").val();
		
		if(!$("#isi_krs").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal KRS tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#isi_krs").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/update_krs",
			data	: "tgl_krs="+tgl_krs,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Peringatan..!!',
					text: data,
					class_name: 'gritter-error' 
				});
			}
		});
	});
	
	$("#simpan_wisuda").click(function(){
		var tgl_wisuda = $("#isi_wisuda").val();
		
		if(!$("#isi_wisuda").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal KRS tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#isi_wisuda").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/update_wisuda",
			data	: "tgl_wisuda="+tgl_wisuda,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Peringatan..!!',
					text: data,
					class_name: 'gritter-error' 
				});
			}
		});
	});
});
</script>
<!-- <div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">

        </h4>
    </div>

    <div class="widget-body">
    	<div class="widget-main">
            <div class="row-fluid">

           </div>
        </div>
    </div>
</div>    -->