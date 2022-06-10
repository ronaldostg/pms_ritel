<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */





	public function pipeline()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){
			$d['judul']="Grafik Pipeline";
			$d['class'] = "grafik";
			
			date_default_timezone_set('Asia/Jakarta'); 
//			$thak = $this->input->post('thak');
//			if(empty($thak)){
//				$x_smt = $this->model_global->cari_semester();
//				if($x_smt=='ganjil'){
//					$smt = 1;
//				}else{
//					$smt = 2;
//				}
//				$th = date('Y').$smt;
//				$d['th'] = $th;
//			}else{
//				$th = $thak;
//				$d['th'] = $th;
//			}



			$jlh_prospek = $this->model_data->sum_data_prospek($username);
			$jlh_target = $this->model_data->sum_data_target($username);
			$jlh_data_coll = $this->model_data->sum_data_data_coll($username);
			$jlh_analisa = $this->model_data->sum_data_analisa($username);
			$jlh_komite = $this->model_data->sum_data_komite($username);
			$jlh_sppk = $this->model_data->sum_data_sppk($username);
			$jlh_pk = $this->model_data->sum_data_pk($username);
			$jlh_on_book = $this->model_data->sum_data_on_book($username);
			
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


				$rp_target_tumbuh = $this->model_data->ambil_data_rencana_kerja("rp_target_tumbuh",$username,date("Y"));
				$rp_existing_debitur = $this->model_data->ambil_data_rencana_kerja("rp_existing_debitur",$username,date("Y"));
				$rp_pelunasan = $this->model_data->ambil_data_rencana_kerja("rp_pelunasan",$username,date("Y"));
				$rp_wajib_expansi = $rp_target_tumbuh+$rp_pelunasan;
				$rp_target_os = $rp_target_tumbuh+$rp_existing_debitur;
				$rp_potensi_on_book = $jlh_jlh_on_book;
				$rp_lebih_kurang = $rp_potensi_on_book-$rp_wajib_expansi;
				
				$d['rp_target_tumbuh'] = $rp_target_tumbuh;
				$d['rp_existing_debitur'] = $rp_existing_debitur;
				$d['rp_pelunasan'] = $rp_pelunasan;
				$d['rp_wajib_expansi'] = $rp_wajib_expansi;
				$d['rp_target_os'] = $rp_target_os;
				$d['rp_potensi_on_book'] = $rp_potensi_on_book;
				$d['rp_lebih_kurang'] = $rp_lebih_kurang;
			
//			$total = $this->model_data->data_chart_mhs_total($th);
//			$aktif = $this->model_data->data_chart_mhs($th,'Aktif');
//			$lulus = $this->model_data->data_chart_mhs($th,'Lulus');
//			$cuti = $this->model_data->data_chart_mhs($th,'Cuti');
//			$do = $this->model_data->data_chart_mhs($th,'DO');
//			$meninggal = $this->model_data->data_chart_mhs($th,'Meninggal');
			
//			$d['mhs_total'] = $total;
//			$d['mhs_aktif'] = $aktif; //@number_format($total/$aktif*100,1);
//			$d['mhs_lulus'] = $lulus; //@number_format($total/$lulus*100,1);
//			$d['mhs_cuti'] = $cuti; //@number_format($total/$cuti*100,1);
//			$d['mhs_do'] = $do; //@number_format($total/$do*100,1);
//			$d['mhs_meninggal'] = $meninggal; //@number_format($total/$meninggal*100,1);
			
			$d['content']= 'site_user/grafik/pipeline';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
//
//	public function mhs_aktif()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='admin'){
//			$d['judul']="Grafik Mahasiswa Aktif";
//			$d['class'] = "grafik";
//			
//			date_default_timezone_set('Asia/Jakarta'); 
//			$thak = $this->input->post('thak');
//			if(empty($thak)){
//				$x_smt = $this->model_global->cari_semester();
//				if($x_smt=='ganjil'){
//					$smt = 1;
//				}else{
//					$smt = 2;
//				}
//				$th = date('Y').$smt;
//				$d['th'] = $th;
//			}else{
//				$th = $thak;
//				$d['th'] = $th;
//			}
//			
//			$d['category'] = $this->model_data->create_category($th);
//			$d['ti'] = $this->model_data->data_chart_mhs_aktif($th,'55-201');
//			$d['si'] = $this->model_data->data_chart_mhs_aktif($th,'57-201');
//			
//			$d['content']= 'grafik/mhs_aktif';
//			$this->load->view('home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	
//	
//	public function mhs()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='admin'){
//			$d['judul']="Grafik Mahasiswa";
//			$d['class'] = "grafik";
//			
//			date_default_timezone_set('Asia/Jakarta'); 
//			$thak = $this->input->post('thak');
//			if(empty($thak)){
//				$x_smt = $this->model_global->cari_semester();
//				if($x_smt=='ganjil'){
//					$smt = 1;
//				}else{
//					$smt = 2;
//				}
//				$th = date('Y').$smt;
//				$d['th'] = $th;
//			}else{
//				$th = $thak;
//				$d['th'] = $th;
//			}
//			
//			$total = $this->model_data->data_chart_mhs_total($th);
//			$aktif = $this->model_data->data_chart_mhs($th,'Aktif');
//			$lulus = $this->model_data->data_chart_mhs($th,'Lulus');
//			$cuti = $this->model_data->data_chart_mhs($th,'Cuti');
//			$do = $this->model_data->data_chart_mhs($th,'DO');
//			$meninggal = $this->model_data->data_chart_mhs($th,'Meninggal');
//			
//			$d['mhs_total'] = $total;
//			$d['mhs_aktif'] = $aktif; //@number_format($total/$aktif*100,1);
//			$d['mhs_lulus'] = $lulus; //@number_format($total/$lulus*100,1);
//			$d['mhs_cuti'] = $cuti; //@number_format($total/$cuti*100,1);
//			$d['mhs_do'] = $do; //@number_format($total/$do*100,1);
//			$d['mhs_meninggal'] = $meninggal; //@number_format($total/$meninggal*100,1);
//			
//			$d['content']= 'grafik/mhs';
//			$this->load->view('home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	
//	public function dosen()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='admin'){
//			$d['judul']="Grafik Dosen";
//			$d['class'] = "grafik";
//			
//			date_default_timezone_set('Asia/Jakarta'); 
//			
//			
//			$ti = $this->model_data->data_chart_dosen('55-201');
//			$si = $this->model_data->data_chart_dosen('57-201');
//			
//			$d['total'] = $ti+$si;
//			$d['si'] = $si;
//			$d['ti'] = $ti; 
//			
//			$d['content']= 'grafik/dosen';
//			$this->load->view('home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	
//
//	
//	public function krs()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='admin'){
//			$d['judul']="Grafik KRS Mahasiswa";
//			$d['class'] = "grafik";
//			
//			
//			
//			date_default_timezone_set('Asia/Jakarta'); 
//			$thak = $this->input->post('thak');
//			if(empty($thak)){
//				$x_smt = $this->model_global->cari_semester();
//				if($x_smt=='ganjil'){
//					$smt = 1;
//				}else{
//					$smt = 2;
//				}
//				$th = date('Y').$smt;
//				$d['th'] = $th;
//			}else{
//				$th = $thak;
//				$d['th'] = $th;
//			}
//			
//			$d['category'] = $this->model_data->create_category($th);
//			$d['ti'] = $this->model_data->data_chart_krs($th,'55-201');
//			$d['si'] = $this->model_data->data_chart_krs($th,'57-201');
//			
//			$d['content']= 'grafik/krs';
//			$this->load->view('home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	
//	public function wisuda()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='admin'){
//			$d['judul']="Grafik Wisuda";
//			$d['class'] = "grafik";
//			
//			
//			
//			date_default_timezone_set('Asia/Jakarta'); 
//			$thak = $this->input->post('thak');
//			if(empty($thak)){
//				$x_smt = $this->model_global->cari_semester();
//				if($x_smt=='ganjil'){
//					$smt = 1;
//				}else{
//					$smt = 2;
//				}
//				$th = date('Y').$smt;
//				$d['th'] = $th;
//			}else{
//				$th = $thak;
//				$d['th'] = $th;
//			}
//			
//			$d['category'] = $this->model_data->create_category($th);
//			$d['ti'] = $this->model_data->data_chart_wisuda($th,'55-201');
//			$d['si'] = $this->model_data->data_chart_wisuda($th,'57-201');
//			
//			$d['content']= 'grafik/wisuda';
//			$this->load->view('home',$d);
//		}else{
//			redirect('login','refresh');
//		}
//	}
//	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */