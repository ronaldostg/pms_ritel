<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mutasi_mhs extends CI_Controller {

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
			$d['judul']="Mutasi Mahasiswa";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query('SELECT * FROM mutasi_mhs JOIN mahasiswa ON mutasi_mhs.nim=mahasiswa.nim');
			$d['content'] = 'mutasi_mhs/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Tambah Mutasi Mahasiswa";
			$d['class'] = "transaksi";
			
			$id = $this->model_global->cari_max_mutasi_mhs();
			$d['id'] = $id;
			$d['content'] = 'mutasi_mhs/form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Edit Mutasi Mahasiswa";
			$d['class'] = "transaksi";
			
			$id = $this->uri->segment(3);
			$d['id'] = $id;
			$d['content'] = 'mutasi_mhs/form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_mhs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['nim']	= $this->input->post('nim');
			
			$q = $this->db->get_where("mahasiswa",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['nama'] = $dt->nama_mhs;
					$d['sex'] = $dt->sex;
				}
				echo json_encode($d);
			}else{
				$d['nama'] = '';
				$d['sex'] = '';
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
			$id['id_mutasi']	= $this->input->post('id');
			
			$q = $this->db->get_where("mutasi_mhs",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_str($dt->tgl_mutasi);
					$d['thak'] = $dt->th_akademik;
					$d['smt'] = $dt->semester;
					$d['tgl'] = $tgl;
					$d['nim'] = $dt->nim;
					$d['status'] = $dt->status;
					$d['ket'] = $dt->ket;
				}
				echo json_encode($d);
			}else{
				$d['thak'] = '';
				$d['smt'] = '';
				$d['tgl'] = '';
				$d['nim'] = '';
				$d['status'] = '';
				$d['ket'] = '';
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
			date_default_timezone_set('Asia/Jakarta');
			
			$id['id_mutasi'] = $this->input->post('id');
			$tgl = $this->model_global->tgl_sql($this->input->post('tgl'));
			
			$dt['th_akademik'] = $this->input->post('thak');
			$dt['semester'] = $this->input->post('smt');
			$dt['tgl_mutasi'] = $tgl;
			$dt['nim'] = $this->input->post('nim');
			$dt['status'] = $this->input->post('status');
			$dt['ket'] = $this->input->post('ket');
						
			$q = $this->db->get_where("mutasi_mhs",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("mutasi_mhs",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("mutasi_mhs",$dt);
				echo "Data Sukses diSimpan";
			}
			
			$id_u['nim'] = $this->input->post('nim');
			$dt_u['status']= $this->input->post('status');
			$this->db->update("mahasiswa",$dt_u,$id_u);
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['id_mutasi']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("mutasi_mhs",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("mutasi_mhs",$id);
			}
			redirect('mutasi_mhs','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */