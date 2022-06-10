<div class="row-fluid">
    <div class="span3 center">
        <span class="profile-picture">
            <img class="editable" alt="Alex's Avatar" id="avatar2" src="<?php echo base_url();?>assets/avatars/profile-pic.jpg" />
        </span>

        <div class="space space-4"></div>
        <a href="#" class="btn btn-small btn-block btn-primary">
            <i class="icon-envelope-alt"></i>
            Kirim Pesan
        </a>
    </div><!--/span-->

    <div class="span9">
        <h4 class="blue">
            <span class="middle"><?php echo $nama;?></span>

            <span class="label label-purple arrowed-in-right">
                <i class="icon-circle smaller-80"></i>
                <?php echo $status_mhs;?>
            </span>
        </h4>

        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Lengkap </div>
                <div class="profile-info-value">
                    <span><?php echo $nama;?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> TTL </div>
                <div class="profile-info-value">
                    <span><?php echo $tempat_lahir;?></span>
                    <span><?php echo $this->model_global->tgl_indo($tgl_lahir);?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Jenis Kelamin </div>
                <div class="profile-info-value">
                    <span>
                    <?php
					if($sex=='L'){
						echo 'Laki-laki';
					}else{
						echo 'Perempuan';
					}
					?>
                    </span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Alamat </div>
                <div class="profile-info-value">
                    <span><?php echo $alamat;?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Kota </div>
                <div class="profile-info-value">
                    <span><?php echo $kota;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Telepon </div>
                <div class="profile-info-value">
                    <span><?php echo $telp;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Email </div>
                <div class="profile-info-value">
                    <span><?php echo $email;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Warga Negara </div>
                <div class="profile-info-value">
                    <span><?php echo $warga_negara;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Tinggi Badan </div>
                <div class="profile-info-value">
                    <span><?php echo $tinggi_badan;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Berat Badan </div>
                <div class="profile-info-value">
                    <span><?php echo $berat_badan;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Gol Darah </div>
                <div class="profile-info-value">
                    <span><?php echo $gol_darah;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Hobby </div>
                <div class="profile-info-value">
                    <span><?php echo $hobby;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Penyakit </div>
                <div class="profile-info-value">
                    <span><?php echo $penyakit;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Asal Sekolah </div>
                <div class="profile-info-value">
                    <span><?php echo $asal_sekolah;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Sekolah </div>
                <div class="profile-info-value">
                    <span><?php echo $nama_sekolah;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> No Ijazah </div>
                <div class="profile-info-value">
                    <span><?php echo $no_ijazah;?></span>
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Tahun Ijazah </div>
                <div class="profile-info-value">
                    <span><?php echo $th_ijazah;?></span>
                </div>
            </div>
            
		</div><!--profil info-->

    </div><!--/span-->
</div><!--/row-fluid-->