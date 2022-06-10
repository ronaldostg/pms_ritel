Ket : <span class="badge badge-important">Belum mengisi</span> bisa jadi Mahasiswa Proses Wisuda.
<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">NIM</th>
            <th class="center">Nama Mahasiswa</th>
            <th class="center">L/P</th>
            <th class="center">Jml SKS</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$jml_sks = $this->model_data->cari_jml_sks_krs_($th_ak,$dt->nim);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->nim;?></td>
            <td ><?php echo $dt->nama_mhs;?></td>
            <td class="center"><?php echo $dt->sex;?></td>
            <td class="center">
			<?php
			if($jml_sks==0){
			?>
            <span class="badge badge-important">Belum Mengisi</span>
			<?php 
			}else{
				echo $jml_sks;
			}?>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>