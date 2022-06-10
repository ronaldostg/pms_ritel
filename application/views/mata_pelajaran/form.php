<script type="text/javascript">
$(document).ready(function(){
	$('#kode_mk').focus();
	
	$('#simpan').click(function(){
		var kode_mk = $('#kode_mk').val();
		alert('tes');
	});
});
</script>
<div class="row-fluid">
<div class="widget-box">
<div class="widget-header">
<h4>Form <?php echo $judul;?></h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
      <!--PAGE CONTENT BEGINS-->
      <form class="form-horizontal">
      <fieldset>
          <div class="control-group">
              <label class="control-label" for="form-field-1">Kode Mata Pelajaran</label>
              <div class="controls">
                  <input type="text" id="kode_mk" name="kode_mk" placeholder="kode mata pelajaran" />
              </div>
          </div>
          <div class="control-group">
              <label class="control-label" for="form-field-2">Nama Mata Pelajaran</label>
              <div class="controls">
                  <input type="text" id="nama_mk" name="nama_mk" placeholder="Nama mata pelajaran" class="span6"/>
              </div>
          </div>
           <div class="control-group">
              <label class="control-label" for="form-field-select-1">Jenis</label>
              <div class="controls">
                  <select id="jenis">
						<option value="" selected="selected">-Pilih Jenis-</option>
                        <option value="WAJIB">WAJIB</option>
                        <option value="MULOK">MULOK</option>
                  </select>      
              </div>
          </div>
           <div class="control-group">
              <label class="control-label" for="form-field-1">Keterangan</label>
              <div class="controls">
                  <input type="text" id="ket" name="ket" placeholder="keterangan" class="span8"/>
              </div>
          </div>
       </fieldset>   
    <div class="form-actions center">
        <button type="button" id="simpan" name="simpan" class="btn btn-small btn-success" onclick="tes();">
            Simpan
            <i class="icon-arrow-right icon-save bigger-110"></i>
        </button>
        <button type="reset" id="reset" name="reset" class="btn btn-small btn-danger">
            Kosong
            <i class="icon-arrow-right icon-undo bigger-110"></i>
        </button>

        <a href="<?php echo base_url();?>index.php/mata_pelajaran" class="btn btn-small btn-primary">
        Kembali
        <i class="icon-arrow-right icon-on-right bigger-110"></i>
        </a>
    </div>
	</form>
</div> <!-- widget-main-->
</div> <!-- widget-body-->           
</div> <!-- widget-box-->
</div>