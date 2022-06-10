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
		if(!empty($cek) && $level=='user'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="Target"; 
			$d['class'] = "master";
			
			$d['content']= 'site_user/target/view';
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
			$id['id_target']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_target",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_str($dt->target_tgl_booking);
//					$tgl = $this->model_global->tgl_indo($dt->target_tgl_booking);
					
					$d['kode'] = $dt->id_target;
					$d['lm_usaha'] = $dt->lm_usaha;
					$d['bi_checking'] = $dt->bi_checking;
					$d['siup'] = $dt->siup;
					$d['status_data'] = $dt->status_data;
					$d['nominal'] = number_format($dt->nominal,2);
					$d['target_tgl_booking'] = $tgl;
					$d['no_identitas'] = $dt->no_identitas;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
					$d['nikdebitur'] = $dt->nikdebitur;
					$d['id_prospek'] = $dt->id_prospek;
									
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
				$d['nik'] = '';
				$d['id_prospek'] = '';
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
			$id['id_target'] = $this->input->post('kode');
			$status_data = $this->input->post('status_data');
			
			$dt['id_target'] = $this->input->post('kode');
			$tgl = $this->model_global->tgl_sql($this->input->post('target_tgl_booking'));
//			$tgl = $this->model_global->tgl_indo($this->input->post('target_tgl_booking'));			
			
			$dt['lm_usaha'] = $this->input->post('lm_usaha');
			$dt['bi_checking'] = $this->input->post('bi_checking');
			$dt['siup'] = $this->input->post('siup');
			$nominal = $this->input->post('nominal');
			$dt['nominal'] = str_replace(",","",$nominal);
//			$dt['nominal'] = $this->input->post('nominal');
			$dt['target_tgl_booking'] = $tgl;
			$dt['no_identitas'] = $this->input->post('no_identitas');
			$dt['id_user_pic'] = $username;
			$dt['status_data'] = 2;
			if($status_data != '3'){
				$dt['tampil_pd_laporan'] = 1;
			}
			if($status_data == '3'){
				$dt['tampil_pd_laporan'] = 0;
			}

			$idp['id_prospek'] = $this->input->post('id_prospek');
			$dtt['id_prospek'] = $this->input->post('id_prospek');
			$dtt['nominal'] = str_replace(",","",$nominal);
			$dtt['id_user_pic'] = $username;
			$dtp['tampil_pd_laporan'] = 0;					
			
						
			$q = $this->db->get_where("t_target",$id);
			$row = $q->num_rows();
			$Detail = $q->row();
			$id_masterdebitur = $Detail->idmasterdebitur;

			$dtt['idmasterdebitur'] = $id_masterdebitur;
			// UPDATE MASTER DEBITUR
			if($status_data != '3'){
				$datamasterdebitur = [
						'status_prospek' => 6,
						'tanggal_update' => date('Y-m-d'),
				];
				$this->db->where('id', $id_masterdebitur );
				$this->db->update('t_master_debitur', $datamasterdebitur);
			}

			if($row>0){
				// $this->db->update("t_target",$dt,$id);
				if($status_data == '3'){

					$this->db->update("t_target",$dt,$id);
					$idt['id_prospek'] = $this->input->post('id_prospek');
					$dpk['status_data'] = 0;
					$dpk['tampil_pd_laporan'] = 1;

					$drecord['status_perbaikan'] = '1';
					$this->db->update('record_tidak_di_approve' , $drecord , $idt);

					$this->db->update('t_pk' , $dpk , $idt);
					echo "Data Sukses diUpdate";

				}else{
					$this->db->insert("t_data_collect",$dtt);
					$this->db->update("t_target",$dt,$id);
					$this->db->update("t_prospek",$dtp,$idp);
					echo "Data Sukses diUpdate";
				}
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
		if(!empty($cek) && $level=='user'){
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
		if(!empty($cek) && $level=='user'){
			$id['id_target']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_target",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_target",$id);
			}
			redirect('site_user/target','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */