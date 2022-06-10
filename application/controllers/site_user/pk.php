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
		if(!empty($cek) && $level=='user'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="PK";
			$d['class'] = "master";
			
			$d['content']= 'site_user/pk/view';
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
			// $id['id_pk']	= $this->input->post('cari');
			$id =  $this->input->post('cari');
			
			// $q = $this->db->get_where("v_pk",$id);
			// $q = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_target on t_target.id_prospek = t_pk.id_prospek left join t_data_collect on t_prospek.id_prospek = t_data_collect.id_prospek left join t_analisa on t_prospek.id_prospek = t_data_collect.id_prospek left join t_daerah on t_daerah.kd_daerah = t_data_collect.kd_daerah left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha where t_pk.id_pk  = '$id'");
			$q = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha where t_pk.id_pk  = '$id'");
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){

					$provinsi = strtoupper(KonHelpers::joinGampang('pembagian_wilayah' , 'kode_wilayah' , $dt->kode_wilayah , 'provinsi'));
					$kabkota = strtoupper(KonHelpers::joinGampang('pembagian_wilayah' , 'kode_wilayah' , $dt->kode_wilayah , 'nama_wilayah'));
				
					
					$d['kode'] = $dt->id_pk;
					$d['kode_master'] = $dt->idmasterdebitur;
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
					$d['idmasterdebitur'] = $dt->idmasterdebitur;

					
					// $d['lm_usaha'] = $dt->lm_usaha;

				
					// $d['target_tgl_booking'] = $dt->target_tgl_booking;

					
					// $d['bi_checking'] = $dt->bi_checking;
					// $d['siup'] = $dt->siup;
					// $d['surat_permohonan'] = $dt->surat_permohonan;
					// $d['lap_keuangan_2thn_terakhir'] = $dt->lap_keuangan_2thn_terakhir;
					// $d['agunan'] = $dt->agunan;
					// $d['dokumen_pendukung_lain'] = $dt->dokumen_pendukung_lain;
					// $d['nama_daerah'] = $dt->nama_daerah;
					$d['jenis_guna'] = $dt->jenis_guna;
					$d['permohonbaru_topup'] = $dt->permohonbaru_topup;
					$d['jenis_kredit'] = $dt->jenis_kredit;
					$d['baki_debet_lama'] = number_format($dt->baki_debet_lama , 0 , ',' , ',');
					$d['tanggal_release'] = $dt->tanggal_release;
					$d['sisa_baki_debet'] = number_format($dt->sisa_baki_debet , 0 , ',' , ','); 
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
		if(!empty($cek) && $level=='user'){


			if(empty($this->input->post('permohonanbaru_topup'))){

				echo "Maaf, Permohonan Top Up/Baru Tidak Boleh Kosong ";
				exit();
			}
			
			if($this->input->post('permohonanbaru_topup') == '1'){
				if(str_replace("," , "" ,  $this->input->post('baki_debet_lama')) == 0){
					echo "Maaf, Baki debet lama tidak boleh 0";
					exit();

				}
			}
			

			// echo "Proses berjalan";
			// die();


			$id['id_pk'] = $this->input->post('kode');
			$idmaster['id'] = $this->input->post('kode_master');
			
			$dt['id_pk'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('id_prospek');
			$dt['nasabah_setuju'] = $this->input->post('nasabah_setuju');
			
			$nominal = $this->input->post('nominal');
			$baki_debet_lama = str_replace("," , "" ,  $this->input->post('baki_debet_lama'));
			$sisa_baki_debet = str_replace("," , "" , $this->input->post('sisa_baki_debet'));
			$validasisisabakidebet = str_replace(",","",$nominal) - $baki_debet_lama;

			$validasisisabakidebet;
			// echo $sisa_baki_debet;
			// exit();
			if($validasisisabakidebet != $sisa_baki_debet){

				echo "Maaf, sisa baki debet tidak sama dengan pengajuan plafond - baki debet lama";
				exit();
			}

			$dt['nominal'] = str_replace(",","",$nominal);		
			$dt['id_user_pic'] = $username;
			$dt['komite_setuju'] = $this->input->post('komite_setuju');


			$no_rek_np = $this->input->post('nomor_rekening');
			$kodecab = substr($no_rek_np , 0 ,3 );

			$dtmaster['kode_cabang'] = $kodecab;
			$dtmaster['no_rekening_pinjaman'] = $this->input->post('nomor_rekening');
			$dtmaster['permohonbaru_topup'] = $this->input->post('permohonanbaru_topup');
			$dtmaster['tanggal_release'] = $this->input->post('tanggal_release');
			$dtmaster['baki_debet_lama'] =str_replace("," , "" ,  $this->input->post('baki_debet_lama'));
			$dtmaster['sisa_baki_debet'] = str_replace("," , "" , $this->input->post('sisa_baki_debet'));
			$dtmaster['plafond_akhir'] = str_replace(",","",$nominal);
			
			
			// if($this->db->update("t_master_debitur" , $dtmaster , $idmaster)){
			// 	echo "sukses";
			// }else{
			// 	echo "GAGAL";
			// }
			// die();	
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){

				$this->db->update("t_master_debitur" , $dtmaster , $idmaster);
				$this->db->update("t_pk",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$this->db->update("t_master_debitur" , $dtmaster , $idmaster);
				$this->db->insert("t_pk",$dt);
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
			$id['id_pk'] = $this->input->post('kode');
			
			$dt['id_pk'] = $this->input->post('kode');
			//			$dt['id_prospek'] = $this->input->post('id_prospek');
			//			$dt['nasabah_setuju'] = $this->input->post('nasabah_setuju');
			//			$dt['cukup_agunan'] = $this->input->post('cukup_agunan');
			//			$dt['nominal'] = $this->input->post('nominal');
			//			$dt['pembiayaan_wajar'] = $this->input->post('pembiayaan_wajar');
			$dt['status_data'] = 1;

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
	
		
		
		
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			$id['id_pk']	= $this->uri->segment(4);
			
			$q = $this->db->get_where("t_pk",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_pk",$id);
			}
			redirect('site_user/pk','refresh');
		}else{
			redirect('login','refresh');
		}
		

		
	}
	public function hitungsisabakidebet(){

		$plafond = str_replace(',' , '' , $this->input->post("plafond"));
		$baki_debet_lama = str_replace(',' , '' , $this->input->post('baki_debet_lama'));
		if($baki_debet_lama > $plafond){
			echo json_encode("gagal");
			exit();
		}
		$sisa_baki_debet  =  $plafond - $baki_debet_lama;
		echo json_encode(number_format($sisa_baki_debet , 0 , ',' , ','));

	}

	public function updatenikdebitur(){

		$nik_dbtr = $this->input->post('nik_dbtr');
		$idmasterdebitur = $this->input->post('idmasterdebitur');
		$id['id'] = $idmasterdebitur;
		$data['nik_debitur']  = $nik_dbtr;
		
		// echo json_encode("HELLO");
		// die();
		if($this->db->update("t_master_debitur" , $data , $id)){

			echo json_encode("Nik Berhasil diupdate");

		}else{

			echo json_encode("Data gagal diupdate");
		}


	}

	public function ceknomorrekening(){

		$dh = curl_init();
		$nomor_rek = $this->input->post('nomor_rek');
		$niktext = $this->input->post('niktext');
		// echo $niktext;
		// die();
		$url = 'http://192.168.3.57/banksumut_interface/index.php/mutasitrx/cek_rekening_kredit';
		$dataJSON = array(
            'norek' => $nomor_rek
        );

		$data = http_build_query($dataJSON);

  		curl_setopt($dh, CURLOPT_URL, $url); //interface 724
        curl_setopt($dh, CURLOPT_POST, 'POST');
        curl_setopt($dh, CURLOPT_POSTFIELDS, $data);
        curl_setopt($dh, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($dh, CURLOPT_FAILONERROR, true); //fungsi nya akan mengembalikan server internal error ketika di set true sehingga message kesalah tidak ditampilkan
        $respon = curl_exec($dh);

		$datas = json_decode($respon);

		// print_r($respon);

		// die();

		if(empty($niktext)){
			$data_respon = [
				"msg" => "error",
				"msgtext" => "Nik debitur tidak boleh kosong",
			];

			echo json_encode($data_respon);
			exit();
		}

		if(empty($nomor_rek)){
			$data_respon = [
				"msg" => "error",
				"msgtext" => "Nomor rekening tidak boleh kosong",
			];

			echo json_encode($data_respon);
			exit();
		}

		if($datas->message == "REKENING TIDAK DITEMUKAN"){
			$data_respon = [
				"msg" => "error",
				"msgtext" => $datas->message,
			];

			echo json_encode($data_respon);
			exit();
		}

		$res = $datas->result;
		
		
		$IDNBR = $res->IDNBR;

		// echo $IDNBR ."-". $niktext;
		// die();

		if($IDNBR == ""){

			$data_respon = [
				"msg" => 'success',
				"tanggal_realisasi" => $res->STRTDT,
				"plafond" => number_format($res->MAXCR , 0 , ',' , ','),
				"sisa_baki_debet" => number_format($res->MAXCR , 0 , ',' , ','),
				"baki_debet_lama" => 0,
			];

			echo json_encode($data_respon);

			exit();

		}

		if($IDNBR == $niktext){
		
			$data_respon = [
				"msg" => 'success',
				"tanggal_realisasi" => $res->STRTDT,
				"plafond" => number_format($res->MAXCR , 0 , ',' , ','),
				"sisa_baki_debet" => number_format($res->MAXCR , 0 , ',' , ','),
				"baki_debet_lama" => 0,
			];

		}else{

			$data_respon = [
				"msg" => "error",
				"msgtext" => "Data NIK/Nomor rekening tidak sesuai dengan yang ada dicore banking",
			];


		}


		echo json_encode($data_respon);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */