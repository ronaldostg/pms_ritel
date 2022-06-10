<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	cari_data();
	
	function cari_data(){
		var nim = $("#nim").val();
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_dosen/profil/cari_data",
			data	: "nim="+nim,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#tgl_masuk").val(data.tgl_masuk);
				$("#sex").val(data.sex);
				$("#tempat_lahir").val(data.tempat_lahir);
				$("#tanggal_lahir").val(data.tanggal_lahir);
				$("#alamat").val(data.alamat);
				$("#hp").val(data.hp);
				$("#email").val(data.email);
				$("#pendidikan").val(data.pendidikan);
				$("#prodi").val(data.prodi);
			}
		});
	}
	
	
	$("#simpan_profil").click(function(){
		
		var string = $("#form-profil").serialize();
		
		
		if(!$("#nama_lengkap").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama Lengkap tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nama_lengkap").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_dosen/profil/simpan_profil",
			data	: string,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Info..!!',
					text: data,
					class_name: 'gritter-info' 
				});
			}
		});
		
	});
	
});
</script>
<div class="row-fluid">
    <div class="span12">       
    	<form name="form-profil" id="form-profil">
        <fieldset>
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Tanggal Masuk </div>
                <div class="profile-info-value">
                    <input type="text" name="tgl_masuk" id="tgl_masuk"  class="span3" readonly="readonly"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Kode Dosen </div>
                <div class="profile-info-value">
                    <input type="text" name="nim" id="nim" value="<?php echo $kd_dosen;?>" class="span3" readonly="readonly"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Lengkap </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $nama_lengkap;?>" class="span6"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Jenis Kelamin </div>
                <div class="profile-info-value">
                    <select name="sex" id="sex" class="span2">
                    <option value="">-Pilih-</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Tempat Lahir </div>
                <div class="profile-info-value">
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="span6"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Tanggal Lahir </div>
                <div class="profile-info-value">
                	<div class="input-append">
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir"  class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span>
                    </div>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Alamat </div>
                <div class="profile-info-value">
                    <input type="text" name="alamat" id="alamat"  class="span8"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> HP </div>
                <div class="profile-info-value">
                    <input type="text" name="hp" id="hp" class="span4"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Email </div>
                <div class="profile-info-value">
                    <input type="text" name="email" id="email"  class="span5"  />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Pendidikan Terakhir </div>
                <div class="profile-info-value">
                    <input type="text" name="pendidikan" id="pendidikan"  class="span1"  readonly="readonly" />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Program Studi </div>
                <div class="profile-info-value">
                    <input type="text" name="prodi" id="prodi"  class="span5" readonly="readonly" />
                </div>
            </div>
            
		</div><!--profil info-->
        </fieldset>
        <div class="form-actions center">
             <button type="button" name="simpan_profil" id="simpan_profil" class="btn btn-mini btn-primary">
             <i class="icon-save"></i> Simpan
             </button>
        </div>     
		</form>
    </div><!--/span-->
</div><!--/row-fluid-->