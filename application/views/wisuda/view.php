<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
    <div class="widget-toolbar no-border pull-right">
    <a href="<?php echo base_url();?>index.php/wisuda/tambah" class="btn btn-small btn-success"  name="tambah" id="tambah">
        <i class="icon-check"></i>
        Tambah Data
    </a>
    <a href="<?php echo site_url();?>/wisuda" class="btn btn-small btn-info"  >
        <i class="icon-refresh"></i>
        Refresh
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Tahun</th>
            <th class="center">Tanggal</th>
            <th class="center">NIM</th>
            <th class="center">Nama Mahasiswa</th>
            <th class="center">L/P</th>
            <th class="center">IPK</th>
            <th class="center">Valid</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		//$data = $this->model_data->data_mk();
		$i=1;
		foreach($data->result() as $dt){ 
			$tgl = $this->model_global->tgl_indo($dt->tgl_daftar);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->th_akademik;?></td>
            <td class="center"><?php echo $tgl;?></td>
            <td class="center"><?php echo $dt->nim;?></td>
            <td ><?php echo $dt->nama_mhs;?></td>
            <td class="center"><?php echo $dt->sex;?></td>
            <td class="center"><?php echo $dt->ipk;?></td>
            <td class="center">
			<?php
			$valid = $dt->acc_akademik;
			if($valid=='T'){
			?>
            <span class="badge badge-important">
			<?php echo $dt->acc_akademik;?>
            </span>
            <?php }else{ ?>
            <span class="badge badge-success">
			<?php echo $dt->acc_akademik;?>
            </span>
            <?php } ?>
            </td>            
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="<?php echo site_url();?>/wisuda/edit/<?php echo $dt->id_wisuda;?>" >
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/wisuda/hapus/<?php echo $dt->id_wisuda;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>

                <div class="hidden-desktop visible-phone">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-caret-down icon-only bigger-120"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green">
                                        <i class="icon-edit bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                        <i class="icon-trash bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </center>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>
</div>
 