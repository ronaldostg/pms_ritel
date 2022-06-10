<?php 
$month = date('m');
$bulan = array(
    '1' => "Januari",
    '2' => "Februari",
    '3' => "Maret",
    '4' => "April",
    '5' => "Mei",
    '6' => "Juni",
    '7' => "Juli",
    '8' => "Agustus",
    '9' => "Septemper",
    '10' => "Oktober",
    '11' => "November",
    '12' => "Desember",
);

?>
<input type="hidden" id="url" value="<?php echo site_url(); ?>">
<input type="hidden" id="type" value="<?php echo $_GET['type']; ?>">
<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-desktop blue"></i>
            <?php echo $judul;?> 
        </h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">
                <form class="form-horizontal" name="my-form" id="my-form">

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Pilih bulan</label>
                        <div class="controls">
                            <select name="bulan" id="bulan" class="span6">
                                <option value="" selected="selected">--- Pilih bulan ---</option>
                                <option value="all">All</option>
                                <?php 
                                    for($i=1 ; $i <= count($bulan) ; $i++){
                                ?>
                                <option value="<?=$i?>" <?=$i == $month ? "selected='true'" : "";?>><?=$bulan[$i]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <?php 
                        if($level != 'supervisi'){
                    ?>
                  
                    
                    <?php 
                        if($_GET['type'] == 'realisasiao'){
                    ?>
                      <div class="control-group">
                        <label class="control-label" for="form-field-1">Pilih cabang</label>
                        <div class="controls">
                            <select name="kode_cabang" id="kode_cabang" class="span6">
                                <option value="" selected="selected">-Pilih-</option>
                                <option value="all">All</option>
                                <?php 
                                    $cabang = $this->db->query("SELECT * FROM t_cabang")->result();
                                    foreach($cabang as $row_cabang){
                                ?>
                                <?php 
                                        if($row_cabang->kd_cab != '001'){
                                    ?>
                                <option value="<?=$row_cabang->kd_cab?>"><?=$row_cabang->nm_cabang;?>
                                    (<?=$row_cabang->kd_cab?>)</option>
                                <?php }?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">User AO</label>
                        <div class="controls">
                            <select name="user_ao" id="user_ao" class="span6" disabled="true">
                                <option value="" selected="selected">--- Pilih user ---</option>

                            </select>
                        </div>
                    </div>
                    <?php }?>

                    <?php 
                        if($_GET['type'] == 'jenisguna'){
                    ?>
                      <div class="control-group">
                        <label class="control-label" for="form-field-1">Pilih cabang</label>
                        <div class="controls">
                            <select name="kode_cabang" id="kode_cabang" class="span6">
                                <option value="" selected="selected">-Pilih-</option>
                                <option value="all">All</option>
                                <?php 
                                    $cabang = $this->db->query("SELECT * FROM t_cabang")->result();
                                    foreach($cabang as $row_cabang){
                                ?>
                                <?php 
                                        if($row_cabang->kd_cab != '001'){
                                    ?>
                                <option value="<?=$row_cabang->kd_cab?>"><?=$row_cabang->nm_cabang;?>
                                    (<?=$row_cabang->kd_cab?>)</option>
                                <?php }?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Jenis Guna</label>
                        <div class="controls">
                            <select name="jenis_guna" id="jenis_guna" class="span6" disabled="true">
                                <option value="all" selected="selected">All</option>
                                <option value="Konsumtif">Konsumtif</option>
                                <option value="Investasi">Investasi</option>
                                <option value="Modal Kerja">Modal Kerja</option>
                            </select>
                        </div>
                    </div>
                    <?php }?>

                    <?php 
                        if($_GET['type'] == 'realisasisnd'){
                    ?>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">SND</label>
                        <div class="controls">
                            <select name="snd" id="snd" class="span6">
                                <option value="all" selected="selected">All</option>
                                <option value="1">SND 1</option>
                                <option value="2">SND 2</option>
                                <option value="3">SND 3</option>
                            </select>
                        </div>
                    </div>

                    <?php }?>

                    <?php } else{ ?>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">User AO</label>
                        <div class="controls">
                            <select name="user_ao" id="user_ao" class="span6">
                                <option value="all" selected="selected">All</option>
                                <?php 
                                        foreach($userao as $rowuser){
                                    ?>

                                <option value="<?=$rowuser->id_user?>"><?=$rowuser->nama_user?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Jenis Guna</label>
                        <div class="controls">
                            <select name="jenis_guna" id="jenis_guna" class="span6">
                                <option value="all" selected="selected">All</option>
                                <option value="Konsumtif">Konsumtif</option>
                                <option value="Investasi">Investasi</option>
                                <option value="Modal Kerja">Modal Kerja</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">SND</label>
                        <div class="controls">
                            <select name="snd" id="snd" class="span6">
                                <option value="all" selected="selected">All</option>
                                <option value="1">SND 1</option>
                                <option value="2">SND 2</option>
                                <option value="3">SND 3</option>
                            </select>
                        </div>
                    </div>

                    <?php }?>
                    <div class="alert alert-success">
                        <center>
                            <div style="display:flex; justify-content: center;">
                                <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                                    <i class="icon-th"></i> Lihat Data
                                </button>
                                <div id="cetak" style="margin-left : 5px; display: none;">
                                        <button type="button" name="cetak_pdf" id="cetak_pdf"  class="btn btn-mini btn-primary">
                                            <i class="icon-print" disabled="true"></i> Cetak PDF
                                        </button>
                                        <button type="button" name="cetak_excel" id="cetak_excel" class="btn btn-mini btn-success">
                                            <i class="icon-print" disabled="true"></i> Cetak EXCEL
                                        </button>
                                </div>
                           </div>
                        </center>
                    </div>
                </form>
            </div>
            <!-- <?php
		  	echo  $this->session->flashdata('result_info');
		   ?> -->
        </div> <!-- wg body -->
    </div>
    <!--wg-main-->
</div>

<div id="viewreport" style="display: none;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center" width="10">No</th>
                <th class="center span2">Nama Prospek</th>
                <th class="center" width="20">Realisasi Plafond</th>
                <th class="center" width="20">Baki Debet Lama</th>
                <th class="center" width="20">Realisasi Real</th>
                <th class="center" width="20">Tanggal Realisasi</th>
                <th class="center" width="20">Nama Petugas</th>


            </tr>
        </thead>
        <tbody id="viewTbody"></tbody>
        <tr>
            <td colspan="6" class="center"><strong>Jumlah Total</strong></td>
            <td style="text-align:right"><strong id="totaldata">0</strong></td>
        </tr>
        <tr>
            <td colspan="6" class="center"><strong>Total Realisasi Plafond</strong></td>
            <td style="text-align:right"><strong id="tp">0</strong></td>
        </tr>

        </tbody>
    </table>
</div>