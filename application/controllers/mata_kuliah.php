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
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Mata Kuliah";
			$d['class'] = "master";
			
			$sess_data['sesi_kd_prodi'] = '';
			$sess_data['sesi_singkat_prodi'] = '';
			$this->session->set_userdata($sess_data);	
			
			$d['content'] = 'mata_kuliah/form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function view_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Mata Kuliah";
			$d['class'] = "master";
			
			//$kd_prodi = $this->input->post('cari_jurusan');
			
			$var = $this->session->userdata['sesi_kd_prodi'];
			if(empty($var)){
				$kd_prodi = $this->input->post('cari_jurusan');
			}else{
				$kd_prodi = $var;
			}
			
			$jurusan = $this->model_data->singkat_jurusan($kd_prodi);
			
			if(!empty($jurusan)){
				$sess_data['sesi_kd_prodi'] = $kd_prodi;
				$sess_data['sesi_singkat_prodi'] = $jurusan;
				$this->session->set_userdata($sess_data);	
				
			}
			$jur = $this->session->userdata('sesi_kd_prodi');
			
			
			$d['data'] = $data = $this->model_data->data_mk($jur);
			$d['content'] = 'mata_kuliah/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function create_kdmk()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$kd_prodi = $this->session->userdata('sesi_kd_prodi');//$this->input->post('prodi');
			$singkat_prodi = $this->session->userdata('sesi_singkat_prodi');
			
			$q = $this->db->query("SELECT MAX(right(kd_mk,4)) as kode FROM mata_kuliah WHERE kd_prodi='$kd_prodi'");
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$no_akhir = (int) $dt->kode+1;
					$d['kode'] = $singkat_prodi.'-'.sprintf("%04s", $no_akhir);
				}
				echo json_encode($d);
			}else{
				$d['kode'] = $singkat_prodi.'-0001';
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['kd_mk']	= $this->input->post('cari');
			
			$q = $this->db->get_where("mata_kuliah",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['jurusan'] = $dt->kd_prodi;
					$d['semester'] = $dt->smt;
					$d['kode'] = $dt->kd_mk;
					$d['nama_mk'] = $dt->nama_mk;
					$d['sks'] = $dt->sks;
					$d['tayang'] = $dt->aktif;
				}
				echo json_encode($d);
			}else{
				$d['jurusan'] = '';
				$d['semester'] = '';
				$d['kode'] = '';
				$d['nama_mk'] = '';
				$d['sks'] = '';
				$d['tayang'] = '';
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$smt = $this->input->post('semester');
			if($smt % 2 ==0){
				$ket_smt = "Genap";
			}else{
				$ket_smt = "Ganjil";
			}
			
			$id['kd_mk'] = $this->input->post('kode');
			
			$dt['kd_mk'] = $this->input->post('kode');
			$dt['kd_prodi'] = $this->input->post('jurusan');
			$dt['smt'] = $this->input->post('semester');
			$dt['nama_mk'] = $this->input->post('nama_mk');
			$dt['sks'] = $this->input->post('sks');
			$dt['semester'] = $ket_smt;
			$dt['aktif'] = $this->input->post('tayang');
						
			$q = $this->db->get_where("mata_kuliah",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("mata_kuliah",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("mata_kuliah",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['KdMK']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("msmatakuliah",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("msmatakuliah",$id);
			}
			redirect('mata_kuliah/view_data','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */