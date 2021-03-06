<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller {

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
		if(!empty($cek) && $level=='user'){
			$kd_cab = $this->session->userdata('kd_cab');
			$prodi = $this->model_data->nama_cabang($kd_cab);
			$d['judul']="Mata Kuliah ".$prodi;
			$d['class'] = "master";
			
			$d['content']= 'site_user/mata_kuliah/form';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			
			$kd_cab = $this->session->userdata('kd_cab');
			$smt = $this->input->post('smt');
			
			$where = "WHERE aktif='Ya' AND kd_cab='$kd_cab'";
		
			if(!empty($smt)){
				$where .=" AND smt='$smt'";
			}
					
			
			$q = $this->db->query("SELECT * FROM mata_kuliah $where ");
			if($q->num_rows()>0){
				$dt['data'] = $q;
				echo $this->load->view('site_user/mata_kuliah/view',$dt);
			}else{
				echo $this->load->view('site_user/view_kosong');
			}
				
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */