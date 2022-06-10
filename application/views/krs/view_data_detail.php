<div class="table-header">
    <?php echo $judul;?> 
	
    <div class="widget-toolbar no-border pull-right">
    
    <a href="<?php echo site_url();?>/krs" class="btn btn-small btn-info"  >
        <i class="icon icon-arrow-left"></i>
        Kembali
    </a>
    </div>
</div>
<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">NIM</th>
            <th class="center">Nama Mahasiswa</th>
            <th class="center">Prodi</th>
            <th class="center">Status</th>
            <th class="center">Jumlah</th>
            <th class="center">Ket</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$prodi = $this->model_data->nama_jurusan($dt->kd_prodi);
			$jml_sks = $this->model_data->cari_jml_sks_krs_($dt->th_akademik,$dt->nim);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->nim;?></td>
            <td ><?php echo $dt->nama_mhs;?></td>
            <td class="center"><?php echo $dt->kd_prodi.' - '.$prodi;?></td>
            <td class="center span2"><?php echo $dt->status;?></td>
            <td class="center span2"><span class="badge badge-success"><?php echo $jml_sks;?></span></td>
            <td class="center">SKS</td>
        </tr>
		<?php } ?>
    </tbody>
</table>
