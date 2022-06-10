<?php

class KonHelpers {


	static public function  testing(){

		echo "kon helper";
	}

	static public function  joinGampang($table , $filed , $data , $paramaterfiledget , $queryand = ''){
		$CI =& get_instance();
        if($queryand != ''){
		    $res = $CI->db->query("SELECT * FROM $table where $filed = '$data' AND $queryand")->row_array();
        }else{
		    $res = $CI->db->query("SELECT * FROM $table where $filed = '$data' $queryand")->row_array();
        }

        if(!empty($res)){
		    return $res["$paramaterfiledget"];
        }else{
            return '';
        }
	}

	static public function  joinGampang2($table , $queryjoin, $where = '' , $paramaterfiledget){
		$CI =& get_instance();
		$res = $CI->db->query("SELECT * FROM $table $queryjoin where $where")->row_array();
		return $res["$paramaterfiledget"];
		//echo "SELECT * FROM $table $queryjoin $where";
				
	}

	static public function EnkripsiAes($password){

		$iv = '2210198409061988';
		$key = '947ba042d09050506b222425dfaf6afb';

		$plainString = $password;
		$ciphering = "AES-256-CBC";
		$options = 1;
		$encryption = openssl_encrypt($plainString, $ciphering, $key, $options, $iv);

		return base64_encode($encryption);

	}

	static public function Apisendata($data , $url){

		// var_dump($url);
		// exit();

		/* Endpoint */
		 $url = "http://192.168.3.196:8004/$url";
    
		 /* eCurl */
		 $curl = curl_init($url);
	 
		 /* Data */
		//  $data = [
		// 	 'name'=>'John Doe', 
		// 	 'email'=>'johndoe@yahoo.com'
		//  ];
	 
		 /* Set JSON data to POST */
		 curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			  
		 /* Define content type */
		 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			 'Content-Type:application/json',
			 'X-Api-Key: abfadf891b7eb6b80f11cf2d3371ead65032e809',
		 ));
			  
		 /* Return json */
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			  
		 /* make request */
		 $result = curl_exec($curl);
			   
		 /* close curl */
		 curl_close($curl);
		
		return json_decode($result , true);

	}

	static public function curlpost($data , $url){


		// var_dump($url);
		// exit();

		/* Endpoint */
    
		 /* eCurl */
		 $curl = curl_init($url);
	 
		 /* Data */
		//  $data = [
		// 	 'name'=>'John Doe', 
		// 	 'email'=>'johndoe@yahoo.com'
		//  ];
	 
		 /* Set JSON data to POST */
		 curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			  
		 /* Define content type */
		 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			 'Content-Type:application/json',
			 'X-Api-Key: abfadf891b7eb6b80f11cf2d3371ead65032e809',
		 ));
			  
		 /* Return json */
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			  
		 /* make request */
		 $result = curl_exec($curl);
			   
		 /* close curl */
		 curl_close($curl);
		
		return json_decode($result , true);


	}

	static public function getDokumenBasedIdCond($idcond , $idreq , $callfield = 'docfilename'){


		$CI =& get_instance();
		$res = $CI->db->query("SELECT * FROM tbl_docregister where idcond = '$idcond' and id_req = '$idreq'")->row_array();
		return $res["$callfield"];

	}

	static public function propinsi(){

			$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM cfg_wilayah")->result();
	        $output = array(
	            "success" => false,
	            "items" => array()
	        );
	        foreach($query as $dt){
	            $kodewilayah  = $dt->kode;
	            if(strlen($kodewilayah) == 2){
	                $output['items'][] = array(
	                    'kode_wilayah' => $dt->kode,
	                    'wilayah' => $dt->nama_wilayah,
	                    'kode_klaster' => $dt->kode_klaster,
	                  );
	            }
	        }
	        $output['success'] = true; // if you want to update `status` as well
	        return json_encode($output);

	}

	static public function kota($provinsi){

        
		$CI =& get_instance();

        $provinsi = strtolower($provinsi);
        $query = $CI->db->query("SELECT * FROM cfg_wilayah where nama_prop = '$provinsi'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode;
            if(strlen($kodewilayah) == 4){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode,
                    'wilayah' => $dt->nama_wilayah,
                    'kode_klaster' => $dt->kode_klaster,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);

        
    }

    static public function kecamatan($kabupaten){

        
		$CI =& get_instance();

        $kabupaten = strtolower($kabupaten);
      	$query = $CI->db->query("SELECT * FROM cfg_wilayah where nama_kabkota = '$kabupaten'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode;
            if(strlen($kodewilayah) == 6){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode,
                    'wilayah' => $dt->nama_wilayah,
                    'kode_klaster' => $dt->kode_klaster,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);
        
    }

    static public function kelurahan($kecamatan){
        
		$CI =& get_instance();

        // $kecamatan = strtolower($kecamatan);
      	$query = $CI->db->query("SELECT * FROM cfg_wilayah where nama_kec = '$kecamatan'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode;
            if(strlen($kodewilayah) == 10){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode,
                    'wilayah' => $dt->nama_wilayah,
                    'kode_klaster' => $dt->kode_klaster,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);
        
    }

    static public function countData($table , $where , $value , $and = ''){

		$CI =& get_instance();
		$profile = $CI->session->userdata('profile');
		 $BRANCHID = $profile->branchid;
		 if($and != ''){
			$query = $CI->db->query("SELECT * FROM $table where $where = '$value' and $and")->result();
		}else{
			$query = $CI->db->query("SELECT * FROM $table where $where = '$value'")->result();
		}
		echo count($query);


    }



	static public function replace_image($namefirst ="image_" , $nameimage){

		$pecah = explode('.' , $nameimage);

        $getExt = $pecah[1];

        $random = rand ( 10000 , 99999 );

        $replacename = "$namefirst".date('YmdHis').$random.".".$getExt;

        return $replacename;
		
	}

	static public function download_jpg($zid_req,$zdata) 
    {
        $CI = & get_instance();
        $path_destination = FCPATH.'upload/'.$zid_req."/";
        
        if (!file_exists($path_destination)) 
        {
            mkdir($path_destination, 0777, true);
        }
        $destination = FCPATH.'upload/'.$zid_req."/".$zdata;
        $source = $CI->config->item('serv_download').$zid_req."/".$zdata;

        copy($source,$destination);
        header("Content-Disposition: attachment; filename=$zdata");
        header("Content-Type: iamage/jpg");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . filesize($destination));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        ob_clean();
        flush();
        readfile($destination);
        // return $zid_req;
    }



    static public function sendData($dataJSON, $addURL, $dataType) 
    {
        $CI     = & get_instance();
        $key    = $CI->config->item('key_checkrek'); 
        $header = 'X-Api-Key: ' . $key;
        $url    = $CI->config->item('serv_senddata').$addURL;

        //print($url);
        if ($dataType == '1') {
            $data = json_encode($dataJSON);
        } else if ($dataType == '2') {
            $data = http_build_query($dataJSON);
        } else {
            $data = $dataJSON;
        }
        // print($url);

        $dh = curl_init($url);
        if ($dataType != '2') {
            if ($header == '') {
                curl_setopt($dh, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            } else {
                curl_setopt($dh, CURLOPT_HTTPHEADER, array($header));
                curl_setopt($dh, CURLINFO_HEADER_OUT, TRUE);
            }
        }


        //curl_setopt($dh, CURLOPT_URL, $url); //interface 724
        curl_setopt($dh, CURLOPT_POST, 'POST');
        curl_setopt($dh, CURLOPT_POSTFIELDS, $data);
        curl_setopt($dh, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($dh, CURLOPT_NOSIGNAL, 1);
        curl_setopt($dh, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($dh, CURLOPT_TIMEOUT, 0); //timeout in seco
        curl_setopt($dh, CURLOPT_FAILONERROR, true);
        $respon = curl_exec($dh);
        // print_r(curl_getinfo($dh));
        //echo "<pre>";
        //var_dump(($respon));
        //var_dump(json_decode($respon)->rcode);
        //echo "</pre>";
        //die();
        //$info = curl_getinfo($dh,  CURLINFO_HEADER_OUT);

        if (curl_error($dh)) {
            $error_msg = curl_error($dh);
            $responData = array('rCode' => '99', 'data' => $error_msg);
            // echo "<pre>";
            // var_dump(($responData));
            //var_dump(json_decode($respon)->rcode);
            //echo "</pre>";
            //die();
            curl_close($dh);
        } 
        else 
        {
            curl_close($dh);
            $myrcode = (isset(json_decode($respon)->rcode)) ?  json_decode($respon)->rcode :  '00' ;
            //echo "<pre>";
            //var_dump($respon);
            //var_dump($myrcode);
            //echo "</pre>";
            //die();
            // if ($respon) {

            // if (!isset($myrcode)  ) 
            // {
            //     $responData = array('rCode' => $myrcode, 'data' => json_decode($respon));
            // } 
            // else {

            //     $responData = array('rCode' => '99', 'data' => $respon);
            // }
            $responData = array('rCode' => $myrcode, 'data' => json_decode($respon));
        }
        return $responData;
    }

    static public function Terbilang($nilai) {
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if($nilai==0){
            return "";
        }elseif ($nilai < 12&$nilai!=0) {
            return "" . $huruf[$nilai];
        } elseif ($nilai < 20) {
            return KonHelpers::Terbilang($nilai - 10) . " Belas ";
        } elseif ($nilai < 100) {
            return KonHelpers::Terbilang($nilai / 10) . " Puluh " . KonHelpers::Terbilang($nilai % 10);
        } elseif ($nilai < 200) {
            return " Seratus " . KonHelpers::Terbilang($nilai - 100);
        } elseif ($nilai < 1000) {
            return KonHelpers::Terbilang($nilai / 100) . " Ratus " . KonHelpers::Terbilang($nilai % 100);
        } elseif ($nilai < 2000) {
            return " Seribu " . KonHelpers::Terbilang($nilai - 1000);
        } elseif ($nilai < 1000000) {
            return KonHelpers::Terbilang($nilai / 1000) . " Ribu " . KonHelpers::Terbilang($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            return KonHelpers::Terbilang($nilai / 1000000) . " Juta " . KonHelpers::Terbilang($nilai % 1000000);
        }elseif ($nilai < 1000000000000) {
            return KonHelpers::Terbilang($nilai / 1000000000) . " Milyar " . KonHelpers::Terbilang($nilai % 1000000000);
        }elseif ($nilai < 100000000000000) {
            return KonHelpers::Terbilang($nilai / 1000000000000) . " Trilyun " . KonHelpers::Terbilang($nilai % 1000000000000);
        }elseif ($nilai <= 100000000000000) {
            return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
        }
    } 

    static public function showDataWithPagination($table_name ,$table_join = '' ,  $where = '' , $like = '' ,$short_name , $short_index , $current_page , $page_size){

        
                $CI =& get_instance();

                if($current_page == 1){
                    $offset = 0;
                }else{
                    $offset = ($current_page * $page_size) - $page_size;
                }

                $items = $CI->db->query("SELECT * FROM $table_name $table_join $where $like order by $short_name $short_index LIMIT $page_size OFFSET $offset")->result();

              
                if($like != ''){
                    $count = count($CI->db->query("SELECT * FROM $table_name $where $like")->result());
                }else{
                    $count = count($CI->db->query("SELECT * FROM $table_name $where")->result());
                }

                if(empty($items)){

                    $result = [
                        'results' => $items,
                        'count' => $count,
                        'offset' => $offset,
                        'msg' => 'Gagal ambil data',
                    ];

                }else{

                    $result = [
                        'results' => $items,
                        'count' => $count,
                        'offset' => $offset,
                        'msg' => 'Sukses ambil data',
                    ];
                }

              return $result;

    }


        static public function pembulatan($uang)
        {

         $getuang = number_format($uang , 0 , '.' , '.');
         $newuang = str_replace(".", '', $getuang);
         $puluhribu = substr($newuang, -5 , 5);

         if($puluhribu>10000)
         $akhir = $uang - $puluhribu;
         else
         $akhir = $uang - $puluhribu;
         echo number_format($akhir, 0, ',', '.');;
        }
        // $uang = 133500;
        // pembulatan($uang); // hasilnya adalah 134.000,00

        // //kalau tanpa pembulatan
        // echo number_format($uang, 2, ',', '.');; // hasilnya 133.500,00


}