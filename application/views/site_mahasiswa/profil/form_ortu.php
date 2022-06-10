<script type="text/javascript">
$(document).ready(function(){
	
	
	
	$("#simpan_ortu").click(function(){
		
		var string = $("#form-ortu").serialize();
		
		
		if(!$("#nama_ayah").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama Ayah tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nama_ayah").focus();
			return false();
		}
		
		if(!$("#nama_ibu").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama Ibu tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nama_ibu").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/site_mahasiswa/profil/simpan_ortu",
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
    	<form name="form-ortu" id="form-ortu">
        <fieldset>
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Ayah </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_ayah" id="nama_ayah"  class="span6"  />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Ibu </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_ibu" id="nama_ibu"  class="span6"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Alamat </div>
                <div class="profile-info-value">
                    <input type="text" name="alamat_ortu" id="alamat_ortu"  class="span6"  />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> HP </div>
                <div class="profile-info-value">
                    <input type="text" name="hp_ortu" id="hp_ortu"  class="span3"  />
                </div>
            </div>
            
		</div><!--profil info-->
        </fieldset>
        <div class="form-actions center">
             <button type="button" name="simpan_ortu" id="simpan_ortu" class="btn btn-mini btn-primary">
             <i class="icon-save"></i> Simpan
             </button>
        </div>     
		</form>
    </div><!--/span-->
</div><!--/row-fluid-->