<script type="text/javascript">
$(document).ready(function(){
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#simpan").click(function(){
		var kode	= $("#kode").val();
		var jurusan	= $("#jurusan").val();
		var nama_dosen	= $("#nama_dosen").val();
		
		var string = $("#my-form").serialize();
		
		
		if(kode.length==0){
			//alert('Maaf, Kode Tidak boleh kosong');
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Kode tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#kode").focus();
			return false();
		}
		
		if(jurusan.length==0){
			//alert('Maaf, Nama Jurusan Tidak boleh kosong');
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Program Studi tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#jurusan").focus();
			return false();
		}
		
		if(nama_dosen.length==0){
			//alert('Maaf, Nama Dosen Tidak boleh kosong');
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama Dosen tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#nama_dosen").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/dosen/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				//location.reload();
				//window.location.assign("<?php echo site_url();?>/mata_kuliah/view_data")
			}
		});
		
	});
	
	function create_kddosen(){
		var kd_prodi	= $("#jurusan").val();	
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/dosen/create_kddosen",
			data	: "kd_prodi="+kd_prodi,
			dataType: "json",
			success	: function(data){
				$('#kode').val(data.kode);
				$('#kode').attr("readonly","true");
			}
		});
	};
	
	$("#tambah").click(function(){
		$('#nidn').val('');
		$('#nama_dosen').val('');
		$('#jk').val('');
		$('#alamat').val('');
		create_kddosen();
	});
	
	$("#add").click(function(){
		$('#nidn').val('');
		$('#nama_dosen').val('');
		$('#jk').val('');
		$('#alamat').val('');
		create_kddosen();
	});
	
	$("#close").click(function(){
		location.reload();
	});

});

function editData(ID){
	var cari	= ID;	
	//alert(cari);
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/dosen/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#nidn').val(data.nidn);
			$('#nama_dosen').val(data.nama_dosen);
			$('#jk').val(data.jk);
			$('#alamat').val(data.alamat);
			$('#tempat_lahir').val(data.tempat_lahir);
			$('#tanggal_lahir').val(data.tanggal_lahir);
			$('#hp').val(data.hp);
			$('#pendidikan').val(data.pendidikan);
			$('#prodi').val(data.prodi);
			$('#status').val(data.status);
		}
	});
	
}

</script>
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
	 <?php echo $this->session->userdata('sesi_kd_prodi');?> ( <?php echo $this->model_data->nama_jurusan($this->session->userdata('sesi_kd_prodi'));?> )
    <div class="widget-toolbar no-border pull-right">
    <a href="#modal-table" class="btn btn-small btn-success"  role="button" data-toggle="modal" name="tambah" id="tambah">
        <i class="icon-check"></i>
        Tambah Data
    </a>
    <a href="<?php echo site_url();?>/dosen/view_data" class="btn btn-small btn-info"  >
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
            <th class="center">Kd Prodi</th>
            <th class="center">NIDN</th>
            <th class="center">Nama Dosen</th>
            <th class="center">L/P</th>
            <th class="center">Pendidikan</th>
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
            <td class="center span2"><?php echo $dt->kd_dosen;?></td>
            <td class="center"><?php echo $dt->kd_prodi;?></td>
            <td class="center"><?php echo $dt->nidn;?></td>
            <td ><?php echo $dt->nama_dosen;?></td>
            <td class="center"><?php echo $dt->sex;?></td>
            <td class="center"><?php echo $dt->pendidikan.' - '.$dt->prodi;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->kd_dosen;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/dosen/hapus/<?php echo $dt->kd_dosen;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            Data Dosen
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
                    <label class="control-label" for="form-field-1">Kode Dosen</label>

                    <div class="controls">
                        <input type="text" name="kode" id="kode" placeholder="Kode Dosen" class="span4" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">NIDN</label>

                    <div class="controls">
                        <input type="text" name="nidn" id="nidn" placeholder="NIDN" class="span3" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Dosen</label>

                    <div class="controls">
                        <input type="text" name="nama_dosen" id="nama_dosen" placeholder="Nama Dosen" class="span10"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Jenis Kelamin</label>
                    <div class="controls">
                        <select name="jk" id="jk" class="span5">
                        	<option value="L" selected="selected">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tempat Lahir</label>
                    <div class="controls">
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="span10"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal Lahir</label>
                    <div class="controls">
                        <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="span5 date-picker"  data-date-format="dd-mm-yyyy"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>
                    <div class="controls">
                        <input type="text" name="alamat" id="alamat" class="span10"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">HP</label>

                    <div class="controls">
                        <input type="text" name="hp" id="hp" class="span8"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Jenjang Pendidikan</label>

                    <div class="controls">
                        <select name="pendidikan" id="pendidikan" class="span5">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->jenjang_pendidikan();
							foreach($data as $dt){
							?>
                            <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Program Studi</label>

                    <div class="controls">
                        <input type="text" name="prodi" id="prodi" class="span8"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Status</label>

                    <div class="controls">
                        <select name="status" id="status" class="span5">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->status_dosen();
							foreach($data as $dt){
							?>
                            <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                            <?php } ?>
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