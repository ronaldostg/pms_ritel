<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komite extends CI_Controller {

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
		if(!empty($cek) && $level=='user'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="Komite";
			$d['class'] = "master";
			
			$d['content']= 'site_user/komite/view';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			$id['id_komite']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					
					$d['kode'] = $dt->id_komite;
					$d['id_prospek'] = $dt->id_prospek;
					$d['komite_setuju'] = $dt->komite_setuju;
					$d['nominal'] = number_format($dt->nominal,2);
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['id_prospek'] 		= '';
				$d['komite_setuju'] 		= '';
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
		if(!empty($cek) && $level=='user'){
			$id['id_komite'] = $this->input->post('kode');
			
			$dt['id_komite'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('id_prospek');
			$dt['komite_setuju'] = $this->input->post('komite_setuju');
			$nominal = $this->input->post('nominal');
			$dt['nominal'] = str_replace(",","",$nominal);	
			$dt['id_user_pic'] = $username;
			
			
						
			$q = $this->db->get_where("t_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_komite",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_komite",$dt);
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
		if(!empty($cek) && $level=='user'){
			$id['id_komite'] = $this->input->post('kode');
			
			$dt['id_komite'] = $this->input->post('kode');
//			$dt['id_prospek'] = $this->input->post('id_prospek');
//			$dt['komite_setuju'] = $this->input->post('komite_setuju');
//			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
			$dt['status_data'] = 1;

			$q = $this->db->get_where("t_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_komite",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_komite",$dt);
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
		if(!empty($cek) && $level=='user'){
			$id['id_komite']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_komite",$id);
			}
			redirect('site_user/komite','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */