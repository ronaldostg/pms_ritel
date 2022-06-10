<script type="text/javascript">
$(document).ready(function(){
	/*
	function view(){
		$("#v_profil").show();
		$("#e_profil").hide();
		$("#v_orang_tua").show();
		$("#e_orang_tua").hide();
		
	}
	
	view();
	
	$("#edit_profil").click(function(){
		$("#v_profil").hide();
		$("#e_profil").show();
		$("#nama_lengkap").focus();
	});
	*/
	
	
});
</script>
<div class="row-fluid">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-18" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#profil">
                        <i class="green icon-user bigger-110"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#orangtua">
                    	<i class="red icon-home bigger-110"></i>
                        Orang Tua
                    </a>
                </li>
				<li>
                    <a data-toggle="tab" href="#nilai">
                    	<i class="green icon-book bigger-110"></i>
                        Nilai
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#transkrip_nilai">
                    	<i class="red icon-table bigger-110"></i>
                        Transkrip Nilai
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#grafik">
                    	<i class="green icon-bar-chart bigger-110"></i>
                        Grafik IP
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#histori">
                    	<i class="red icon-film bigger-110"></i>
                        History
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="profil" class="tab-pane in active">
                    <!--awal -->
                        <?php echo $this->load->view('mahasiswa/profil_mhs');?>
                    <!--akhir-->
                </div>
                <div id="orangtua" class="tab-pane">
                    <?php echo $this->load->view('mahasiswa/orang_tua');?>
                </div>
                <div id="nilai" class="tab-pane">
                    <?php echo $this->load->view('mahasiswa/form_nilai');?>
                </div>
                <div id="transkrip_nilai" class="tab-pane">
                    <?php echo $this->load->view('mahasiswa/form_transkrip');?>
                </div>
                <div id="grafik" class="tab-pane">
                    <?php echo $this->load->view('mahasiswa/grafik_ip');?>
                </div>
                <div id="histori" class="tab-pane">
                    <p>Histori Keuangan dan Aktifitas Mahasiswa</p>
                </div>
            </div>
        </div>
</div>    