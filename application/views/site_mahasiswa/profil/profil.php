<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active">
        <a data-toggle="tab" href="#profil">
            <i class="green icon-user bigger-110"></i>
            Biodata
        </a>
    </li>
    <li>
        <a data-toggle="tab" href="#ortu">
            <i class="red icon-heart bigger-110"></i>
            Orang Tua
        </a>
    </li>
	<li>
        <a data-toggle="tab" href="#foto">
        	<i class="blue icon-camera bigger-110"></i>
            Unggah Foto
        </a>
    </li>
    <li>
        <a data-toggle="tab" href="#password">
        	<i class="green icon-key bigger-110"></i>
            Password
        </a>
    </li>

</ul>

<div class="tab-content">
    <div id="profil" class="tab-pane in active">
        <?php echo $this->load->view('site_mahasiswa/profil/form_profil');?>
    </div>
	<div id="ortu" class="tab-pane">
        <?php echo $this->load->view('site_mahasiswa/profil/form_ortu');?>
    </div>
    <div id="foto" class="tab-pane">
        <?php echo $this->load->view('site_mahasiswa/profil/form_foto');?>
    </div>

    <div id="password" class="tab-pane">
        <?php echo $this->load->view('site_mahasiswa/profil/form_pwd');?>
    </div>

</div>
<?php
echo $this->session->flashdata('result_info');
?>
</div>