<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center" width="80" >PRODI</th>
            <th class="center" width="90">Kode</th>
            <th class="center">Nama Mata Kuliah</th>
            <th class="center" width="10">SKS</th>
            <th class="center" width="10">SMT</th>
            <th class="center">Semester</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$t_sks =0;
		$i=1;
		foreach($data->result() as $dt){ 
			$sing = $this->model_data->singkat_jurusan($dt->kd_prodi);
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td class="center"><?php echo $dt->kd_prodi.' ('.$sing.')';?></td>
            <td class="center"><?php echo $dt->kd_mk;?></td>
            <td ><?php echo $dt->nama_mk;?></td>
            <td class="center"><?php echo $dt->sks;?></td>
            <td class="center"><?php echo $dt->smt;?></td>
            <td class="center"><?php echo $dt->semester;?></td>
        </tr>
		<?php 
			$t_sks = $t_sks+$dt->sks;
		} ?>
        <tr>
        	<td colspan="4" class="center">Total SKS</td>
            <td class="center"><?php echo $t_sks;?></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>