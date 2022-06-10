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
		if(!empty($cek) && $level=='user'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="Prospek";
			$d['class'] = "master";
			$d['vue'] = "prospek";
			
			$d['content']= 'site_user/prospek/view';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari2(){
		echo "Test";
	}
	
	public function dataexsiting(){

		$nikprospek = $this->input->post("nikprospek");

		$q = $this->db->query("SELECT * FROM t_master_debitur where nik_debitur = '$nikprospek'")->row_array();
		if(!empty($q)){

			
			$kd_wilayah = $q['kode_wilayah'];
			$provinsi = KonHelpers::joinGampang('pembagian_wilayah' , 'kode_wilayah' , $kd_wilayah , 'provinsi');
			$provinsi = strtoupper($provinsi);

			$kode_provinsi = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $provinsi , 'kode_wilayah');

			$gabung["kode_provinsi"] = $kode_provinsi;



			$provinsi = strtolower($provinsi);
			$kabupaten  = $this->db->query("SELECT * FROM pembagian_wilayah where provinsi = '$provinsi'")->result();
			$kabshow = array(
				"success" => false,
				"items" => array()
			);
			foreach($kabupaten as $dt){
				$kodewilayah  = $dt->kode_wilayah;
				if(strlen($kodewilayah) == 4){
					$kabshow['items'][] = array(
						'kode_wilayah' => $dt->kode_wilayah,
						'wilayah' => $dt->nama_wilayah,
					);
				}
			}
        	$kabshow['success'] = true; 
	
			$q = array_merge($q , $gabung);

		}

		if(empty($q)){

			$data = [
				"msg" => 'error',
				"results" => [],
			];

		}else{

			$data = [
				"msg" => "success",
				"results" => $q,
				"kabupaten" => $kabshow['items'],
			];

		}

		echo json_encode($data);
		

	}

	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		
		if(!empty($cek) && $level=='user'){
			$id['id_prospek']	= $this->input->post('cari');
			$idprospek = $this->input->post('cari');
			//$q = $this->db->get_where("t_prospek",$id);
			$q = $this->db->query("SELECT * FROM t_prospek left join t_master_debitur on t_prospek.id_masterdebitur = t_master_debitur.id where t_prospek.id_prospek = '$idprospek' ");
			$row = $q->num_rows();
			if($row>0){
					//				$this->load->library('session');
					//				$sess_data['tombol_mati'] = '0';
					//				$this->session->set_userdata($sess_data);
					//				$this->session->set_userdata('tombol_mati', '0');
					//				$this->session->set_userdata(‘some_name’, ‘some_value’);
				foreach($q->result() as $dt){
					
					$kodewilayah = $dt->kode_wilayah;
					$detail_wilayah = $this->db->query("SELECT * FROM pembagian_wilayah where kode_wilayah = '$kodewilayah'")->row();
					$provinsi = strtoupper($detail_wilayah->provinsi);
					$kabupaten = $detail_wilayah->nama_wilayah;
					
					$idprov = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $provinsi , 'kode_wilayah');
					// echo json_encode($kodewilayah);
					// die();
					
					$nama_pic = KonHelpers::joinGampang('t_user' , 'id_user' , $dt->user_petugas , 'nama_user');








					$d['kode'] = $dt->id_prospek;
					$d['nama_prospek'] = $dt->nama_debitur;
					$d['kode_status'] = $dt->jenis_debitur;
					$d['alamat'] = $dt->alamat;
					$d['kd_bidang_usaha'] = $dt->kd_bidang_usaha;					
					$d['telp'] = $dt->no_telepon;
					$d['status_data'] = $dt->status_data;
					$d['snd'] = $dt->snd;
					$d['hp'] = $dt->no_handphone;
					$d['email'] = $dt->email;
					$d['nominal'] = number_format($dt->nominal_prospek_awal,2);					
					$d['pic'] = $nama_pic;
					$d['sumber_referensi'] = $dt->sumber_referensi;
					$d['detail_sumber_referensi'] = $dt->detail_sumber_referensi;
					$d['status_data'] = $dt->status_data;
					$d['nik_debitur'] = $dt->nik_debitur;
					$d['kode_wilayah'] = $kabupaten;
					$d['provinsi'] = $idprov;
					$d['idmasterdebitur'] = $dt->id;
					$d['cif'] = $dt->cif;
					$d['nama_instansi'] = $dt->nama_instansi;
					$d['gaji_bruto'] = $dt->gaji_bruto;
					$d['angsuran_kredit'] = $dt->angsuran_kredit;
//					$d['tombol_mati'] = '1';
					
				//				$this->session->unset_userdata('tombol_mati'); 
				//				$sess_data['tombol_mati'] = '2222';
				//				$this->session->set_userdata($sess_data);		
							
				}
				echo json_encode($d);
			}else{
//				$this->load->library('session');
//				$this->session->set_userdata('tombol_mati', '1');
//				$sess_data['tombol_mati'] = '1111';
//				$this->session->set_userdata($sess_data);				
//				$this->session->set_userdata($sess_data);				

//				$this->session->unset_userdata('tombol_mati'); 
//				$sess_data['tombol_mati'] = '1111';
//				$this->session->set_userdata($sess_data);	
				$d['kode'] 		= '';
				$d['nama_prospek'] 	= '';
				$d['kode_status'] 		= '';
				$d['alamat'] 	= '';
				$d['kd_bidang_usaha'] 		= '';
				$d['telp'] 	= '';
				$d['hp'] 		= '';
				$d['email'] 		= '';
				$d['nominal'] 		= '';
//				$d['pic'] 		= 'ajsdjsadjkas';
				$d['pic'] 		= '';
				$d['sumber_referensi'] 		= '';
				$d['detail_sumber_referensi'] 		= '';
				$d['status_data'] 		= '';
				$d['nik_debitur'] = '';
				$d['kode_wilayah'] = '';
				$d['namakabupaten'] = '';
				$d['namakecamatan'] = '';
				$d['idmasterdebitur'] = '';
//				$d['tombol_mati'] = '0';

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

		if(empty($username)){

			echo "Username petugas tidak terdeteksi oleh sistem. silahkan logout dan  login kembali";
			exit();

		}

		if($this->input->post('snd') == ''){
			echo "SND tidak boleh kosong";
			exit();

		}
		
		if(!empty($cek) && $level=='user'){
			$id['id_prospek'] = $this->input->post('kode');
			$status_data = $this->input->post('status_data');
			//$dt['id_prospek'] = $this->input->post('kode');
			$dt['kd_cab'] = $kd_cabang;
			$dt['nama_prospek'] = $this->input->post('nama_prospek');
			$dt['kode_status'] = $this->input->post('kode_status');	
			$dt['status_data'] = $this->input->post('status_data');			

			$dt['alamat_prospek'] = $this->input->post('alamat');
			$dt['kd_bidang_usaha'] = $this->input->post('kd_bidang_usaha');
			$dt['telp'] = $this->input->post('telp');
			$dt['hp'] = $this->input->post('hp');
			$dt['email'] = $this->input->post('email');
//			$dt['nominal_prospek_awal'] = $this->input->post('nominal');
			$nominal = $this->input->post('nominal');
			$dt['nominal_prospek_awal'] = str_replace(",","",$nominal);			
			$dt['pic_prospek'] = $this->input->post('pic');
			$dt['sumber_referensi'] = $this->input->post('sumber_referensi');
			$dt['detail_sumber_referensi'] = $this->input->post('detail_sumber_referensi');
			if($status_data != '3'){
				$dt['tampil_pd_laporan'] = 1;
			}
			if($status_data == '3'){
				$dt['tampil_pd_laporan'] = 0;
			}
			$dt['status_data'] = 2;


//			if(!empty($dt['detail_sumber_referensi'])){
//				$dt['detail_sumber_referensi']="";
//			}
//			if($dt['detail_sumber_referensi']=="0"){
//				$dt['detail_sumber_referensi']="";
//			}			
			$dt['id_user_input'] = $username;
			$dt['id_user_pic'] = $username;

			// FOR MASTER DEBITUR
			$nikdebitur = $this->input->post('nikprospek');
			$idmasterdebitur = $this->input->post('idmasterdebitur');
			$dtt['jenis_debitur'] = $this->input->post('kode_status');
			$dtt['nama_debitur'] = $this->input->post('nama_prospek');
			$dtt['nik_debitur'] = $this->input->post('nikprospek');
			$dtt['kategori_debitur'] = $this->input->post('kd_bidang_usaha');
			$dtt['alamat'] = $this->input->post('alamat');
			$dtt['no_telepon'] = $this->input->post('telp');
			$dtt['no_handphone'] = $this->input->post('hp');
			$dtt['email'] = $this->input->post('email');
			$dtt['nomor_rekening'] = $this->input->post('nomor_rekening_tabungan');
			$dtt['no_rekening_pinjaman'] = $this->input->post('nomor_rekening_pinjaman');
			$dtt['cif'] = $this->input->post('cif');
			$dtt['nama_instansi'] = $this->input->post('nama_instansi');
			$dtt['gaji_bruto'] = $this->input->post('gaji_bruto');
			$dtt['snd'] = $this->input->post('snd');


			
			// $dtt['angsuran_kredit'] = $this->input->post('angsuran_kredit');
			// GET KODE WILAYAH
			// $provinci =  $this->input->post('kode_wilayah');
			$kabukota =  $this->input->post('kabupaten');
			$idkabupaten = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $kabukota , 'kode_wilayah');

		
			// $kec =  $this->input->post('kecamatan');
			// $kelurahan =  $this->input->post('kelurahan');
			// $provinsi = $this->db->get_where('pembagian_wilayah', array('nama_wilayah' => $provinci))->row();
			// $kab = $this->db->get_where('pembagian_wilayah', array('nama_wilayah' => $kabukota))->row();
			// $kecama = $this->db->get_where('pembagian_wilayah', array('nama_wilayah' => $kec))->row();
			// $kelc = $this->db->get_where('pembagian_wilayah', array('nama_wilayah' => $kelurahan))->row();
			// $kodewilayah = $provinsi->kode_wilayah;
			// $kode_kabupaten = $kab->kode_wilayah;
			// $kode_kecamatan = $kecama->kode_wilayah;

			if(empty($idkabupaten)){
				$dtt['kode_wilayah'] = $kabukota;
			}else{
				$dtt['kode_wilayah'] = $idkabupaten;
			}

			// $dtt['provinsi'] = $kodewilayah;
			// $dtt['kode_kabupaten'] = $kode_kabupaten;
			// $dtt['kode_kecamatan'] = $kode_kecamatan;
			// $dtt['kelurahan'] = $kelc->kode_wilayah;
			$dtt['status_prospek'] = 5;
			$dtt['tanggal_input'] = date('Y-m-d');
			$dtt['user_petugas'] = $username;
			$dtt['kode_cabang'] = $kd_cabang;
			$idmaster['id'] = $idmasterdebitur;
			// var_dump($this->input->post('snd'));
			// die();
			// CHECKING NIK BEFORE SAVE
			$ceknip = $this->db->get_where('t_master_debitur', array('nik_debitur' => $nikdebitur));
			$countrow = $ceknip->num_rows();
			$datamasterdebitur = $ceknip->row();
			
			// ADD TO TARGET
			$dtarget['nominal'] = str_replace(",","",$nominal);
			$dtarget['id_user_pic'] = $username;



			if(str_replace(",","",$nominal) <= 0){
				echo "Maaf, Nominal Pengajuan Plafond Tidak Boleh Kosong";
				exit();
			}
			
	//			echo $dt['detail_sumber_referensi'];
	//			echo "Data Sukses diSimpanJKHHJBHJBHBVHJV";
				$q = $this->db->get_where("t_prospek",$id);
				$row = $q->num_rows();
				if($row>0){
					
					if($status_data == '3'){

						$this->db->update("t_prospek",$dt,$id);
						$idt['id_prospek'] = $this->input->post('kode');
						$dpk['status_data'] = 0;
						$dpk['tampil_pd_laporan'] = 1;

						$drecord['status_perbaikan'] = '1';
						$this->db->update('record_tidak_di_approve' , $drecord , $idt);

						$this->db->update('t_pk' , $dpk , $idt);
						echo "Data Sukses diUpdate";
					}else{
						$this->db->update("t_prospek",$dt,$id);
						$this->db->update("t_master_debitur" , $dtt , $idmaster);
						$dtarget['id_prospek'] = $this->input->post('kode');
						$dtarget['idmasterdebitur'] = $idmasterdebitur;
						$this->db->insert("t_analisa",$dtarget);
						echo "Data Sukses diUpdate";
					}
					// if($status_data != '3'){
					// 	$this->db->update("t_prospek",$dt,$id);
					// 	$this->db->update("t_master_debitur" , $dtt , $idmaster);
					// 	$dtarget['id_prospek'] = $this->input->post('kode');
					// 	$dtarget['idmasterdebitur'] = $idmasterdebitur;
					// 	$this->db->insert("t_target",$dtarget);
					// 	echo "Data Sukses diUpdate";
					// }else{
					// 	echo "Data Gagal diupdate 1";
					// }
					
					// if($status_data == '3'){
					// 	$this->db->update("t_prospek",$dt,$id);
					// 	$idt['id_prospek'] = $this->input->post('kode');
					// 	$dpk['status_data'] = 1;
					// 	$dpk['tampil_pd_laporan'] = 1;
					// 	$this->db->update('t_pk' , $dpk , $idt);
					// 	echo "Data Sukses diUpdate";
					// }else{
					// 	echo "Data Gagal diupdate 2";
					// }
				
				}else{
					// print_r($dt);
					// exit();

					// if($countrow > 0){

					// 	echo "NIK : $nikdebitur telah terdaftar pada sistem";
		
					// }else{
						
					if($countrow > 0){

							$lastIDmaster =  $datamasterdebitur->id;
							$dt['id_masterdebitur'] = $lastIDmaster;
							$this->db->insert("t_prospek",$dt);
							$idprospek = $this->db->insert_id();
							$dtarget['id_prospek'] = $idprospek;
							$dtarget['idmasterdebitur'] = $lastIDmaster;
							$this->db->insert("t_analisa",$dtarget);	
							echo "Data Sukses diSimpan";

					}else{
						$dtt['tanggal_snd_update'] = date("Y-m-d H:i:s");
						$this->db->insert("t_master_debitur" , $dtt);
						$lastIDmaster =  $this->db->insert_id();
						$dt['id_masterdebitur'] = $lastIDmaster;
						$this->db->insert("t_prospek",$dt);
						$idprospek = $this->db->insert_id();
						$dtarget['id_prospek'] = $idprospek;
						$dtarget['idmasterdebitur'] = $lastIDmaster;
						$this->db->insert("t_analisa",$dtarget);	
						echo "Data Sukses diSimpan";
					}

						// if($this->db->insert("t_master_debitur" , $dtt)){
						// 	$lastIDmaster =  $this->db->insert_id();
						// 	$dt['id_masterdebitur'] = $lastIDmaster;
						// 	$this->db->insert("t_prospek",$dt);
						// 	$idprospek = $this->db->insert_id();
						// 	$dtarget['id_prospek'] = $idprospek;
						// 	$dtarget['idmasterdebitur'] = $lastIDmaster;
						// 	$this->db->insert("t_target",$dtarget);	
						// 	echo "Data Sukses diSimpan";
						// }else{
						// 	echo "Gagal save data";
						// }

					//}
					
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
			$id['id_prospek'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('kode');
//			$dt['lm_usaha'] = $this->input->post('lm_usaha');
//			$dt['bi_checking'] = $this->input->post('bi_checking');
//			$dt['siup'] = $this->input->post('siup');
//			$dt['nominal'] = $this->input->post('nominal');
//			$dt['no_identitas'] = $this->input->post('no_identitas');
			$dt['status_data'] = 1;
			$dt['status_data_sebelumnya'] = $this->input->post('status_data');

			
			
						
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
		if(!empty($cek) && $level=='user'){
			$id['id_prospek']	= $this->uri->segment(4);
			$dt['status_data'] = 4;
			
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_prospek",$dt,$id);
			}
			redirect('site_user/prospek','refresh');
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
//		if(!empty($cek) && $level=='user'){
//			$id['id_analisa']	= $this->uri->segment(4);
//			
//			$q = $this->db->get_where("t_prospek",$id);
//			$row = $q->num_rows();
//			if($row>0){
//				$this->db->delete("t_prospek",$id);
//			}
//			redirect('site_user/prospek','refresh');
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