<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center">Hari</th>
            <th class="center">Pukul</th>
            <th class="center">Ruang</th>
            <th class="center">Mata Kuliah</th>
            <th class="center" width="10">SKS</th>
            <th class="center">Jumlah Mahasiswa</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
			$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
			$jml_mhs= $this->model_data->cari_jml_mhs_mk($dt->th_akademik,$dt->kd_mk,$dt->kd_dosen);
		?>
        <tr>
            <td class="center"><?php echo $i++?></td>
            <td class="center"><?php echo $dt->hari;?></td>
            <td class="center"><?php echo $dt->pukul;?></td>
            <td class="center"><?php echo $dt->ruang;?></td>
            <td ><?php echo $dt->kd_mk.' - '.$nama_mk;?></td>
            <td class="center"><?php echo $dt->sks;?></td>
            <td class="center"><?php echo $jml_mhs;?> Orang</td>
        </tr>
		<?php 
		} ?>
    </tbody>
</table>