<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analisa extends CI_Controller {

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
			$d['judul']="Analisa";
			$d['class'] = "master";
			
			$d['content']= 'site_user/analisa/view';
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
			$id['id_analisa']	= $this->input->post('cari');
			
			$q = $this->db->get_where("v_analisa",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					
					$d['kode'] = $dt->id_analisa;
					$d['id_prospek'] = $dt->id_prospek;
					$d['mampu_memenuhi_tagihan'] = $dt->mampu_memenuhi_tagihan;
					$d['cukup_agunan'] = $dt->cukup_agunan;
					$d['nominal'] = number_format($dt->nominal,2);
					$d['pembiayaan_wajar'] = $dt->pembiayaan_wajar;
					$d['jenis_kredit'] = $dt->jenis_kredit;
					$d['jenis_guna'] = $dt->jenis_guna;
					// $d['id_jenis_pembiayaan'] = $dt->id_jenis_pembiayaan;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['alamat'] = $dt->alamat_prospek;
					$d['id_prospek'] = $dt->id_prospek;
					$d['status_data'] = $dt->status_data;

									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['id_prospek'] 		= '';
				$d['mampu_memenuhi_tagihan'] 		= '';
				$d['cukup_agunan'] 		= '';
				$d['nominal'] 		= '';
				$d['pembiayaan_wajar'] 		= '';
				$d['id_jenis_pembiayaan'] 		= '';
				$d['nama_prospek'] 		= '';
				$d['alamat'] 		= '';
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

		$jenis_kredit = $this->input->post('jenis_kredit');
		$jenis_guna = $this->input->post('jenis_guna');
		if(!empty($cek) && $level=='user'){
			$id['id_analisa'] = $this->input->post('kode');
			
			$dt['id_analisa'] = $this->input->post('kode');
			$status_data = $this->input->post('status_data');

			$dtp['tampil_pd_laporan'] = 0;
			$dtt['id_prospek'] = $this->input->post('id_prospek');
			$idp['id_prospek'] = $this->input->post('id_prospek');
			
			$dt['id_prospek'] = $this->input->post('id_prospek');
			$dt['mampu_memenuhi_tagihan'] = $this->input->post('mampu_memenuhi_tagihan');
			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
			$nominal = $this->input->post('nominal');
			$dt['nominal'] = str_replace(",","",$nominal);	
			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
			// $dt['jenis_kredit'] = $this->input->post('jenis_kredit');
			$dt['id_user_pic'] = $username;
			$dt['status_data'] = 2;
			if($status_data != '3'){
				$dt['tampil_pd_laporan'] = 1;
			}
			if($status_data == '3'){
				$dt['tampil_pd_laporan'] = 0;
			}

			$dtt['id_user_pic'] = $username;
			$dtt['nominal'] = str_replace(",","",$nominal);	
			
			
						
			$q = $this->db->get_where("t_analisa",$id);
			$row = $q->num_rows();
			$Detail = $q->row();
			$id_masterdebitur = $Detail->idmasterdebitur;
			
			$dtt['idmasterdebitur'] = $id_masterdebitur;
			// UPDATE MASTER DEBITUR
			if($status_data != '3'){
				$datamasterdebitur = [
					'status_prospek' => 6,
					'tanggal_update' => date('Y-m-d'),
					'jenis_kredit' => $jenis_kredit,
					'jenis_guna' => $jenis_guna,
				];
				$this->db->where('id', $id_masterdebitur );
				$this->db->update('t_master_debitur', $datamasterdebitur);
			}
			if($row>0){
				if($status_data == '3'){

					$this->db->update("t_analisa",$dt,$id);
					$idt['id_prospek'] = $this->input->post('id_prospek');
					$dpk['status_data'] = 0;
					$dpk['tampil_pd_laporan'] = 1;

					$drecord['status_perbaikan'] = '1';
					$this->db->update('record_tidak_di_approve' , $drecord , $idt);

					$this->db->update('t_pk' , $dpk , $idt);
					echo "Data Sukses diUpdate";

				}else{
					$this->db->insert("t_pk",$dtt);
					$this->db->update("t_analisa",$dt,$id);
					$this->db->update("t_prospek",$dtp,$idp);
					// $this->db->update("t_analisa",$dt,$id);
					echo "Data Sukses diUpdate";
				}
			}else{
				$this->db->insert("t_analisa",$dt);
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
			$id['id_analisa'] = $this->input->post('kode');
			
			$dt['id_analisa'] = $this->input->post('kode');
//			$dt['id_prospek'] = $this->input->post('id_prospek');
//			$dt['mampu_memenuhi_tagihan'] = $this->input->post('mampu_memenuhi_tagihan');
//			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
			$dt['status_data'] = 1;

			$q = $this->db->get_where("t_analisa",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_analisa",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_analisa",$dt);
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
			$id['id_analisa']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_analisa",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_analisa",$id);
			}
			redirect('site_user/analisa','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */