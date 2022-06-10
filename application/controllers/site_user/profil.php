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
		// if(!empty($cek) && $level=='user'){
			$d['judul']="Edit Profil";
			$d['class'] = "home";
			
			$d['nama_lengkap'] = $this->session->userdata('nama_lengkap');

			$d['content']= 'site_user/profil/profil';
			$this->load->view('site_user/home',$d);
		// }else{
		// 	redirect('login','refresh');
		// }
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		// if(!empty($cek) && $level=='user'){
			
			$id['id_user'] = $this->session->userdata('username');
			
			$q = $this->db->get_where("t_user",$id);
			foreach($q->result()as $dt){
				$data['tgl_masuk'] = $this->model_global->tgl_indo($dt->tgl_masuk);
				$data['nama'] = $dt->nama_user;
				$data['id_user_supervisi2'] = $dt->id_user_supervisi2;
//				$data['tanggal_lahir'] = $this->model_global->tgl_str($dt->tanggal_lahir);
				$data['id_user_supervisi1'] = $dt->id_user_supervisi1;
				$data['status_user'] = $dt->status_user;
//				$data['hp'] = $dt->hp;
//				$data['email'] = $dt->email;
//				$data['pendidikan'] = $dt->pendidikan;
//				$data['prodi'] = $dt->prodi;
			}
			
			echo json_encode($data);
			
		// }else{
		// 	redirect('login','refresh');
		// }
	}
	
	public function simpan_profil()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		// if(!empty($cek) && $level=='user'){
			date_default_timezone_set('Asia/Jakarta'); 
			
			$id['username'] = $this->session->userdata('username');
			
			$dt['nama_lengkap'] = $this->input->post('nama_lengkap');
			
			$q = $this->db->get_where('t_user');
			$r = $q->num_rows();
			if($r>0){
				$this->db->update('t_user',$dt,$id);
				echo "Sukses di Ubah";
			}


		// }else{
		// 	redirect('login','refresh');
		// }
	}
	
	
	
	public function simpan_foto()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		// if(!empty($cek) && $level=='t_user'){
			
			$key = $this->session->userdata('username');
			
			$config['upload_path'] = './assets/foto_user/'; 
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
					$config['source_image'] = './assets/foto_user/'.$ori;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 150;
					$config['height'] = 200;
					
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$id['id_user'] = $this->session->userdata('username');
					
					$q = $this->db->get_where('t_user',$id);
					$r = $q->num_rows();
					if($r>0){
						$this->db->update('t_user',$data,$id);
						$info = "Sukses di Ubah";
						$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
						redirect('site_user/profil','refresh');
					}
				}else{
					$info =  $this->upload->display_errors();
					$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
					redirect('site_user/profil');
				}
			}else{
				$info ='File Foto tidak ada';
				$this->session->set_flashdata('result_info', '<center>'.$info.'</center>');
				redirect('profil');
			}
			
			
			
		// }else{
		// 	redirect('login','refresh');
		// }
	}
	
	public function simpan_pwd()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		// if(!empty($cek) && $level=='user'){
			$id['id_user'] = $this->session->userdata('username');
			
			$pwd = $this->input->post('pwd_1');
			$dt['password'] = md5($pwd);
			
			$q = $this->db->get_where('t_user',$id);
			$r = $q->num_rows();
			if($r>0){
				$this->db->update('t_user',$dt,$id);
				echo "Password !!! Sukses di Ubah";
			}
			
		// }else{
		// 	redirect('login','refresh');
		// }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */