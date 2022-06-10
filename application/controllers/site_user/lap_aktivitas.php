<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_aktivitas extends CI_Controller {

//	*
//	 * Index Page for this controller.
//	 * Programmer : Deddy Rusdiansyah.S.Kom
//	 * http://deddyrusdiansyah.blogspot.com
//	 * http://softwarebanten.com
//	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			$d['judul']="Laporan Data Aktivitas";
			$d['class'] = "laporan";
			
			$d['content']= 'site_user/lap_aktivitas/form';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}

	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
		
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

			$posisi_data = $this->input->post('posisi_data');
			$status_prospek = $this->input->post('status_prospek');
			$status_kondisi_data = $this->input->post('status_kondisi_data');
			

			if($status_prospek=='Semua'){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);		
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);											
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);												
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);		
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);											
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);												
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
				
				
			 
			}elseif($status_prospek=="Perusahaan"){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");

						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
														
			}elseif($status_prospek=="Perorangan"){										
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;

						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_target',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_data_coll',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");

						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_analisa',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_komite',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_sppk',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_pk',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_aktivitas/view_on_book',$dt);											
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
			}

		}else{
			redirect('login','refresh');
		}
	}

	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	
	public function cari_semua_data_prospek()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){
//			$id['id_prospek'] = $this->input->post('kode');
//			
//			$dt['id_prospek'] = $this->input->post('kode');
//			$dt['id_user_pic'] = $username;
			$where = "WHERE id_user_pic='$username' ";
			
			$q = $this->db->query("SELECT * FROM v_prospek $where ");
			$dt['data'] = $q;
			
			echo $this->load->view('site_user/lap_aktivitas/view',$dt);
			
		}else{
			redirect('login','refresh');
		}
	
	}
	
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	
	public function cetak_lap_aktivitas()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			
			$posisi_data = $this->input->post('thak');
			$smt = $this->input->post('semester');
			$nim = $this->session->userdata('username');
			
			$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$posisi_data' AND semester='$smt' AND nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				$sess_data['posisi_data'] = $posisi_data;
				$sess_data['smt'] = $smt;
				$this->session->set_userdata($sess_data);
				echo "Sukses";		
			}else{
				echo "Maaf, Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	
	public function cetak_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

			$posisi_data = $this->input->post('posisi_data');
			$status_prospek = $this->input->post('status_prospek');
			$status_kondisi_data = $this->input->post('status_kondisi_data');
			

			if($status_prospek=='Semua'){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
				
				
			 
			}elseif($status_prospek=="Perusahaan"){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}         
					                    
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}               
					              
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
														
			}elseif($status_prospek=="Perorangan"){										
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}    
					 
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}          
					                   
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}     
					                        
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}     
					                        
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}    
					                         
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND tampil_pd_laporan=1 AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
			}

			
			if($r>0){
				$sess_data['posisi_data'] = $posisi_data;
				$sess_data['status_prospek'] = $status_prospek;
				$sess_data['status_kondisi_data'] = $status_kondisi_data;
				
				$this->session->set_userdata($sess_data);
				echo "Sukses";
			}else{
				echo "Maaf, Tidak Ada data";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
	
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	public function print_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

//			$posisi_data = $this->input->post('posisi_data');
//			$status_prospek = $this->input->post('status_prospek');
//			$status_kondisi_data = $this->input->post('status_kondisi_data');
			$posisi_data = $this->session->userdata('posisi_data');
			$status_prospek = $this->session->userdata('status_prospek');
			$status_kondisi_data = $this->session->userdata('status_kondisi_data');

			if($status_prospek=='Semua'){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();			
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();			
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}     
					
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                  
					           
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}        
					                     
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}              
					               
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}      
					                       
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
				
				
			 
			}elseif($status_prospek=="Perusahaan"){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}       
					                      
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}          
					                   
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}  
					                           
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}       
					                      
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
														
			}elseif($status_prospek=="Perorangan"){										
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}     
					
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}           
					                  
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}        
					                     
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}       
					                      
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}          
					                   
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
			}
		
			if($r>0){

							
				  $pdf=new reportProduct();
				  $pdf->setKriteria("cetak_laporan");
				  $pdf->setNama("CETAK LAPORAN");
				  $pdf->AliasNbPages();
				  
					if($posisi_data=='Prospek'){
						$pdf->AddPage("P","A4");
					}elseif($posisi_data=="Target"){
						$pdf->AddPage("H","A4");					
					}elseif($posisi_data=="Data Coll"){
						$pdf->AddPage("H","A4");
					}elseif($posisi_data=="Analisa"){
						$pdf->AddPage("H","A4");
					}elseif($posisi_data=="Komite"){
						$pdf->AddPage("P","A4");
					}elseif($posisi_data=="SPPK"){
						$pdf->AddPage("P","A4");
					}elseif($posisi_data=="PK"){
						$pdf->AddPage("P","A4");
					}elseif($posisi_data=="On Book"){
						$pdf->AddPage("P","A4");
					}				  
				//foreach($data->result() as $t){
					$A4[0]=210;
					$A4[1]=297;
					$Q[0]=216;
					$Q[1]=279;
					$pdf->SetTitle('Laporan Aplikasi');
					$pdf->SetCreator('Programmer IT with fpdf');
					
					$h = 7;
					$pdf->SetFont('Times','B',14);
					$pdf->SetX(6);
					$pdf->Cell(198,4,$this->config->item('nama_instansi'),0,1,'L');
					$pdf->SetX(6);
					$pdf->SetFont('Times','',10);
					$pdf->Cell(198,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'L');
					$pdf->Ln(5);
					
					//Column widths
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(6);

					
					//$w = array(10,25,30,30,80,10,30,35,25);
					
					if($posisi_data=='Prospek'){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data Prospek',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}       
						$pdf->Ln(5);						
						$w = array(10,40,40,20,50,30);					
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'Nominal',1,0,'C');
						//$pdf->Cell($w[6],$h,'HP',1,0,'C');
						//$pdf->Cell($w[7],$h,'Kota',1,0,'C');
						//$pdf->Cell($w[8],$h,'Status',1,0,'C');
					}elseif($posisi_data=="Target"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data Target',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}       

						$pdf->Ln(5);						
						$w = array(10,40,40,20,40,20,17,20,20,22,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'No Identitas',1,0,'C');
						$pdf->Cell($w[6],$h,'Usaha(Thn)',1,0,'C');
						$pdf->Cell($w[7],$h,'Bi Checking',1,0,'C');
						$pdf->Cell($w[8],$h,'SIUP',1,0,'C');
						$pdf->Cell($w[9],$h,'Target Booking',1,0,'C');
						$pdf->Cell($w[10],$h,'Nominal',1,0,'C');					
					}elseif($posisi_data=="Data Coll"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data Data Coll',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}    
						
						$pdf->Ln(5);						
						$w = array(10,40,40,20,30,20,20,20,22,22,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'Permohonan',1,0,'C');
						$pdf->Cell($w[6],$h,'Lap Keuangan',1,0,'C');
						$pdf->Cell($w[7],$h,'Agunan',1,0,'C');
						$pdf->Cell($w[8],$h,'Dok Pendukung',1,0,'C');
						$pdf->Cell($w[9],$h,'Nama Daerah',1,0,'C');
						$pdf->Cell($w[10],$h,'Nominal',1,0,'C');	
					}elseif($posisi_data=="Analisa"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data Analisa',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}    

						$pdf->Ln(5);						
						$w = array(10,40,40,20,40,20,27,27,27,27,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'Pembiayaan',1,0,'C');
						$pdf->Cell($w[6],$h,'Mampu',1,0,'C');
						$pdf->Cell($w[7],$h,'Cukup Agunan',1,0,'C');
						$pdf->Cell($w[8],$h,'Pemb. Wajar',1,0,'C');
						$pdf->Cell($w[9],$h,'Nominal',1,0,'C');	

					}elseif($posisi_data=="Komite"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data Komite',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}    
						$pdf->Ln(5);							
						$w = array(10,40,40,20,33,20,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'Komite Setuju',1,0,'C');
						$pdf->Cell($w[6],$h,'Nominal',1,0,'C');	
					}elseif($posisi_data=="SPPK"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data SPPK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}    
						$pdf->Ln(5);							
						$w = array(10,40,40,20,30,23,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'Nasabah Setuju',1,0,'C');
						$pdf->Cell($w[6],$h,'Nominal',1,0,'C');
					}elseif($posisi_data=="PK"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data PK',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}    
						$pdf->Ln(5);							
						$w = array(10,40,40,20,30,23,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'Nasabah Setuju',1,0,'C');
						$pdf->Cell($w[6],$h,'Nominal',1,0,'C');
					}elseif($posisi_data=="On Book"){
						if($status_kondisi_data=='Semua'){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,2,'Status Data = Semua',0,1,'C');
						}elseif($status_kondisi_data=='Blm Diajukan'){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diajukan',0,1,'C');
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Sudah Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Blm Diapprove"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Blm Diapprove',0,1,'C');
						}elseif($status_kondisi_data=="Dikembalikan"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dikembalikan',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Dihapus"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Dihapus',0,1,'C');
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Mhn Mutasi',0,1,'C');
						}elseif($status_kondisi_data=="Ditolak"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Ditolak',0,1,'C');
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							$pdf->Cell(200,4,'Laporan Data On Book',0,1,'C');
							$pdf->SetFont('Arial','',8);
							$pdf->Cell(190,4,'Status Data = Detail Laporan Pipeline',0,1,'C');
						}else{
							echo "Maaf, Tidak Ada data";
						}    
						$pdf->Ln(5);							
						$w = array(10,40,40,20,30,23,30);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Nama Prospek',1,0,'C');
						$pdf->Cell($w[2],$h,'Alamat',1,0,'C');
						$pdf->Cell($w[3],$h,'Status',1,0,'C');
						$pdf->Cell($w[4],$h,'Bidang Usaha',1,0,'C');
						$pdf->Cell($w[5],$h,'No Booking',1,0,'C');
						$pdf->Cell($w[6],$h,'Nominal',1,0,'C');
					}
									
					

					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$pdf->SetFont('Arial','',8);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$total=0;
					foreach($q->result() as $row)
					{
						//$sing = $this->model_data->singkat_jurusan($row->kd_prodi);
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,$row->nama_prospek,'LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,$row->alamat_prospek,'LR',0,'L',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						if($row->kode_status==1){
							 $pdf->Cell($w[3],$h,"Perusahaan",'LR',0,'L',$fill);	
						}else{
						if($row->kode_status==0){
							$pdf->Cell($w[3],$h,"Perorangan",'LR',0,'L',$fill);	
							}
						};
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);						
//						$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,35),'LR',0,'L',$fill);


///////************
						if($posisi_data=='Prospek'){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,35),'LR',0,'L',$fill);
							$pdf->Cell($w[5],$h,number_format($row->nominal_prospek_awal,0),'LR',0,'R',$fill);
							$total = $total + $row->nominal_prospek_awal;
						}elseif($posisi_data=="Target"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
							$pdf->Cell($w[5],$h,substr($row->no_identitas,0,20),'LR',0,'L',$fill);
							$pdf->Cell($w[6],$h,substr($row->lm_usaha,0,20),'LR',0,'C',$fill);
							if($row->bi_checking==1){
								 $pdf->Cell($w[7],$h,"Baik",'LR',0,'L',$fill);	
							}else{
							if($row->bi_checking==2){
								$pdf->Cell($w[7],$h,"Tidak Baik",'LR',0,'L',$fill);	
							}else{
							if($row->bi_checking==3){
								$pdf->Cell($w[7],$h,"Baik Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[7],$h," ",'LR',0,'L',$fill);
									}
								}
							}		
							
							if($row->siup==1){
								 $pdf->Cell($w[8],$h,"Ada",'LR',0,'L',$fill);	
							}else{
							if($row->siup==2){
								$pdf->Cell($w[8],$h,"Tidak Ada",'LR',0,'L',$fill);	
							}else{
							if($row->siup==3){
								$pdf->Cell($w[8],$h,"Ada Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[8],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
																					
							$pdf->Cell($w[9],$h,substr($row->target_tgl_booking,0,20),'LR',0,'C',$fill);
							$pdf->Cell($w[10],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;		
						}elseif($posisi_data=="Data Coll"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
							if($row->surat_permohonan==1){
								 $pdf->Cell($w[5],$h,"Ada",'LR',0,'L',$fill);	
							}else{
							if($row->surat_permohonan==2){
								$pdf->Cell($w[5],$h,"Tidak Ada",'LR',0,'L',$fill);	
							}else{
							if($row->surat_permohonan==3){
								$pdf->Cell($w[5],$h,"Ada Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[5],$h," ",'LR',0,'L',$fill);
									}
								}
							}		
							
							if($row->lap_keuangan_2thn_terakhir==1){
								 $pdf->Cell($w[6],$h,"Ada",'LR',0,'L',$fill);	
							}else{
							if($row->lap_keuangan_2thn_terakhir==2){
								$pdf->Cell($w[6],$h,"Tidak Ada",'LR',0,'L',$fill);	
							}else{
							if($row->lap_keuangan_2thn_terakhir==3){
								$pdf->Cell($w[6],$h,"Ada Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[6],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
										
							if($row->agunan==1){
								 $pdf->Cell($w[7],$h,"Ada",'LR',0,'L',$fill);	
							}else{
							if($row->agunan==2){
								$pdf->Cell($w[7],$h,"Tidak Ada",'LR',0,'L',$fill);	
							}else{
							if($row->agunan==3){
								$pdf->Cell($w[7],$h,"Ada Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[7],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
							
							if($row->dokumen_pendukung_lain==1){
								 $pdf->Cell($w[8],$h,"Ada",'LR',0,'L',$fill);	
							}else{
							if($row->dokumen_pendukung_lain==2){
								$pdf->Cell($w[8],$h,"Tidak Ada",'LR',0,'L',$fill);	
							}else{
							if($row->dokumen_pendukung_lain==3){
								$pdf->Cell($w[8],$h,"Ada Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[8],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
																																																	
							$pdf->Cell($w[9],$h,substr($row->nama_daerah,0,20),'LR',0,'L',$fill);
							$pdf->Cell($w[10],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;	
						}elseif($posisi_data=="Analisa"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
							$pdf->Cell($w[5],$h,substr($row->nama_jenis_pembiayaan,0,30),'LR',0,'L',$fill);
							if($row->mampu_memenuhi_tagihan==1){
								 $pdf->Cell($w[6],$h,"Ya",'LR',0,'L',$fill);	
							}else{
							if($row->mampu_memenuhi_tagihan==2){
								$pdf->Cell($w[6],$h,"Tidak",'LR',0,'L',$fill);	
							}else{
							if($row->mampu_memenuhi_tagihan==3){
								$pdf->Cell($w[6],$h,"Ya Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[6],$h," ",'LR',0,'L',$fill);
									}
								}
							}		
							
							if($row->cukup_agunan==1){
								 $pdf->Cell($w[7],$h,"Ya",'LR',0,'L',$fill);	
							}else{
							if($row->cukup_agunan==2){
								$pdf->Cell($w[7],$h,"Tidak",'LR',0,'L',$fill);	
							}else{
							if($row->cukup_agunan==3){
								$pdf->Cell($w[7],$h,"Ya Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[7],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
										
							if($row->pembiayaan_wajar==1){
								 $pdf->Cell($w[8],$h,"Ya",'LR',0,'L',$fill);	
							}else{
							if($row->pembiayaan_wajar==2){
								$pdf->Cell($w[8],$h,"Tidak",'LR',0,'L',$fill);	
							}else{
							if($row->pembiayaan_wajar==3){
								$pdf->Cell($w[8],$h,"Ya Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[8],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
							
							$pdf->Cell($w[9],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;	
						}elseif($posisi_data=="Komite"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
	
							if($row->komite_setuju==1){
								 $pdf->Cell($w[5],$h,"Ya",'LR',0,'L',$fill);	
							}else{
							if($row->komite_setuju==2){
								$pdf->Cell($w[5],$h,"Tidak",'LR',0,'L',$fill);	
							}else{
							if($row->komite_setuju==3){
								$pdf->Cell($w[5],$h,"Ya Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[5],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
							
							$pdf->Cell($w[6],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;	
						}elseif($posisi_data=="SPPK"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
	
							if($row->nasabah_setuju==1){
								 $pdf->Cell($w[5],$h,"Ya",'LR',0,'L',$fill);	
							}else{
							if($row->nasabah_setuju==2){
								$pdf->Cell($w[5],$h,"Tidak",'LR',0,'L',$fill);	
							}else{
							if($row->nasabah_setuju==3){
								$pdf->Cell($w[5],$h,"Ya Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[5],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
							
							$pdf->Cell($w[6],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;	
						}elseif($posisi_data=="PK"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
	
							if($row->nasabah_setuju==1){
								 $pdf->Cell($w[5],$h,"Ya",'LR',0,'L',$fill);	
							}else{
							if($row->nasabah_setuju==2){
								$pdf->Cell($w[5],$h,"Tidak",'LR',0,'L',$fill);	
							}else{
							if($row->nasabah_setuju==3){
								$pdf->Cell($w[5],$h,"Ya Dgn Catatan",'LR',0,'L',$fill);	
							}else{						
								$pdf->Cell($w[5],$h," ",'LR',0,'L',$fill);
									}
								}
							}	
							
							$pdf->Cell($w[6],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;	
						}elseif($posisi_data=="On Book"){
							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
							$pdf->Cell($w[5],$h,substr($row->no_booking,0,20),'LR',0,'L',$fill);
								
							$pdf->Cell($w[6],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
							$total = $total + $row->nominal;	
						}
//////*************
						
//						$pdf->Cell($w[5],$h,number_format($row->nominal_prospek_awal,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[6],$h,$row->hp,'LR',0,'L',$fill);
//						$pdf->Cell($w[7],$h,$row->kota,'LR',0,'L',$fill);
//						$pdf->Cell($w[8],$h,$row->status,'LR',0,'C',$fill);
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						
					}

					if($posisi_data=='Prospek'){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
//						$pdf->Cell($w[4],$h,'',1,0,'C');
//						$pdf->Cell($w[5],$h,'',1,0,'C');
//						
//						$pdf->Cell($w[0],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[1],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[2],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[3],$h,' ','LR',0,'C',$fill);
//						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[4],$h,'Total','1',0,'C');
						$pdf->Cell($w[5],$h,number_format($total,0),'1',0,'R');
						//$pdf->Cell($w[5],$h,number_format($total,0),'LR',0,'R',$fill);	
						$pdf->SetFont('Arial','',8);
						// Closing line
//						$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'___________________','C');

					}elseif($posisi_data=="Target"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
						$pdf->Cell($w[5],$h,'',1,0,'C');
						$pdf->Cell($w[6],$h,'',1,0,'C');
						$pdf->Cell($w[7],$h,'',1,0,'C');
						$pdf->Cell($w[8],$h,'',1,0,'C');
						$pdf->Cell($w[9],$h,'Total','1',0,'C');
						$pdf->Cell($w[10],$h,number_format($total,0),'1',0,'R');						
						$pdf->SetFont('Arial','',8);						
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(240);
						$pdf->Cell(240,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(240);
						$pdf->Cell(240,$h,'___________________','C');


					}elseif($posisi_data=="Data Coll"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
						$pdf->Cell($w[5],$h,'',1,0,'C');
						$pdf->Cell($w[6],$h,'',1,0,'C');
						$pdf->Cell($w[7],$h,'',1,0,'C');
						$pdf->Cell($w[8],$h,'',1,0,'C');
						$pdf->Cell($w[9],$h,'Total','1',0,'C');
						$pdf->Cell($w[10],$h,number_format($total,0),'1',0,'R');						
						$pdf->SetFont('Arial','',8);						
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(240);
						$pdf->Cell(240,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(240);
						$pdf->Cell(240,$h,'___________________','C');

					}elseif($posisi_data=="Analisa"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
						$pdf->Cell($w[5],$h,'',1,0,'C');
						$pdf->Cell($w[6],$h,'',1,0,'C');
						$pdf->Cell($w[7],$h,'',1,0,'C');
						$pdf->Cell($w[8],$h,'Total','1',0,'C');
						$pdf->Cell($w[9],$h,number_format($total,0),'1',0,'R');						
						$pdf->SetFont('Arial','',8);						
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(240);
						$pdf->Cell(240,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(240);
						$pdf->Cell(240,$h,'___________________','C');


					}elseif($posisi_data=="Komite"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
//						$pdf->Cell($w[5],$h,'',1,0,'C');
//						
//						$pdf->Cell($w[0],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[1],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[2],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[3],$h,' ','LR',0,'C',$fill);
//						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[5],$h,'Total','1',0,'C');
						$pdf->Cell($w[6],$h,number_format($total,0),'1',0,'R');
						//$pdf->Cell($w[5],$h,number_format($total,0),'LR',0,'R',$fill);	
						$pdf->SetFont('Arial','',8);
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'___________________','C');

					}elseif($posisi_data=="SPPK"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
//						$pdf->Cell($w[5],$h,'',1,0,'C');
//						
//						$pdf->Cell($w[0],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[1],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[2],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[3],$h,' ','LR',0,'C',$fill);
//						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[5],$h,'Total','1',0,'C');
						$pdf->Cell($w[6],$h,number_format($total,0),'1',0,'R');
						//$pdf->Cell($w[5],$h,number_format($total,0),'LR',0,'R',$fill);	
						$pdf->SetFont('Arial','',8);
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'___________________','C');


					}elseif($posisi_data=="PK"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
//						$pdf->Cell($w[5],$h,'',1,0,'C');
//						
//						$pdf->Cell($w[0],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[1],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[2],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[3],$h,' ','LR',0,'C',$fill);
//						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[5],$h,'Total','1',0,'C');
						$pdf->Cell($w[6],$h,number_format($total,0),'1',0,'R');
						//$pdf->Cell($w[5],$h,number_format($total,0),'LR',0,'R',$fill);	
						$pdf->SetFont('Arial','',8);
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'___________________','C');


					}elseif($posisi_data=="On Book"){
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
//						$pdf->Cell($w[5],$h,'',1,0,'C');
//						
//						$pdf->Cell($w[0],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[1],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[2],$h,' ','LR',0,'C',$fill);
//						$pdf->Cell($w[3],$h,' ','LR',0,'C',$fill);
//						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[5],$h,'Total','1',0,'C');
						$pdf->Cell($w[6],$h,number_format($total,0),'1',0,'R');
						//$pdf->Cell($w[5],$h,number_format($total,0),'LR',0,'R',$fill);	
						$pdf->SetFont('Arial','',8);
						// Closing line
						//$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(160);
						$pdf->Cell(160,$h,'___________________','C');


					}					
					
					
				//}
					
				//}
				//$pdf->Output('Lap_Mahasiswa.pdf','D');
				//$pdf->Output('Lap_Prospek'.$th_ak.'_'.$smt.'_'.$kd_dosen.'.pdf','D');	
				$pdf->Output('Lap_Data_Prospek_'.$this->model_global->tgl_indo(date('Y-m-d')).'.pdf','D');	
			}else{
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data'.$status_kondisi_data.'</center>');
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data1'.$username.'</center>');
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data1'.$status_kondisi_data.'</center>');
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				//echo $status_kondisi_data;
				
				redirect('site_user/lap_aktivitas');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
					

	}
	
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
	public function print_excel()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

//			$posisi_data = $this->input->post('posisi_data');
//			$status_prospek = $this->input->post('status_prospek');
//			$status_kondisi_data = $this->input->post('status_kondisi_data');
			$posisi_data = $this->session->userdata('posisi_data');
			$status_prospek = $this->session->userdata('status_prospek');
			$status_kondisi_data = $this->session->userdata('status_kondisi_data');

			if($status_prospek=='Semua'){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();			
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();			
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}     
					
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                  
					           
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}        
					                     
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();	
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}              
					               
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}      
					                       
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
				
				
			 
			}elseif($status_prospek=="Perusahaan"){
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}     
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}       
					                      
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}          
					                   
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}  
					                           
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}       
					                      
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='1' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='1' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
														
			}elseif($status_prospek=="Perorangan"){										
				if($posisi_data=='Prospek'){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_prospek $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                            

				}elseif($posisi_data=="Target"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_target $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                                         

				}elseif($posisi_data=="Data Coll"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_data_coll $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}     
					
				}elseif($posisi_data=="Analisa"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_analisa $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}           
					                  
				}elseif($posisi_data=="Komite"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_komite $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}        
					                     
				}elseif($posisi_data=="SPPK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();				
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_sppk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}       
					                      
				}elseif($posisi_data=="PK"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_pk $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}          
					                   
				}elseif($posisi_data=="On Book"){
					if($status_kondisi_data=='Semua'){
						$where = "WHERE id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=='Blm Diajukan'){
						$where = "WHERE status_data='0' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();
					}elseif($status_kondisi_data=="Sudah Diapprove"){
						$where = "WHERE status_data='2' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();						
					}elseif($status_kondisi_data=="Blm Diapprove"){
						$where = "WHERE status_data='1' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dikembalikan"){
						$where = "WHERE status_data='3' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Dihapus"){
						$where = "WHERE status_data='4' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Dihapus"){
						$where = "WHERE status_data='5' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Mohon Mutasi"){
						$where = "WHERE status_data='6' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Ditolak"){
						$where = "WHERE status_data='8' AND id_user_pic='$username' AND kode_status='0' ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}elseif($status_kondisi_data=="Laporan Pipeline"){
						$where = "WHERE status_data=2 AND id_user_pic='$username' AND kode_status='0' AND tampil_pd_laporan=1 ";
						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
						$r = $q->num_rows();					
					}else{
						echo "Maaf, Tidak Ada data";
					}                             
				}else{
					echo "Maaf, Tidak Ada data";
				}   
			}
		
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				//header("Content-Disposition: attachment; filename=MUTASI_MAHASISWA_".$th_ak.'_'.$smt.".xls");
				header("Content-Disposition: attachment; filename=Lap_Aktivitas_".$this->model_global->tgl_indo(date('Y-m-d')).".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>

            		<?php
 					if($posisi_data=="Prospek"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA PROSPEK</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>   
                  
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								 <td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
										}else{
										if($dt->kode_status==0){
											echo "Perorangan";
												}else{						
													echo " ";	
											}
										
									};?></td>  
								<td><?php echo $dt->nama_bidang_usaha;?></td>  
                                <td><?php echo number_format($dt->nominal_prospek_awal,0);?></td>                  
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>
					<?php
					}elseif($posisi_data=="Target"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA TARGET</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>No Identitas</td>
                                    <td>Usaha (Thn)</td>
                                    <td>Bi Checking</td>
                                    <td>SIUP</td>
                                    <td>Target Booking</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td>  
								<td><?php echo $dt->nama_bidang_usaha;?></td>  
								<td><?php echo $dt->no_identitas;?></td>    
                                <td><?php echo $dt->lm_usaha;?></td>    
                                <td><?php 
										if($dt->bi_checking==1){
											 echo "Baik";
										}else{
										if($dt->bi_checking==2){
											echo "Tidak Baik";
										}else{
										if($dt->bi_checking==3){
											echo "Baik Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>    
                                <td><?php if($dt->siup==1){
										 echo "Ada";
									}else{
									if($dt->siup==2){
										echo "Tidak Ada";
									}else{
									if($dt->siup==3){
										echo "Ada Dgn Catatan";
									}else{						
										echo " ";	
										}
									}
								};?></td>    
                                <td><?php echo $dt->target_tgl_booking;?></td>    
                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                        
                    <?php					
					}elseif($posisi_data=="Data Coll"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA DATA COLL</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>Permohonan</td>
                                    <td>Lap Keuangan</td>
                                    <td>Agunan</td>
                                    <td>Dok Pendukung</td>
                                    <td>Nama Daerah</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td> 
								<td><?php echo $dt->nama_bidang_usaha;?></td>  
								<td><?php if($dt->surat_permohonan==1){
											 echo "Ada";
										}else{
										if($dt->surat_permohonan==2){
											echo "Tidak Ada";
										}else{
										if($dt->surat_permohonan==3){
											echo "Ada Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>   
                                <td><?php if($dt->lap_keuangan_2thn_terakhir==1){
											 echo "Ada";
										}else{
										if($dt->lap_keuangan_2thn_terakhir==2){
											echo "Tidak Ada";
										}else{
										if($dt->lap_keuangan_2thn_terakhir==3){
											echo "Ada Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>                                       
                                <td><?php if($dt->agunan==1){
											 echo "Ada";
										}else{
										if($dt->agunan==2){
											echo "Tidak Ada";
										}else{
										if($dt->agunan==3){
											echo "Ada Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>    
                                <td><?php 
										if($dt->dokumen_pendukung_lain==1){
											 echo "Ada";
										}else{
										if($dt->dokumen_pendukung_lain==2){
											echo "Tidak Ada";
										}else{
										if($dt->dokumen_pendukung_lain==3){
											echo "Ada Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>    
  
                                <td><?php echo $dt->nama_daerah;?></td>  
                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                           	
					<?php
					}elseif($posisi_data=="Analisa"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA ANALISA</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>Pembiayaan</td>
                                    <td>Mampu</td>
                                    <td>Cukup Agunan</td>
                                    <td>Dok Pendukung</td>
                                    <td>Pemb. Wajar</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td> 
								<td><?php echo $dt->nama_bidang_usaha;?></td> 
                                <td><?php echo $dt->nama_jenis_pembiayaan;?></td>   
								<td><?php if($dt->mampu_memenuhi_tagihan==1){
											 echo "Ya";
										}else{
										if($dt->mampu_memenuhi_tagihan==2){
											echo "Tidak";
										}else{
										if($dt->mampu_memenuhi_tagihan==3){
											echo "Ya Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>   
                                <td><?php if($dt->cukup_agunan==1){
											 echo "Ya";
										}else{
										if($dt->cukup_agunan==2){
											echo "Tidak";
										}else{
										if($dt->cukup_agunan==3){
											echo "Ya Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>                                       
                                <td><?php if($dt->pembiayaan_wajar==1){
											 echo "Ya";
										}else{
										if($dt->pembiayaan_wajar==2){
											echo "Tidak";
										}else{
										if($dt->pembiayaan_wajar==3){
											echo "Ya Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>    

                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                                
                        
					<?php
					}elseif($posisi_data=="Komite"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA KOMITE</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>Komite Setuju</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td> 
								<td><?php echo $dt->nama_bidang_usaha;?></td> 
								<td><?php if($dt->komite_setuju==1){
											 echo "Ya";
										}else{
										if($dt->komite_setuju==2){
											echo "Tidak";
										}else{
										if($dt->komite_setuju==3){
											echo "Ya Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>   


                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                                
                        
                                                
					<?php
					}elseif($posisi_data=="SPPK"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA SPPK</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>Nasabah Setuju</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td> 
								<td><?php echo $dt->nama_bidang_usaha;?></td> 
								<td><?php if($dt->nasabah_setuju==1){
											 echo "Ya";
										}else{
										if($dt->nasabah_setuju==2){
											echo "Tidak";
										}else{
										if($dt->nasabah_setuju==3){
											echo "Ya Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>   


                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                                
                                                
					<?php
					}elseif($posisi_data=="PK"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA PK</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>Nasabah Setuju</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td> 
								<td><?php echo $dt->nama_bidang_usaha;?></td> 
								<td><?php if($dt->nasabah_setuju==1){
											 echo "Ya";
										}else{
										if($dt->nasabah_setuju==2){
											echo "Tidak";
										}else{
										if($dt->nasabah_setuju==3){
											echo "Ya Dgn Catatan";
										}else{						
											echo " ";	
											}
										}
									};?></td>   


                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                           
                        
					<?php
					}elseif($posisi_data=="On Book"){
						if($status_kondisi_data=='Semua'){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = SEMUA</p>
                            <p></p>  
                        <?php                            
						}elseif($status_kondisi_data=='Blm Diajukan'){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = BLM DIAJUKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Sudah Diapprove"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = SUDAH DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Blm Diapprove"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = BLM DIAPPROVE</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dikembalikan"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = DIKEMBALIKAN</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Dihapus"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = MHN DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Dihapus"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = DIHAPUS</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Mohon Mutasi"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = MHN MUTASI</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Ditolak"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = DITOLAK</p>
                            <p></p>  
                        <?php
						}elseif($status_kondisi_data=="Laporan Pipeline"){
							?>
                            <p>LAPORAN DATA ON BOOK</p>
                            <p>STATUS DATA = DETAIL LAPORAN PIPELINE</p>
                            <p></p>  
                        <?php
						}else{
							echo "Maaf, Tidak Ada data";
						}       
                        ?>  						
						
						<table border="1">
							<thead>
								<tr>
									<td>No</td>
									<td>Nama Prospek</td>
									<td>Alamat</td>
									<td>Status</td>
									<td>Bidang Usaha</td>
                                    <td>No Booking</td>
									<td>Nominal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
							foreach($q->result() as $dt){
							?>
							<tr>
								<td><?php echo $no;?></td>  
								<td><?php echo $dt->nama_prospek;?></td>
								<td><?php echo $dt->alamat_prospek;?></td>
								<td><?php if($dt->kode_status==1){
											 echo "Perusahaan";
											}else{
											if($dt->kode_status==0){
												echo "Perorangan";
													}else{						
														echo " ";	
												}
											
										};?></td> 
								<td><?php echo $dt->nama_bidang_usaha;?></td> 
								<td><?php echo $dt->no_booking;?></td> 

                                <td><?php echo number_format($dt->nominal,0);?></td>                    
							</tr>    
						<?php
							$no++;	
							}
						?>
							</tbody>
						   </table>                           
                                                
					<?php						
					}
					?>
             <?php
			}
		}else{
			redirect('login','refresh');
		}
	}	
	
}
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */