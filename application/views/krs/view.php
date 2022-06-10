<script type="text/javascript">
	function hapus(id){
		var r = confirm("Yakin akan menghapus data ini!");
		if (r == true) {
			$.ajax({
				type	: 'POST',
				url		: "<?php echo site_url(); ?>/krs/hapus",
				data	: "id="+id,
				cache	: false,
				success	: function(data){
					$.gritter.add({
						title: 'Info..!!',
						text: data,
						class_name: 'gritter-info' 
					});
					cari_krs();
				}
			});
		}
			
	}
	
	function cari_krs(){
		var th_ak = $("#th_ak").val();
		var nim = $("#nim").val();
		var smt = $("#semester").val();
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/krs/cari_krs",
			data	: "nim="+nim+"&smt="+smt+"&th_ak="+th_ak,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}

</script>


<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center">Mata Kuliah</th>
            <th class="center" width="10">SKS</th>
            <th class="center">Dosen</th>
            <th class="center">Hari</th>
            <th class="center">Pukul</th>
            <th class="center">Ruang</th>
            <th class="center" width="20">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		$t_sks=0;
		foreach($data->result() as $dt){ 
			$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
			$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td ><?php echo $dt->kd_mk.' - '.$nama_mk;?></td>
            <td class="center"><?php echo $dt->sks;?></td>
            <td ><?php echo $dt->kd_dosen.' - '.$nama_dosen;?></td>
            <td class="center"><?php echo $dt->hari;?></td>
            <td class="center"><?php echo $dt->pukul;?></td>
            <td class="center"><?php echo $dt->ruang;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="red" href="javascript:" onClick="hapus('<?php echo $dt->id_krs;?>')">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>
                </center>
            </td>
        </tr>
		<?php 
		$t_sks = $t_sks+$dt->sks;
		} ?>
        <tr>
        	<td colspan="2" class="center">Total SKS</td>
            <td class="center"><?php echo $t_sks;?></td>
            <td colspan="5"></td>
        </tr>
    </tbody>
</table>
