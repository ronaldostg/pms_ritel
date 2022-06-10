<div class="row-fluid">
<h3 class="header smaller lighter blue"><?php echo $judul;?></h3>
<div class="table-header"><?php echo $judul;?>
    <div class="pull-right" style="padding-right:4px;">
    <a href="<?php echo base_url();?>index.php/mata_pelajaran/tambah" class="btn btn-small btn-success"><i class="icon-ok bigger-110"></i>
    Tambah Data
    </a>
    </div>
</div>            
    <table class="table fpTable lcnp table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center">No</th>
                <th class="center">Kode</th>

                <th class="center">Mata Pelajaran</th>
                <th class="center">Jenis</th>
                <th class="center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php 
        $i=1;
        foreach($data as $dt){
        ?>
            <tr>
                <td class="center span2"><?php echo $i++;?></td>
                <td class="span2"><?php echo $dt->id_mp;?></td>

                <td>
                    <?php echo $dt->mata_pelajaran;?></td>
                </td>
                <td>
                    <?php echo $dt->jenis;?></td>
                </td>
                <td class="center td-actions span2">
        <div class="hidden-phone visible-desktop action-buttons">
            <a class="green" href="#">
                <i class="icon-pencil bigger-130"></i>
            </a>
            <a class="red" href="#">
                <i class="icon-trash bigger-130"></i>
            </a>
        </div>
        <div class="hidden-desktop visible-phone">
            <div class="inline position-relative">
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
    </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
        