<script type="text/javascript">
$(document).ready(function(){
	$(".chzn-select").chosen(); 
	
	$("#cari_nim").change(function(){
		var nim = $("#cari_nim").val();
		//alert(nim);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/cari_mhs",
			data	: "nim="+nim,
			cache	: false,
			success	: function(data){
				$("#info_mhs").html(data);
			}
		});
	});
});
</script>

<div class="">
    <div class="widget-box">
        <div class="widget-header">
            <h4><i class="icon-user"></i> <?php echo $judul;?></h4>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <div class="row-fluid">
					<form action="<?php echo site_url();?>/mahasiswa/view_data" method="post">
                        <label class="control-label" for="form-field-1">Filter Jurusan</label>
                        <div class="controls">
                        <select name="cari_jurusan" id="cari_jurusan">
                        <?php
                        $data = $this->model_data->data_jurusan();
                        foreach($data->result() as $dt){
                        ?>
                        <option value="<?php echo $dt->kd_prodi;?>"><?php echo $dt->prodi;?></option>
                        <?php
                        }
                        ?>
                        </select>
                        </div>
                        <button type="submit" name="lanjut" id="lanjut" class="btn btn-small btn-success" >
                        Lanjut
                        <i class="icon-arrow-right icon-on-right bigger-110"></i>
                        </button>
                    </form> 
                </div>
                <div class="row-fluid">
                    <label for="form-field-select-1">Pencarian Mahasiswa [Masukan NIM]</label>
                    <select class="chzn-select" data-placeholder="Cari NIM ...." name="cari_nim" id="cari_nim" >
                    <option value="">Cari NIM ....</option>
                    <?php
                    $data = $this->model_data->data_all_mhs();
                    foreach($data->result() as $dt){
                    ?>
                    <option value="<?php echo $dt->nim;?>"><?php echo $dt->nim;?></option>
                    <?php
                    }
                    ?>
                    </select> 
                </div>
            </div>
            <div id="info_mhs"></div>
        </div>
    </div>
</div><!--/span-->