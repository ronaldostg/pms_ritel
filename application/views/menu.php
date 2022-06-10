<?php
if($class=='home'){
	$home = 'class="active"';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
    $masterdebitur = '';
    $manajemenuser = '';
    $report = '';
}elseif($class=='master'){
	$home = '';
	$master ='class="active"';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
    $masterdebitur = '';
    $manajemenuser = '';
    $report = '';
}elseif($class=='transaksi'){
	$home = '';
	$master ='';
	$transaksi = 'class="active"';
	$laporan = '';
	$grafik = '';
    $masterdebitur = '';
    $manajemenuser = '';
    $report = '';
}elseif($class=='laporan'){
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = 'class="active"';
	$grafik = '';		
    $masterdebitur = '';
    $manajemenuser = '';
    $report = '';
}else if($class == 'masterdebitur'){
    $home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';	
    $masterdebitur = 'class="active"';
    $manajemenuser = '';
    $report = '';
}else if($class == 'manajemenuser'){
    $home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';	
    $masterdebitur = '';
    $manajemenuser = 'class="active"';
    $report = '';
}else if($class == "report"){
    $home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';	
    $masterdebitur = '';
    $manajemenuser = '';
    $report = 'class="active"';
}else if($class == "tpkad"){
    $home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = '';	
    $masterdebitur = '';
    $manajemenuser = '';
    $report = 'class="active"';
}else{
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
	$grafik = 'class="active"';
    $masterdebitur = '';
    $manajemenuser = '';
    $report = '';
}

$uri = $_SERVER['REQUEST_URI'];
$x = explode('/' , $uri);
if(!empty($x[3])){
    $getUri = $x[3];
    // if(!empty($x[4])){
    //     $getUri = $x[4];
    // }else{
    //     $getUri = $x[3];
    // }
}else{
    $getUri = '';
}
// $getUri = str_replace('/' , '' , $uri);
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
        </div>
        <!--#sidebar-shortcuts-->

        <div align="center">
            <img src="<?php echo base_url();?>assets/img/logo-black.png" width="140">

        </div>

        <ul class="nav nav-list">
            <li <?php echo $home;?>>
                <a href="<?php echo base_url();?>index.php/home">
                    <i class="icon-dashboard"></i>
                    <span class="menu-text"> Dashboard <?=$report?></span>
                </a>
            </li>
            <?php 
            if($this->session->userdata('akses') != 'adminkantor'){
             ?>
            <?php 
            if($this->session->userdata('akses') == 'admin'){
             ?>
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
                    <li class="<?=$getUri == 'masterdebitur' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/masterdebitur">
                            <i class="icon-double-angle-right"></i>
                            Upload Debitur
                        </a>
                    </li>
                    <!-- <li class="<?=$getUri == 'settingunitcabang' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/settingunitcabang">
                            <i class="icon-double-angle-right"></i>
                            Setting unit cabang
                        </a>
                    </li> -->


                   
                   


                </ul>
            </li>
          
            <?php }else{?>
            <li <?=$masterdebitur?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> Master Data</span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">

                    <?php 
                        if($this->session->userdata('username') == 'u2852'){
                    ?>
                        <li class="<?=$getUri == 'masterdebitur' ? 'active' : ''?>">
                            <a href="<?php echo base_url();?>index.php/masterdebitur">
                                <i class="icon-double-angle-right"></i>
                                Upload Debitur
                            </a>
                        </li>
                    <?php }?>
                    

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
                   
                        <!-- <li class="<?=$getUri == 'masterdebitur' ? 'active' : ''?>">
                            <a href="<?php echo base_url();?>index.php/masterdebitur">
                                <i class="icon-double-angle-right"></i>
                                Terima Debitur
                            </a>
                        </li> -->
                        <li class="<?=$getUri == 'delegasidebitur' ? 'active' : ''?>">
                            <a href="<?php echo base_url();?>index.php/delegasidebitur">
                                <i class="icon-double-angle-right"></i>
                                Delegasi debitur
                            </a>
                        </li>

                    <?php }?>

                 
                </ul>
            </li>
            <?php }?>
            <li <?php echo $master;?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> Data </span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">
                    <li class="<?=$getUri == 'prospek' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/prospek">
                            <i class="icon-double-angle-right"></i>
                            Prospek
                        </a>
                    </li>
                    <!-- <li class="<?=$getUri == 'target' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/target">
                            <i class="icon-double-angle-right"></i>
                            Target
                        </a>
                    </li>
                    <li class="<?=$getUri == 'data_collect' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/data_collect">
                            <i class="icon-double-angle-right"></i>
                            Data Coll
                        </a>
                    </li> -->
                    <li class="<?=$getUri == 'analisa' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/analisa">
                            <i class="icon-double-angle-right"></i>
                            Analisa
                        </a>
                    </li>
                    <!-- <li class="<?=$getUri == 'komite' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/komite">
                            <i class="icon-double-angle-right"></i>
                            Komite
                        </a>
                    </li>
                    <li class="<?=$getUri == 'sppk' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/sppk">
                            <i class="icon-double-angle-right"></i>
                            SPPK
                        </a>
                    </li> -->
                    <li class="<?=$getUri == 'pk' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/pk">
                            <i class="icon-double-angle-right"></i>
                            Pencairan Kredit
                        </a>
                    </li>

                    <li class="<?=$getUri == 'tpkad' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/tpkad">
                            <i class="icon-double-angle-right"></i>
                            Pengajuan TPAKD
                        </a>
                    </li>
                    <!-- <li class="<?=$getUri == 'on_book' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/on_book">
                            <i class="icon-double-angle-right"></i>
                            On Book
                        </a>
                    </li> -->

                </ul>
            </li>
            
            <!-- <li>
                <a href="<?php echo base_url();?>index.php/report">
                    <i class="icon-print"></i>
                    <span class="menu-text"> Report  </span>
                </a>
            </li> -->

            <li <?php echo $report;?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-print"></i>
                    <span class="menu-text">
                        Report
                    </span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'realisasiao'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/report?type=realisasiao">
                            <i class="icon-double-angle-right"></i>
                            Realisasi AO
                        </a>
                    </li>
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'realisasisnd'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/report?type=realisasisnd">
                            <i class="icon-double-angle-right"></i>
                            Realisasi SND
                        </a>
                    </li>
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'jenisguna'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/report?type=jenisguna">
                            <i class="icon-double-angle-right"></i>
                            Realisasi jenis guna
                        </a>
                    </li>
                </ul>
            </li>
<!-- 
            <li <?php echo $transaksi;?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-edit"></i>
                    <span class="menu-text"> Transaksi </span>

                    <b class="arrow icon-angle-down"></b>
                </a>

                <ul class="submenu">
                    <li class="<?=$getUri == 'mutasi_data' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/mutasi_data">
                            <i class="icon-double-angle-right"></i>
                            Mutasi Data
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li <?php echo $laporan;?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-print"></i>
                    <span class="menu-text"> Laporan </span>
                    <b class="arrow icon-angle-down"></b>
                </a>

                <ul class="submenu">
                    <li class="<?=$getUri == 'lap_aktivitas' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/lap_aktivitas">
                            <i class="icon-double-angle-right"></i>
                            Aktivitas
                        </a>
                    </li>
                    <li class="<?=$getUri == 'lap_pipeline' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/lap_pipeline">
                            <i class="icon-double-angle-right"></i>
                            Pipeline
                        </a>
                    </li>
                </ul>
            </li> -->

            <li <?php echo $grafik;?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="menu-text">
                        Grafik
                    </span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">
                    <!-- <li class="<?=$getUri == 'grafik' ? 'active' : ''?>">
                        <a href="<?php echo base_url();?>index.php/grafik/pipeline">
                            <i class="icon-double-angle-right"></i>
                            Pipeline
                        </a>
                    </li> -->
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'ao'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/grafik?type=ao">
                            <i class="icon-double-angle-right"></i>
                            Acount Officer
                        </a>
                    </li>
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'cabang'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/grafik?type=cabang">
                            <i class="icon-double-angle-right"></i>
                            Cabang
                        </a>
                    </li>
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'capem'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/grafik?type=capem">
                            <i class="icon-double-angle-right"></i>
                            Cabang Pembantu
                        </a>
                    </li>
                </ul>
            </li>
            <?php }?>

            <li <?php echo $manajemenuser;?>>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-user"></i>
                    <span class="menu-text">
                        Manajemen user
                    </span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu">
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'supervisi'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/manajemenuser?type=supervisi">
                            <i class="icon-double-angle-right"></i>
                            Supervisi
                        </a>
                    </li>
                    <li
                        <?php 
                            if(isset($_GET['type'])){

                                if($_GET['type'] == 'userao'){
                                    echo "class='active'";
                                }

                            }
                        ?>
                    >
                        <a href="<?php echo base_url();?>index.php/manajemenuser/userao?type=userao">
                            <i class="icon-double-angle-right"></i>
                            User AO
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
         
        </ul>
        <!--/.nav-list-->

        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="icon-double-angle-left"></i>
        </div>
    </div>