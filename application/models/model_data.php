<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_data extends CI_Model {

//	*
//	 * @author : Deddy Rusdiansyah
//	 * @web : http://deddyrusdiansyah.blogspot.com
//	 * @keterangan : Model untuk menangani semua query database aplikasi
//	 *

//	public function data_prospek(){
//		$q = $this->db->order_by('id_prospek');
//		$q = $this->db->get('t_prospek');
//		return $q;
//	}
//	

	//
//	public function data_mk($jur){
//		$id['kd_prodi'] = $jur;
//		$q = $this->db->order_by('kd_mk');
//		$q = $this->db->get_where('mata_kuliah',$id);
//		return $q;
//	}
		
	
	

		
	


//	public function data_prospek($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_prospek',$id);
//		return $q;
//	}
	
//	public function data_prospek_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_prospek_supervisi',$id);
//		return $q;
//	}	


	public function data_prospek($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_prospek',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_prospek_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_prospek');
		}		

//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
		return $q;
		
	}




//	public function data_prospek_mutasi($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_prospek_mutasi',$id);
//		return $q;
//	}
//	
//	public function data_prospek_supervisi_mutasi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_prospek_supervisi_mutasi',$id);
//		return $q;
//	}	
	
//	public function data_prospek_supervisi2($id_user){
//		$id['id_user_supervisi2'] = $id_user;
//		$q = $this->db->get_where('v_prospek_supervisi',$id);
//		return $q;
//	}	
	

	public function data_prospek_mutasi($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_prospek_mutasi',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_prospek_supervisi_mutasi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_prospek_mutasi');
		}	
		return $q;	
	}
		
	
//	public function data_target($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_target',$id);
//		return $q;
//	}
//
//
//	public function data_target_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_target_supervisi',$id);
//		return $q;
//	}	
	
	public function data_target($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_target',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_target_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_target');
		}	
		return $q;	
	}
	
//	public function data_data_collect($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_data_collect',$id);
//		return $q;
//	}
//
//	public function data_data_collect_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_data_collect_supervisi',$id);
//		return $q;
//	}	
	

	public function data_data_collect($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_data_collect',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_data_collect_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_data_collect');
		}	
		return $q;	
	}
	
	//public function data_analisa($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_analisa',$id);
//		return $q;
//	}
//
//	public function data_analisa_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_analisa_supervisi',$id);
//		return $q;
//	}	
//	
	public function data_analisa($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_analisa',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_analisa_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_analisa');
		}	
		return $q;	
	}	


//	public function data_komite($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_komite',$id);
//		return $q;
//	}
//
//	public function data_komite_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_komite_supervisi',$id);
//		return $q;
//	}	
	
	public function data_komite($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_komite',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_komite_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_komite');
		}	
		return $q;	
	}
			
//	public function data_sppk($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_sppk',$id);
//		return $q;
//	}
//		
//	public function data_sppk_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_sppk_supervisi',$id);
//		return $q;
//	}	

	public function data_sppk($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_sppk',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_sppk_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_sppk');
		}	
		return $q;	
	}
			
		
//	public function data_pk($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_pk',$id);
//		return $q;
//	}
//	
//	public function data_pk_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_pk_supervisi',$id);
//		return $q;
//	}	
//	
	public function data_pk($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_pk',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_pk_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_pk');
		}	
		return $q;	
	}
	
		
			
//	public function data_on_book($id_user){
//		$id['id_user_pic'] = $id_user;
//		$q = $this->db->get_where('v_on_book',$id);
//		return $q;
//	}
//
//
//	public function data_on_book_supervisi($id_user){
//		$id['id_user_supervisi1'] = $id_user;
//		$q = $this->db->get_where('v_on_book_supervisi',$id);
//		return $q;
//	}	
		
	public function data_on_book($level,$username){
		if($level=='user'){
			$id['id_user_pic'] = $username;
			$q = $this->db->get_where('v_on_book',$id);
		}elseif($level=='supervisi'){
			$id['id_user_supervisi1'] = $username;
			$q = $this->db->get_where('v_on_book_supervisi',$id);
		}elseif($level=='admin'){
			$q = $this->db->get_where('v_on_book');
		}	
		return $q;	
	}
	

		

		
		


		

	

		


		

			



							
	public function nama_prospek($id){
		$q = $this->db->query("SELECT * FROM t_prospek WHERE id_prospek='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->nama_prospek;
            }
        }else{
            $hasil = '';
        }
		return $hasil;
	}

	public function singkat_prospek1($id){
		$q = $this->db->query("SELECT * FROM t_prospek WHERE id_prospek='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->singkat_prospek1;
            }
        }else{
            $hasil ='';
        }
		return $hasil;
	}
	

	public function kd_bidang_usaha(){
		$q = $this->db->query("SELECT * FROM t_bidang_usaha");
		return $q;
	}

	public function kd_daerah(){
		$q = $this->db->query("SELECT * FROM t_daerah");
		return $q;
	}
	
	public function kd_pembiayaan(){
		$q = $this->db->query("SELECT * FROM t_jenis_pembiayaan");
		return $q;
	}	
	
	public function id_user(){
		$q = $this->db->query("SELECT * FROM t_user order by nama_user");
		return $q;
	}
	

	
	
	



	
	public function nama_target($id){
		$q = $this->db->query("SELECT * FROM t_target WHERE id_target='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->nama_target;
            }
        }else{
            $hasil = '';
        }
		return $hasil;
	}	
	

//============================================================================================
//UNTUK USER
//============================================================================================

//	public function sum_data_prospek($username){
//		$q = $this->db->query("SELECT SUM(nominal_prospek_awal) AS nominal_prospek FROM t_prospek WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_prospek;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//
//	public function sum_data_target($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_target FROM t_target WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_target;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//
//	public function sum_data_data_coll($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_data_coll FROM t_data_collect WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_data_coll;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//
//	public function sum_data_analisa($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_analisa FROM t_analisa WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_analisa;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//	
//	public function sum_data_komite($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_komite FROM t_komite WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_komite;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//
//
//	public function sum_data_sppk($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_sppk FROM t_sppk WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_sppk;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//	
//	public function sum_data_pk($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_pk FROM t_pk WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_pk;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//	
//	public function sum_data_on_book($username){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_on_book FROM t_on_book WHERE id_user_pic='$username' 
//		AND status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_on_book;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//			


//
//	public function ambil_data_rp_target_tumbuh($username,$thn){
//		$q = $this->db->query("SELECT rp_target_tumbuh FROM t_rencana_kerja WHERE id_user='$username' 
//		AND tahun=$thn");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->rp_target_tumbuh;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//		
//	public function ambil_data_rencana_kerja($field,$username,$thn){
//		$q = $this->db->query("SELECT $field FROM t_rencana_kerja WHERE id_user='$username' 
//		AND tahun=$thn");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}					
//		
//	public function ambil_data_user($field,$username){
//		$q = $this->db->query("SELECT $field FROM t_user WHERE id_user='$username'");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//---------------------------------------
	public function sum_data_nominal_tabel($nama_tabel,$field,$level,$username){
		if($level=='user'){
			$q = $this->db->query("SELECT SUM(".$field.") AS ".$field." FROM ".$nama_tabel." WHERE
			id_user_pic='$username' AND status_data=2 AND tampil_pd_laporan=1");		
		}elseif($level=='supervisi'){
			$q = $this->db->query("SELECT SUM(".$field.") AS ".$field." FROM ".$nama_tabel." 
			LEFT JOIN t_user
			ON ".$nama_tabel.".id_user_pic=t_user.id_user
			WHERE
			t_user.id_user_supervisi1='".$username."' AND ".$nama_tabel.".status_data=2 AND ".$nama_tabel.".tampil_pd_laporan=1  || t_user.id_user_supervisi2='".$username."' AND ".$nama_tabel.".status_data=2 AND ".$nama_tabel.".tampil_pd_laporan=1");		
		}elseif($level=='admin'){
			$q = $this->db->query("SELECT SUM(".$field.") AS ".$field." FROM ".$nama_tabel." WHERE
			status_data=2 AND tampil_pd_laporan=1");		
		}		

		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				$h = $dt->$field;
			}
		}else{
			$h = 0;
		}
		return $h;
		
	}
	
	public function ambil_data_nominal_tabel_per_thn($nama_tabel,$field,$level,$username,$thn){
		if($level=='user'){
			$q = $this->db->query("SELECT ".$field." FROM ".$nama_tabel." WHERE
			id_user='".$username."' AND tahun=".$thn);		
		}elseif($level=='supervisi'){
			$q = $this->db->query("SELECT ".$field." FROM ".$nama_tabel."
			LEFT JOIN t_user
			ON ".$nama_tabel.".id_user=t_user.id_user
			WHERE
			t_user.id_user_supervisi1='".$username."' AND ".$nama_tabel.".tahun=".$thn."||"."t_user.id_user_supervisi2='".$username."' AND ".$nama_tabel.".tahun=".$thn);		
		}elseif($level=='admin'){
			$q = $this->db->query("SELECT ".$field." FROM ".$nama_tabel." WHERE
			tahun=".$thn);


		}		

		$r = $q->num_rows();
		$h = 0;
		if($r>0){
			
			if($level == 'admin'){

			   foreach($q->result() as $dt){
				$hasil = $dt->$field;
				$h += $hasil;				
			  }	
			}else if($level == 'supervisi'){

			   foreach($q->result() as $dt){
				$hasil = $dt->$field;
				$h += $hasil;				
			  }	
			}
			else{
				foreach($q->result() as $dt){
				$h = $dt->$field;				
			}
			}
			
		
		}else{
			$h = 0;
		}
		return $h;
		
	}


	public function ambil_data_user($field,$level,$username){
		if($level=='user'){
			$q = $this->db->query("SELECT $field FROM t_user WHERE id_user='$username'");	
		}elseif($level=='supervisi'){
			$q = $this->db->query("SELECT $field FROM t_user WHERE id_user='$username'");	
		}elseif($level=='admin'){
			$q = $this->db->query("SELECT $field FROM admins WHERE username='$username'");
		}		

		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				$h = $dt->$field;
			}
		}else{
			$h = 0;
		}
		return $h;
	}

	public function ambil_user_ao($kodecabang){
		return $this->db->query("SELECT * FROM t_user where level = 'user' and kd_cab = '$kodecabang'")->result();
	}
	
	public function detail_master_debitur($iddata){

		// return $iddata;
		// exit();
		return $this->db->query("SELECT * FROM t_master_debitur left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang where t_master_debitur.id = '$iddata' order by t_master_debitur.id desc")->row();
	}


//	public function ambil_data_user($field,$username){
//		$q = $this->db->query("SELECT $field FROM t_user WHERE id_user='$username'");	
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}			
	

//	public function ambil_data_user($field,$username){
//		$q = $this->db->query("SELECT $field FROM admins WHERE username='$username'");	
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}					
//============================================================================================
//============================================================================================
//UNTUK ADMIN
//============================================================================================
//
//	public function sum_data_prospek_admin(){
//		$q = $this->db->query("SELECT SUM(nominal_prospek_awal) AS nominal_prospek FROM t_prospek WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_prospek;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//
//	public function sum_data_target_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_target FROM t_target WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_target;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//
//	public function sum_data_data_coll_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_data_coll FROM t_data_collect WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_data_coll;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//
//	public function sum_data_analisa_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_analisa FROM t_analisa WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_analisa;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}
//	
//	public function sum_data_komite_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_komite FROM t_komite WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_komite;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//
//
//	public function sum_data_sppk_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_sppk FROM t_sppk WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_sppk;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//	
//	public function sum_data_pk_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_pk FROM t_pk WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_pk;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//	
//	public function sum_data_on_book_admin(){
//		$q = $this->db->query("SELECT SUM(nominal) AS nominal_on_book FROM t_on_book WHERE 
//		status_data=2 AND tampil_pd_laporan=1");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->nominal_on_book;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//			
//
//
//
//	public function ambil_data_rp_target_tumbuh_admin($thn){
//		$q = $this->db->query("SELECT rp_target_tumbuh FROM t_rencana_kerja WHERE tahun=$thn");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->rp_target_tumbuh;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}	
//		
//	public function ambil_data_rencana_kerja_admin($field,$thn){
//		$q = $this->db->query("SELECT $field FROM t_rencana_kerja WHERE tahun=$thn");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}					
		
//	public function ambil_data_user_admin($field,$username){
//		$q = $this->db->query("SELECT $field FROM t_user WHERE id_user='$username'");		
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->$field;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}					
//============================================================================================		
//public function jml_sks_mhs($th_ak,$smt,$nim){
//		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim'");
//		$r = $q->num_rows();
//		if($r>0){
//			foreach($q->result() as $dt){
//				$h = $dt->t_sks;
//			}
//		}else{
//			$h = 0;
//		}
//		return $h;
//	}





	
//	public function data_target(){
////		$q = $this->db->query("SELECT tt.id_target,tt.id_prospek,tt.nominal_prospek,tp.kd_cab,tp.nama_prospek,
////							tp.kode_status,tp.alamat_prospek,tp.telp,tp.hp,tp.email,tp.pic_prospek 
////							FROM t_target tt LEFT JOIN t_prospek tp 
////							ON tt.id_prospek=tp.id_prospek ORDER BY tt.id_target");
//		$q = $this->db->query("SELECT *
//							FROM t_target ORDER BY id_target");							
//		foreach($q->result() as $dt){
////			$hasil = array('id_target'=>$dt->id_target,'id_prospek'=>$dt->id_prospek,'nominal_prospek'=>$dt->nominal_prospek,'kd_cab'=>$dt->kd_cab,'nama_prospek'=>$dt->nama_prospek,'kode_status'=>$dt->kode_status,'alamat_prospek'=>$dt->alamat_prospek,'telp'=>$dt->telp,'email'=>$dt->email,'pic_prospek'=>$dt->pic_prospek);
//			$hasil = array('id_target'=>$dt->id_target,'nominal_prospek'=>$dt->nominal_prospek);			
//		}
//		return $hasil;
//	}	
	
	//	
//	
//	public function nama_target($id){
//		$q = $this->db->query("SELECT * FROM t_target WHERE id_target='$id'");
//        if($q->num_rows()>0){
//            foreach($q->result() as $dt){
//                $hasil = $dt->nama_target;
//            }
//        }else{
//            $hasil = '';
//        }
//		return $hasil;
//	}
//
//	public function singkat_target($id){
//		$q = $this->db->query("SELECT * FROM t_target WHERE id_target='$id'");
//        if($q->num_rows()>0){
//            foreach($q->result() as $dt){
//                $hasil = $dt->singkat_target;
//            }
//        }else{
//            $hasil ='';
//        }
//		return $hasil;
//	}
	
	public function data_jurusan(){
		$q = $this->db->order_by('kd_prodi');
		$q = $this->db->get('prodi');
		return $q;
	}
	
	public function nama_jurusan($id){
		$q = $this->db->query("SELECT * FROM prodi WHERE kd_prodi='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->prodi;
            }
        }else{
            $hasil = '';
        }
		return $hasil;
	}
	
	public function nama_cabang($id){
		$q = $this->db->query("SELECT * FROM t_cabang WHERE kd_cabang='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->t_cabang;
            }
        }else{
            $hasil = '';
        }
		return $hasil;
	}

	public function singkat_jurusan($id){
		$q = $this->db->query("SELECT * FROM prodi WHERE kd_prodi='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->singkat;
            }
        }else{
            $hasil ='';
        }
		return $hasil;
	}
	
	
	public function singkat_prospek($id){
		$q = $this->db->query("SELECT * FROM v_prospek WHERE id_user_pic='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->nama_prospek;
            }
        }else{
            $hasil ='';
        }
		return $hasil;
	}
	
		
	public function data_mk($jur){
		$id['kd_prodi'] = $jur;
		$q = $this->db->order_by('kd_mk');
		$q = $this->db->get_where('mata_kuliah',$id);
		return $q;
	}
	
	public function data_dosen($jur){
		$id['kd_prodi'] = $jur;
		$q = $this->db->order_by('kd_dosen');
		$q = $this->db->get_where('dosen',$id);
		return $q;
	}
	
	public function data_user($jur){
		$id['kd_cab'] = $jur;
		$q = $this->db->order_by('id_user');
		$q = $this->db->get_where('t_user',$id);
		return $q;
	}	
	
	public function th_akademik_jadwal(){
		$q = $this->db->query("SELECT th_akademik FROM jadwal GROUP BY th_akademik ORDER BY th_akademik");
		return $q;
	}


	public function isi_sumber_referensi(){
		$q = array('Teman','Internet','Lainnya');
		return $q;
	}
	
	public function th_akademik_krs_mhs($nim){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE nim='$nim' GROUP BY th_akademik ORDER BY th_akademik");
		return $q;
	}
	
	public function th_akademik_krs_dosen($key){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE kd_dosen='$key' GROUP BY th_akademik ORDER BY th_akademik");
		return $q;
	}
	
	public function data_mhs($jur){
		$id['kd_prodi'] = $jur;
		$q = $this->db->order_by('nim');
		$q = $this->db->get_where('mahasiswa',$id);
		return $q;
	}
	
	public function data_all_mhs(){
		$this->db->where('status','Aktif');
		$this->db->order_by('nim');
		$q = $this->db->get('mahasiswa');
		return $q;
	}
	
	/*** jumlah data ***/
	
	
	public function jml_data_t_prospek($user){

		$q = $this->db->get_where("t_prospek");
		$row = $q->num_rows();
		return $row;
	}
		
	public function jml_data_t_target($user){

		$q = $this->db->get_where("t_target");
		$row = $q->num_rows();
		return $row;
	}		


	public function jml_data_t_data_collect($user){

		$q = $this->db->get_where("t_data_collect");
		$row = $q->num_rows();
		return $row;
	}
		
		
	public function jml_data_t_analisa($user){

		$q = $this->db->get_where("t_analisa");
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_t_komite($user){

		$q = $this->db->get_where("t_komite");
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_t_sppk($user){

		$q = $this->db->get_where("t_sppk");
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_t_pk($user){

		$q = $this->db->get_where("t_pk");
		$row = $q->num_rows();
		return $row;
	}					
		
		
	public function jml_data_t_on_book($user){

		$q = $this->db->get_where("t_on_book");
		$row = $q->num_rows();
		return $row;
	}			
		
			
	
	public function jml_data_user_t_prospek($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_prospek",$key);
		$row = $q->num_rows();
		return $row;
	}
		
	public function jml_data_user_t_target($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_target",$key);
		$row = $q->num_rows();
		return $row;
	}		


	public function jml_data_user_t_data_collect($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_data_collect",$key);
		$row = $q->num_rows();
		return $row;
	}
		
		
	public function jml_data_user_t_analisa($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_analisa",$key);
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_user_t_komite($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_komite",$key);
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_user_t_sppk($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_sppk",$key);
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_user_t_pk($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_pk",$key);
		$row = $q->num_rows();
		return $row;
	}					
		
		
	public function jml_data_user_t_on_book($user){
		$key['id_user_pic']= $user;
		$q = $this->db->get_where("t_on_book",$key);
		$row = $q->num_rows();
		return $row;
	}			
		
		




	


	
	public function data_prospek_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_prospek_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	


	public function data_target_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_target_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	
	
	

	public function data_data_collect_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_data_collect_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	
	


	public function data_analisa_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_analisa_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	
	
	public function data_komite_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_komite_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	
		
		
	public function data_sppk_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_sppk_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	


	
	public function data_pk_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_pk_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	
	

	
	public function data_on_book_supervisi_jml_data($id_user){
		$id['id_user_supervisi1'] = $id_user;
		$q = $this->db->get_where('v_on_book_supervisi',$id);
		$row = $q->num_rows();
		return $row;
	}	
		




		

		
		

















		
		
		
		
	public function jml_data($table){
		$month =date('y');
		$q = $this->db->query("SELECT * FROM $table");
		return $q->num_rows();
	}
	
	public function jml_data_jadwal($th,$smt,$prodi){
		$key['th_akademik']= $th;
		$key['semester'] = $smt;
		$key['kd_prodi'] = $prodi;
		$q = $this->db->get_where("jadwal",$key);
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_krs($th,$smt,$prodi){
		
		$q = $this->db->query("SELECT a.th_akademik,a.semester,b.kd_prodi 
								FROM krs as a
								JOIN jadwal as b
								ON a.id_jadwal = b.id_jadwal
								WHERE a.th_akademik='$th' AND a.semester='$smt' AND b.kd_prodi='$prodi'
								GROUP BY a.th_akademik,a.nim");
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_nilai($th,$smt,$mk){
		
		$q = $this->db->query("SELECT *
								FROM krs 
								WHERE th_akademik='$th' AND semester='$smt' AND kd_mk='$mk' AND NOT ISNULL(nilai_akhir)");
		$row = $q->num_rows();
		return $row;
	}
	
	
	/*** data table ***/
	public function data($table){
		$q = $this->db->get($table);
		return $q->result();
	}
	
	
	/**** REFERENSI ***/
	public function semester(){
		$q = array('ganjil','genap');
		return $q;
	}
	
	public function smt(){
		$q = array('1','2','3','4','5','6','7','8');
		return $q;
	}
	
	public function hari_kuliah(){
		$q = array('Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu');
		return $q;
	}
	
	public function jam_kuliah(){
		$q = array('08.00 - 10.00','10.00 - 12.00','13.00 - 15.00','15.00 - 17.00','19.00 - 20.00','20.00 - 22.00');
		return $q;
	}
	
	public function ruang_kuliah(){
		$q = array('R01','R02','R03','R04');
		return $q;
	}
	
	public function status_mhs(){
		$q = array('Aktif','Cuti','DO','Meninggal','Lulus');
		return $q;
	}
	
	public function status_data_prospek(){
		$q = array('Semua','Blm Diajukan','Sudah Diapprove','Blm Diapprove',
		'Dikembalikan','Mohon Dihapus','Dihapus','Mohon Mutasi','Ditolak','Laporan Pipeline');
		return $q;
	}	
	
	public function status_prospek(){
		$q = array('Semua','Perorangan','Perusahaan');
		return $q;
	}
	
	
	public function posisi_data_prospek(){
		$q = array('Prospek','Target','Data Coll','Analisa','Komite','SPPK','PK','On Book');
		return $q;
	}
	
			
	public function status_dosen(){
		$q = array('Aktif','Keluar');
		return $q;
	}
	
	public function nilai(){
		$q = array('A','B+','B','C+','C','D','E');
		return $q;
	}
	
	public function jenjang_pendidikan(){
		$q = array('SMA / Sederajat','D3','S1','S2','S3');
		return $q;
	}
	
	
	/*** cari_data **/
	public function cari_id_username($u){
		$q = $this->db->query("SELECT * FROM admins WHERE username='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->id_username;
		}
		return $hasil;
	}
	
	public function cari_foto_username($u){
		$q = $this->db->query("SELECT * FROM admins WHERE username='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->foto;
		}
		return $hasil;
	}
	
	public function cari_foto_mahasiswa($u){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->file_foto;
		}
		return $hasil;
	}
	
	public function cari_foto_dosen($u){
		$q = $this->db->query("SELECT * FROM dosen WHERE kd_dosen='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->file_foto;
		}
		return $hasil;
	}
	
	public function cari_foto_user($u){
		$q = $this->db->query("SELECT * FROM t_user WHERE id_user='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->file_foto;
		}
		return $hasil;
	}
		
	public function cari_data_mhs($nim){
		$id['nim'] = $nim;
		$q = $this->db->get_where("mahasiswa",$id);
		return $q;
	}
	
	public function cari_semester_aktif($nim){
		$q = $this->db->query("SELECT smt FROM krs WHERE nim='$nim' GROUP BY smt ORDER BY smt");
		return $q;
	}
	
	public function cari_smt_krs($th,$smt,$nim){
		$q = $this->db->query("SELECT smt FROM krs WHERE th_akademik='$th' AND semester='$smt' AND nim='$nim' GROUP BY smt");
		foreach($q->result() as $dt){
			$hasil = $dt->smt;
		}
		return $hasil;
	}
	
	public function cari_sks_jadwal($id){
		$q = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal='$id'");
		foreach($q->result() as $dt){
			$mk = $dt->kd_mk;
			$q_mk = $this->db->query("SELECT sks FROM mata_kuliah WHERE kd_mk='$mk'");
			foreach($q_mk->result() as $dt_mk){
				$hasil = $dt_mk->sks;
			}
		}
		return $hasil;
	}
	
	public function cari_jml_sks_krs($th,$smt,$nim){
		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th' AND semester='$smt' AND nim='$nim' GROUP BY smt");
		if($q->num_rows>0){
			foreach($q->result() as $dt){
				$hasil = $dt->t_sks;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function cari_jml_sks_krs_($th,$nim){
		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th' AND nim='$nim' GROUP BY smt");
		if($q->num_rows>0){
			foreach($q->result() as $dt){
				$hasil = $dt->t_sks;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function cari_ipk_lalu($smt,$nim){
		if($smt>1){
			
			$smt = $smt-1;
			$q = $this->db->query("SELECT * FROM krs WHERE smt='$smt' AND nim='$nim'");
			$t_sks =0;
			$t_nilai=0;
			$t_akhir =0;
            if($q->num_rows()>0){
                foreach($q->result() as $dt){
                    $t_sks = $t_sks + $dt->sks;
                    $n_angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
                    $t_nilai = $t_nilai + $n_angka;
                    $akhir = $n_angka*$dt->sks;
                    $t_akhir = $t_akhir+$akhir;
                }
                $h = number_format($t_akhir/$t_sks,2);
            }else{
                $h = 0;
            }
		}else{
			$h = 0;
		}
		return $h;
	}
	
	public function cari_ip($nim){
		
		$q = $this->db->query("SELECT * FROM krs WHERE nim='$nim' AND nilai_akhir<>''");
		if($q->num_rows()>0){
			$t_sks =0;
			$t_nilai=0;
			$t_akhir=0;
			$h=0;
			foreach($q->result() as $dt){
				$t_sks = $t_sks+$dt->sks;
				$n_angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
				$t_nilai = $t_nilai+$n_angka;
				$akhir = $n_angka*$dt->sks;
				$t_akhir = $t_akhir+$akhir;
			}
			$h = number_format($t_akhir/$t_sks,2);
		}else{
			$h=0;
		}
		return $h;
	}
	
	public function cari_ipk($smt,$nim){
		
		$q = $this->db->query("SELECT * FROM krs WHERE smt='$smt' AND nim='$nim' AND nilai_akhir<>''");
		if($q->num_rows()>0){
			$t_sks =0;
			$t_nilai=0;
			$t_akhir=0;
			foreach($q->result() as $dt){
				$t_sks = $t_sks+$dt->sks;
				$n_angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
				$t_nilai = $t_nilai+$n_angka;
				$akhir = $n_angka*$dt->sks;
				$t_akhir = $t_akhir+$akhir;
			}
			$h = number_format($t_akhir/$t_sks,2);
		}else{
			$h=0;
		}
		return $h;
	}
	
	public function cari_nilai_angka($nilai){
		if($nilai=='A'){
			$h=4;
		}elseif($nilai=='B'){
			$h=3;
		}elseif($nilai=='C'){
			$h=2;
		}elseif($nilai=='D'){
			$h=1;	
		}elseif($nilai=='E'){
			$h=0;		
		}else{
			$h = '';
		}
		return $h;
	}
	
	
	
	public function cari_nama_mk($key){
		$q = $this->db->query("SELECT * FROM mata_kuliah WHERE kd_mk='$key'");
		if($q->num_rows()>0){
			foreach($q->result() as $dt){
				$hasil = $dt->nama_mk;
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
	
	public function cari_nama_dosen($key){
		$q = $this->db->query("SELECT * FROM dosen WHERE kd_dosen='$key'");
		if($q->num_rows()>0){
			foreach($q->result() as $dt){
				$hasil = $dt->nama_dosen;
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
	
	public function cari_nama_user($key){
		$q = $this->db->query("SELECT * FROM t_user WHERE id_user='$key'");
		if($q->num_rows()>0){
			foreach($q->result() as $dt){
				$hasil = $dt->nama_user;
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
		
	public function cari_nama_ka_prodi($key){
		$q = $this->db->query("SELECT * FROM prodi WHERE kd_prodi='$key'");
		foreach($q->result() as $dt){
			$hasil = array('nama'=>$dt->ketua_prodi,'nik'=>$dt->nik);
		}
		return $hasil;
	}
	
	public function cari_data_mhs_lengkap($key){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$key'");
		foreach($q->result() as $dt){
			$hasil = array('nama'=>$dt->nama_mhs,'sex'=>$dt->sex);
		}
		return $hasil;
	}
	
	public function cari_nama_mhs($key){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$key'");
		foreach($q->result() as $dt){
			$hasil = $dt->nama_mhs;
		}
		return $hasil;
	}
	
	public function cari_kd_prodi_mhs($key){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$key'");
		foreach($q->result() as $dt){
			$hasil = $dt->kd_prodi;
		}
		return $hasil;
	}
	
	public function cari_mk_jadwal($key){
		$q = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal='$key'");
		foreach($q->result() as $dt){
			$hasil = $dt->kd_mk;
		}
		return $hasil;
	}
	
	public function jml_sks_mhs($th_ak,$smt,$nim){
		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim'");
		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				$h = $dt->t_sks;
			}
		}else{
			$h = 0;
		}
		return $h;
	}
	
	public function cari_jml_mhs_mk($thak,$kdmk,$kddosen){
		$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$thak' AND kd_mk='$kdmk' AND kd_dosen='$kddosen'");
		$r = $q->num_rows();
		/*
		if($r>0){
			foreach($q->result() as $dt){
				$h = $dt->t_sks;
			}
		}else{
			$h = 0;
		}
		*/
		return $r;
	}
	
	public function create_category_mhs($th){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik='$th' group by th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		//$hasil .= $x+9;
		return $hasil;
	}
	
	public function create_category($th){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik<='$th' group by th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		//$hasil .= $x+9;
		return $hasil;
	}
	
	public function create_category_krs_nim($nim){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE nim='$nim' group by th_akademik ORDER BY th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		//$hasil .= $x+9;
		return $hasil;
	}
	
	
	
	
	public function create_data_krs_nim($nim){
		$q = $this->db->query("SELECT th_akademik,smt FROM krs WHERE nim='$nim' group by th_akademik ORDER BY th_akademik");
		//$data = array();
		$data = '[';
		foreach($q->result() as $dt){
			$th = $dt->th_akademik;
			$smt = $dt->smt;
			//$this->db->where(array('th_akademik'=>$th,'nim'=>$nim));
			//$this->db->from('krs');
			//$q2 = $this->db->get();
			 $data .= $this->model_data->cari_ipk($smt,$nim).','; //$q2->num_rows();
		}
		$data .=']';
		//return json_encode($data);
		return $data;
	}
	
	public function data_chart($key){
		$q = $this->db->query("SELECT th_akademik FROM krs group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;
                 $q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key' GROUP BY nim,th_akademik");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return json_encode($data);
	}
	
	public function data_chart_mhs_aktif($th,$key){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik<='$th' group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th,'kd_prodi'=>$key,'status'=>'Aktif'));
                //$this->db->group_by('nim','th_akadmeik');
                $this->db->from('mahasiswa');
                $q2 = $this->db->get();
                 //$q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key' GROUP BY nim,th_akademik");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data=0;
        }
		return json_encode($data);
	}
	
	public function data_chart_krs($th,$key){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE th_akademik<='$th' group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th,'kd_prodi'=>$key));
                //$this->db->group_by('nim','th_akadmeik');
                $this->db->from('krs');
                $q2 = $this->db->get();
                 //$q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key' GROUP BY nim,th_akademik");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return json_encode($data);
	}
	
	public function data_chart_wisuda($th,$key){
		$q = $this->db->query("SELECT th_akademik FROM wisuda WHERE th_akademik<='$th' group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                 $q2 = $this->db->query("SELECT a.th_akademik,b.kd_prodi
                                        FROM wisuda as a
                                        JOIN mahasiswa as b
                                        ON a.nim = b.nim
                                        WHERE a.th_akademik='".$th."' AND b.kd_prodi='".$key."'");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return json_encode($data);
	}
	
	public function data_chart_mhs($th,$status){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik='$th' group by th_akademik LIMIT 1");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th,'status'=>$status));
                $this->db->from('mahasiswa');
                $q2 = $this->db->get();
                 $data = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return $data;
	}
	
	public function data_chart_mhs_total($th){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik='$th' group by th_akademik LIMIT 1");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th));
                $this->db->from('mahasiswa');
                $q2 = $this->db->get();
                $data= $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return $data;
	}
	
	public function data_chart_dosen($key){
		
			$this->db->where(array('kd_prodi'=>$key,'status'=>'Aktif'));
			$this->db->from('dosen');
			$q2 = $this->db->get();
            if($q2->num_rows()>0){
			     $data = $q2->num_rows();
            }else{
                $data = 0;
            }
		return $data;
	}

	public function dataPengajuTpkad($level,$username){
		$url_name = "http://127.0.0.1:8000/api/data-tpakd";

        $ch_session = curl_init();

        curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch_session, CURLOPT_URL, $url_name);

        $result_url = curl_exec($ch_session);

		// return $result_url;
		// return $result_url;
		if($level=='admin'){
			$q = $result_url;
		}	
		return $q;	

	}

	// public function data_pk($level,$username){
	// 	if($level=='user'){
	// 		$id['id_user_pic'] = $username;
	// 		$q = $this->db->get_where('v_pk',$id);
	// 	}elseif($level=='supervisi'){
	// 		$id['id_user_supervisi1'] = $username;
	// 		$q = $this->db->get_where('v_pk_supervisi',$id);
	// 	}elseif($level=='admin'){
	// 		$q = $this->db->get_where('v_pk');
	// 	}	
	// 	return $q;	
	// }


}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */