<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_global extends CI_Model {

	/**
	 * @author : Deddy Rusdiansyah
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	function cari_max_mutasi_mhs(){
		$q = $this->db->query("SELECT MAX(id_mutasi) as no FROM mutasi_mhs");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_wisuda_mhs(){
		$q = $this->db->query("SELECT MAX(id_wisuda) as no FROM wisuda");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	public function cari_semester(){
		date_default_timezone_set('Asia/Jakarta');
		$bln = date('m');
		
		switch ($bln){
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
				return "genap";
				break;
			case 8: 
			case 9:
			case 10:
			case 11:
			case 12:
			case 1:
				return "ganjil";
				break;	
		}
		
	}
	
	public function max_sks($ip){
		
		if($ip>=3.00){
			$sks = 24;
		}elseif($ip>=2.50){
			$sks = 22;
		}elseif($ip>=2.00){
			$sks = 20;	
		}elseif($ip>=1.50){
			$sks = 16;
		}elseif($ip>=1.00){
			$sks = 14;
		}else{
			$sks = 12;
		}
		return $sks;
		/*
		switch($ip){
			case 3.00:
				return 24;
				break;
			case 2.50:
				return 22;
				break;
			case 2.00:
				return 20;
				break;	
			case 1.50:
				return 16;
				break;
			case 1.00:
				return 14;
				break;
			case 0.00:
				return 12;
				break;
		}
		*/
				
	}
	
	function cari_th_akademik(){
		date_default_timezone_set('Asia/Jakarta');
		$th = date('Y');
		
		$smt = $this->model_global->cari_semester();
		if($smt=='ganjil'){
			$ket = 1;
		}else{
			$ket = 2;
		}
		$hasil = $th.$ket;
		
		return $hasil;
	}
	
	/*
	function semester($nim){
		$id['nim'] = $nim;
		$q = $this->db->get_where("mahasiswa",$id);
		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				$th = substr($dt->th_akademik,0,4);
				$bln_now = date('m');
				$th_now = date('Y');
				$thn = $th_now-$th;
				if($thn >1 && $bln_now >=2){
					$smt = ($thn*2)+1;
				}elseif($thn >1 && $bln_now >=8){
					$smt = ($thn*2)+2;
				}else{
					$smt = 1;
				}
			}
		}else{
			$smt = 1;
		}
		return $smt;
	}
	*/
	function semester($nim,$thak){
		$id['nim'] = $nim;
		$q = $this->db->get_where("mahasiswa",$id);
		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				date_default_timezone_set('Asia/Jakarta');
				$th_now = substr($thak,0,4);//date('Y');
				$th_masuk = substr($dt->th_akademik,0,4);
				//$smt_masuk = substr($dt->th_akademik,4,1);
				$smt = substr($thak,4,1);
				$th = $th_now-$th_masuk;
				$smt =  ($th*2)+$smt;
			}
		}else{
			$smt = 1;
		}
		return $smt;
	}
	//Konversi tanggal

				
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}

	public function tgl_target_booking_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function tgl_target_booking_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	

	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->model_global->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->model_global->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	


	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = $this->db->escape_str(($usr));
		$p = md5($this->db->escape_str(($psw)));
		$q_cek_login = $this->db->get_where('admins', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						if($qad->kategori_admin == 1){
							$session_admin = 'adminsupervisi';
						}else if($qad->kategori_admin == 2){
							$session_admin = 'adminsupervisi';
						}else if($qad->kategori_admin){
							$session_admin = 'admin';
						}else{
							$session_admin = 'adminkantor';
						}

						$kodeadmin = $qad->kategori_admin;
						
						$sess_data['logged_in'] = 'getLoginPMS_online';
						$sess_data['username'] = $qad->username;
						$sess_data['nama_lengkap'] = $qad->nama_lengkap;
						if($qad->kategori_admin == 1){
							$sess_data['level'] = 'supervisi';
						}else{
							$sess_data['level'] = 'admin';
						}
						$sess_data['akses'] = $session_admin;
						$sess_data['kd_cabang'] = $qad->kd_cab;
						$sess_data['nm_cabang'] = $qad->nm_cabang;
						$sess_data['kode_admin'] = $qad->kategori_admin;
						$this->session->set_userdata($sess_data);
					}

					if($kodeadmin == '1'){
						
						header('location:'.base_url().'index.php/site_supervisi/home');
					}else{
						header('location:'.base_url().'index.php/home');
					}
				
			}
		}else{
			/**login Mahasiswa **/
			$u = $this->db->escape_str(($usr));
			$p = md5($this->db->escape_str(($psw)));
			$s = array('Aktif','Lulus');
			//$l = 'Lulus';
			$this->db->where('nim',$u);
			$this->db->where('password',$p);
			$this->db->where_in('status',$s);
			//$this->db->or_where('status','Lulus');
			$q_mhs = $this->db->get('mahasiswa');
			//$q_mhs = $this->db->get_where('mahasiswa', array('nim' => $u, 'password' => $p,'status'=>$s, 'status'=>'Lulus'));
			if($q_mhs->num_rows()>0){
				foreach($q_mhs->result() as $dt){
					$sess_data['logged_in'] = 'getLoginPMS_online';
					$sess_data['username'] = $dt->nim;
					$sess_data['nama_lengkap'] = $dt->nama_mhs;
					$sess_data['kd_prodi'] = $dt->kd_prodi;
					$sess_data['level'] = 'mahasiswa';
					$sess_data['status'] = $dt->status;
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url().'site_mahasiswa/home');
			}else{


				/*** Login Dosen ***/
				$u = $this->db->escape_str(($usr));
				$p = md5($this->db->escape_str(($psw)));
				$s = 'Aktif';
				//$l = 'Lulus';
				$q_mhs = $this->db->get_where('dosen', array('kd_dosen' => $u, 'password' => $p,'status'=>$s));

				if($q_mhs->num_rows()>0){

					foreach($q_mhs->result() as $dt){
						$sess_data['logged_in'] = 'getLoginPMS_online';
						$sess_data['username'] = $dt->kd_dosen;
						$sess_data['nama_lengkap'] = $dt->nama_dosen;
						$sess_data['kd_prodi'] = $dt->kd_prodi;
						$sess_data['level'] = 'dosen';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'site_dosen/home');
				}else{

					/*** Login User ***/
					$u = $this->db->escape_str(($usr));
					$p = md5($this->db->escape_str(($psw)));
					$s = '1';
					$l = 'user';
					$q_mhs = $this->db->get_where('v_data_user', array('id_user' => $u, 'password' => $p,'status_user'=>$s,'level'=>$l));

					if($q_mhs->num_rows()>0){
						foreach($q_mhs->result() as $dt){
							$sess_data['logged_in'] = 'getLoginPMS_online';
							$sess_data['username'] = $dt->id_user;
							$sess_data['nama_lengkap'] = $dt->nama_user;
							$sess_data['kd_cabang'] = $dt->kd_cab;
							$sess_data['nm_cabang'] = $dt->nm_cabang;
							$sess_data['level'] = 'user';
//							$sess_data['tombol_mati'] = '0';
							$this->session->set_userdata($sess_data);

						}

						header('location:'.base_url().'index.php/site_user/home');

					}else{
						/*** Login Supervisi ***/
						$u = $this->db->escape_str(($usr));
						$p = md5($this->db->escape_str(($psw)));
						$s = '1';
						$l = 'supervisi';

						
//						$q_mhs = $this->db->get_where('t_user', array('id_user' => $u, 'password' => $p,'status_user'=>$s,'level'=>$l));
						$q_mhs = $this->db->get_where('v_data_user', array('id_user' => $u, 'password' => $p,'status_user'=>$s,'level'=>$l));

						if($q_mhs->num_rows()>0){
							foreach($q_mhs->result() as $dt){
								$sess_data['logged_in'] = 'getLoginPMS_online';
								$sess_data['username'] = $dt->id_user;
								$sess_data['nama_lengkap'] = $dt->nama_user;
								$sess_data['kd_cabang'] = $dt->kd_cab;
								$sess_data['nm_cabang'] = $dt->nm_cabang;
								$sess_data['level'] = 'supervisi';
								$this->session->set_userdata($sess_data);
							}
							header('location:'.base_url().'index.php/site_supervisi/home');
							
						}else{
					
						$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah. Atau Akun Anda diblokir. Silahkan Hubungi Administrator.');
						header('location:'.base_url().'index.php/login');
						}
					}
				}
			}
		}
	}
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */