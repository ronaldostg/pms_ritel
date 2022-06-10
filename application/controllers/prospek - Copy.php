<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nama_prospek extends CI_Controller {

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
			$d['judul']="Prospek";
			$d['class'] = "master";
			
			$d['content'] = 'nama_prospek/view';
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
			$id['id_prospek']	= $this->input->post('cari');
			
			$q = $this->db->get_where("nama_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['kode'] = $dt->id_prospek;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat_prospek'] = $dt->alamat_prospek;
					$d['telp'] = $dt->telp;
					$d['pic_prospek'] = $dt->pic_prospek;
					$d['nominal_prospek_awal'] = $dt->nominal_prospek_awal;
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['nama_prospek'] 	= '';
				$d['alamat_prospek'] 	= '';
				$d['telp'] 	= '';
				$d['pic_prospek'] 		= '';
				$d['nominal_prospek_awal'] 		= '';
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
			$id['id_prospek'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('kode');
			$dt['nama_prospek'] = $this->input->post('nama_prospek');
			$dt['alamat_prospek'] = $this->input->post('alamat_prospek');
			$dt['telp'] = $this->input->post('telp');
			$dt['pic_prospek'] = $this->input->post('pic_prospek');
			$dt['nominal_prospek_awal'] = $this->input->post('nominal_prospek_awal');
						
			$q = $this->db->get_where("nama_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("nama_prospek",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("nama_prospek",$dt);
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
			$id['id_prospek']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("nama_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("nama_prospek",$id);
			}
			redirect('nama_prospek','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */