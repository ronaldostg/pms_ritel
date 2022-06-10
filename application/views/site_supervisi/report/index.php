
<input type="hidden" id="url" value="<?php echo site_url(); ?>">
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
                        <label class="control-label" for="form-field-1">Pilih cabang</label>
                        <div class="controls">
                            <select name="kode_cabang" id="kode_cabang" class="span2">
                                <option value="" selected="selected">-Pilih-</option>
                                <?php 
                                    $cabang = $this->db->query("SELECT * FROM t_cabang")->result();
                                    foreach($cabang as $row_cabang){
                                ?>
                                <option value="<?=$row_cabang->kd_cab?>"><?=$row_cabang->nm_cabang;?> (<?=$row_cabang->kd_cab?>)</option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">User</label>
                        <div class="controls">
                            <select name="user_ao" id="user_ao" class="span2" disabled="true">
                                <option value="" selected="selected">-Pilih user-</option>
                            </select>
                        </div>
                    </div>



                    <div class="alert alert-success">
                        <center>
                            <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                                <i class="icon-th"></i> Lihat Data
                            </button>
                            <!-- <button type="button" name="cetak_pdf" id="cetak_pdf" class="btn btn-mini btn-primary">
                                <i class="icon-print"></i> Cetak PDF
                            </button>
                            <button type="button" name="cetak_excel" id="cetak_excel" class="btn btn-mini btn-success">
                                <i class="icon-print"></i> Cetak EXCEL
                            </button> -->

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
<table  class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center" width="10">No</th>
                <th class="center span2">Nama Prospek</th>
                <th class="center" width="20">Nominal Plafond</th>
                <th class="center" width="20">Baki Debet Lama</th>
                <th class="center" width="20">Sisa Bagi Debet</th>
                <th class="center" width="20">Tanggal Release</th>

                
            </tr>
        </thead>
        <tbody id="viewTbody"></tbody>
        <tr>
        	<td colspan="5" class="center"><strong>T o t a l</strong></td>
            <td style="text-align:right"><strong id="totaldata">0</strong></td>
        </tr>
   
    </tbody>
</table>
</div>