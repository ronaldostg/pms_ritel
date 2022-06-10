<script type="text/javascript">
$(document).ready(function(){
	$("#sks").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
	
	$("#simpan").click(function(){
		var kode	= $("#kode").val();
		var jurusan	= $("#jurusan").val();
		var nama_mk	= $("#nama_mk").val();
		
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
		
		if(nama_mk.length==0){
			alert('Maaf, Nama Mata Kuliah Tidak boleh kosong');
			$("#nama_mk").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mata_kuliah/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				//location.reload();
				//window.location.assign("<?php echo site_url();?>/mata_kuliah/view_data")
			}
		});
		
	});
	
	function create_kdmk(){
		var prodi = $("#jurusan").val();
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/mata_kuliah/create_kdmk",
			data	: "prodi="+prodi,
			dataType: "json",
			success	: function(data){
				$('#kode').val(data.kode);
				$('#kode').attr("readonly","true");
			}
		});
	}
	
	$("#tambah").click(function(){
		create_kdmk();
		//$('#kode').val('');
		$('#kode').attr("readonly","false");
		$('#nama_mk').val('');
		$('#semester').val('');
		$('#sks').val('');
		$('#tayang').val('');
	});
	
	$("#add").click(function(){
		create_kdmk();
		//$('#kode').val('');
		$('#kode').attr("readonly","false");
		$('#nama_mk').val('');
		$('#semester').val('');
		$('#sks').val('');
		$('#tayang').val('');
	});
	
	$("#close").click(function(){
		location.reload();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/mata_kuliah/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#nama_mk').val(data.nama_mk);
			$('#jurusan').val(data.jurusan);
			$('#semester').val(data.semester);
			$('#sks').val(data.sks);
			$('#tayang').val(data.tayang);
		}
	});
	
}

</script>
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
	 <?php echo $this->session->userdata('sesi_kd_prodi');?> ( <?php echo $this->model_data->nama_jurusan($this->session->userdata('sesi_kd_prodi'));?> )
    <div class="widget-toolbar no-border pull-right">
    <a href="#modal-table" class="btn btn-small btn-success"  role="button" data-toggle="modal" name="tambah" id="tambah" >
        <i class="icon-check"></i>
        Tambah Data
    </a>
    <a href="<?php echo site_url();?>/mata_kuliah/view_data" class="btn btn-small btn-info"  >
        <i class="icon-refresh"></i>
        Refresh
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Kode</th>
            <th class="center">Kode Prodi</th>
            <th class="center">Semester</th>
            <th class="center">Nama Mata Kuliah</th>
            <th class="center">SKS</th>
            <th class="center">Status</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		//$data = $this->model_data->data_mk();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->kd_mk;?></td>
            <td class="center"><?php echo $dt->kd_prodi;?></td>
            <td class="center"><?php echo $dt->semester;?></td>
            <td ><?php echo $dt->nama_mk;?></td>
            <td class="center"><?php echo $dt->sks;?></td>
            <td class="center"><?php echo $dt->aktif;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->kd_mk;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/mata_kuliah/hapus/<?php echo $dt->kd_mk;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
                    <label class="control-label" for="form-field-1">Jurusan</label>
                    <div class="controls">
                    	<input type="text" name="jurusan" id="jurusan" value="<?php echo $this->session->userdata('sesi_kd_prodi');?>" readonly="readonly" class="span3" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Kode MK</label>

                    <div class="controls">
                        <input type="text" name="kode" id="kode" placeholder="Kode MK" class="span4" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Semester</label>
                    <div class="controls">
                        <select name="semester" id="semester" class="span2">
                        	<option value="">-Pilih-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Mata Kuliah</label>

                    <div class="controls">
                        <input type="text" name="nama_mk" id="nama_mk" placeholder="Nama Mata Kuliah" class="span10"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">SKS</label>

                    <div class="controls">
                        <input type="text" name="sks" id="sks" placeholder="SKS" class="span2" maxlength="1"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Aktif</label>
                    <div class="controls">
                        <select name="tayang" id="tayang" class="span5">
                        	<option value="Ya" selected="selected">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                </div>
			</form>                
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal" name="close" id="close">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="button" name="add" id="add" class="btn btn-small btn-info pull-left">
            <i class="icon-add"></i>
            Tambah
        </button>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
		</div>
    </div>
</div>   