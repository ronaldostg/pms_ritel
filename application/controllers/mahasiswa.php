<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

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
			$d['judul']="Mahasiswa";
			$d['class'] = "master";
			
			$sess_data['sesi_kd_prodi'] = '';
			$sess_data['sesi_singkat_prodi'] = '';
			$this->session->set_userdata($sess_data);	
			
			$d['content'] = 'mahasiswa/form';
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
			
			//$d['judul']="Mahasiswa";
			//$d['class'] = "master";
			//$d['content'] = 'mahasiswa/form_mhs';
			//$th_now = date('Y');
			//$th_next = date('Y')+1;
			$th_akademik = $this->model_global->cari_th_akademik();// $th_now.'/'.$th_next;
			$kd_prodi = $this->session->userdata('sesi_kd_prodi');
			$singkat = $this->session->userdata('sesi_singkat_prodi');
			$nim = $this->create_nim();
			$d = array('judul' => 'Mahasiswa',
						'class' => 'master',
						'th_akademik' => $th_akademik,
						'kd_prodi' => $kd_prodi.' / '.$singkat,
                        'prodi' => $kd_prodi,
						'nim' => $nim,
						'status_mhs' => '',
						'nama' => '',
						'tempat_lahir' => '',
						'tgl_lahir' => '',
						'sex'=>'',
						'alamat'=>'',
						'kota'=>'',
						'telp'=>'',
						'email'=>'',
						'nama_ayah'=>'',
						'nama_ibu'=>'',
						'alamat_ortu'=>'',
						'hp_ortu'=>'',
						'foto' => '',
						'kategori' => 0,
						'data_chart' => 0,
						'content' => 'mahasiswa/form_mhs',
						);
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
			$d['judul']="Mahasiswa";
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
			
			$d['data'] = $data = $this->model_data->data_mhs($jur);
			$d['content'] = 'mahasiswa/view';
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
			
			$id['nim'] 			= $this->input->post('nim');
			
			$dt['data'] = $this->db->get_where("mahasiswa",$id);
			
			echo $this->load->view('mahasiswa/view_mhs',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$id['th_akademik'] 	= $this->input->post('thak');
			$id['nim'] 			= $this->input->post('nim');
			
			$dt['data'] = $this->db->get_where("krs",$id);
			
			echo $this->load->view('mahasiswa/view_nilai',$dt);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_transkrip()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			//$id['th_akademik'] 	= $this->input->post('thak');
			$id['nim'] 			= $this->input->post('nim');
			
			$dt['data'] = $this->db->get_where("krs",$id);
			
			echo $this->load->view('mahasiswa/view_transkrip',$dt);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function create_nim()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Jakarta');
			
			$th = date('Y');
			$kd_prodi = $this->session->userdata('sesi_kd_prodi');//$this->input->post('prodi');
			$singkat_prodi = $this->session->userdata('sesi_singkat_prodi');
			
			$q = $this->db->query("SELECT MAX(right(nim,4)) as kode FROM mahasiswa WHERE kd_prodi='$kd_prodi'");
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$no_akhir = (int) $dt->kode+1;
					$nim = $singkat_prodi.$th.sprintf("%04s", $no_akhir);
				}
				//echo json_encode($d);
			}else{
				$nim = $singkat_prodi.$th.'0001';
				//echo json_encode($d);
			}
			return $nim;
		}else{
			redirect('login','refresh');
		}
		
	}
	
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$nim = $this->uri->segment(3);
			$data_mhs = $this->model_data->cari_data_mhs($nim);
			foreach($data_mhs->result()as $dt){
				$th_akademik = $dt->th_akademik;
				$nim = $dt->nim;
				$nama = $dt->nama_mhs;
				$status = $dt->status;
				$tempat_lahir = $dt->tempat_lahir;
				$tgl_lhr = $this->model_global->tgl_str($dt->tanggal_lahir);
				$sex = $dt->sex;
				$alamat = $dt->alamat;
				$kota = $dt->kota;
				$hp = $dt->hp;
				$email = $dt->email;
				$nama_ayah  = $dt->nama_ayah;
				$nama_ibu = $dt->nama_ibu;
				$alamat_ortu = $dt->alamat_ortu;
				$hp_ortu = $dt->hp_ortu;
				$foto = $dt->file_foto;
			}
			
			
			$kd_prodi = $dt->kd_prodi;// $this->session->userdata('sesi_kd_prodi');
			$singkat =  $this->model_data->singkat_jurusan($kd_prodi);// $this->session->userdata('sesi_singkat_prodi');
			$d = array('judul' => 'Mahasiswa',
						'class' => 'master',
						'th_akademik' => $th_akademik,
						'kd_prodi' => $kd_prodi.' / '.$singkat,
						'prodi' =>$kd_prodi,
						'nim' => $nim,
						'status_mhs' => $status,
						'nama' => $nama,
						'tempat_lahir' => $tempat_lahir,
						'tgl_lahir' => $tgl_lhr,
						'sex'=>$sex,
						'alamat'=>$alamat,
						'kota'=>$kota,
						'telp'=>$hp,
						'email'=>$email,
						'nama_ayah'=>$nama_ayah,
						'nama_ibu'=>$nama_ibu,
						'alamat_ortu'=>$alamat_ortu,
						'hp_ortu'=>$hp_ortu,
						'foto' => $foto,
						'kategori' => $this->model_data->create_category_krs_nim($nim),
						'data_chart' => $this->model_data->create_data_krs_nim($nim),
						'content' => 'mahasiswa/form_mhs'
						);
			$this->load->view('home',$d);
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
			$tgl_lhr = $this->model_global->tgl_sql($this->input->post('tgl_lahir'));
			
			$id['nim'] = $this->input->post('nim');
			
			$dt['th_akademik'] = $this->input->post('th_akademik');
			$dt['kd_prodi'] = $this->session->userdata('sesi_kd_prodi');
			$dt['nim'] = $this->input->post('nim');
			$dt['nama_mhs'] = $this->input->post('nama_lengkap');
			$dt['sex'] = $this->input->post('sex');
			$dt['tempat_lahir'] = $this->input->post('tempat_lahir');
			$dt['tanggal_lahir'] = $tgl_lhr;
			$dt['alamat'] = $this->input->post('alamat');
			$dt['kota'] = $this->input->post('kota');
			$dt['hp'] = $this->input->post('telp');
			$dt['email'] = $this->input->post('email');
			$dt['password'] = md5($this->input->post('nim'));

						
			$q = $this->db->get_where("mahasiswa",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("mahasiswa",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("mahasiswa",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function simpan_ortu()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Jakarta'); 
			
			$nim = $this->input->post('nim');
			$data = $this->model_data->cari_data_mhs($nim);
			if($data->num_rows()>0){
				$id['nim'] = $this->input->post('nim');
				
				$dt['nama_ayah'] = $this->input->post('nama_ayah');
				$dt['nama_ibu'] = $this->input->post('nama_ibu');
				$dt['alamat_ortu'] = $this->input->post('alamat_ortu');
				$dt['hp_ortu'] = $this->input->post('hp_ortu');
	
							
				$q = $this->db->get_where("mahasiswa",$id);
				$row = $q->num_rows();
				if($row>0){
					$dt['tgl_update'] = date('Y-m-d h:i:s');
					$this->db->update("mahasiswa",$dt,$id);
					echo "Data Sukses diUpdate";
				}else{
					$dt['tgl_insert'] = date('Y-m-d h:i:s');
					$this->db->insert("mahasiswa",$dt);
					echo "Data Sukses diSimpan";
				}
			}else{
				echo "Maaf, NIM belum disimpan";
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
			$id['nim']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("mahasiswa",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("mahasiswa",$id);
			}
			redirect('mahasiswa/view_data','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */