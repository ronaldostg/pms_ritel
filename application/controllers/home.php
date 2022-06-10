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
		$akses = $this->session->userdata('akses');
		

		
		// $posisi_data = $this->input->post('posisi_data');
		// $status_prospek = $this->input->post('status_prospek');
		// $status_kondisi_data = $this->input->post('status_kondisi_data');

		$where = "WHERE status_data='2' ";
		// $q = $this->db->query("SELECT SUM(nominal_prospek_awal) AS nominal_prospek FROM v_lap_prospek $where ");
		//$dt['data'] = $q;
					// echo $this->load->view('lap_pipeline/view',$dt);	

		// var_dump($q);
		// die();
		// $d['data'] = $q;
		$d['data'] = 0;

		if(!empty($cek) && $level=='admin'){
			$d['judul']="Dashboard";
			$d['class'] = "home";
			
			$krs['form'] ='KRS';
			$q = $this->db->get_where('setting',$krs);
			foreach($q->result() as $dt){
				$tgl = $this->model_global->tgl_str($dt->tgl_close);
				$d['tgl_krs'] = $tgl;
			}
			
			$wisuda['form'] ='Wisuda';
			$q = $this->db->get_where('setting',$wisuda);
			foreach($q->result() as $dt){
				$tgl = $this->model_global->tgl_str($dt->tgl_close);
				$d['tgl_wisuda'] = $tgl;
			}
			if($akses == 'adminkantor'){
				$d['content']= 'isiadminkantor';
			}else{
				$d['content']= 'isi';
			}
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function update_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$id['id'] = 1;
			$id['form'] ='KRS';
			
			$tgl = $this->model_global->tgl_sql($this->input->post('tgl_krs'));
			$dt['tgl_close'] = $tgl;
			
			$this->db->update("setting",$dt,$id);
			echo "Tanggal KRS sukses di update";
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function update_wisuda()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$id['id'] = 2;
			$id['form'] ='Wisuda';
			
			$tgl = $this->model_global->tgl_sql($this->input->post('tgl_wisuda'));
			$dt['tgl_close'] = $tgl;
			
			$this->db->update("setting",$dt,$id);
			echo "Tanggal Wisuda sukses di update";
			
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */