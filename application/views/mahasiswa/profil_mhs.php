<script type="text/javascript">
$(document).ready(function(){
	$("#nama_lengkap").focus();
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
		
		if(!$("#nama_lengkap").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama Lengkap tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nama_lengkap").focus();
			return false();
		}
		
		if(!$("#tgl_lahir").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal Lahir tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#tgl_lahir").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/mahasiswa/simpan",
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
    <div class="span3 center">
        <span class="profile-picture">
        	<?php
			if(empty($foto)){
			?>
            <img class="editable" id="avatar2" src="<?php echo base_url();?>assets/foto_mhs/no_foto.jpg" />
			<?php }else{ ?>
            <img class="editable" id="avatar2" src="<?php echo base_url();?>assets/foto_mhs/<?php echo $foto;?>" width="100" />
            <?php } ?>
        </span>

        <div class="space space-4"></div>
        <a href="#" class="btn btn-small btn-block btn-primary">
            <i class="icon-envelope-alt"></i>
            Kirim Pesan
        </a>
    </div><!--/span-->

    <div class="span9">
        <h4 class="blue">
            <span class="label label-purple arrowed-in-right">
                <i class="icon-circle smaller-80"></i>
                <?php echo $status_mhs;?>
            </span>
        </h4>
		<form name="my-form" id="my-form">
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Th Akademik </div>
                <div class="profile-info-value">
                    <input type="text" name="th_akademik" id="th_akademik" value="<?php echo $th_akademik;?>" class="span2" readonly="readonly" />
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Kode Prodi </div>
                <div class="profile-info-value">
                    <input type="text" name="kd_prodi" id="kd_prodi" value="<?php echo $kd_prodi;?>  ( <?php echo $this->model_data->nama_jurusan($prodi);?> )" class="span6" readonly="readonly" />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> NIM </div>
                <div class="profile-info-value">
                    <input type="text" name="nim" id="nim" value="<?php echo $nim;?>" class="span3" readonly="readonly" />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Lengkap </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $nama;?>" class="span8" />
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> TTL </div>
                <div class="profile-info-value">
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo $tempat_lahir;?>" class="span7" />
                    <div class="input-append">
                    <input type="text" name="tgl_lahir" id="tgl_lahir" value="<?php echo $tgl_lahir;?>" class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span>
                    </div>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Jenis Kelamin </div>
                <div class="profile-info-value">
                    <select name="sex" id="sex" class="span3">
                    <?php
					if($sex=='L'){
					?>
						<option value="">-Pilih-</option>
                        <option value="L" selected="selected">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    <?php
					}elseif($sex=='P'){
					?>
	                    <option value="">-Pilih-</option>
                        <option value="L" >Laki-laki</option>
                        <option value="P" selected="selected">Perempuan</option>
                    <?php
					}else{
					?>
                    	<option value="" selected="selected">-Pilih-</option>
                        <option value="L" >Laki-laki</option>
                        <option value="P" >Perempuan</option>
					<?php }?>
                    	</select>
                    </span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Alamat </div>
                <div class="profile-info-value">
                    <input type="text" name="alamat" id="alamat" value="<?php echo $alamat;?>" class="span11" />
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Kota </div>
                <div class="profile-info-value">
                    <input type="text" name="kota" id="kota" value="<?php echo $kota;?>" class="span5" />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Telepon </div>
                <div class="profile-info-value">
                    <input type="text" class="span3" name="telp" id="telp" value="<?php echo $telp;?>" />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Email </div>
                <div class="profile-info-value">
                    <input type="text" class="span7" name="email" id="email" value="<?php echo $email;?>" />
                </div>
            </div>
            
            
		</div><!--profil info-->
		 <div class="alert alert-error" align="center">
             <button type="button" name="simpan" id="simpan" class="btn btn-mini btn-primary">
             <i class="icon-save"></i> Simpan
             </button>
              <a href="<?php echo base_url();?>index.php/mahasiswa/tambah" class="btn btn-mini btn-info">
             <i class="icon-check"></i> Tambah
             </a>
              <a href="<?php echo base_url();?>index.php/mahasiswa/view_data" class="btn btn-mini btn-success">
             <i class="icon-double-angle-right"></i> Kembali
             </a>
        </div>        
        </form>
        
    </div><!--/span-->
</div><!--/row-fluid-->
