<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
//	public function ip()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='mahasiswa'){
//			$d['judul']="Grafik IP";
//			$d['class'] = "master";
//			
//			$nim = $this->session->userdata('username');
//			
//			
//			$d['kategori'] = $this->model_data->create_category_krs_nim($nim);
//			$d['data'] = $this->model_data->create_data_krs_nim($nim);
//			$d['content']= 'site_mahasiswa/grafik_ip';
//			$this->load->view('site_mahasiswa/home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	

	public function pipeline()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='supervisi'){
			$d['judul']="Grafik Pipeline";
			$d['class'] = "grafik";
			
			date_default_timezone_set('Asia/Jakarta'); 

//			$jlh_prospek = $this->model_data->sum_data_prospek($level,$username);
//			$jlh_target = $this->model_data->sum_data_target($level,$username);
//			$jlh_data_coll = $this->model_data->sum_data_data_coll($level,$username);
//			$jlh_analisa = $this->model_data->sum_data_analisa($level,$username);
//			$jlh_komite = $this->model_data->sum_data_komite($level,$username);
//			$jlh_sppk = $this->model_data->sum_data_sppk($level,$username);
//			$jlh_pk = $this->model_data->sum_data_pk($level,$username);
//			$jlh_on_book = $this->model_data->sum_data_on_book($level,$username);


//			$target1 = $this->model_data->sum_data_nominal_tabel("t_target","nominal",$level,$username);
			$jlh_prospek = $this->model_data->sum_data_nominal_tabel("t_prospek","nominal_prospek_awal",$level,$username);
			$jlh_target = $this->model_data->sum_data_nominal_tabel("t_target","nominal",$level,$username);
			$jlh_data_coll = $this->model_data->sum_data_nominal_tabel("t_data_collect","nominal",$level,$username);
			$jlh_analisa = $this->model_data->sum_data_nominal_tabel("t_analisa","nominal",$level,$username);
			$jlh_komite = $this->model_data->sum_data_nominal_tabel("t_komite","nominal",$level,$username);
			$jlh_sppk = $this->model_data->sum_data_nominal_tabel("t_sppk","nominal",$level,$username);
			$jlh_pk = $this->model_data->sum_data_nominal_tabel("t_pk","nominal",$level,$username);
			$jlh_on_book = $this->model_data->sum_data_nominal_tabel("t_on_book","nominal",$level,$username);
			
			$jlh_prospek1=0.3*$jlh_prospek;
			$jlh_prospek2=0.6*$jlh_prospek1;
			$jlh_prospek3=0.7*$jlh_prospek2;
			$jlh_prospek4=0.8*$jlh_prospek3;
			$jlh_prospek5=0.8*$jlh_prospek4;
			$jlh_prospek6=0.8*$jlh_prospek5;
			$jlh_prospek7=0.6*$jlh_prospek6;

			$jlh_target2=0.6*$jlh_target;
			$jlh_target3=0.7*$jlh_target2;
			$jlh_target4=0.8*$jlh_target3;
			$jlh_target5=0.8*$jlh_target4;
			$jlh_target6=0.8*$jlh_target5;
			$jlh_target7=0.6*$jlh_target6;

			$jlh_data_coll3=0.7*$jlh_data_coll;
			$jlh_data_coll4=0.8*$jlh_data_coll3;
			$jlh_data_coll5=0.8*$jlh_data_coll4;
			$jlh_data_coll6=0.8*$jlh_data_coll5;
			$jlh_data_coll7=0.6*$jlh_data_coll6;

			$jlh_analisa4=0.8*$jlh_analisa;
			$jlh_analisa5=0.8*$jlh_analisa4;
			$jlh_analisa6=0.8*$jlh_analisa5;
			$jlh_analisa7=0.6*$jlh_analisa6;
						
			$jlh_komite5=0.8*$jlh_komite;
			$jlh_komite6=0.8*$jlh_komite5;
			$jlh_komite7=0.6*$jlh_komite6;

			$jlh_sppk6=0.8*$jlh_sppk;
			$jlh_sppk7=0.6*$jlh_sppk6;
									
			$jlh_pk7=0.6*$jlh_pk;
			
			$jlh_jlh_on_book=$jlh_prospek7+$jlh_target7+$jlh_data_coll7+$jlh_analisa7+$jlh_komite7+$jlh_sppk7+$jlh_pk7;


				$rp_target_tumbuh = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_target_tumbuh",$level,$username,date("Y"));
				$rp_existing_debitur = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_existing_debitur",$level,$username,date("Y"));
				$rp_pelunasan = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_pelunasan",$level,$username,date("Y"));
				$rp_wajib_expansi = $rp_target_tumbuh+$rp_pelunasan;
				$rp_target_os = $rp_target_tumbuh+$rp_existing_debitur;
				$rp_potensi_on_book = $jlh_jlh_on_book;
				$rp_lebih_kurang = $rp_potensi_on_book-$rp_wajib_expansi;
				
				
			
			//$d['category'] = $this->model_data->category_pipeline();
			$d['rp_target_tumbuh'] = '['.$rp_target_tumbuh.']';
			$d['rp_existing_debitur'] = '['.$rp_existing_debitur.']';
			$d['rp_pelunasan'] = '['.$rp_pelunasan.']';
			$d['rp_wajib_expansi'] = '['.$rp_wajib_expansi.']';
			$d['rp_target_os'] = '['.$rp_target_os.']';
			$d['rp_potensi_on_book'] = '['.$rp_potensi_on_book.']';
			$d['rp_lebih_kurang'] = '['.$rp_lebih_kurang.']';
			
			//$d['data'] = $this->model_data->create_data_pipeline($nim);
			$d['content']= 'site_supervisi/pipeline';
			$this->load->view('site_supervisi/home',$d);
			
		}else{
			redirect('login','refresh');
		}
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */















//
//
//
//
//
//
//////////////////////////////////
//
//
//	/**
//	 * Index Page for this controller.
//	 * Programmer : Deddy Rusdiansyah.S.Kom
//	 * http://deddyrusdiansyah.blogspot.com
//	 * http://softwarebanten.com
//	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
//	 */
//	public function ip()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='mahasiswa'){
//			$d['judul']="Grafik IP";
//			$d['class'] = "master";
//			
//			$nim = $this->session->userdata('username');
//			
//			
//			$d['kategori'] = $this->model_data->create_category_krs_nim($nim);
//			$d['data'] = $this->model_data->create_data_krs_nim($nim);
//			$d['content']= 'site_mahasiswa/grafik_ip';
//			$this->load->view('site_mahasiswa/home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	
//	
//}
//
///* End of file welcome.php */
///* Location: ./application/controllers/welcome.php */