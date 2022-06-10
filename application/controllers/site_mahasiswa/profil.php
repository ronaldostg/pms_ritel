<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

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
			$d['judul']="Edit Profil";
			$d['class'] = "home";
			
			$d['nim'] = $this->session->userdata('username');
			$d['nama_lengkap'] = $this->session->userdata('nama_lengkap');
			$d['foto']= $this->model_data->cari_foto_mahasiswa($this->session->userdata('username'));
			$d['content']= 'site_mahasiswa/profil/profil';
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
			
			
			$id['nim'] = $this->session->userdata('username');
			
			$q = $this->db->get_where("mahasiswa",$id);
			foreach($q->result()as $dt){
				$data['th_ak'] = $dt->th_akademik;
				$data['nama'] = $dt->nama_mhs;
				$data['tempat_lahir'] = $dt->tempat_lahir;
				$data['tanggal_lahir'] = $this->model_global->tgl_str($dt->tanggal_lahir);
				$data['sex'] = $dt->sex;
				$data['alamat'] = $dt->alamat;
				$data['kota'] = $dt->kota;
				$data['hp'] = $dt->hp;
				$data['email'] = $dt->email;
				$data['nama_ayah']  = $dt->nama_ayah;
				$data['nama_ibu'] = $dt->nama_ibu;
				$data['alamat_ortu'] = $dt->alamat_ortu;
				$data['hp_ortu'] = $dt->hp_ortu;
				//$foto = $dt->file_foto;
			}
			
			echo json_encode($data);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_profil()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			date_default_timezone_set('Asia/Jakarta'); 
			$tgl_lhr = $this->model_global->tgl_sql($this->input->post('tanggal_lahir'));
			
			$id['nim'] = $this->session->userdata('username');
			
			$dt['nama_mhs'] = $this->input->post('nama_lengkap');
			$dt['sex'] = $this->input->post('sex');
			$dt['tempat_lahir'] = $this->input->post('tempat_lahir');
			$dt['tanggal_lahir'] = $tgl_lhr;
			$dt['alamat'] = $this->input->post('alamat');
			$dt['kota'] = $this->input->post('kota');
			$dt['hp'] = $this->input->post('hp');
			$dt['email'] = $this->input->post('email');
			
			$q = $this->db->get_where('mahasiswa');
			$r = $q->num_rows();
			if($r>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update('mahasiswa',$dt,$id);
				echo "Sukses di Ubah";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_ortu()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			date_default_timezone_set('Asia/Jakarta'); 
			
			$id['nim'] = $this->session->userdata('username');
			
			$dt['nama_ayah'] = $this->input->post('nama_ayah');
			$dt['nama_ibu'] = $this->input->post('nama_ibu');
			$dt['alamat_ortu'] = $this->input->post('alamat_ortu');
			$dt['hp_ortu'] = $this->input->post('hp_ortu');
			
			$q = $this->db->get_where('mahasiswa');
			$r = $q->num_rows();
			if($r>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update('mahasiswa',$dt,$id);
				echo "Sukses di Ubah";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_foto()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			
			$key = $this->session->userdata('username');
			
			$config['upload_path'] = './assets/foto_mhs/'; 
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			//$config['max_size'] = '2000';
			//$config['max_width'] = '1280';
			//$config['max_height'] = '1280';	
			$config['overwrite'] = TRUE;	
			$config['file_name'] = $key;							
			$this->load->library('upload', $config);
			
			$foto = $_FILES['gambar']['name'];
			
			if(!empty($foto)){
				if($this->upload->do_upload('gambar')){
					$tp=$this->upload->data();
					$ori = $tp['file_name'];
					
					$data['file_foto'] = $ori;
					
					$this->load->library('image_lib');
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/foto_mhs/'.$ori;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 150;
					$config['height'] = 200;
					
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$id['nim'] = $this->session->userdata('username');
					
					$q = $this->db->get_where('mahasiswa',$id);
					$r = $q->num_rows();
					if($r>0){
						$this->db->update('mahasiswa',$data,$id);
						$info = "Sukses di Ubah";
						$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
						redirect('site_mahasiswa/profil','refresh');
					}
				}else{
					$info =  $this->upload->display_errors();
					$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
					redirect('site_mahasiswa/profil');
				}
			}else{
				$info ='File Foto tidak ada';
				$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
				redirect('profil');
			}
			
			
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_pwd()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			$id['nim'] = $this->session->userdata('username');
			
			$pwd = $this->input->post('pwd_1');
			$dt['password'] = md5($pwd);
			
			$q = $this->db->get_where('mahasiswa',$id);
			$r = $q->num_rows();
			if($r>0){
				$this->db->update('mahasiswa',$dt,$id);
				echo "Password !!! Sukses di Ubah";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */