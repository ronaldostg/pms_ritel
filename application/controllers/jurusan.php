<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurusan extends CI_Controller {

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
			$d['judul']="Program Studi";
			$d['class'] = "master";
			
			$d['content'] = 'jurusan/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['kd_prodi']	= $this->input->post('cari');
			
			$q = $this->db->get_where("prodi",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['kode'] = $dt->kd_prodi;
					$d['jurusan'] = $dt->prodi;
					$d['singkat'] = $dt->singkat;
					$d['ketua'] = $dt->ketua_prodi;
					$d['nip'] = $dt->nik;
					$d['akreditasi'] = $dt->akreditasi;
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['jurusan'] 	= '';
				$d['singkat'] 	= '';
				$d['ketua'] 	= '';
				$d['nip'] 		= '';
				$d['akreditasi'] 		= '';
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
			$id['kd_prodi'] = $this->input->post('kode');
			
			$dt['kd_prodi'] = $this->input->post('kode');
			$dt['prodi'] = $this->input->post('jurusan');
			$dt['singkat'] = $this->input->post('singkat');
			$dt['ketua_prodi'] = $this->input->post('ketua');
			$dt['nik'] = $this->input->post('nip');
			$dt['akreditasi'] = $this->input->post('akreditasi');
						
			$q = $this->db->get_where("prodi",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("prodi",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("prodi",$dt);
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
			$id['kd_prodi']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("prodi",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("prodi",$id);
			}
			redirect('jurusan','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */