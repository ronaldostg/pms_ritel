<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajukansupervisisnd extends CI_Controller {


    public function index(){
       
        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$nm_cabang = $this->session->userdata('nm_cabang');

        if(!empty($cek) && $level=='admin' || !empty($cek) && $level == 'supervisi'){
            $d['nm_cabang'] =$nm_cabang;
			$d['judul']="Ajuan Ke Supervisi SND";
			$d['class'] = "masterdebitur";
            $d['vue'] = "ajukansupervisisnd";
			
			$d['content'] = 'masterdebitur/v_ajukansnd';
			$this->load->view('home',$d);
        }else{
            redirect('login','refresh');
        }

    }

    public function getDatamasterdebitur(){
        // $cek = $this->session->userdata('logged_in');
		// $level = $this->session->userdata('level');
        // if(!empty($cek) && $level=='admin' || !empty($cek) && $level == 'supervisi'){

            $data = json_decode(file_get_contents("php://input"));
            
            
            $pageSize = $data->pageSize;
            $currentPage = $data->currentPage;
            $text_cari = $data->textCari;
            $provinsi = strtolower($data->provinsi);
            $kabupaten = strtoupper($data->kabupaten);
            $getkodeKab = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $kabupaten , 'kode_wilayah');

           
            // if($provinsi != '' AND $kabupaten != ''){
                
                if($text_cari != ''){
                    
                    $like = "and nik_debitur LIKE '%" .$text_cari. "%' or nama_debitur LIKE '%" .$text_cari. "%'";

                }else{
                    $like = "";
                }

                $where = "where t_master_debitur.kode_wilayah = '$getkodeKab' and t_master_debitur.status_prospek = '1'";
                $items = KonHelpers::showDataWithPagination('t_master_debitur' , "left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang", $where , $like , 'id' , 'desc' , $currentPage , $pageSize);

            // }else{

            //     if($text_cari != ''){
                    
            //         $like = "and nik_debitur LIKE '%" .$text_cari. "%' or nama_debitur LIKE '%" .$text_cari. "%'";

            //     }else{
            //         $like = "";
            //     }
              

            //     $where = "where t_master_debitur.kode_cabang != '' and t_master_debitur.status_prospek = '1'";

            //     $items = KonHelpers::showDataWithPagination('t_master_debitur' , "left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang", $where , $like , 'id' , 'desc' , $currentPage , $pageSize);

            // }

    

           echo json_encode($items);

        // }else{
        //     redirect('login','refresh');
        // }
    }

    public function ajukan(){

       $iddata = $_POST['iddata'];
       $kabupaten = $_POST['kabupaten'];
       $jumlahdata = count($iddata);

        $kodekabupaten =  KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $kabupaten , 'kode_wilayah');

        $datainkabupatenselected = $this->db->where("kode_wilayah" ,$kodekabupaten )->where("status_prospek" , "1")->get("t_master_debitur")->num_rows();
        // print_r($datainkabupatenselected);
        // die();
     
        $data = array(
            'status_prospek' => '2',
            'tanggal_update' => date('Y-m-d'),
            'tanggal_snd_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where(['kode_wilayah'=> $kodekabupaten , 'status_prospek' => '1']);
        if($this->db->update('t_master_debitur', $data)){
            $this->session->set_flashdata('msg', "Berhasil menyebarkan $datainkabupatenselected pada wilayah $kabupaten");
        }else{
            $this->session->set_flashdata('msg', "Gagal menyebarkan $datainkabupatenselected pada wilayah $kabupaten");
        }
    
        redirect('/index.php/supervisiapprove');


    }

}