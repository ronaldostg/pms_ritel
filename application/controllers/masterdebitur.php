<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masterdebitur extends CI_Controller {


    public function index(){

        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$nm_cabang = $this->session->userdata('nm_cabang');
        $akses = $this->session->userdata('akses');
        $username = $this->session->userdata('username');
        
        
        if($akses == 'adminsupervisi'){

            //echo "The master debitur";
            if(!empty($cek) && $level == 'admin' || !empty($cek) && $level == 'supervisi'){

                $d['nm_cabang'] =$nm_cabang;
                $d['judul']="Master Debitur Supervisi";
                $d['class'] = "masterdebitur";
              
                
                if($username === 'u2852'){
                    $d['vue'] = "masterdebitur";
                    $d['content'] = 'masterdebitur/index';
                }else{
                    $d['vue'] = "masterdebitursupervisi";
                    $d['content'] = 'masterdebitursupervisi/index';
                }

                $this->load->view('home',$d);

            }else{
                redirect('login' , 'refresh');
            }

        }else{

        

            if(!empty($cek) && $level=='admin'){
                $d['nm_cabang'] =$nm_cabang;
                $d['judul']="Master Debitur";
                $d['class'] = "masterdebitur";

                if($username == 'koko'){
                    $d['vue'] = "masterdebitur2";
                }else{
                    $d['vue'] = "masterdebitur";
                }
                
                $d['content'] = 'masterdebitur/index';
                $this->load->view('home',$d);
            }else{
                redirect('login','refresh');
            }

        }

    }

    public function getDatamasterdebitur(){

        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
        if(!empty($cek) && $level=='admin' || !empty($cek) && $level == 'supervisi'){

            $data = json_decode(file_get_contents("php://input"));
            
            $provinsi = strtolower($data->provinsi);
            $kabupaten = strtolower($data->kabupaten);
            $kecamatan = strtolower($data->kecamatan);

            // if($provinsi != '' AND $kabupaten != '' AND $kecamatan != ''){
                $query = $this->db->query("SELECT * FROM t_master_debitur inner join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur inner join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur inner join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_kecamatan where pembagian_wilayah.provinsi = '$provinsi' and pembagian_wilayah.kab_kota = '$kabupaten' and pembagian_wilayah.kecamatan = '$kecamatan' order by t_master_debitur.id desc")->result();
            // }else{
            //     $query = $this->db->query("SELECT * FROM t_master_debitur inner join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur inner join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur inner join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_kecamatan order by t_master_debitur.id desc")->result();
            // }

            $output = [ 
                    'type' => 'ok',
                    'items' => $query,
            ];

            echo json_encode($output);
        }else{
            redirect('login','refresh');
        }


    }

    public function getDataByCabang(){

        $data = json_decode(file_get_contents("php://input"));

        $kodecabang = $this->session->userdata('kd_cabang');
        $pageSize = $data->pageSize;
        $currentPage = $data->currentPage;
        $text_cari = $data->textCari;

        if($text_cari != ''){
                    
            $like = "and nik_debitur LIKE '%" .$text_cari. "%' or nama_debitur LIKE '%" .$text_cari. "%'";

        }else{
            $like = "";
        }

        $query = KonHelpers::showDataWithPagination('t_master_debitur' , "left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang", "where t_master_debitur.kode_cabang = '$kodecabang' and t_master_debitur.status_prospek = '2'" , $like , 'id' , 'desc' , $currentPage , $pageSize);

        echo json_encode($query);
       
      
    }

    public function getDetailMasterDebitur(){

        $data = json_decode(file_get_contents("php://input"));

        $iddata = $data->iddata;
        
        $query = $this->db->query("SELECT * FROM t_master_debitur left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang where t_master_debitur.id = '$iddata' order by t_master_debitur.id desc")->row();
          $output = [ 
                    'type' => 'ok',
                    'items' => $query,
        ];

        echo json_encode($output);

    }

    public function updatetmasterdebitur(){

        $this->load->model('model_data');
        $iddata = $_POST['iddata'];
        $no_rekening_pinjaman = $_POST['no_rekening_pinjaman'];
        $jumlahdata = count($iddata);
        $jumlahdatano_rekening_pinjaman = count($no_rekening_pinjaman);

        $suksesnumber = 0;

        for($i = 0; $i < $jumlahdata ; $i++){

                        $idprimary = $iddata[$i];
                        $_no_rekening_pinjaman = $no_rekening_pinjaman[$i];
                
                
                        // === UPDATE STATUS
                        $data = array(
                            'no_rekening_pinjaman' => $_no_rekening_pinjaman,
                        );
                    
                        $res = $this->db->where('id', $idprimary );
                        $res = $this->db->update('t_master_debitur', $data);

                        if($res){

                            $suksesnumber +=1;

                        }else{

                            $suksesnumber +=0;
                            

                        }
   
              
              

            

        }

      

        $this->session->set_flashdata('msg', "Berhasil mendelegasi ke $suksesnumber user ! $suksesnumber Data telah masuk ke tahap prospek!");

        redirect('/index.php/supervisiapprove');
      

    }

    public function upload(){

        $this->load->library('excel');



		header('Access-Control-Allow-Origin: *');
		date_default_timezone_set('Asia/Jakarta');
        $namafile =  $_FILES['file']["name"];
		$ukuranfile = $_FILES["file"]["size"];
		$typefile = $_FILES["file"]["type"];
		$path = $_FILES["file"]["tmp_name"];

        // echo $namafile;
        // die();

        if (!file_exists($path)) {
			$output = [
				'type' => 'error',
				'message' => 'File excel tidak valid',

			];

          echo json_encode($output);

		}else{

            $object = PHPExcel_IOFactory::load($path);
            $datas = [];

           
            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highest_row = $worksheet->getHighestRow();
                $highest_column = $worksheet->getHighestColumn();

                for($row = 2; $row <= $highest_row; $row++)
                {
                    $nomor_rekening = $worksheet->
                    getCellByColumnAndRow(1, $row)->
                    getValue();


                    $cif = $worksheet->
                    getCellByColumnAndRow(2, $row)->
                    getValue();

                    $jenis_debitur = $worksheet->
                    getCellByColumnAndRow(3, $row)->
                    getValue();

                    $kategori_debitur = $worksheet->
                    getCellByColumnAndRow(4, $row)->
                    getValue();

                    $kode_kantor_cabang = $worksheet->
                    getCellByColumnAndRow(5, $row)->
                    getValue();

                    $nik_debitur = $worksheet->
                    getCellByColumnAndRow(6, $row)->
                    getValue();

                    $nama_debitur = $worksheet->
                    getCellByColumnAndRow(7, $row)->
                    getValue();

                    $nomor_handphone = $worksheet->
                    getCellByColumnAndRow(8, $row)->
                    getValue();

                    $nomor_telepon = $worksheet->
                    getCellByColumnAndRow(9, $row)->
                    getValue();

                    $alamat = $worksheet->
                    getCellByColumnAndRow(10, $row)->
                    getValue();

                    $email = $worksheet->
                    getCellByColumnAndRow(11, $row)->
                    getValue();

                    $wilayah = $worksheet->
                    getCellByColumnAndRow(12, $row)->
                    getValue();

                    $nama_instansi = $worksheet->
                    getCellByColumnAndRow(13, $row)->
                    getValue();

                    $gaji_bruto = $worksheet->
                    getCellByColumnAndRow(14, $row)->
                    getValue();

                    $jenis_kredit = $worksheet->
                    getCellByColumnAndRow(15, $row)->
                    getValue();

                    $permohonan_topup = $worksheet->
                    getCellByColumnAndRow(16, $row)->
                    getValue();

                    $snd = $worksheet->
                    getCellByColumnAndRow(17, $row)->
                    getValue();
                    
                    $angsuran_kredit = $worksheet->
                    getCellByColumnAndRow(18, $row)->
                    getValue();

                    $no_rekening_pinjaman = $worksheet->
                    getCellByColumnAndRow(19, $row)->
                    getValue();
                    
                    if($nik_debitur != null){
                        $obj = new \stdClass;

                    
                        $obj->nomor_rekening = $nomor_rekening;
                        $obj->cif = $cif;
                        $obj->jenis_debitur = $jenis_debitur;
                        $obj->kategori_debitur = $kategori_debitur;
                        $obj->kode_kantor_cabang = $kode_kantor_cabang;
                        $obj->nik_debitur = $nik_debitur;
                        $obj->nama_debitur = $nama_debitur;
                        $obj->nomor_handphone = $nomor_handphone;
                        $obj->nomor_telepon = $nomor_telepon;
                        $obj->alamat = $alamat;
                        $obj->email = $email;
                        $obj->wilayah = $wilayah;
                        $obj->nama_instansi = $nama_instansi;
                        $obj->gaji_bruto = $gaji_bruto;
                        $obj->jenis_kredit = $jenis_kredit;
                        $obj->permohonan_topup = $permohonan_topup;
                        $obj->snd = $snd;
                        $obj->angsuran_kredit = $angsuran_kredit;
                        $obj->no_rekening_pinjaman = $no_rekening_pinjaman;
                    

                        $obj->path = $path;
                        $datas[] = $obj;

                    }

    
                }
                $row++;

            }

            $output = [

                'type' => 'success',
                'datas' => $datas,
    
            ];
    
        
        
            echo $this->do_upload(json_encode($output));
            // var_dump($output);
        }



    }
    // == Upload

    // ==DO Upload
    public function do_upload($data){

        // ini_set('display_errors', '1');
        // ini_set('display_startup_errors', '1');
        // error_reporting(E_ALL);

        $datas = json_decode($data);
        
        
        // var_dump($datas);
        
        // die();
    
        $dataentry = 0;
        $dataentrygagal = 0;
        $countalldata = 0;
        $insert = 'no';
        $duplicatenik = '';
        $username= $this->session->userdata('username');
        $isierror = '';
        $nikerror = '';

        if(count($datas->datas) >  15000){


          $pesanggal = "Gagal upload! Data yang diupload melewati batas maximum upload. hanya diperbolehkan 15000";
          $dataentrygagal = count($datas->datas);

        }else{
        
       
      
            $dts = [];
            foreach ($datas->datas as $key => $r_data) {

                $nm_wilayah = $r_data->wilayah;
                $nm_wilayah = str_replace('.' , '' , $nm_wilayah);
                $nm_wilayah = strtoupper($nm_wilayah);
                $kd_wilayah = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $nm_wilayah , 'kode_wilayah');
                
            
                
                $nik = $r_data->nik_debitur;
                $nama = $r_data->nama_debitur;
                $dt['jenis_debitur'] =  $r_data->jenis_debitur;
                $dt['nama_debitur'] = $r_data->nama_debitur;
                $dt['nik_debitur'] = $r_data->nik_debitur;
                $dt['kategori_debitur'] = $r_data->kategori_debitur;
                $dt['alamat'] = $r_data->alamat;
                $dt['no_telepon'] = $r_data->nomor_telepon;
                $dt['no_handphone'] = $r_data->nomor_handphone;
                $dt['email'] = $r_data->email;
                $dt['kode_wilayah'] = $kd_wilayah;
                $dt['kode_cabang'] = $r_data->kode_kantor_cabang;
                $dt['nama_instansi'] = $r_data->nama_instansi;
                $dt['gaji_bruto'] = $r_data->gaji_bruto;
                $dt['jenis_kredit'] = $r_data->jenis_kredit;
                $dt['permohonbaru_topup'] = $r_data->permohonan_topup;
                $dt['cif'] = $r_data->cif;
                $dt['nomor_rekening'] = $r_data->nomor_rekening;
                $dt['status_prospek'] = 1;
                $dt['tanggal_input'] = date('Y-m-d');
                $dt['user_snd'] = $username;
                $dt['snd'] = $r_data->snd;
                $dt['angsuran_kredit'] = $r_data->angsuran_kredit;
                $dt['tanggal_update_gaji'] = date("Y-m-d H:i:s");

                if($nik != '' || $nik != '0' || $nik != '#N/A'){
                    $dts[] = $dt;
                    $dataentry +=1;
                }
              
            

            }

            $this->db->insert_batch('t_master_debitur', $dts);

            // SELECT NIK DOUBLE
            // $doublenik = $this->db->query("SELECT nik_debitur ,  nama_debitur , COUNT(nik_debitur) as jumlahnik FROM t_master_debitur GROUP BY nik_debitur HAVING COUNT(nik_debitur) > 1")->result();
            // if(!empty($doublenik)){
                
            //     foreach($doublenik as $rowdoublenik){

            //         $nama  = $rowdoublenik->nama_debitur;
            //         $nik  = $rowdoublenik->nik_debitur;
            //         $jumlahnik  = $rowdoublenik->jumlahnik;
            //         $dataentrygagal +=1;
            //         $isierror .= "NIK $nik ($nama) terduplicate sebanyak $jumlahnik kali. $jumlahnik nik terduplicate sudah dihapus \n";

            //     }

            //     $jumlahberhasil = abs(count($datas->datas) -  $jumlahnik);
            //     $dataentry = $jumlahberhasil;

            //     $this->db->query("DELETE t1 FROM t_master_debitur t1 INNER JOIN t_master_debitur t2 WHERE t1.id < t2.id AND t1.nik_debitur = t2.nik_debitur");
            
            // }else{

            //     $dataentry = count($datas->datas);

            // }


  

            // if($dataentrygagal > 0){
            //     $filename = 'LOG_ERROR_'.date('dmYHis') . '.txt';
            //     $destination = $_SERVER['DOCUMENT_ROOT'] . '/pms_ritel/sistemlog/' . $filename;

            //     if (file_exists($destination)) {
            //             //unlink dokumen log
            //             unlink($destination);
            //     } else {
            //             $respon = $isierror;	
            //             $file = fopen($destination, "w+");
            //             fputs($file, $respon);
            //             fclose($file);
            //     }

            //     $bacafile = "$dataentrygagal data gagal diupload. <a href='$destination' downloand>Silahkan downloand log error</a>";

            // }else{

            //    $bacafile = '';
            // }
    
            $pesanggal = '';



        }
        

       
        $output=[
            'type' => 'ok',
            'csukses' => $dataentry,
            'cgagal' => $dataentrygagal,
            'suksesmsg' => "Berhasil upload $dataentry data",
            'errormsg' => "$pesanggal",
        ];

        echo json_encode($output);

    }
    
    public function do_upload_backup($data){

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        $datas = json_decode($data);

        // echo var_dump($datas->datas);
        // die();

    
        $dataentry = 0;
        $dataentrygagal = 0;
        $countalldata = 0;
        $insert = 'no';
        $duplicatenik = '';
        $username= $this->session->userdata('username');
        $isierror = '';

        if(count($datas->datas) >  10000){


          $pesanggal = "Gagal upload! Data yang diupload melewati batas maximum upload. hanya diperbolehkan 10000";
          $dataentrygagal = count($datas->datas);

        }else{
        
       
      
            $dts = [];
            foreach ($datas->datas as $key => $r_data) {

                $nm_wilayah = $r_data->wilayah;
                $nm_wilayah = str_replace('.' , '' , $nm_wilayah);
                $nm_wilayah = strtoupper($nm_wilayah);
                $kd_wilayah = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $nm_wilayah , 'kode_wilayah');
                
                $_gajibruto = str_replace('.' , '' , $r_data->gaji_bruto);

                // echo $_gajibruto."\n";
                // if(stripos($_gajibruto , '=') !== false){
                //     $replacegaji = str_replace('=' , '' , $_gajibruto);
                //     if(stripos($replacegaji , "+") !== false){
                //         $expgaji = explode('+' , $replacegaji);
                //         $gjbruto = intval($expgaji[0]) +intval($expgaji[1]);
                //     }else{
                //         $gjbruto = $replacegaji;
                //     }
 
                
                // }else{
                //     $gjbruto = $_gajibruto;
                // }

                $gjbruto = $_gajibruto;


                // echo $gjbruto."\n";
           
              
                
                $nik = $r_data->nik_debitur;
                $nama = $r_data->nama_debitur;
                $dt['jenis_debitur'] =  $r_data->jenis_debitur;
                $dt['nama_debitur'] = $r_data->nama_debitur;
                $dt['nik_debitur'] = $r_data->nik_debitur;
                $dt['kategori_debitur'] = $r_data->kategori_debitur;
                $dt['alamat'] = $r_data->alamat;
                $dt['no_telepon'] = $r_data->nomor_telepon;
                $dt['no_handphone'] = $r_data->nomor_handphone;
                $dt['email'] = $r_data->email;
                $dt['kode_wilayah'] = $kd_wilayah;
                $dt['kode_cabang'] = $r_data->kode_kantor_cabang;
                $dt['nama_instansi'] = $r_data->nama_instansi;
                $dt['gaji_bruto'] = $gjbruto;
                $dt['jenis_kredit'] = $r_data->jenis_kredit;
                $dt['permohonbaru_topup'] = $r_data->permohonan_topup;
                $dt['cif'] = $r_data->cif;
                $dt['nomor_rekening'] = $r_data->nomor_rekening;
                $dt['status_prospek'] = 1;
                $dt['tanggal_input'] = date('Y-m-d');
                $dt['user_snd'] = $username;
                $dt['snd'] = $r_data->snd;
                $dt['angsuran_kredit'] = $r_data->angsuran_kredit;
                $dt['no_rekening_pinjaman'] = $r_data->no_rekening_pinjaman;
                
            
                $dts[] = $dt;
              
                // if($nik != '' || $nik === '0'){
                //     $dts[] = $dt;
                //     $dataentry += 1;
                // }

                // try {
                  
                //     $this->db->insert('t_master_debitur',$dt);
            
                //     $db_error = $this->db->_error_message();
                //     if (!empty($db_error)) {
                //        $dataentrygagal +=1;
                //        $isierror .= "Duplicate nik $nama ($nik)\n";
                       
                //     }else{

                //         $dataentry +=1;

                //     }
                   
                // } catch (Exception $e) {
                //     $dataentrygagal +=1;
                //     $isierror .= "Duplicate nik $nama ($nik)\n";
                    

                // }

               

            }

            // die();

            $pesanggal = '';

            // if($dataentrygagal > 0){
            //     $filename = 'LOG_ERROR_'.date('dmYHis') . '.txt';
            //     $destination = $_SERVER['DOCUMENT_ROOT'] . '/pms_ritel/sistemlog/' . $filename;

            //     if (file_exists($destination)) {
            //             //unlink dokumen log
            //             unlink($destination);
            //     } else {
            //             $respon = $isierror;	
            //             $file = fopen($destination, "w+");
            //             fputs($file, $respon);
            //             fclose($file);
            //     }

            //     $link = "http://192.168.3.155/pms_ritel/sistemlog/$filename";
            //     $bacafile = "$dataentrygagal data gagal diupload. <a href='$link' download>Silahkan downloand log error</a>";

            // }else{

            //    $bacafile = '';
            // }

            $bacafile = '';


            if(!empty($dts)){
                $this->db->insert_batch('t_master_debitur', $dts);
            }

        }

        $dataentry = count($datas->datas);
       
        $output=[
            'type' => 'ok',
            'csukses' => $dataentry,
            'cgagal' => $dataentrygagal,
            'suksesmsg' => "Berhasil upload $dataentry data",
            'errormsg' => "$pesanggal",
        ];

        echo json_encode($output);

    }

    public function editmaster(){

        $this->load->library('excel');



		header('Access-Control-Allow-Origin: *');
		date_default_timezone_set('Asia/Jakarta');
        $namafile =  $_FILES['file']["name"];
		$ukuranfile = $_FILES["file"]["size"];
		$typefile = $_FILES["file"]["type"];
		$path = $_FILES["file"]["tmp_name"];

        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];


        // echo $namafile;
        // die();

        if (!file_exists($path)) {
			$output = [
				'type' => 'error',
				'message' => 'File excel tidak valid',

			];

          echo json_encode($output);

		}else{

            $object = PHPExcel_IOFactory::load($path);
            $datas = [];

           
            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highest_row = $worksheet->getHighestRow();
                $highest_column = $worksheet->getHighestColumn();

                for($row = 2; $row <= $highest_row; $row++)
                {
                    $nomor_rekening = $worksheet->
                    getCellByColumnAndRow(1, $row)->
                    getValue();


                    $nik = $worksheet->
                    getCellByColumnAndRow(2, $row)->
                    getValue();

                    $nama_debitur = $worksheet->
                    getCellByColumnAndRow(3, $row)->
                    getValue();

                  
                    $obj = new \stdClass;
                    $obj->nomor_rekening = $nomor_rekening;
                    $obj->nik = $nik;
                    $obj->nama_debitur = $nama_debitur;
                 

                    $obj->path = $path;
    


    
                    $datas[] = $obj;

    
                }
                $row++;

            }

            $output = [

                'type' => 'success',
                'datas' => $datas,
    
            ];
    
        
        
            echo $this->updatemaster(json_encode($output) , $dari , $sampai);
            // var_dump($output);
        }

    }

    public function updatemaster($data , $dari , $sampai){


        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        $datas = json_decode($data);

        $dataentry = 0;
        $dataentrygagal = 0;
        $countalldata = 0;
        $insert = 'no';
        $duplicatenik = '';
        $username= $this->session->userdata('username');

        if(count($datas->datas) >  10000){


          $pesanggal = "Gagal edit! Data yang diedit melewati batas maximum edit. hanya diperbolehkan 10000";
          $dataentrygagal = count($datas->datas);

        }else{
        
       
      
            $dts = [];
            $number = $dari;
            foreach ($datas->datas as $key => $r_data) {

                if($number <= $sampai){

            
                    $id['nik_debitur'] = $r_data->nik;
                    $dt['no_rekening_pinjaman'] = $r_data->nomor_rekening;
                


                    if($this->db->update("t_master_debitur",$dt,$id)){

                        $dataentry +=1;

                    }else{

                        $dataentrygagal +=0;
                    }

                }
                

                $number++;

            }
            $pesanggal = '';
        
            

        }


     

       
        $output=[
            'type' => 'ok',
            'csukses' => $dataentry,
            'cgagal' => $dataentrygagal,
            'suksesmsg' => "Berhasil edit $dataentry data",
            'errormsg' => "$pesanggal",
        ];

        echo json_encode($output);
        

        

    }

    public function upload2(){

        $this->load->library('excel');



		header('Access-Control-Allow-Origin: *');
		date_default_timezone_set('Asia/Jakarta');
        $namafile =  $_FILES['file']["name"];
		$ukuranfile = $_FILES["file"]["size"];
		$typefile = $_FILES["file"]["type"];
		$path = $_FILES["file"]["tmp_name"];

        // echo $namafile;
        // die();

        if (!file_exists($path)) {
			$output = [
				'type' => 'error',
				'message' => 'File excel tidak valid',

			];

          echo json_encode($output);

		}else{

            $object = PHPExcel_IOFactory::load($path);
            $datas = [];

           
            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highest_row = $worksheet->getHighestRow();
                $highest_column = $worksheet->getHighestColumn();

                for($row = 2; $row <= $highest_row; $row++)
                {
                    $nomor_rekening = $worksheet->
                    getCellByColumnAndRow(1, $row)->
                    getValue();


                    $cif = $worksheet->
                    getCellByColumnAndRow(2, $row)->
                    getValue();

                    $jenis_debitur = $worksheet->
                    getCellByColumnAndRow(3, $row)->
                    getValue();

                    $kategori_debitur = $worksheet->
                    getCellByColumnAndRow(4, $row)->
                    getValue();

                    $kode_kantor_cabang = $worksheet->
                    getCellByColumnAndRow(5, $row)->
                    getValue();

                    $nik_debitur = $worksheet->
                    getCellByColumnAndRow(6, $row)->
                    getValue();

                    $nama_debitur = $worksheet->
                    getCellByColumnAndRow(7, $row)->
                    getValue();

                    $nomor_handphone = $worksheet->
                    getCellByColumnAndRow(8, $row)->
                    getValue();

                    $nomor_telepon = $worksheet->
                    getCellByColumnAndRow(9, $row)->
                    getValue();

                    $alamat = $worksheet->
                    getCellByColumnAndRow(10, $row)->
                    getValue();

                    $email = $worksheet->
                    getCellByColumnAndRow(11, $row)->
                    getValue();

                    $wilayah = $worksheet->
                    getCellByColumnAndRow(12, $row)->
                    getValue();

                    $nama_instansi = $worksheet->
                    getCellByColumnAndRow(13, $row)->
                    getValue();

                    $gaji_bruto = $worksheet->
                    getCellByColumnAndRow(14, $row)->
                    getValue();

                    $jenis_kredit = $worksheet->
                    getCellByColumnAndRow(15, $row)->
                    getValue();

                    $permohonan_topup = $worksheet->
                    getCellByColumnAndRow(16, $row)->
                    getValue();

                    $snd = $worksheet->
                    getCellByColumnAndRow(17, $row)->
                    getValue();
                    
                    $angsuran_kredit = $worksheet->
                    getCellByColumnAndRow(18, $row)->
                    getValue();
                
                    $obj = new \stdClass;
                    $obj->nomor_rekening = $nomor_rekening;
                    $obj->cif = $cif;
                    $obj->jenis_debitur = $jenis_debitur;
                    $obj->kategori_debitur = $kategori_debitur;
                    $obj->kode_kantor_cabang = $kode_kantor_cabang;
                    $obj->nik_debitur = $nik_debitur;
                    $obj->nama_debitur = $nama_debitur;
                    $obj->nomor_handphone = $nomor_handphone;
                    $obj->nomor_telepon = $nomor_telepon;
                    $obj->alamat = $alamat;
                    $obj->email = $email;
                    $obj->wilayah = $wilayah;
                    $obj->nama_instansi = $nama_instansi;
                    $obj->gaji_bruto = $gaji_bruto;
                    $obj->jenis_kredit = $jenis_kredit;
                    $obj->permohonan_topup = $permohonan_topup;
                    $obj->snd = $snd;
                    $obj->angsuran_kredit = $angsuran_kredit;
                 




                    $obj->path = $path;
    


    
                    $datas[] = $obj;

    
                }
                $row++;

            }

            $output = [

                'type' => 'success',
                'datas' => $datas,
    
            ];
    
        
        
            echo $this->do_upload2(json_encode($output));
            // var_dump($output);
        }



    }
    // == Upload

    // ==DO Upload
    public function do_upload2($data){

        
          // ini_set('display_errors', '1');
        // ini_set('display_startup_errors', '1');
        // error_reporting(E_ALL);

        $datas = json_decode($data);
        
        
        // var_dump($datas->datas);
        
        // die();
    
        $dataentry = 0;
        $dataentrygagal = 0;
        $countalldata = 0;
        $insert = 'no';
        $duplicatenik = '';
        $username= $this->session->userdata('username');
        $isierror = '';
        $nikerror = '';

        if(count($datas->datas) >  15000){


          $pesanggal = "Gagal upload! Data yang diupload melewati batas maximum upload. hanya diperbolehkan 15000";
          $dataentrygagal = count($datas->datas);

        }else{
        
       
      
            $dts = [];
            foreach ($datas->datas as $key => $r_data) {

                $nm_wilayah = $r_data->wilayah;
                $nm_wilayah = str_replace('.' , '' , $nm_wilayah);
                $nm_wilayah = strtoupper($nm_wilayah);
                $kd_wilayah = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $nm_wilayah , 'kode_wilayah');
                
            
                
                $nik = $r_data->nik_debitur;
                $nama = $r_data->nama_debitur;
                $dt['jenis_debitur'] =  $r_data->jenis_debitur;
                $dt['nama_debitur'] = $r_data->nama_debitur;
                $dt['nik_debitur'] = $r_data->nik_debitur;
                $dt['kategori_debitur'] = $r_data->kategori_debitur;
                $dt['alamat'] = $r_data->alamat;
                $dt['no_telepon'] = $r_data->nomor_telepon;
                $dt['no_handphone'] = $r_data->nomor_handphone;
                $dt['email'] = $r_data->email;
                $dt['kode_wilayah'] = $kd_wilayah;
                $dt['kode_cabang'] = $r_data->kode_kantor_cabang;
                $dt['nama_instansi'] = $r_data->nama_instansi;
                $dt['gaji_bruto'] = $r_data->gaji_bruto;
                $dt['jenis_kredit'] = $r_data->jenis_kredit;
                $dt['permohonbaru_topup'] = $r_data->permohonan_topup;
                $dt['cif'] = $r_data->cif;
                $dt['nomor_rekening'] = $r_data->nomor_rekening;
                $dt['status_prospek'] = 1;
                $dt['tanggal_input'] = date('Y-m-d');
                $dt['user_snd'] = $username;
                $dt['snd'] = $r_data->snd;
                $dt['angsuran_kredit'] = $r_data->angsuran_kredit;

                if($nik != '' || $nik != '0' || $nik != '#N/A'){
                  if(!empty($nik)){
                    if(!preg_match("/[^A-Za-z0-9]/", $nik)){
                        if(!strpos($nik , "SM")){

                            if(!strpos($nik , "AS")){
                               
                              if($nik != '2'){
                                $dts[] = $dt;
                                $dataentry +=1;
                                // echo $nik."<br/>";
                              }

                            }

                        }
                    }
                  }
                }
              
            

            }

       
            // die();
            // count($dts);
            // die();

            $this->db->insert_batch('t_master_debitur_copy1', $dts);

            // SELECT NIK DOUBLE
            // $doublenik = $this->db->query("SELECT nik_debitur ,  nama_debitur , COUNT(nik_debitur) as jumlahnik FROM t_master_debitur GROUP BY nik_debitur HAVING COUNT(nik_debitur) > 1")->result();
            // if(!empty($doublenik)){
                
            //     foreach($doublenik as $rowdoublenik){

            //         $nama  = $rowdoublenik->nama_debitur;
            //         $nik  = $rowdoublenik->nik_debitur;
            //         $jumlahnik  = $rowdoublenik->jumlahnik;
            //         $dataentrygagal +=1;
            //         $isierror .= "NIK $nik ($nama) terduplicate sebanyak $jumlahnik kali. $jumlahnik nik terduplicate sudah dihapus \n";

            //     }

            //     $jumlahberhasil = abs(count($datas->datas) -  $jumlahnik);
            //     $dataentry = $jumlahberhasil;

            //     $this->db->query("DELETE t1 FROM t_master_debitur t1 INNER JOIN t_master_debitur t2 WHERE t1.id < t2.id AND t1.nik_debitur = t2.nik_debitur");
            
            // }else{

            //     $dataentry = count($datas->datas);

            // }


  

            // if($dataentrygagal > 0){
            //     $filename = 'LOG_ERROR_'.date('dmYHis') . '.txt';
            //     $destination = $_SERVER['DOCUMENT_ROOT'] . '/pms_ritel/sistemlog/' . $filename;

            //     if (file_exists($destination)) {
            //             //unlink dokumen log
            //             unlink($destination);
            //     } else {
            //             $respon = $isierror;	
            //             $file = fopen($destination, "w+");
            //             fputs($file, $respon);
            //             fclose($file);
            //     }

            //     $bacafile = "$dataentrygagal data gagal diupload. <a href='$destination' downloand>Silahkan downloand log error</a>";

            // }else{

            //    $bacafile = '';
            // }
    
            $pesanggal = '';



        }
        

       
        $output=[
            'type' => 'ok',
            'csukses' => $dataentry,
            'cgagal' => $dataentrygagal,
            'suksesmsg' => "Berhasil upload $dataentry data",
            'errormsg' => "$pesanggal",
        ];

        echo json_encode($output);


    }

    // === Approve ===

    public function approve(){

        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        $status = $data->param;
        $username= $this->session->userdata('username');
        switch($status){
            case 'approve' :
                
                $data = array(
                    'status_prospek' => 3,
                    'user_supervisi' => $username,
                    'tanggal_supervisi' => date('Y-m-d Y-m-d H:i:s'),
                );
            
                $res = $this->db->where('id', $id );
                $res = $this->db->update('t_master_debitur', $data);
                if($res){

                    $output = [
                        'type' => 'ok',
                        'message' => 'Sukses approve',
                    ];

                }

            break;
            default :
                $output = [
                    'type' => 'gagal',
                    'message' => 'Gagal Approve',
                ];
            break;
        }

        echo json_encode($output);

    }

    // === End Approve 

    public function terima(){
        $iddata = $_POST['iddata'];
        $jumlahdata = count($iddata);
        for($i = 0; $i < $jumlahdata ; $i++){
 
             $idprimary = $iddata[$i];
             $data = array(
                 'status_prospek' => '3',
                 'tanggal_update' => date('Y-m-d'),
                 'tanggal_snd_update' => date('Y-m-d H:i:s'),
             );
         
             $this->db->where('id', $idprimary );
             $this->db->update('t_master_debitur', $data);
 
 
 
         }
         $this->session->set_flashdata('msg', "Berhasil terima data debitur");
         redirect('/index.php/delegasidebitur');
    }


}