<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center span2">Th. Akademik</th>
            <th class="center span2">NIM</th>
            <th class="center">Nama Mahasiswa</th>
            <th class="center" width="10">L/P</th>
            <th class="center">Program Studi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$nama_prodi = $this->model_data->nama_jurusan($dt->kd_prodi);
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td class="center"><?php echo $dt->th_akademik;?></td>
            <td class="center">
			<a href="<?php echo base_url();?>index.php/mahasiswa/edit/<?php echo $dt->nim;?>">
			<?php echo $dt->nim;?></a>
            </td>
            <td ><?php echo $dt->nama_mhs;?></td>
            <td class="center" ><?php echo $dt->sex;?></td>
            <td ><?php echo $dt->kd_prodi.'-'.$nama_prodi;?></td>
        </tr>
		<?php 
		} 
		?>
    </tbody>
</table>