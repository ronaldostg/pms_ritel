<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	public function ip()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			$d['judul']="Grafik IP";
			$d['class'] = "master";
			
			$nim = $this->session->userdata('username');
			
			
			$d['kategori'] = $this->model_data->create_category_krs_nim($nim);
			$d['data'] = $this->model_data->create_data_krs_nim($nim);
			$d['content']= 'site_mahasiswa/grafik_ip';
			$this->load->view('site_mahasiswa/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */