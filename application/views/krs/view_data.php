<div class="table-header">
    <?php echo $judul;?> 
	
    <div class="widget-toolbar no-border pull-right">
    
    <a href="<?php echo site_url();?>/krs/tambah" class="btn btn-small btn-info"  >
        <i class="icon-check"></i>
        Tambah
    </a>
    </div>
</div>
<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">Tahun Akademik</th>
            <th class="center">Semester</th>
            <th class="center">Prodi</th>
            <th class="center">Jumlah Mhs</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$prodi = $this->model_data->nama_jurusan($dt->kd_prodi);
			$jml_mhs = $this->model_data->jml_data_krs($dt->th_akademik,$dt->semester,$dt->kd_prodi);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span3"><?php echo $dt->th_akademik;?></td>
            <td class="center span3"><?php echo $dt->semester;?></td>
            <td class="center"><?php echo $dt->kd_prodi.' - '.$prodi;?></td>
            <td class="center span2"><span class="badge badge-important"><?php echo $jml_mhs;?></span>
	            <a class="blue" href="<?php echo base_url();?>index.php/krs/view_detail/<?php echo $dt->id_jadwal;?>">
                    <i class="icon-zoom-in bigger-130"></i>
                </a>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>
