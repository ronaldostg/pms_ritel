<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <div class="alert alert-block alert-warning">
            
            <i class="icon-ok green"></i>

            Selamat datang <strong> <?php echo $this->session->userdata('nama_lengkap');?> (Supervisi <?=strtolower($this->session->userdata('nm_cabang'))?>)</strong> di 
            <strong class="green">
                Aplikasi <?php echo $this->config->item('nama_aplikasi');?>
                <small>(v1.1.0)</small>
            </strong>
            ,
            <?php echo $this->config->item('nama_instansi');?>
        </div>
</div>                            
</div> 



<?php

$kd_cab = $this->session->userdata('kd_cabang');


$alldatamaster = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur where kode_cabang = '$kd_cab'")->row();
$snd1 = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur inner join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where snd = '1' and kode_cabang = '$kd_cab'")->row();
$snd2 = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur inner join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where snd = '2' and kode_cabang = '$kd_cab'")->row();
$snd3 = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur inner join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where snd = '3' and kode_cabang = '$kd_cab'")->row();


?>

<div class="row-fluid">
    <div class="span12 infobox-container">
            <div class="infobox infobox-green  ">
                <div class="infobox-icon">
                    <i class="icon-group"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number" style="font-size: 18px;">All SND</span>
                    <div class="infobox-content">Rp <?=number_format($alldatamaster->jumlahsemusnd , 0 , ',' , ',')?></div>
                </div>
            </div>
            <div class="infobox infobox-blue  ">
                <div class="infobox-icon">
                    <i class="icon-group"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number" style="font-size: 18px;">Realisasi SND 1</span>
                    <div class="infobox-content">Rp <?=number_format($snd1->jumlahsemusnd , 0 , ',' , ',')?> </div>
                </div>
            </div>
            <div class="infobox infobox-red  ">
                <div class="infobox-icon">
                    <i class="icon-group"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number" style="font-size: 18px;">Realisasi SND 2</span>
                    <div class="infobox-content">Rp <?=number_format($snd2->jumlahsemusnd , 0 , ',' , ',')?> </div>
                </div>
            </div>
            <div class="infobox infobox-pink  ">
                <div class="infobox-icon">
                    <i class="icon-group"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number" style="font-size: 18px;">Realisasi SND 3</span>
                    <div class="infobox-content">Rp <?=number_format($snd3->jumlahsemusnd , 0 , ',' , ',')?> </div>
                </div>
            </div>
          
    </div>
</div>

<div class="row-fluid">
	<div class="span12">
    
    </div>
    <div class="span12 infobox-container">
    
    
    <a href="<?php echo base_url();?>index.php/site_supervisi/prospek">
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>


            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_prospek_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">Prospek</div>
            </div>           
        </div>
    </a>
                        

    <!-- <a href="<?php echo base_url();?>index.php/site_supervisi/target">
        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>


            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_target_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">Target</div>
            </div>

        </div>
    </a>


    <a href="<?php echo base_url();?>index.php/site_supervisi/data_collect">
        <div class="infobox infobox-pink  ">
            <div class="infobox-icon">
                <i class="icon-briefcase"></i>
            </div>


            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_data_collect_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">Collect</div>
            </div>
        </div>
    </a> -->


    <a href="<?php echo base_url();?>index.php/site_supervisi/analisa">
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-eye-open"></i>
            </div>


            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_analisa_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">Analisa</div>
            </div>
        </div>
    </a>
<!-- 
    <a href="<?php echo base_url();?>index.php/site_supervisi/komite">
        <div class="infobox infobox-orange2  ">
            <div class="infobox-icon">
                <i class="icon-calendar"></i>
            </div>


            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_komite_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">Komite</div>
            </div>
        </div>
    </a>

    <a href="<?php echo base_url();?>index.php/site_supervisi/sppk">
        <div class="infobox infobox-blue2  ">
            <div class="infobox-icon">
                <i class="icon-envelope-alt "></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_sppk_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">SPPK</div>
            </div>
        </div>
    </a> -->

    <a href="<?php echo base_url();?>index.php/site_supervisi/pk">
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-beaker"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_pk_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">PK</div>
            </div>
        </div>
    </a>
		
    <!-- <a href="<?php echo base_url();?>index.php/site_supervisi/on_book">
		<div class="infobox infobox-orange  ">
            <div class="infobox-icon">
                <i class="icon-coffee"></i> 
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->data_on_book_supervisi_jml_data($username);?> Data</span>
                <div class="infobox-content">On Book</div>
            </div>
        </div>
    </a> -->


        
    </div>
</div>    
<br />
