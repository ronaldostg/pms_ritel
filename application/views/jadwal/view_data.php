<script type="text/javascript">
$(document).ready(function(){
	
});


</script>
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
    <div class="widget-toolbar no-border pull-right">
    <a href="<?php echo base_url();?>index.php/jadwal/tambah" class="btn btn-small btn-success"  name="tambah" id="tambah" >
        <i class="icon-check"></i>
        Tambah Data
    </a>
    <a href="<?php echo site_url();?>/jadwal" class="btn btn-small btn-info"  >
        <i class="icon-refresh"></i>
        Refresh
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Th Akademik</th>
            <th class="center">Semester</th>
            <th class="center">Program Studi</th>
            <th class="center">Status</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$nama_prodi = $this->model_data->nama_jurusan($dt->kd_prodi);
			$jml = $this->model_data->jml_data_jadwal($dt->th_akademik,$dt->semester,$dt->kd_prodi);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->th_akademik;?></td>
            <td class="center"><?php echo $dt->semester;?></td>
            <td ><?php echo $dt->kd_prodi;?> - <?php echo $nama_prodi;?></td>
            <td class="center"><?php echo $jml;?> Jadwal</td>
        </tr>
		<?php } ?>
    </tbody>
</table>
</div>