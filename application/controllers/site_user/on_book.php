<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class On_book extends CI_Controller {

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
			$d['judul']="On Book";
			$d['class'] = "master";
			
			$d['content']= 'site_user/on_book/view';
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
			$id['id_on_book']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_on_book",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					
					$d['kode'] = $dt->id_on_book;
					$d['id_prospek'] = $dt->id_prospek;
					$d['no_booking'] = $dt->no_booking;
					$d['nominal'] = number_format($dt->nominal,2);
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['id_prospek'] 		= '';
				$d['no_booking'] 		= '';
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
			$id['id_on_book'] = $this->input->post('kode');
			
			$dt['id_on_book'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('id_prospek');
			$dt['no_booking'] = $this->input->post('no_booking');
			$nominal = $this->input->post('nominal');
			$dt['nominal'] = str_replace(",","",$nominal);	
			$dt['id_user_pic'] = $username;
			
			$dt['status_data'] = 2;
			$dt['tampil_pd_laporan'] = 1;
			$idp['id_prospek'] = $this->input->post('id_prospek');
			$dtp['tampil_pd_laporan'] = 0;		
						
			$q = $this->db->get_where("t_on_book",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_on_book",$dt,$id);
				$this->db->update("t_pk",$dtp,$idp);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_on_book",$dt);
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
			$id['id_on_book'] = $this->input->post('kode');
			
			$dt['id_on_book'] = $this->input->post('kode');
//			$dt['id_prospek'] = $this->input->post('id_prospek');
//			$dt['no_booking'] = $this->input->post('no_booking');
//			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
			$dt['status_data'] = 1;

			$q = $this->db->get_where("t_on_book",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_on_book",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_on_book",$dt);
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
			$id['id_on_book']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_on_book",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_on_book",$id);
			}
			redirect('site_user/on_book','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */