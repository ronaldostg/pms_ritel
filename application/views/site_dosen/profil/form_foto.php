<div class="row-fluid">
    <div class="span12"> 
    	<span class="profile-picture" style="max-width:25%;">
        <center>
        	<?php
			if(empty($foto)){
			?>
            <img class="editable" alt="Alex's Avatar" id="avatar2" src="<?php echo base_url();?>assets/foto_dosen/no_foto.jpg" />
			<?php }else{ ?>
            <img class="editable" alt="Alex's Avatar" id="avatar2" src="<?php echo base_url();?>assets/foto_dosen/<?php echo $foto;?>" />
            <?php } ?>
        </center>    
        </span>      
    	<form name="form-foto" id="form-foto" action="<?php echo base_url();?>index.php/site_dosen/profil/simpan_foto" method="post" enctype="multipart/form-data">
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Upload File Foto </div>
                <div class="profile-info-value">
                    <input type="file" name="gambar" id="gambar" />
                </div>
            </div>
            <strong>Catatan : </strong> Foto bersifat Formal untuk keperluan Buku Induk Mahasiswa. Menggunakan Jas Almamater background Merah.
		</div><!--profil info-->
        <div class="form-actions center">
             <button type="submit" name="simpan_foto" id="simpan_foto" class="btn btn-mini btn-primary">
             <i class="icon-cloud-upload "></i> Upload Foto
             </button>
        </div>     
		</form>
    </div><!--/span-->
</div><!--/row-fluid-->