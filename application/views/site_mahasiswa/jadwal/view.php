<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center">Hari</th>
            <th class="center">Pukul</th>
            <th class="center">Ruang</th>
            <th class="center">Mata Kuliah</th>
            <th class="center" width="10">SKS</th>
            <th class="center">Dosen</th>
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
            <td class="center"><?php echo $dt->hari;?></td>
            <td class="center"><?php echo $dt->pukul;?></td>
            <td class="center"><?php echo $dt->ruang;?></td>
            <td ><?php echo $dt->kd_mk.' - '.$nama_mk;?></td>
            <td class="center"><?php echo $dt->sks;?></td>
            <td ><?php echo $dt->kd_dosen.' - '.$nama_dosen;?></td>
        </tr>
		<?php 
		$t_sks = $t_sks+$dt->sks;
		} ?>
    </tbody>
</table>