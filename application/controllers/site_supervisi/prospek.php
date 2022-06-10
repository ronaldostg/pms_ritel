<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prospek extends CI_Controller {

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
		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
			$d['nm_cabang'] =$nm_cabang;	
			$d['judul']="Prospek";
			$d['class'] = "master";
			
			$d['content']= 'site_supervisi/prospek/view';
			$this->load->view('site_supervisi/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
			$id['id_prospek']	= $this->input->post('cari');
			
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['kode'] = $dt->id_prospek;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['kode_status'] = $dt->kode_status;
					$d['alamat'] = $dt->alamat_prospek;
					$d['telp'] = $dt->telp;
					$d['hp'] = $dt->hp;
					$d['email'] = $dt->email;
					$d['nominal'] = number_format($dt->nominal_prospek_awal,2);					
					$d['pic'] = $dt->pic_prospek;
					$d['sumber_referensi'] = $dt->sumber_referensi;
					$d['detail_sumber_referensi'] = $dt->detail_sumber_referensi;
					$d['id_user_pic'] = $dt->id_user_pic;
					$d['status_data'] = $dt->status_data;

				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['nama_prospek'] 	= '';
				$d['kode_status'] 		= '';
				$d['alamat'] 	= '';
				$d['telp'] 	= '';
				$d['hp'] 		= '';
				$d['email'] 		= '';
				$d['nominal'] 		= '';
				$d['pic'] 		= '';
				$d['sumber_referensi'] 		= '';
				$d['detail_sumber_referensi'] 		= '';
				$d['id_user_pic'] 		= '';
				$d['status_data'] 		= '';
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
		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
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
//			$dtt['nominal'] = $this->input->post('nominal');
			$status_data_awal = $this->input->post('status_data');
			
			
			$nominal = $this->input->post('nominal');
			$dtt['nominal'] = str_replace(",","",$nominal);			
			//$dt['pic_prospek'] = $this->input->post('pic');
			//$dt['sumber_referensi'] = $this->input->post('sumber_referensi');
			$dt['id_user_approval'] = $username;
			$dt['status_data'] = 2;
			$dtt['id_user_pic'] = $this->input->post('id_user_pic');
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			$dt['tampil_pd_laporan'] = 1;


						
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			$Detail = $q->row();
			$id_masterdebitur = $Detail->id_masterdebitur;

			$dtt['idmasterdebitur'] = $id_masterdebitur;
			// UPDATE MASTER DEBITUR
			$datamasterdebitur = [
				'status_prospek' => 5,
				'tanggal_update' => date('Y-m-d'),
			];
			$this->db->where('id', $id_masterdebitur );
			$this->db->update('t_master_debitur', $datamasterdebitur);

			if($row>0){
				
				if($status_data_awal==4){
					$dt['status_data'] = 5;
					$dt['tampil_pd_laporan'] = 0;
					$this->db->update("t_prospek",$dt,$id);
					//$this->db->insert("t_target",$dtt);	
					echo "Data Sukses diUpdate";					
				}else{
					$this->db->update("t_prospek",$dt,$id);
					$this->db->insert("t_target",$dtt);	
					echo "Data Sukses diUpdate";				
				}



						

				
			}else{
				$this->db->insert("t_prospek",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	
	public function kembalikan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
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
			$dt['id_user_approval'] = $username;
			$dt['status_data'] = 3;
//			$dtt['status_data'] = 0;
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			$dt['tampil_pd_laporan'] = 0;
			
						
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
	
	

	public function tolak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
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
			$dt['id_user_approval'] = $username;
			$dt['status_data'] = 8;
//			$dtt['status_data'] = 0;
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			$dt['tampil_pd_laporan'] = 0;
			
						
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
		
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
			$id['id_prospek']	= $this->uri->segment(4);
			$dt['status_data'] = 5;
			$dt['tampil_pd_laporan'] = 0;
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_prospek",$dt,$id);
			}
			redirect('site_supervisi/prospek','refresh');
		}else{
			redirect('login','refresh');
		}

	}
}
		
	
//	public function hapus()
//	{
//		$cek = $this->session->userdata('logged_in');
//		$level = $this->session->userdata('level');
//		if(!empty($cek) && $level=='supervisi' || !empty($cek) && $level == 'admin'){
//			$id['id_prospek']	= $this->uri->segment(3);
//			
//			$q = $this->db->get_where("t_prospek",$id);
//			$row = $q->num_rows();
//			if($row>0){
//				$this->db->delete("t_prospek",$id);
//			}
//			redirect('site_supervisi/prospek','refresh');
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