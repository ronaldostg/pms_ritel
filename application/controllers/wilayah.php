<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wilayah extends CI_Controller {


    public function index(){

        $query = $this->db->query("SELECT * FROM pembagian_wilayah")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode_wilayah;
            if(strlen($kodewilayah) == 2){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode_wilayah,
                    'wilayah' => $dt->nama_wilayah,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);
       
    }

    public function kabupaten(){

        $data = json_decode(file_get_contents("php://input"));

        $provinsi = strtolower($data->provinsi);
        $query = $this->db->query("SELECT * FROM pembagian_wilayah where provinsi = '$provinsi'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode_wilayah;
            if(strlen($kodewilayah) == 4){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode_wilayah,
                    'wilayah' => $dt->nama_wilayah,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);

        
    }

    public function kabupaten2(){

       $kode_wilayah = $_POST['provinsi'];
       $provinsi = KonHelpers::joinGampang('pembagian_wilayah' , 'kode_wilayah' , $kode_wilayah , 'provinsi');
       $provinsi = strtolower($provinsi);
       $query = $this->db->query("SELECT * FROM pembagian_wilayah where provinsi = '$provinsi'")->result();
       $output = array(
           "success" => false,
           "items" => array()
       );
       foreach($query as $dt){
           $kodewilayah  = $dt->kode_wilayah;
           if(strlen($kodewilayah) == 4){
               $output['items'][] = array(
                   'kode_wilayah' => $dt->kode_wilayah,
                   'wilayah' => $dt->nama_wilayah,
                 );
           }
       }
       $output['success'] = true; // if you want to update `status` as well
       echo json_encode($output);

    }

    public function kecamatan(){

        $data = json_decode(file_get_contents("php://input"));

        $kabkota = strtolower($data->kabkota);
        $query = $this->db->query("SELECT * FROM pembagian_wilayah where kab_kota = '$kabkota'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode_wilayah;
            if(strlen($kodewilayah) == 6){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode_wilayah,
                    'wilayah' => $dt->nama_wilayah,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);

        
    }

    public function kelurahan(){

        $kecamatan = strtolower($_POST['kecamatan']);
        $query = $this->db->query("SELECT * FROM pembagian_wilayah where kecamatan = '$kecamatan'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode_wilayah;
            if(strlen($kodewilayah) == 10){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode_wilayah,
                    'wilayah' => $dt->nama_wilayah,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);

    }

    public function kecamatan2(){
       $kabkota = strtolower($_POST['kabkota']);
       $query = $this->db->query("SELECT * FROM pembagian_wilayah where kab_kota = '$kabkota'")->result();
       $output = array(
           "success" => false,
           "items" => array()
       );
       foreach($query as $dt){
           $kodewilayah  = $dt->kode_wilayah;
           if(strlen($kodewilayah) == 6){
               $output['items'][] = array(
                   'kode_wilayah' => $dt->kode_wilayah,
                   'wilayah' => $dt->nama_wilayah,
                 );
           }
       }
       $output['success'] = true; // if you want to update `status` as well
       echo json_encode($output);

    }

    public function kelurahanShow(){
        $kecamatan = $_POST['kecamatan'];
        $query = $this->db->query("SELECT * FROM pembagian_wilayah where kecamatan = '$kecamatan'")->result();
        $output = array(
            "success" => false,
            "items" => array()
        );
        foreach($query as $dt){
            $kodewilayah  = $dt->kode_wilayah;
            if(strlen($kodewilayah) == 10){
                $output['items'][] = array(
                    'kode_wilayah' => $dt->kode_wilayah,
                    'wilayah' => $dt->nama_wilayah,
                  );
            }
        }
        $output['success'] = true; // if you want to update `status` as well
        echo json_encode($output);
 
     }

    

}