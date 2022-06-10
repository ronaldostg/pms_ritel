<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wisuda extends CI_Controller {

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
			$d['judul']="Wisuda";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query('SELECT * FROM wisuda JOIN mahasiswa ON wisuda.nim=mahasiswa.nim');
			$d['content'] = 'wisuda/view';
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
			$d['judul']="Tambah Wisuda";
			$d['class'] = "transaksi";
			
			$id = $this->model_global->cari_max_wisuda_mhs();
			$d['id'] = $id;
			$d['content'] = 'wisuda/form';
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
			$d['judul']="Edit Wisuda";
			$d['class'] = "transaksi";
			
			$id = $this->uri->segment(3);
			$d['id'] = $id;
			$d['content'] = 'wisuda/form';
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
			$id['id_wisuda']	= $this->input->post('id');
			
			$q = $this->db->get_where("wisuda",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_str($dt->tgl_daftar);
					$d['thak'] = $dt->th_akademik;
					$d['tgl'] = $tgl;
					$d['nim'] = $dt->nim;
					$d['skripsi'] = $dt->judul_skripsi;
					$d['ipk'] = $dt->ipk;
					$d['valid'] = $dt->acc_akademik;
				}
				echo json_encode($d);
			}else{
				$d['thak'] = '';
				$d['tgl'] = '';
				$d['nim'] = '';
				$d['skripsi'] = '';
				$d['ipk'] = '';
				$d['valid'] = 'T';
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
			
			$id['id_wisuda'] = $this->input->post('id');
			$tgl = $this->model_global->tgl_sql($this->input->post('tgl'));
			
			$dt['th_akademik'] = $this->input->post('thak');
			$dt['tgl_daftar'] = $tgl;
			$dt['nim'] = $this->input->post('nim');
			$dt['judul_skripsi'] = $this->input->post('skripsi');
			$dt['ipk'] = $this->input->post('ipk');
			$dt['acc_akademik'] = $this->input->post('valid');
						
			$q = $this->db->get_where("wisuda",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("wisuda",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("wisuda",$dt);
				echo "Data Sukses diSimpan";
			}
			$valid = $this->input->post('valid');
			if($valid=='Y'){
				$id_u['nim'] = $this->input->post('nim');
				$dt_u['status']= 'Lulus';
				$this->db->update("mahasiswa",$dt_u,$id_u);
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
			$id['id_wisuda']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("wisuda",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$id_u['nim'] = $dt->nim;
					$dt_u['status']= 'Aktif';
					$this->db->update("mahasiswa",$dt_u,$id_u);
				}
				$this->db->delete("wisuda",$id);
			}
			redirect('wisuda','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */