<?php
$username = $this->session->userdata('username');
$nama_user = $this->model_data->ambil_data_user("nama_lengkap","admin",$username); 
$month = date('m');
$bulan = array(
    '01' => "Januari",
    '02' => "Februari",
    '03' => "Maret",
    '04' => "April",
    '05' => "Mei",
    '06' => "Juni",
    '07' => "Juli",
    '08' => "Agustus",
    '09' => "Septemper",
    '10' => "Oktober",
    '11' => "November",
    '12' => "Desember",
);
?>




<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <div class="alert alert-block alert-success">

            <i class="icon-ok green"></i>

            Selamat datang di </strong>
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



$alldatamaster = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where month(t_master_debitur.tanggal_release) = '$month' and t_pk.status_data = '2'")->row();
$snd1 = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where snd = '1' and month(t_master_debitur.tanggal_release) = '$month' and t_pk.status_data = '2'")->row();
$snd2 = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where snd = '2' and month(t_master_debitur.tanggal_release) = '$month' and t_pk.status_data = '2'")->row();
$snd3 = $this->db->query("SELECT sum(plafond_akhir) as jumlahsemusnd FROM t_master_debitur join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where snd = '3' and month(t_master_debitur.tanggal_release) = '$month' and t_pk.status_data = '2'")->row();


?>

<div class="row-fluid">
    <div class="span12 green" style="text-align :center;">
        <h3>Total Realisasi <?=$bulan[$month]?></h3>
    </div>
</div>
<br />
<div class="row-fluid">
    <div class="span12 infobox-container">
            <div class="infobox infobox-green  ">
                <div class="infobox-icon">
                    <i class="icon-group"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number" style="font-size: 18px;">All SND </span>
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


        <a href="<?php echo base_url();?>index.php/prospek">
            <div class="infobox infobox-green  ">
                <div class="infobox-icon">
                    <i class="icon-group"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number"><?php echo $this->db->query("select * from t_prospek where status_data = '0' and SUBSTR(tgl_input , 6 ,2) = '$month'")->num_rows();?> Data</span>
                    <div class="infobox-content">Prospek</div>
                </div>
            </div>
        </a>


        <!-- <a href="<?php echo base_url();?>index.php/target">
        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('t_target');?> Data</span>
                <div class="infobox-content">Target</div>
            </div>

        </div>
        </a>


        <a href="<?php echo base_url();?>index.php/data_collect">
            <div class="infobox infobox-pink  ">
                <div class="infobox-icon">
                    <i class="icon-briefcase"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number"><?php echo $this->model_data->jml_data('t_data_collect');?> Data</span>
                    <div class="infobox-content">Data Collect</div>
                </div>
            </div>
        </a> -->


        <a href="<?php echo base_url();?>index.php/analisa">
            <div class="infobox infobox-red  ">
                <div class="infobox-icon">
                    <i class="icon-eye-open"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number"><?php echo $this->db->query("select  t_prospek.tgl_input , t_analisa.*   from t_analisa join t_prospek on t_prospek.id_prospek = t_analisa.id_prospek where t_analisa.status_data = 0  and SUBSTR(t_prospek.tgl_input , 6 ,2) = '$month'")->num_rows();?> Data</span>
                    <div class="infobox-content">Analisa</div>
                </div>
            </div>
        </a>

        <!-- <a href="<?php echo base_url();?>index.php/komite">
        <div class="infobox infobox-orange2  ">
            <div class="infobox-icon">
                <i class="icon-calendar"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('t_komite');?> Data</span>
                <div class="infobox-content">Komite</div>
            </div>
        </div>
        </a>

        <a href="<?php echo base_url();?>index.php/sppk">
            <div class="infobox infobox-blue2  ">
                <div class="infobox-icon">
                    <i class="icon-envelope-alt "></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number"><?php echo $this->model_data->jml_data('t_sppk');?> Data</span>
                    <div class="infobox-content">SPPK</div>
                </div>
            </div>
        </a> -->

            <a href="<?php echo base_url();?>index.php/pk">
                <div class="infobox infobox-red  ">
                    <div class="infobox-icon">
                        <i class="icon-beaker"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number"><?php echo $this->db->query("select  t_prospek.tgl_input , t_prospek.nama_prospek, t_pk.*   from t_pk join t_prospek on t_prospek.id_prospek = t_pk.id_prospek where t_pk.status_data in (0,1) and SUBSTR(t_prospek.tgl_input , 6 ,2) = '$month';")->num_rows();?> Data</span>
                        <div class="infobox-content">PK (Belum cair)</div>
                    </div>
                </div>
            </a>
            <a href="<?php echo base_url();?>index.php/pk">
                <div class="infobox infobox-green  ">
                    <div class="infobox-icon">
                        <i class="icon-beaker"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number"><?php echo $this->db->query("select  t_prospek.tgl_input , t_prospek.nama_prospek, t_pk.*   from t_pk join t_prospek on t_prospek.id_prospek = t_pk.id_prospek where t_pk.status_data = '2' and SUBSTR(t_prospek.tgl_input , 6 ,2) = '$month';")->num_rows();?> Data</span>
                        <div class="infobox-content">PK (Sudah cair)</div>
                    </div>
                </div>
            </a>

            <!-- <a href="<?php echo base_url();?>index.php/on_book">
            <div class="infobox infobox-orange  ">
                <div class="infobox-icon">
                    <i class="icon-coffee"></i> 
                </div>


                <div class="infobox-data">
                    <span class="infobox-data-number"><?php echo $this->model_data->jml_data('t_on_book');?> Data</span>
                    <div class="infobox-content">On Book</div>
                </div>
            </div>
        </a> -->



    </div>
</div>
<br />
<br />

<div class="row-fluid">
<div class="table-header">
    Data pencairan kredit bulan <?=$bulan[$month]?>
    <div class="widget-toolbar no-border pull-right">

    </div>
</div>

<table  class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="5">No</th>
            <th class="center" width="80">Nama Prospek</th>
            <th class="center" width="50">Realisasi Plafond</th>
            <th class="center" width="50">Baki Debet Lama</th>
            <th class="center" width="50">Realisasi Real</th>
            <th class="center" width="20">Status</th>

        </tr>
    </thead>
    <tbody>
        <?php 
			$q = $this->db->query("SELECT * FROM t_pk left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur where  substr( tanggal_snd_update, 6 , 2) = '$month' order by t_master_debitur.plafond_akhir desc LIMIT 10")->result();
            $no = 1;
            if(!empty($q)){
            foreach($q as $r){
        ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$r->nama_debitur?></td>
                <td style="text-align: right;">Rp. <?=number_format($r->plafond_akhir , 0 , '.' , '.')?></td>
                <td style="text-align: right;">Rp. <?=number_format($r->baki_debet_lama , 0 , '.' , '.')?></td>
                <td style="text-align: right;">Rp. <?=number_format($r->sisa_baki_debet ,0 , '.' , '.')?></td>
                <td>
                    <?php 

                       if($r->status_data){
                           echo "Approve";
                       }else{
                           echo "Belum diapprove";
                       }
                    
                    ?>
                </td>
            </tr>
        <?php $no++; }}else{?>

            <tr>
                <td colspan="6" style="text-align : center;">Tidak ada data</td>
            </tr>

        <?php }?>
    </tbody>
</table>
</div>
<?php echo $this->load->view('setting');?>