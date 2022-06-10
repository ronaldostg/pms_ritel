<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Target extends CI_Controller {

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
			$d['judul']="Target"; 
			$d['class'] = "master";
			
			$d['content']= 'target/view';
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
			$id['id_target']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_target",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_str($dt->target_tgl_booking);
					
					$d['kode'] = $dt->id_target;
					$d['lm_usaha'] = $dt->lm_usaha;
					$d['bi_checking'] = $dt->bi_checking;
					$d['siup'] = $dt->siup;
					$d['nominal'] = $dt->nominal;
					$d['target_tgl_booking'] = $tgl;
					$d['no_identitas'] = $dt->no_identitas;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['lm_usaha'] 		= '';
				$d['bi_checking'] 		= '';
				$d['siup'] 		= '';
				$d['nominal'] 		= '';
				$d['target_tgl_booking'] 		= '';
				$d['no_identitas'] 		= '';
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
			$id['id_target'] = $this->input->post('kode');
			
			$dt['id_target'] = $this->input->post('kode');
			$tgl = $this->model_global->tgl_sql($this->input->post('target_tgl_booking'));
			
			$dt['lm_usaha'] = $this->input->post('lm_usaha');
			$dt['bi_checking'] = $this->input->post('bi_checking');
			$dt['siup'] = $this->input->post('siup');
			$dt['nominal'] = $this->input->post('nominal');
			$dt['target_tgl_booking'] = $tgl;
			$dt['no_identitas'] = $this->input->post('no_identitas');
			$dt['id_user_pic'] = $username;

			
			
						
			$q = $this->db->get_where("t_target",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_target",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_target",$dt);
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
			$id['id_target'] = $this->input->post('kode');
			
			$dt['id_target'] = $this->input->post('kode');
//			$dt['lm_usaha'] = $this->input->post('lm_usaha');
//			$dt['bi_checking'] = $this->input->post('bi_checking');
//			$dt['siup'] = $this->input->post('siup');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['no_identitas'] = $this->input->post('no_identitas');
			$dt['status_data'] = 1;

			
			
						
			$q = $this->db->get_where("t_target",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_target",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_target",$dt);
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
			$id['id_target']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_target",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_target",$id);
			}
			redirect('target','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */