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
		if(!empty($cek) && $level=='mahasiswa'){
			$d['judul']="Jadwal Kuliah";
			$d['class'] = "master";
			
			$d['content']= 'site_mahasiswa/jadwal/form';
			$this->load->view('site_mahasiswa/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			
			$nim = $this->session->userdata('username');
			$th_ak = $this->input->post('thak');
			$smt = $this->input->post('semester');
			
			$where = "WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim'";
		
			
			$q = $this->db->query("SELECT * FROM krs $where ORDER BY hari,pukul,ruang");
			if($q->num_rows>0){
				$dt['data'] = $q;
				echo $this->load->view('site_mahasiswa/jadwal/view',$dt);
			}else{
				echo $this->load->view('site_mahasiswa/view_kosong');
			}
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */