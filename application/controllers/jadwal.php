<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller {

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
			
			$d = array('judul' => 'Jadwal Kuliah Semester',
					'class'=> 'transaksi',
					'data' => $this->db->query('SELECT * FROM jadwal GROUP BY th_akademik,semester,kd_prodi'),
					'content'=>'jadwal/view_data'
					);
			
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
			/*
			$d['judul']="Jadwal Kuliah Semester";
			$d['class'] = "transaksi";
			$d['content'] = 'jadwal/form';
			*/
			//$th_now = date('Y');
			//$th_next = date('Y')+1;
			$th_akademik = $this->model_global->cari_th_akademik();  //$th_now.'/'.$th_next;
			$semester = $this->model_global->cari_semester();
			$d = array('judul' => 'Jadwal Kuliah Semester',
					'class'=> 'transaksi',
					'content'=>'jadwal/form',
					'th_akademik'=>$th_akademik,
					'semester'=>$semester
					);
			
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function data_MK_prodi(){
		$id['Fak'] = $this->input->post('id');
		$id['Smt'] = $this->input->post('smt');
		
		$q = $this->db->get_where("msmatakuliah",$id);
		foreach($q->result() as $dt){
			echo "<option value='".$dt->KdMK."'>".$dt->NamaMK."</option>";
		}
	}
	
	
	public function view_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Dosen";
			$d['class'] = "master";
			
			$jurusan = $this->input->post('cari_jurusan');
			if(!empty($jurusan)){
				$sess_data['sesi_jurusan'] = $jurusan;
				$this->session->set_userdata($sess_data);	
			}
			$jur = $this->session->userdata('sesi_jurusan');
			
			
			$d['data'] = $data = $this->model_data->data_dosen($jur);
			$d['content'] = 'dosen/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function mata_kuliah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['kd_prodi']	= $this->input->post('kd_prodi');
			$id['semester']	= $this->input->post('smt');
			
			$q = $this->db->get_where("mata_kuliah",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
				?>
                	<option value="<?php echo $dt->kd_mk;?>"><?php echo $dt->nama_mk;?></option>
                <?php
				}
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_jadwal()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['th_akademik']	= $this->input->post('th_ak');
			$id['kd_prodi']	= $this->input->post('kd_prodi');
			$id['semester']	= $this->input->post('smt');
			
			$d['data'] = $this->db->get_where("jadwal",$id);
			echo $this->load->view('jadwal/view',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$id['th_akademik'] = $this->input->post('th_akademik');
			$id['semester'] = $this->input->post('smt');
			$id['hari'] = $this->input->post('hari');
			$id['pukul'] = $this->input->post('pukul');
			$id['ruang'] = $this->input->post('ruang');
			
			$q = $this->db->get_where('jadwal',$id);
			$r = $q->num_rows();
			if($r>0){
				echo "Maaf, Hari - Pukul - Ruang sudah di Gunakan";
			}else{
				$id['kd_mk'] = $this->input->post('mk');
				$q = $this->db->get_where('jadwal',$id);
				$r = $q->num_rows();
				if($r>0){
					echo "Maaf, Hari - Pukul - Ruang - Mata Kuliah sudah di Gunakan";
				}else{
					$id_2['th_akademik'] = $this->input->post('th_akademik');
					$id_2['semester'] = $this->input->post('smt');
					$id_2['hari'] = $this->input->post('hari');
					$id_2['pukul'] = $this->input->post('pukul');
					$id_2['kd_dosen'] = $this->input->post('kd_dosen');
					$q = $this->db->get_where('jadwal',$id_2);
					$r = $q->num_rows();
					if($r>0){
						echo "Maaf, Hari - Pukul - Ruang - Dosen sudah di Gunakan";
					}else{
						//echo "Simpan";
						$data['th_akademik'] = $this->input->post('th_akademik');
						$data['semester'] = $this->input->post('smt');
						$data['kd_prodi'] = $this->input->post('kd_prodi');
						$data['hari'] = $this->input->post('hari');
						$data['pukul'] = $this->input->post('pukul');
						$data['ruang'] = $this->input->post('ruang');
						$data['kd_mk'] = $this->input->post('mk');
						$data['kd_dosen'] = $this->input->post('kd_dosen');
						$data['tgl_insert'] = date('Y-m-d h:i:s');
						
						$this->db->insert("jadwal",$data);
						
						echo "Data Sukses disimpan";
					}
				}
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
			$id['id_jadwal']	= $this->input->post('id');
			
			$q = $this->db->get_where("jadwal",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("jadwal",$id);
				echo 'Data Sukses dihapus';
			}
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */