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
		if(!empty($cek) && $level=='admin' || !empty($cek) && $level=='supervisi'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="Prospek";
			$d['class'] = "master";
			$d['vue'] = "";
			$d['content'] = 'prospek/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin' || !empty($cek) && $level=='supervisi'){
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
					$d['nominal'] = $dt->nominal_prospek_awal;					
					$d['pic'] = $dt->pic_prospek;
					$d['sumber_referensi'] = $dt->sumber_referensi;

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
		if(!empty($cek) && $level=='admin' || !empty($cek) && $level=='supervisi'){
			$id['id_prospek'] = $this->input->post('kode');
			
			$dt['id_prospek'] = $this->input->post('kode');
			$dt['kd_cab'] = $kd_cabang;
			$dt['nama_prospek'] = $this->input->post('nama_prospek');
			$dt['kode_status'] = $this->input->post('kode_status');			
			$dt['alamat_prospek'] = $this->input->post('alamat');
			$dt['telp'] = $this->input->post('telp');
			$dt['hp'] = $this->input->post('hp');
			$dt['email'] = $this->input->post('email');
			$dt['nominal_prospek_awal'] = $this->input->post('nominal');
			$dt['pic_prospek'] = $this->input->post('pic');
			$dt['sumber_referensi'] = $this->input->post('sumber_referensi');
			$dt['id_user_input'] = $level;
			
			
						
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

	 public function upload()
	{
		$this->load->library('excel');



		header('Access-Control-Allow-Origin: *');
		date_default_timezone_set('Asia/Jakarta');

		$namafile =  $_FILES['file_excel_all'] ["name"];
		$ukuranfile = $_FILES["file_excel_all"] ["size"];
		$typefile = $_FILES["file_excel_all"] ["type"];
		$path = $_FILES["file_excel_all"]["tmp_name"];


		if (!file_exists($path)) {
			$output = [
				'type' => 'error',
				'message' => 'upload_again',

			];

		}

		$object = PHPExcel_IOFactory::load($path);

		$datas = [];
		foreach ($object->getWorksheetIterator() as $worksheet) {

			$highest_row = $worksheet->getHighestRow();
			$highest_column = $worksheet->getHighestColumn();


		

			


                 // ----------------------------------------------------------------
			for($row = 2; $row <= $highest_row; $row++)
			{
				$kd_cab = $worksheet->
				getCellByColumnAndRow(0, $row)->
				getValue();


				if ($kd_cab == '0') {
					$nip = 0;
				}
				else if ($kd_cab == '' || $kd_cab == '-' || $kd_cab === null) {
					$kd_cab = null;
				}
				else{

					$kd_cab = str_replace( ',', '', $kd_cab);
				}


				$id_user = $worksheet->
				getCellByColumnAndRow(1, $row)->
				getValue();


				if ($id_user == '0') {
					$id_user = 0;
				}
				else if ($id_user == '' || $id_user == '-' || $id_user === null) {
					$id_user = null;
				}
				else{

					$id_user = str_replace( ',', '', $id_user);
				}


				$nama_user = $worksheet->
				getCellByColumnAndRow(2, $row)->
				getValue();


				if ($nama_user == '0') {
					$nama_user = 0;
				}
				else if ($nama_user == '' || $nama_user == '-' || $nama_user === null) {
					$nama_user = null;
				}
				else{

					$nama_user = str_replace( ',', '', $nama_user);
				}



				$password = $worksheet->
				getCellByColumnAndRow(3, $row)->
				getValue();


				if ($password == '0') {
					$password = 0;
				}
				else if ($password == '' || $password == '-' || $password === null) {
					$password = null;
				}
				else{

					$password = str_replace( ',', '', $password);
				}


				$id_supervisi1 = $worksheet->
				getCellByColumnAndRow(4, $row)->
				getValue();


				if ($id_supervisi1 == '0') {
					$id_supervisi1 = 0;
				}
				else if ($id_supervisi1 == '' || $id_supervisi1 == '-' || $id_supervisi1 === null) {
					$id_supervisi1 = null;
				}
				else{

					$id_supervisi1 = str_replace( ',', '', $id_supervisi1);
				}



				$id_supervisi2 = $worksheet->
				getCellByColumnAndRow(5, $row)->
				getValue();


				if ($id_supervisi2 == '0') {
					$id_supervisi2 = 0;
				}
				else if ($id_supervisi2 == '' || $id_supervisi2 == '-' || $id_supervisi2 === null) {
					$id_supervisi2 = null;
				}
				else{

					$id_supervisi2 = str_replace( ',', '', $id_supervisi2);
				}

				$status_user = $worksheet->
				getCellByColumnAndRow(6, $row)->
				getValue();


				if ($status_user == '0') {
					$status_user = 0;
				}
				else if ($status_user == '' || $status_user == '-' || $status_user === null) {
					$status_user = null;
				}
				else{

					$status_user = str_replace( ',', '', $status_user);
				}

                $level = $worksheet->
				getCellByColumnAndRow(7, $row)->
				getValue();


				if ($level == '0') {
					$level = 0;
				}
				else if ($level == '' || $level == '-' || $level === null) {
					$level = null;
				}
				else{

					$level = str_replace( ',', '', $level);
				}


				
			
				$obj = new \stdClass;
				$obj->kd_cab = $kd_cab;
				$obj->id_user = $id_user;
				$obj->nama_user = $nama_user;
				$obj->password = $password;
				$obj->id_supervisi1 = $id_supervisi1;
				$obj->id_supervisi2 = $id_supervisi2;
				$obj->status_user = $status_user;
				$obj->level = $level;




				$obj->path = $path;
 


 
				$datas[] = $obj;

  
			}
			$row++;

		}


 

   
		$output = [

			'type' => 'success',
			'datas' => $datas,

		];

    
		// echo ;
	
       $this->do_upload(json_encode($output));



	}
function do_upload($data){
	// print_r($data['datas'][0]->username);
	// exit();

	$datas = json_decode($data);
	
			foreach ($datas->datas as $key => $r_data) {
				
// print_r($r_data->username);
// exit;	

                     	$dt['kd_cab'] =  $r_data->kd_cab;
                     	$dt['id_user'] = $r_data->id_user;
                     	$dt['nama_user'] = $r_data->nama_user;
                     	$dt['password'] =  md5($r_data->password);
                     	$dt['id_user_supervisi1'] = $r_data->id_supervisi1;
                     	$dt['id_user_supervisi2'] = $r_data->id_supervisi2;
                     	$dt['status_user'] = $r_data->status_user;
                     	$dt['file_foto'] = 'none.jpg';
                     	$dt['level'] =  $r_data->level;
                     	$dt['status_data'] = NULL;


						// $form_data = [
						// 	'kd_cab' => $r_data->kd_cab,
						// 	'id_user' => $r_data->id_user,
						// 	'nama_user' => $r_data->nama_user,
						// 	'password' => md5($r_data->password),
						// 	'id_supervisi1' => $r_data->id_supervisi1,
						// 	'id_supervisi2' => $r_data->id_supervisi2,
						// 	'status_user' => $r_data->status_user,     
						// 	'file_foto' => 'none.jpg',
						// 	'level' => $r_data->level,
						// 	'status_data' => NULL    

						// ];



			        $this->db->insert('t_user',$dt);


				  
			
             
				


			}

	}

	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin' || !empty($cek) && $level=='supervisi'){
			$id['id_prospek']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("t_prospek",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("t_prospek",$id);
			}
			redirect('prospek','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */