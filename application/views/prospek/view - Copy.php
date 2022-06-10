<script type="text/javascript">
$(document).ready(function(){
	$("#kode").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	$("#alamat_prospek").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	$("#nominal_prospek_awal").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	
	$("#simpan").click(function(){
		var kode	= $("#kode").val();
		var nama_prospek	= $("#nama_prospek").val();
		
		var string = $("#my-form").serialize();
		
		
		if(kode.length==0){
			alert('Maaf, Kode Tidak boleh kosong');
			$("#kode").focus();
			return false();
		}
		
		if(nama_prospek.length==0){
			alert('Maaf, Nama prospek Tidak boleh kosong');
			$("#nama_prospek").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/prospek/simpan",
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
		$('#nama_prospek').val('');
		$('#alamat_prospek').val('');
		$('#telp').val('');
		$('#pic_prospek').val('');
		$('#nominal_prospek_awal').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/prospek/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#nama_prospek').val(data.nama_prospek);
			$('#alamat_prospek').val(data.alamat_prospek);
			$('#telp').val(data.telp);
			$('#pic_prospek').val(data.pic_prospek);
			$('#nominal_prospek_awal').val(data.nominal_prospek_awal);
			
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
		$data = $this->model_data->data_prospek();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->id_prospek;?></td>
            <td ><?php echo $dt->id_prospek;?></td>
            <td class="center"><?php echo $dt->alamat_prospek;?></td>
            <td class="center"><?php echo $dt->nominal_prospek_awal;?></td>
            <td ><?php echo $dt->telp;?></td>
            <td ><?php echo $dt->pic_prospek;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->id_prospek;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/prospek/hapus/<?php echo $dt->id_prospek;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            Data Prospek
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Kode prospek</label>

                    <div class="controls">
                        <input type="text" name="kode" id="kode" placeholder="Kode prospek" class="span3" maxlength="10" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama prospek</label>

                    <div class="controls">
                        <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama prospek"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Singkat</label>

                    <div class="controls">
                        <input type="text" name="alamat_prospek" id="alamat_prospek"  class="span2" maxlength="2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Akreditasi</label>

                    <div class="controls">
                        <input type="text" name="nominal_prospek_awal" id="nominal_prospek_awal" class="span2" maxlength="2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Ketua</label>

                    <div class="controls">
                        <input type="text" name="telp" id="telp" placeholder="Ketua prospek"  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">NIP</label>

                    <div class="controls">
                        <input type="text" name="pic_prospek" id="pic_prospek" placeholder="NIP"  />
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