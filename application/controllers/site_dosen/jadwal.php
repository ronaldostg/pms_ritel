<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='dosen'){

			$d['judul']="Jadwal Mengajar ";
			$d['class'] = "master";
			
			$d['content']= 'site_dosen/jadwal/form';
			$this->load->view('site_dosen/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_smt()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='dosen'){
			$kd_dosen = $this->session->userdata('username');
			$th_ak	= $this->input->post('th_ak');
			if(!empty($th_ak)){
				if(substr($th_ak,4,1)==1){
					$smt = 'ganjil';
				}else{
					$smt = 'genap';
				}
				
				$d['semester'] = $smt;
				//$d['smt'] = $this->model_global->semester($nim,$th_ak);
			}else{
				$d['semester'] = '';
				//$d['smt'] = '';
			}
			echo json_encode($d);

		}else{
			redirect('login','refresh');
		}	
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='dosen'){
			
			$kd_dosen = $this->session->userdata('username');
			$th_ak = $this->input->post('thak');
			
			$where = "WHERE th_akademik='$th_ak' AND kd_dosen='$kd_dosen'";
		
			
			$q = $this->db->query("SELECT * FROM krs $where GROUP BY th_akademik,kd_mk ");
			if($q->num_rows()>0){
				$dt['data'] = $q;
				echo $this->load->view('site_dosen/jadwal/view',$dt);
			}else{
				echo $this->load->view('site_dosen/view_kosong');
			}
				
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */