<?php
if($class=='home'){
	$home = 'class="active"';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
    $masterdebitur = '';

}elseif($class=='master'){
	$home = '';
	$master ='class="active"';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
    $masterdebitur = '';

}elseif($class=='transaksi'){
	$home = '';
	$master ='';
	$transaksi = 'class="active"';
	$laporan = '';
	$grafik = '';
    $masterdebitur = '';
    
}elseif($class=='laporan'){
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = 'class="active"';
	$grafik = '';		
    $masterdebitur = '';

}else if($class=='masterdebitur'){

    $home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';		
    $masterdebitur = 'class="active"';

}else{
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = 'class="active"';
    $masterdebitur = '';
    
}


$uri = $_SERVER['REQUEST_URI'];
$x = explode('/' , $uri);
if(!empty($x[3])){
    if(!empty($x[4])){
        $getUri = $x[4];
    }else{
        $getUri = $x[3];
    }
}else{
    $getUri = '';
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
	
    <h6><?php echo "";?></h6>
    
    </div>
    
    <ul class="nav nav-list">
        <li <?php echo $home;?> >
            <a href="<?php echo base_url();?>index.php/site_supervisi/home">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li <?=$masterdebitur?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> Master Data</span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">

                    <li class="<?=$getUri == 'supervisiapprove' ? 'active' : ''?>">
                            <a href="<?php echo base_url();?>index.php/supervisiapprove">
                                <i class="icon-double-angle-right"></i>
                                Data Debitur
                            </a>
                    </li>

                    
                    <?php 
                        if($this->session->userdata('kode_admin') == '2'){
                    
                    ?>
                       
                        <li class="<?=$getUri == 'ajukansupervisisnd' ? 'active' : ''?>">
                            <a href="<?php echo base_url();?>index.php/ajukansupervisisnd">
                                <i class="icon-double-angle-right"></i>
                                Sebarkan keunit kantor
                            </a>
                        </li>
                    <?php }else{?>
                   
            
                        <li class="<?=$getUri == 'delegasidebitur' ? 'active' : ''?>">
                            <a href="<?php echo base_url();?>index.php/delegasidebitur">
                                <i class="icon-double-angle-right"></i>
                                Delegasi debitur
                            </a>
                        </li>

                    <?php }?>

                 
                </ul>
        </li>

        <li <?php echo $master;?> >
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Data </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                
                <li class="<?=$getUri == 'prospek' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/prospek">
                        <i class="icon-double-angle-right"></i>
                        Prospek
                    </a>
                </li>                
                <!-- <li class="<?=$getUri == 'target' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/target">
                        <i class="icon-double-angle-right"></i>
                        Target
                    </a>
                </li>  
                <li class="<?=$getUri == 'data_collect' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/data_collect">
                        <i class="icon-double-angle-right"></i>
                        Data Coll
                    </a>
                </li>   -->
                <li class="<?=$getUri == 'analisa' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/analisa">
                        <i class="icon-double-angle-right"></i>
                        Analisa
                    </a>
                </li>  
                <!-- <li class="<?=$getUri == 'komite' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/komite">
                        <i class="icon-double-angle-right"></i>
                        Komite
                    </a>
                </li>  
                <li>
                    <a href="<?php echo base_url();?>index.php/site_supervisi/sppk">
                        <i class="icon-double-angle-right"></i>
                        SPPK
                    </a>
                </li>   -->
                <li class="<?=$getUri == 'pk' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/pk">
                        <i class="icon-double-angle-right"></i>
                        Pencairan Kredit
                    </a>
                </li>  
                <!-- <li class="<?=$getUri == 'on_book' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/on_book">
                        <i class="icon-double-angle-right"></i>
                        On Book
                    </a>
                </li>                              -->
            </ul>
        </li>
                    

        <!-- <li>
                <a href="<?php echo base_url();?>index.php/report">
                    <i class="icon-print"></i>
                    <span class="menu-text"> Report </span>
                </a>
        </li>                 -->
        <!-- <li>
                <a href="<?php echo base_url();?>index.php/site_supervisi/manajemenuser">
                    <i class="icon-user"></i>
                    <span class="menu-text"> Manajemen User </span>
                </a>
        </li>                 -->


        <!-- <li <?php echo $transaksi;?>>
			<a href="#" class="dropdown-toggle">
                <i class="icon-edit"></i>
                <span class="menu-text"> Transaksi </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li class="<?=$getUri == 'mutasi_data' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/mutasi_data">
                        <i class="icon-double-angle-right"></i>
                        Mutasi Data
                    </a>
                </li>  


            </ul>
        </li> -->
<!-- 
        <li <?php echo $laporan;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-print"></i>
                <span class="menu-text"> Laporan </span>
                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
            	 <li class="<?=$getUri == 'lap_aktivitas' ? 'active' : ''?>">
                 	<a href="<?php echo base_url();?>index.php/site_supervisi/lap_aktivitas">
                        <i class="icon-double-angle-right"></i>
                        Aktivitas
                    </a>
                </li>                 
            	 <li class="<?=$getUri == 'lap_pipeline' ? 'active' : ''?>">
                 	<a href="<?php echo base_url();?>index.php/site_supervisi/lap_pipeline">
                        <i class="icon-double-angle-right"></i>
                        Pipeline
                    </a>
                </li>                 


            </ul>
        </li> -->

        <!-- <li <?php echo $grafik;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-bar-chart"></i>
                <span class="menu-text">
                    Grafik
                </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li class="<?=$getUri == 'grafik' ? 'active' : ''?>">
                    <a href="<?php echo base_url();?>index.php/site_supervisi/grafik/pipeline">
                        <i class="icon-double-angle-right"></i>
                        Pipeline
                    </a>
                </li>
            </ul>
        </li>
         -->

          <!-- <li>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-user"></i>
                    <span class="menu-text">
                        Manajemen user
                    </span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">
                    <li class="<?=$getUri == 'userao' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/manajemenuser/userao">
                            <i class="icon-double-angle-right"></i>
                            User AO
                        </a>
                    </li>
                </ul>
            </li> -->
        
         <li>
            <a href="<?=base_url('assets/file/Buku Panduan Aplikasi PMS RITEL.pdf')?>" download>
                <i class="icon-download"></i>
                <span class="menu-text"> User Guide </span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url();?>login/logout">
                <i class="icon-off"></i>
                <span class="menu-text"> Keluar </span>
            </a>
        </li>
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>