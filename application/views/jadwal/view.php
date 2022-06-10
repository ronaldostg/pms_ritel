<script type="text/javascript">
	function cari_jadwal(){
		var th_ak = $("#th_akademik").val();
		var kd_prodi = $("#kd_prodi").val();
		var smt = $("#smt").val();
		
		if(smt.length==0){
			alert('Semester tidak boleh kosong');
			$("#smt").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/jadwal/cari_jadwal",
			data	: "kd_prodi="+kd_prodi+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#view_data").html(data);
			}
		});
	}
	
	function hapus(id){
		var r = confirm("Yakin akan menghapus data ini!");
		if (r == true) {
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/jadwal/hapus",
				data	: "id="+id,
				cache	: false,
				success	: function(data){
					$.gritter.add({
						title: 'Info..!!',
						text: data,
						class_name: 'gritter-info' 
					});
					cari_jadwal();
				}
			});
		}
			
	}
</script>
<div class="row-fluid">
<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Hari</th>
            <th class="center">Pukul</th>
            <th class="center">Ruang</th>
            <th class="center">Mata Kuliah</th>
            <th class="center">Dosen</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
			$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->hari;?></td>
            <td class="center"><?php echo $dt->pukul;?></td>
            <td class="center"><?php echo $dt->ruang;?></td>
            <td ><?php echo $dt->kd_mk;?> - <?php echo $nama_mk;?></td>
            <td ><?php echo $dt->kd_dosen;?> - <?php echo $nama_dosen;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="red" href="javascript:" onClick="hapus('<?php echo $dt->id_jadwal;?>')">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>
                </center>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>
</div>