<script type="text/javascript">
$(document).ready(function(){
	$("#kode").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	$("#singkat").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	$("#akreditasi").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	
	$("#simpan").click(function(){
		var kode	= $("#kode").val();
		var jurusan	= $("#jurusan").val();
		
		var string = $("#my-form").serialize();
		
		
		if(kode.length==0){
			alert('Maaf, Kode Tidak boleh kosong');
			$("#kode").focus();
			return false();
		}
		
		if(jurusan.length==0){
			alert('Maaf, Nama Jurusan Tidak boleh kosong');
			$("#jurusan").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jurusan/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});
	
	$("#tambah").click(function(){
		$('#kode').val('');
		$('#kode').attr("readonly",false);
		$('#jurusan').val('');
		$('#singkat').val('');
		$('#ketua').val('');
		$('#nip').val('');
		$('#akreditasi').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/jurusan/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#jurusan').val(data.jurusan);
			$('#singkat').val(data.singkat);
			$('#ketua').val(data.ketua);
			$('#nip').val(data.nip);
			$('#akreditasi').val(data.akreditasi);
			
		}
	});
	
}

</script>
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?>
    <div class="widget-toolbar no-border pull-right">
    <a href="#modal-table" class="btn btn-small btn-success"  role="button" data-toggle="modal" name="tambah" id="tambah" >
        <i class="icon-check"></i>
        Tambah Data
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Kode</th>
            <th class="center">Program Studi</th>
            <th class="center">Singkat</th>
            <th class="center">Akreditasi</th>
            <th class="center">Ketua</th>
            <th class="center">NIP</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->data_jurusan();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->kd_prodi;?></td>
            <td ><?php echo $dt->prodi;?></td>
            <td class="center"><?php echo $dt->singkat;?></td>
            <td class="center"><?php echo $dt->akreditasi;?></td>
            <td ><?php echo $dt->ketua_prodi;?></td>
            <td ><?php echo $dt->nik;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->kd_prodi;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/jurusan/hapus/<?php echo $dt->kd_prodi;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>

                <div class="hidden-desktop visible-phone">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-caret-down icon-only bigger-120"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green">
                                        <i class="icon-edit bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                        <i class="icon-trash bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </center>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>
</div>

<div id="modal-table" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Data Jurusan
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Kode Jurusan</label>

                    <div class="controls">
                        <input type="text" name="kode" id="kode" placeholder="Kode Jurusan" class="span3" maxlength="10" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Jurusan</label>

                    <div class="controls">
                        <input type="text" name="jurusan" id="jurusan" placeholder="Nama Jurusan"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Singkat</label>

                    <div class="controls">
                        <input type="text" name="singkat" id="singkat"  class="span2" maxlength="2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Akreditasi</label>

                    <div class="controls">
                        <input type="text" name="akreditasi" id="akreditasi" class="span2" maxlength="2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Ketua</label>

                    <div class="controls">
                        <input type="text" name="ketua" id="ketua" placeholder="Ketua Jurusan"  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">NIP</label>

                    <div class="controls">
                        <input type="text" name="nip" id="nip" placeholder="NIP"  />
                    </div>
                </div>
			</form>                
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
		</div>
    </div>
</div>   