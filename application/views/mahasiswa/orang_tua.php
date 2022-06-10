<script type="text/javascript">
$(document).ready(function(){
	
	$("#simpan_ortu").click(function(){
		
		var string = $("#form-ortu").serialize();
		
		
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
			url		: "<?php echo site_url(); ?>/mahasiswa/simpan_ortu",
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
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Ayah </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_ayah" id="nama_ayah" value="<?php echo $nama_ayah;?>" class="span6"  />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Ibu </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_ibu" id="nama_ibu" value="<?php echo $nama_ibu;?>" class="span6"  />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Alamat </div>
                <div class="profile-info-value">
                    <input type="text" name="alamat_ortu" id="alamat_ortu" value="<?php echo $alamat_ortu;?>" class="span8"  />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Hp </div>
                <div class="profile-info-value">
                    <input type="text" name="hp_ortu" id="hp_ortu" value="<?php echo $hp_ortu;?>" class="span4"  />
                </div>
            </div>
		</div><!--profil info-->
        <div class="alert alert-error" align="center">
             <button type="button" name="simpan_ortu" id="simpan_ortu" class="btn btn-mini btn-primary">
             <i class="icon-save"></i> Simpan
             </button>
        </div>     

    </div><!--/span-->
</div><!--/row-fluid-->