<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">NIM</th>
            <th class="center">Nama Mahasiswa</th>
            <th class="center">L/P</th>
            <th class="center">Tanggal</th>
            <th class="center">Judul Skripsi</th>
            <th class="center">IPK</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		$tgl = $this->model_global->tgl_indo($dt->tgl_daftar);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->nim;?></td>
            <td ><?php echo $dt->nama_mhs;?></td>
            <td class="center"><?php echo $dt->sex;?></td>
            <td class="center"><?php echo $tgl;?></td>
            <td><?php echo $dt->judul_skripsi;?></td>
            <td class="center"><?php echo $dt->ipk;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>