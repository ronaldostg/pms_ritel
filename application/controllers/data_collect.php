<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_Collect extends CI_Controller {

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
			$d['judul']="Data Collect";
			$d['class'] = "master";
			
			$d['content']= 'data_collect/view';
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
			$id['id_data_collect']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_data_collect",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					
					$d['kode'] = $dt->id_data_collect;
					$d['surat_permohonan'] = $dt->surat_permohonan;
					$d['lap_keuangan_2thn_terakhir'] = $dt->lap_keuangan_2thn_terakhir;
					$d['agunan'] = $dt->agunan;
					$d['nominal'] = $dt->nominal;
					$d['dokumen_pendukung_lain'] = $dt->dokumen_pendukung_lain;
					$d['kd_daerah'] = $dt->kd_daerah;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['surat_permohonan'] 		= '';
				$d['lap_keuangan_2thn_terakhir'] 		= '';
				$d['agunan'] 		= '';
				$d['nominal'] 		= '';
				$d['dokumen_pendukung_lain'] 		= '';
				$d['kd_daerah'] 		= '';
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
			$id['id_data_collect'] = $this->input->post('kode');
			
			$dt['id_data_collect'] = $this->input->post('kode');
			
			$dt['surat_permohonan'] = $this->input->post('surat_permohonan');
			$dt['lap_keuangan_2thn_terakhir'] = $this->input->post('lap_keuangan_2thn_terakhir');
			$dt['agunan'] = $this->input->post('agunan');
			$dt['nominal'] = $this->input->post('nominal');
			$dt['dokumen_pendukung_lain'] = $this->input->post('dokumen_pendukung_lain');
			$dt['kd_daerah'] = $this->input->post('kd_daerah');
			$dt['id_user_pic'] = $username;

			
			
						
			$q = $this->db->get_where("t_data_collect",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_data_collect",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_data_collect",$dt);
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
			$id['id_data_collect'] = $this->input->post('kode');
			
			$dt['id_data_collect'] = $this->input->post('kode');
//			$dt['surat_permohonan'] = $this->input->post('surat_permohonan');
//			$dt['lap_keuangan_2thn_terakhir'] = $this->input->post('lap_keuangan_2thn_terakhir');
//			$dt['agunan'] = $this->input->post('agunan');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['dokumen_pendukung_lain'] = $this->input->post('dokumen_pendukung_lain');
			$dt['status_data'] = 1;

			
			
						
			$q = $this->db->get_where("t_data_collect",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_data_collect",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_data_collect",$dt);
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
			$id['id_data_collect']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_data_collect",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_data_collect",$id);
			}
			redirect('data_collect','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */