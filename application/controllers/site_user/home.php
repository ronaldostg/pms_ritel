<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
			$d['judul']="Dashboard";
			$d['class'] = "home";
			
			$d['content']= 'site_user/isi';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */