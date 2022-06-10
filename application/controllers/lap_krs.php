<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_krs extends CI_Controller {

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
		if(!empty($cek)){
			$d['judul']="Laporan KRS Mahasiswa";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_krs';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_smt()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$th_ak	= $this->input->post('th_ak');
			if(!empty($th_ak)){
				if(substr($th_ak,4,1)==1){
					$smt = 'ganjil';
				}else{
					$smt = 'genap';
				}
				
				$d['semester'] = $smt;
			}else{
				$d['semester'] = '';
			}
			echo json_encode($d);

		}else{
			redirect('login','refresh');
		}	
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$th_ak = $this->input->post('th_ak');
			$smt = $this->input->post('smt');
			
			$th = $this->input->post('th');
			$kd_prodi = $this->input->post('kd_prodi');
			
			/*
			$query = "SELECT *
						FROM krs as a
						RIGHT JOIN mahasiswa as b
						ON a.nim = b.nim
					WHERE a.th_akademik='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi'
					GROUP BY b.nim";
			*/
			$query = "SELECT * FROM mahasiswa WHERE status='Aktif' AND th_akademik='$th' AND kd_prodi='$kd_prodi'";
			$q = $this->db->query($query);
			$dt['th_ak'] = $th_ak;
			$dt['smt']= $smt;
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/view_lap_krs',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */