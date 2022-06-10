<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pk extends CI_Controller {

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
			$d['judul']="PK";
			$d['class'] = "master";
			
			$d['content']= 'site_supervisi/pk/view';
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
			$id	= $this->input->post('cari');
			
			// $q = $this->db->get_where("v_pk",$id);
			// $q = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_target on t_target.id_prospek = t_pk.id_prospek left join t_data_collect on t_prospek.id_prospek = t_data_collect.id_prospek left join t_analisa on t_prospek.id_prospek = t_data_collect.id_prospek left join t_daerah on t_daerah.kd_daerah = t_data_collect.kd_daerah left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_kecamatan where t_pk.id_pk  = '$id'");
			$q = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha where t_pk.id_pk  = '$id'");
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					
					$provinsi = strtoupper(KonHelpers::joinGampang('pembagian_wilayah' , 'kode_wilayah' , $dt->kode_wilayah , 'provinsi'));
					$kabkota = strtoupper(KonHelpers::joinGampang('pembagian_wilayah' , 'kode_wilayah' , $dt->kode_wilayah , 'nama_wilayah'));
				
					
					$d['kode'] = $dt->id_pk;
					$d['id_prospek'] = $dt->id_prospek;
					$d['nasabah_setuju'] = $dt->nasabah_setuju;
					$d['nominal'] = number_format($dt->plafond_akhir,2);
					$d['plafont'] = $dt->plafond_akhir;
					$d['nama_prospek'] = $dt->nama_prospek;
					$d['sumber_referensi'] = $dt->sumber_referensi;
					$d['detail_sumber_referensi'] = $dt->detail_sumber_referensi;
					$d['alamat'] = $dt->alamat_prospek;
					$d['id_user_pic'] = $dt->id_user_pic;
					$d['komite_setuju'] = $dt->komite_setuju;
					$d['nik'] = $dt->nik_debitur;
					$d['kode_status'] = $dt->kode_status;
					$d['kd_bidang_usaha'] = $dt->nama_bidang_usaha;
					$d['provinsi'] = $provinsi;
					$d['kab_kota'] = $kabkota;
					$d['telp'] = $dt->telp;
					$d['hp'] = $dt->hp;
					$d['email'] = $dt->email;
					
					// $d['lm_usaha'] = $dt->lm_usaha;

				
					// $d['target_tgl_booking'] = $dt->target_tgl_booking;

					
					// $d['bi_checking'] = $dt->bi_checking;
					// $d['siup'] = $dt->siup;
					// $d['surat_permohonan'] = $dt->surat_permohonan;
					// $d['lap_keuangan_2thn_terakhir'] = $dt->lap_keuangan_2thn_terakhir;
					// $d['agunan'] = $dt->agunan;
					// $d['dokumen_pendukung_lain'] = $dt->dokumen_pendukung_lain;
					// $d['nama_daerah'] = $dt->nama_daerah;
					$d['jenis_kredit'] = $dt->jenis_kredit;
					$d['jenis_guna'] = $dt->jenis_guna;
					$d['permohonbaru_topup'] = $dt->permohonbaru_topup;
					$d['jenis_kredit'] = $dt->jenis_kredit;
					$d['baki_debet_lama'] = number_format($dt->baki_debet_lama , 0 , ',' , ',');
					$d['sisa_baki_debet'] = number_format($dt->sisa_baki_debet , 0 , ',' , ','); 
					$d['tanggal_release'] = $dt->tanggal_release;
					$d['nomor_rekening'] = $dt->no_rekening_pinjaman;
					$d['cukup_agunan'] = $dt->cukup_agunan;
					$d['pembiayaan_wajar'] = $dt->pembiayaan_wajar;
					$d['pic_prospek'] = $dt->pic_prospek;
		
									
				}
				echo json_encode($d);
			}else{
				$d['kode'] 		= '';
				$d['id_prospek'] 		= '';
				$d['nasabah_setuju'] 		= '';
				$d['nominal'] 		= '';
				$d['nama_prospek'] 		= '';
				$d['alamat'] 		= '';
				$d['id_user_pic'] 		= '';
				$d['komite_setuju'] = '';
				$d['nik'] = "";
				$d['kode_status'] = "";
				$d['kd_bidang_usaha'] ="";
				$d['provinsi'] ="";
				$d['kab_kota'] = "";
				$d['kecamatan'] = "";
				$d['telp'] = "";
				$d['hp'] ="";
				$d['email'] = "";
				$d['lm_usaha'] = '';
				$d['target_tgl_booking'] = '';
				$d['bi_checking'] = '';
				$d['siup'] = '';
				$d['surat_permohonan'] = '';
				$d['lap_keuangan_2thn_terakhir'] ='';
				$d['agunan'] = '';
				$d['dokumen_pendukung_lain'] = '';
				$d['nama_daerah'] = '';
				$d['nama_jenis_pembiayaan'] = '';
				$d['cukup_agunan'] = '';
				$d['pembiayaan_wajar'] = '';
				
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


			if(empty($this->input->post('permohonanbaru_topup'))){

				echo "Permohonan top up tidak boleh kosong";
				exit();
			}

			if(empty($this->input->post('nomor_rekening'))){

				echo "Nomor rekening tidak boleh kosong";
				exit();
			}

			$stsapprove =$this->input->post('stsapprove');
			$id['id_pk'] = $this->input->post('kode');

			
			$dt['id_pk'] = $this->input->post('kode');
			$dtt['id_prospek'] = $this->input->post('id_prospek');
			$idp['id_prospek'] = $this->input->post('id_prospek');
			$dtp['tampil_pd_laporan'] = 0;			

			$nominal = $this->input->post('nominal');
			$dtt['nominal'] = str_replace(",","",$nominal);
			$dt['id_user_approval'] = $username;
			$dt['status_data'] = 2;
			$dt['tampil_pd_laporan'] = 1;
			$dtt['id_user_pic'] = $this->input->post('id_user_pic');
			
			$dt['tgl_status_data'] = date('Y-m-d h:i:s');
			

			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			$Detail = $q->row();
			$id_masterdebitur = $Detail->idmasterdebitur;
			
			$dtt['idmasterdebitur'] = $id_masterdebitur;

			$nikval = $this->input->post('nikval');
			$nomor_rekening = $this->input->post('nomor_rekening');
			$permohonanbaru_topup = $this->input->post('permohonanbaru_topup');
			$nominal = $this->input->post('nominal');
			$baki_debet_lama = $this->input->post('baki_debet_lama');
			$baki_debet_lama = str_replace("," , "" , $baki_debet_lama);
			$baki_debet_lama =  intval($baki_debet_lama);

			$sisa_baki_debet = $this->input->post('sisa_baki_debet');
			$sisa_baki_debet = str_replace("," , "" , $sisa_baki_debet );
			$sisa_baki_debet = intval($sisa_baki_debet);

			$tanggal_release = $this->input->post('tanggal_release');

			$dt["nasabah_setuju"] = $this->input->post("nasabah_setuju");
			$dt["komite_setuju"] = $this->input->post("komite_setuju");

			// print_r($dt);
			// exit();
			if($stsapprove == '1'){
			// UPDATE MASTER DEBITUR
				$datamasterdebitur = [
					'nik_debitur' => $nikval,
					'status_prospek' => 7,
					'tanggal_update' => date('Y-m-d'),
					'tanggal_release' => $tanggal_release,
					'no_rekening_pinjaman' => $nomor_rekening,
					'permohonbaru_topup' => $permohonanbaru_topup,
					'baki_debet_lama' => $baki_debet_lama,
					'sisa_baki_debet' => $sisa_baki_debet,
					'plafond_akhir' => str_replace("," , "" , $nominal),
				];


			
				$this->db->where('id', $id_masterdebitur );
				$this->db->update('t_master_debitur', $datamasterdebitur);
			}
			
		

			if($row>0){
				if($stsapprove == '2'){
					$statuspengembalian = $this->input->post('statuspengembalian');
					$alasan_kembali = $this->input->post('alasan_kembali');

					if($statuspengembalian == '1'){
						
						$drc['dikembalikan_ke'] = 'prospek';
						$drc['alasan'] = $alasan_kembali;
						$drc['id_prospek'] = $this->input->post('id_prospek');
						$drc['status'] = '2';
						$drc['datetime'] = date('Y-m-d H:i:s');
						$drc['status_perbaikan'] ='0';

						$this->db->insert('record_tidak_di_approve' , $drc);

						$dtk['status_data'] = '3';
						$dtk['tampil_pd_laporan'] = 1;
						$dt['tampil_pd_laporan'] = 0;
						$dt['status_data'] = '3';
					
						$this->db->update("t_prospek" , $dtk , $idp);
						$this->db->update("t_pk",$dt,$id);
						$this->db->update("t_analisa",$dtp,$idp);
						echo "Data Sukses diUpdate";

					}else if($statuspengembalian == '2'){
						// echo "Back to target";
						$drc['dikembalikan_ke'] = 'target';
						$drc['alasan'] = $alasan_kembali;
						$drc['id_prospek'] = $this->input->post('id_prospek');
						$drc['status'] = '2';
						$drc['datetime'] = date('Y-m-d H:i:s');
						$drc['status_perbaikan'] ='0';


						$this->db->insert('record_tidak_di_approve' , $drc);

						$dtk['status_data'] = '3';
						$dtk['tampil_pd_laporan'] = 1;
						$dt['tampil_pd_laporan'] = 0;
						$dt['status_data'] = '3';
						$this->db->update("t_target" , $dtk , $idp);
						$this->db->update("t_pk",$dt,$id);
						$this->db->update("t_analisa",$dtp,$idp);
						echo "Data Sukses diUpdate";
						
					}else if($statuspengembalian == '3'){
						// echo "Back to data coll";
						$drc['dikembalikan_ke'] = 'data coll';
						$drc['alasan'] = $alasan_kembali;
						$drc['id_prospek'] = $this->input->post('id_prospek');
						$drc['status'] = '2';
						$drc['datetime'] = date('Y-m-d H:i:s');
						$drc['status_perbaikan'] ='0';


						$this->db->insert('record_tidak_di_approve' , $drc);

						$dtk['status_data'] = '3';
						$dtk['tampil_pd_laporan'] = 1;
						$dt['tampil_pd_laporan'] = 0;
						$dt['status_data'] = '3';
						$this->db->update("t_data_collect" , $dtk , $idp);
						$this->db->update("t_pk",$dt,$id);
						$this->db->update("t_analisa",$dtp,$idp);
						echo "Data Sukses diUpdate";
					}else{
						// echo "Back to data coll";
						$drc['dikembalikan_ke'] = 'analisa';
						$drc['alasan'] = $alasan_kembali;
						$drc['id_prospek'] = $this->input->post('id_prospek');
						$drc['status'] = '2';
						$drc['datetime'] = date('Y-m-d H:i:s');
						$drc['status_perbaikan'] ='0';


						$this->db->insert('record_tidak_di_approve' , $drc);

						$dtk['status_data'] = '3';
						$dtk['tampil_pd_laporan'] = 1;
						$dt['tampil_pd_laporan'] = 0;
						$dt['status_data'] = '3';
						$this->db->update("t_analisa" , $dtk , $idp);
						$this->db->update("t_pk",$dt,$id);
						// $this->db->update("t_analisa",$dtp,$idp);
						echo "Data Sukses diUpdate";
					}

				}

				if($stsapprove == '3'){
					$idp['id_prospek'] = $this->input->post('id_prospek');
					$dtp['tampil_pd_laporan'] = 0;
					$dtp['status_data'] = 8;
					$alasan_kembali = $this->input->post('alasan_kembali');
					$drc['alasan'] = $alasan_kembali;
					$drc['status'] = '1';
					$drc['id_prospek'] = $this->input->post('id_prospek');
					$drc['datetime'] = date('Y-m-d H:i:s');
					$this->db->insert('record_tidak_di_approve' , $drc);
					$dt['status_data'] = 8;
					$this->db->update("t_pk",$dt,$id);
					$this->db->update("t_analisa",$dtp,$idp);
					$this->db->update("t_data_collect",$dtp,$idp);
					$this->db->update("t_target",$dtp,$idp);
					$this->db->update("t_prospek",$dtp,$idp);				
					echo "Data Sukses diUpdate";

				}
				
				if($stsapprove == '1'){
					//$this->db->insert("t_on_book",$dtt);
					$this->db->update("t_pk",$dt,$id);
					$this->db->update("t_analisa",$dtp,$idp);			
					echo "Data Sukses diUpdate";
				}
			}else{
				// $this->db->insert("t_pk",$dt);
				// echo "Data Sukses diSimpan";
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
			$id['id_pk'] = $this->input->post('kode');
			
			$dt['id_pk'] = $this->input->post('kode');
			$dtp['id_prospek'] = $this->input->post('kode');
			//$dtt['id_pk'] = $this->input->post('kode');
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
			
			
						
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_pk",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_pk",$dt);
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
			$id['id_pk'] = $this->input->post('kode');
			
			$dt['id_pk'] = $this->input->post('kode');
			$idp['id_prospek'] = $this->input->post('id_prospek');
			//$dtt['id_pk'] = $this->input->post('kode');
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
			
			
						
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->update("t_pk",$dt,$id);
				// $this->db->update("t_sppk",$dtp,$idp);
				// $this->db->update("t_komite",$dtp,$idp);
				$this->db->update("t_analisa",$dtp,$idp);
				$this->db->update("t_data_collect",$dtp,$idp);
				$this->db->update("t_target",$dtp,$idp);
				$this->db->update("t_prospek",$dtp,$idp);				
				echo "Data Sukses diUpdate";
			}else{
				$this->db->insert("t_pk",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}	
			
	
	public function cekrekeningpinjaman(){

		$dh = curl_init();
		$nomor_rekening = $this->input->post("nomor_rekening");
		$nikval = $this->input->post("nikval");

		$baki_debet_lama = $this->input->post("baki_debet_lama");
		

		$cekquery = $this->db->query("select * from t_master_debitur where nik_debitur  = '$nikval'")->row();

		if(empty($cekquery)){

			echo "Mohon maaf nik tidak ditemukan dalam sistem. silahkan input nik dengan benar";
			exit();
		}

		$niksistem = $cekquery->nik_debitur;

		$url = 'http://192.168.3.57/banksumut_interface/index.php/mutasitrx/cek_rekening_kredit';

				$dataJSON = array(
					'norek' => $nomor_rekening
				);

				$data = http_build_query($dataJSON);

				curl_setopt($dh, CURLOPT_URL, $url); //interface 724
				curl_setopt($dh, CURLOPT_POST, 'POST');
				curl_setopt($dh, CURLOPT_POSTFIELDS, $data);
				curl_setopt($dh, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($dh, CURLOPT_FAILONERROR, true); //fungsi nya akan mengembalikan server internal error ketika di set true sehingga message kesalah tidak ditampilkan
				$respon = curl_exec($dh);
				$rest = json_decode($respon);
				$result = $rest->result;
				$nikcore  = $result->IDNBR;
				$plafondakhir = $result->MAXCR;
				$tanggal_realisasi = $result->STRTDT;

				$realisareal = $plafondakhir - $baki_debet_lama;

				if($nikcore == $niksistem){

					echo "Mohon maaf nik sistem ($niksistem) tidak sesuai dengan nik core ($nikcore). silahkan ketik kembali dan klik tombol cari kembali";
					exit();

				}

				echo json_encode([
					"plafond_akhir" => number_format( $plafondakhir , 0 , ',' , ','),
					"baki_debet_lama" => number_format($baki_debet_lama , 0 , ',' , ','),
					"realisareal" => number_format( $realisareal , 0 , ',' , ','),
					"tanggal_realisasi" => $tanggal_realisasi,
				]);
			
				// print_r($realisareal);
				
				
			

	}

	public function permohonantopup(){

		$nominal = str_replace("," , "" , $this->input->post("nominal"));
		$baki_debet_lama = str_replace("," , "" , $this->input->post("baki_debet_lama"));
		$realisareal = intval($nominal) - intval($baki_debet_lama);


		echo json_encode([
			"plafond_akhir" => number_format( $nominal , 0 , ',' , ','),
			"baki_debet_lama" => number_format($baki_debet_lama , 0 , ',' , ','),
			"realisareal" => number_format( $realisareal , 0 , ',' , ','),
		]);

	}
		
		
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='supervisi'){
			$id['id_pk']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_pk",$id);
			}
			redirect('site_supervisi/pk','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */