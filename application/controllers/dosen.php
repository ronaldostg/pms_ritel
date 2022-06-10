<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

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
			$d['judul']="Dosen";
			$d['class'] = "master";
			
			//$this->session->unset_userdata('sesi_kd_prodi');
			$sess_data['sesi_kd_prodi'] = '';
			$sess_data['sesi_singkat_prodi'] = '';
			$this->session->set_userdata($sess_data);	
			
			$d['content'] = 'dosen/form';
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
			$d['judul']="Dosen";
			$d['class'] = "master";
			
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
			
			
			$d['data'] = $this->model_data->data_dosen($jur);
			$d['content'] = 'dosen/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function create_kddosen()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Jakarta');
			
			$th = substr(date('Y'),2,2);
			$kd_prodi = $this->session->userdata('sesi_kd_prodi');//$this->input->post('prodi');
			$singkat_prodi = $this->session->userdata('sesi_singkat_prodi');
			
			$q = $this->db->query("SELECT MAX(right(kd_dosen,4)) as kode FROM dosen WHERE kd_prodi='$kd_prodi'");
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$no_akhir = (int) $dt->kode+1;
					$d['kode'] = $singkat_prodi.$th.'DS'.sprintf("%04s", $no_akhir);
				}
				echo json_encode($d);
			}else{
				$d['kode'] = $singkat_prodi.$th.'DS'.'0001';
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
			$id['kd_dosen']	= $this->input->post('cari');
			
			$q = $this->db->get_where("dosen",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_str($dt->tanggal_lahir);
					$d['jurusan'] = $dt->kd_prodi;
					$d['nidn'] = $dt->nidn;
					$d['kode'] = $dt->kd_dosen;
					$d['nama_dosen'] = $dt->nama_dosen;
					$d['jk'] = $dt->sex;
					$d['tempat_lahir'] = $dt->tempat_lahir;
					$d['tanggal_lahir'] = $tgl;
					$d['alamat'] = $dt->alamat;
					$d['hp'] = $dt->hp;
					$d['pendidikan'] = $dt->pendidikan;
					$d['prodi'] = $dt->prodi;
					$d['status'] = $dt->status;
				}
				echo json_encode($d);
			}else{
				$d['jurusan'] = '';
				$d['nidn'] = '';
				$d['kode'] = '';
				$d['nama_dosen'] = '';
				$d['jk'] = '';
				$d['tempat_lahir'] = '';
				$d['tanggal_lahir'] = '';
				$d['alamat'] = '';
				$d['hp'] = '';
				$d['pendidikan']='';
				$d['prodi'] = '';
				$d['status'] = '';
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
			
			$id['kd_dosen'] = $this->input->post('kode');
			$tgl = $this->model_global->tgl_sql($this->input->post('tanggal_lahir'));
			
			$dt['kd_dosen'] = $this->input->post('kode');
			$dt['kd_prodi'] = $this->input->post('jurusan');
			$dt['nidn'] = $this->input->post('nidn');
			$dt['nama_dosen'] = $this->input->post('nama_dosen');
			$dt['sex'] = $this->input->post('jk');
			$dt['tempat_lahir'] = $this->input->post('tempat_lahir');
			$dt['tanggal_lahir'] = $tgl;
			$dt['alamat'] = $this->input->post('alamat');
			$dt['hp'] = $this->input->post('hp');
			$dt['pendidikan'] = $this->input->post('pendidikan');
			$dt['prodi'] = $this->input->post('prodi');
			$dt['status'] = $this->input->post('status');
			$dt['password'] = md5('dosen');
						
			$q = $this->db->get_where("dosen",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("dosen",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_masuk'] = date('Y-m-d');
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("dosen",$dt);
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
			$id['kddosen']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("msdosen",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("msdosen",$id);
			}
			redirect('dosen/view_data','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */