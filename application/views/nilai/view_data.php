<div class="table-header">
    <?php echo $judul;?> 
	
    <div class="widget-toolbar no-border pull-right">
    
    <a href="<?php echo site_url();?>/nilai/tambah" class="btn btn-small btn-info"  >
        <i class="icon-check"></i>
        Tambah
    </a>
    </div>
</div>
<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Th. Akademik</th>
            <th class="center span2">Semester</th>
            <th class="center">Mata Kuliah</th>
            <th class="center">Jumlah Mhs</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$jml_mhs = $this->model_data->jml_data_nilai($dt->th_akademik,$dt->semester,$dt->kd_mk);
			$nm_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td class="center"><?php echo $dt->th_akademik;?></td>
            <td class="center"><?php echo $dt->semester;?></td>
            <td ><?php echo $dt->kd_mk.' - '.$nm_mk;?></td>
            <td class="center span2"><span class="badge badge-important"><?php echo $jml_mhs;?></span></td>
        </tr>
		<?php } ?>
    </tbody>
</table>
