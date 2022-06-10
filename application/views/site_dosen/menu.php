<?php
if($class=='home'){
	$home = 'class="active"';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
}elseif($class=='master'){
	$home = '';
	$master ='class="active"';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
}elseif($class=='transaksi'){
	$home = '';
	$master ='';
	$transaksi = 'class="active"';
	$laporan = '';
	$grafik = '';
}elseif($class=='laporan'){
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = 'class="active"';
	$grafik = '';					
}else{
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = 'class="active"';
}
?>
<div class="main-container container-fluid">
<a class="menu-toggler" id="menu-toggler" href="#">
    <span class="menu-text"></span>
</a>
<div class="sidebar" id="sidebar">
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <i class="icon-calendar"></i> 
			<?php 
			date_default_timezone_set('Asia/Jakarta');
			echo $this->model_global->hari_ini(date('w')).", ".$this->model_global->tgl_indo(date('Y-m-d'));
			?>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div><!--#sidebar-shortcuts-->
	
    <div align="center">
    <img src="<?php echo base_url();?>assets/img/logo-black.png" width="140">
    <h6><?php echo $this->config->item('nama_instansi');?></h6>
    </div>
    
    <ul class="nav nav-list">
        <li <?php echo $home;?> >
            <a href="<?php echo base_url();?>index.php/site_dosen/home">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li <?php echo $master;?> >
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> AKADEMIK </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo base_url();?>index.php/site_dosen/mata_kuliah">
                        <i class="icon-double-angle-right"></i>
                        MATA KULIAH
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/site_dosen/jadwal">
                        <i class="icon-double-angle-right"></i>
                        JADWAL
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/site_dosen/isi_nilai">
                        <i class="icon-double-angle-right"></i>
                        ISI NILAI
                    </a>
                </li>
            </ul>
        </li>


         <li>
            <a href="<?php echo base_url();?>index.php/login/logout">
                <i class="icon-off"></i>
                <span class="menu-text"> Keluar </span>
            </a>
        </li>
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>