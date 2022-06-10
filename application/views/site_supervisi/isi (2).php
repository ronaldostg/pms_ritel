<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <div class="alert alert-block alert-warning">
            
            <i class="icon-ok green"></i>

            Selamat datang <strong> <?php echo $this->session->userdata('nama_lengkap');?> (User)</strong> di 
            <strong class="green">
                Aplikasi <?php echo $this->config->item('nama_aplikasi');?>
                <small>(v1.1.0)</small>
            </strong>
            ,
            <?php echo $this->config->item('nama_instansi');?>
        </div>
</div>                            
</div> 

<div class="row-fluid">
	<div class="span12">
    
    </div>
    <div class="span12 infobox-container">
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_prospek($username);?> Data</span>
                <div class="infobox-content">Prospek</div>
            </div>            
        </div>

        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_target($username);?> Data</span>
                <div class="infobox-content">Target</div>
            </div>

        </div>

        <div class="infobox infobox-pink  ">
            <div class="infobox-icon">
                <i class="icon-briefcase"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_data_collect($username);?> Data</span>
                <div class="infobox-content">Collect</div>
            </div>
        </div>

        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-eye-open"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_analisa($username);?> Data</span>
                <div class="infobox-content">Analisa</div>
            </div>
        </div>

        <div class="infobox infobox-orange2  ">
            <div class="infobox-icon">
                <i class="icon-calendar"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_komite($username);?> Data</span>
                <div class="infobox-content">Komite</div>
            </div>
        </div>

        <div class="infobox infobox-blue2  ">
            <div class="infobox-icon">
                <i class="icon-envelope-alt "></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_sppk($username);?> Data</span>
                <div class="infobox-content">SPPK</div>
            </div>
        </div>
		
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-beaker"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_pk($username);?> Data</span>
                <div class="infobox-content">PK</div>
            </div>
        </div>

		<div class="infobox infobox-orange  ">
            <div class="infobox-icon">
                <i class="icon-coffee"></i> 
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?php $username = $this->session->userdata('username'); echo $this->model_data->jml_data_user_t_on_book($username);?> Data</span>
                <div class="infobox-content">On Book</div>
            </div>
        </div>
        
    </div>
</div>    
<br />
