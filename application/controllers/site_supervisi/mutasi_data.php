<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mutasi_data extends CI_Controller {

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
		if(!empty($cek) && $level=='supervisi'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="Mutasi Data";
			$d['class'] = "transaksi";
			
			$d['content']= 'site_supervisi/mutasi_data/view';
			$this->load->view('site_supervisi/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='supervisi'){
			$id['id_prospek']	= $this->input->post('cari');
			
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['kode'] = $dt->id_prospek;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['kode_status'] = $dt->kode_status;
					$d['alamat'] = $dt->alamat_prospek;
					$d['kd_bidang_usaha'] = $dt->kd_bidang_usaha;					
					$d['telp'] = $dt->telp;
					$d['hp'] = $dt->hp;
					$d['email'] = $dt->email;
					$d['nominal'] = number_format($dt->nominal_prospek_awal,0);					
					$d['pic'] = $dt->pic_prospek;
					$d['sumber_referensi'] = $dt->sumber_referensi;
					$d['status_data_sebelumnya'] = $dt->status_data_sebelumnya;
					$d['id_user'] = $dt->keterangan;
					

				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['nama_prospek'] 	= '';
				$d['kode_status'] 		= '';
				$d['alamat'] 	= '';
				$d['kd_bidang_usaha'] 		= '';
				$d['telp'] 	= '';
				$d['hp'] 		= '';
				$d['email'] 		= '';
				$d['nominal'] 		= '';
				$d['pic'] 		= '';
				$d['sumber_referensi'] 		= '';
				$d['status_data_sebelumnya'] 		= '';
				$d['id_user'] 		= '';
				
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}	
	}
	
//	public function simpan()
//	{
//		
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		$kd_cabang = $this->session->userdata('kd_cabang');
//		$username = $this->session->userdata('username');
//		if(!empty($cek) && $level=='supervisi'){
//			$id['id_prospek'] = $this->input->post('kode');
//			
//			$dt['id_prospek'] = $this->input->post('kode');
//			$dt['kd_cab'] = $kd_cabang;
//			$dt['nama_prospek'] = $this->input->post('nama_prospek');
//			$dt['kode_status'] = $this->input->post('kode_status');			
//			$dt['alamat_prospek'] = $this->input->post('alamat');
//			$dt['kd_bidang_usaha'] = $this->input->post('kd_bidang_usaha');
//			$dt['telp'] = $this->input->post('telp');
//			$dt['hp'] = $this->input->post('hp');
//			$dt['email'] = $this->input->post('email');
//			$dt['nominal_prospek_awal'] = $this->input->post('nominal');
//			$dt['pic_prospek'] = $this->input->post('pic');
//			$dt['sumber_referensi'] = $this->input->post('sumber_referensi');
//			$dt['id_user_input'] = $username;
//			$dt['id_user_pic'] = $username;
//			
//			
//						
//			$q = $this->db->get_where("t_prospek",$id);
//			$row = $q->num_rows();
//			if($row>0){
//				$this->db->update("t_prospek",$dt,$id);
//				echo "Data Sukses diUpdate";
//			}else{
//				$this->db->insert("t_prospek",$dt);
//				echo "Data Sukses diSimpan";
//			}
//		}else{
//			redirect('login','refresh');
//		}
//		
//	}
//
//

	
	public function simpan()
	{
		
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='supervisi'){
			$id['id_prospek'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('kode');
//			$dt['lm_usaha'] = $this->input->post('lm_usaha');
//			$dt['bi_checking'] = $this->input->post('bi_checking');
//			$dt['siup'] = $this->input->post('siup');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['no_identitas'] = $this->input->post('no_identitas');
			$dt['id_user_pic'] = $this->input->post('id_user');
			$dtl['id_user_pic'] = $this->input->post('id_user');
			$dtl['id_user_input'] = $this->input->post('id_user');
			$dt['status_data'] =$this->input->post('status_data_sebelumnya');
			$dt['status_data_sebelumnya'] = NULL;
			$dt['keterangan'] = NULL;

			
		
						
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_prospek",$dt,$id);
				$this->db->update("t_target",$dtl,$id);
				$this->db->update("t_data_collect",$dtl,$id);
				$this->db->update("t_analisa",$dtl,$id);
				$this->db->update("t_komite",$dtl,$id);
				$this->db->update("t_sppk",$dtl,$id);
				$this->db->update("t_pk",$dtl,$id);
				$this->db->update("t_on_book",$dtl,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_prospek",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
//
//	
//	public function hapus()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='user'){
//			$id['id_prospek']	= $this->uri->segment(4);
//			$dt['status_data'] = 4;
//			
//			$q = $this->db->get_where("t_prospek",$id);
//			$row = $q->num_rows();
//			if($row>0){
//				$this->db->update("t_prospek",$dt,$id);
//			}
//			redirect('site_supervisi/mutasi_data','refresh');
//		}else{
//			redirect('login','refresh');
//		}
//
//	}


	
	public function reject()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='supervisi'){
			$id['id_prospek'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('kode');
			$dtt['id_prospek'] = $this->input->post('kode');
			//$dt['kd_cab'] = $kd_cabang;
			//$dt['nama_prospek'] = $this->input->post('nama_prospek');
			//$dt['kode_status'] = $this->input->post('kode_status');			
			//$dt['alamat_prospek'] = $this->input->post('alamat');
			//$dt['telp'] = $this->input->post('telp');
			//$dt['hp'] = $this->input->post('hp');
			//$dt['email'] = $this->input->post('email');
			//$dtt['nominal_prospek'] = $this->input->post('nominal');
			//$dt['pic_prospek'] = $this->input->post('pic');
			//$dt['sumber_referensi'] = $this->input->post('sumber_referensi');
//			$dt['id_user_approval'] = $username;
			$dt['status_data'] = $this->input->post('status_data_sebelumnya');
			$dt['status_data_sebelumnya'] = NULL;
			$dt['keterangan'] = NULL;
//			$dtt['status_data'] = 0;
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			
			
						
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_prospek",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_prospek",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}



}


//		
//	public function hapus()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='supervisi'){
//			$id['id_analisa']	= $this->uri->segment(4);
//			
//			$q = $this->db->get_where("t_prospek",$id);
//			$row = $q->num_rows();
//			if($row>0){
//				$this->db->delete("t_prospek",$id);
//			}
//			redirect('site_supervisi/mutasi_data','refresh');
//		}else{
//			redirect('login','refresh');
//		}
//		
//
//		
//	}
//}






/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */