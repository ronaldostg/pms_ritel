<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pk extends CI_Controller {

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
		$nm_cabang = $this->session->userdata('nm_cabang');
		if(!empty($cek) && $level=='admin'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="PK";
			$d['class'] = "master";
			
			$d['content']= 'pk/view';
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
			$id['id_pk']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					
					$d['kode'] = $dt->id_pk;
					$d['id_prospek'] = $dt->id_prospek;
					$d['nasabah_setuju'] = $dt->nasabah_setuju;
					$d['nominal'] = $dt->nominal;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['id_prospek'] 		= '';
				$d['nasabah_setuju'] 		= '';
				$d['nominal'] 		= '';
				$d['nama_prospek'] 		= '';
				$d['alamat'] 		= '';
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
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){
			$id['id_pk'] = $this->input->post('kode');
			
			$dt['id_pk'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('id_prospek');
			$dt['nasabah_setuju'] = $this->input->post('nasabah_setuju');
			$dt['nominal'] = $this->input->post('nominal');
			$dt['id_user_pic'] = $username;
			
			
						
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_pk",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_pk",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function ajukan()
	{
		
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){
			$id['id_pk'] = $this->input->post('kode');
			
			$dt['id_pk'] = $this->input->post('kode');
//			$dt['id_prospek'] = $this->input->post('id_prospek');
//			$dt['nasabah_setuju'] = $this->input->post('nasabah_setuju');
//			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
			$dt['status_data'] = 1;

			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_pk",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_pk",$dt);
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
			$id['id_pk']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_pk",$id);
			}
			redirect('pk','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */