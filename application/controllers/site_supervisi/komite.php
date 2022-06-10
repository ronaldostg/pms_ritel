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
		if(!empty($cek) && $level=='supervisi'){
			$d['nm_cabang'] =$nm_cabang;	
			$d['judul']="Komite";
			$d['class'] = "master";
			
			$d['content']= 'site_supervisi/komite/view';
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
					$d['id_user_pic'] = $dt->id_user_pic;
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['id_prospek'] 		= '';
				$d['komite_setuju'] 		= '';
				$d['nominal'] 		= '';
				$d['nama_prospek'] 		= '';
				$d['alamat'] 		= '';
				$d['id_user_pic'] 		= '';
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
		if(!empty($cek) && $level=='supervisi'){
			$id['id_komite'] = $this->input->post('kode');
			
			$dt['id_komite'] = $this->input->post('kode');
			$dtt['id_prospek'] = $this->input->post('id_prospek');
			$idp['id_prospek'] = $this->input->post('id_prospek');
			$dtp['tampil_pd_laporan'] = 0;
//			$dt['id_jenis_pembiayaan'] = $this->input->post('id_jenis_pembiayaan');
//			$dt['komite_setuju'] = $this->input->post('komite_setuju');
//			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
			$nominal = $this->input->post('nominal');
			$dtt['nominal'] = str_replace(",","",$nominal);	
//			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
//			$dt['kd_daerah'] = $this->input->post('kd_daerah');
			$dt['id_user_approval'] = $username;
			$dt['status_data'] = 2;
			$dt['tampil_pd_laporan'] = 1;
			$dtt['id_user_pic'] = $this->input->post('id_user_pic');
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
				

			$q = $this->db->get_where("t_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->insert("t_sppk",$dtt);
				$this->db->update("t_komite",$dt,$id);
				$this->db->update("t_analisa",$dtp,$idp);
//				$this->db->update("t_data_collect",$dtp,$idp);
//				$this->db->update("t_target",$dtp,$idp);
//				$this->db->update("t_prospek",$dtp,$idp);	
								
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_komite",$dt);
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
		if(!empty($cek) && $level=='supervisi'){
			$id['id_komite'] = $this->input->post('kode');
			
			$dt['id_komite'] = $this->input->post('kode');
			//$dtt['id_komite'] = $this->input->post('kode');
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
		

	public function tolak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='supervisi'){
			$id['id_komite'] = $this->input->post('kode');
			
			$dt['id_komite'] = $this->input->post('kode');
			$idp['id_prospek'] = $this->input->post('id_prospek');
			//$dtt['id_komite'] = $this->input->post('kode');
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
			$dtp['tampil_pd_laporan'] = 0;
			$dtp['status_data'] = 8;	
//			$dtt['status_data'] = 0;
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			
			
						
			$q = $this->db->get_where("t_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_komite",$dt,$id);
				$this->db->update("t_analisa",$dtp,$idp);
				$this->db->update("t_data_collect",$dtp,$idp);
				$this->db->update("t_target",$dtp,$idp);
				$this->db->update("t_prospek",$dtp,$idp);							
				
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
		if(!empty($cek) && $level=='supervisi'){
			$id['id_komite']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_komite",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_komite",$id);
			}
			redirect('site_supervisi/komite','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */