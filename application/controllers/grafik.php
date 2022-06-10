<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends CI_Controller {

    public function index(){

        $nm_cabang = $this->session->userdata('nm_cabang');
        $kd_cabang = $this->session->userdata('kd_cabang');
        $level = $this->session->userdata('level');
        $title1 = '';
        $value1 = 0;
        $title2 = '';
        $value2 = 0;
        $title3 = '';
        $value3 = 0;
        $title4 = '';
        $value4 = 0;
        $title5 = '';
        $value5 = 0;
        $title6 = '';
        $value6 = 0;
        $title7 = '';
        $value7 = 0;
        $title8 = '';
        $value8 = 0;
        $title9 = '';
        $value9 = 0;
        $title10 = '';
        $value10 = 0;

        $month = date('m');


         // echo "<h1>Sedang perbaikan</h1>";
         // echo "<br />";

         // $query = $this->db->query("SELECT t_user.nama_user , SUM(t_pk.nominal) as plafond_akhir FROM t_user inner join t_pk on t_pk.id_user_pic = t_user.id_user where t_pk.status_data = '2' group by t_user.nama_user order by plafond_akhir DESC LIMIT 10")->result();

      //    echo "<pre />";
      //    print_r($query);

      //   die();

        if($_GET['type'] == 'ao'){

            $query = $this->db->query("SELECT t_user.nama_user , SUM(t_pk.nominal) as plafond_akhir FROM t_user inner join t_pk on t_pk.id_user_pic = t_user.id_user inner join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur where t_pk.status_data = '2' and MONTH(tanggal_release) = '$month' group by t_user.nama_user order by plafond_akhir DESC LIMIT 10")->result();
         
   
            $no =1;
          
            foreach($query as $row){

                if($no == 1){
                   $title1 .= $row->nama_user;
                   $value1 += $row->plafond_akhir;
                }
                if($no == 2){
                   $title2 .= $row->nama_user;
                   $value2 += $row->plafond_akhir;
                }
                if($no == 3){
                   $title3 .= $row->nama_user;
                   $value3 += $row->plafond_akhir;
                }
                if($no == 4){
                   $title4.= $row->nama_user;
                   $value4 += $row->plafond_akhir;
                }
                if($no == 5){
                   $title5 .= $row->nama_user;
                   $value5 += $row->plafond_akhir;
                }
                if($no == 6){
                   $title6 .= $row->nama_user;
                   $value6 += $row->plafond_akhir;
                }
                if($no == 7){
                   $title7 .= $row->nama_user;
                   $value7 += $row->plafond_akhir;
                }
                if($no == 8){
                   $title8 .= $row->nama_user;
                   $value8 += $row->plafond_akhir;
                }
                if($no == 9){
                   $title9 .= $row->nama_user;
                   $value9 += $row->plafond_akhir;
                }
                if($no == 10){
                   $title10 .= $row->nama_user;
                   $value10 += $row->plafond_akhir;
                }
                $no++;
            }
         

        }else if($_GET['type'] == 'cabang'){

            // $query = $this->db->query("SELECT t_cabang.nm_cabang , sum(t_master_debitur.plafond_akhir) as plafond_akhir  FROM t_master_debitur inner join t_pk on t_pk.idmasterdebitur = t_master_debitur.id inner join t_cabang on t_cabang.kd_cab = t_master_debitur.kode_cabang where t_cabang.nm_cabang like '%cabang%' and t_pk.status_data = '2' and MONTH(tanggal_release) = '$month' group by t_master_debitur.kode_cabang  LIMIT 10")->result();

            $query = $this->db->query("SELECT   t_cabang.nm_cabang , sum(t_master_debitur.plafond_akhir) as plafond_akhir FROM t_cabang inner join t_master_debitur on t_cabang.kd_cab = t_master_debitur.kode_cabang inner join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where t_cabang.nm_cabang like '%cabang%' and t_pk.status_data = '2' and MONTH(tanggal_release) = '$month' group by t_cabang.nm_cabang order by plafond_akhir DESC limit 10")->result();
            // echo "<pre />";
            // print_r($query);
            // die();
            $no =1;
          
            foreach($query as $row){

                if($no == 1){
                   $title1 .= $row->nm_cabang;
                   $value1 += $row->plafond_akhir;
                }
                if($no == 2){
                   $title2 .= $row->nm_cabang;
                   $value2 += $row->plafond_akhir;
                }
                if($no == 3){
                   $title3 .= $row->nm_cabang;
                   $value3 += $row->plafond_akhir;
                }
                if($no == 4){
                   $title4.= $row->nm_cabang;
                   $value4 += $row->plafond_akhir;
                }
                if($no == 5){
                   $title5 .= $row->nm_cabang;
                   $value5 += $row->plafond_akhir;
                }
                if($no == 6){
                   $title6 .= $row->nm_cabang;
                   $value6 += $row->plafond_akhir;
                }
                if($no == 7){
                   $title7 .= $row->nm_cabang;
                   $value7 += $row->plafond_akhir;
                }
                if($no == 8){
                   $title8 .= $row->nm_cabang;
                   $value8 += $row->plafond_akhir;
                }
                if($no == 9){
                   $title9 .= $row->nm_cabang;
                   $value9 += $row->plafond_akhir;
                }
                if($no == 10){
                   $title10 .= $row->nm_cabang;
                   $value10 += $row->plafond_akhir;
                }
                $no++;
            }

        }else{


         $query = $this->db->query("SELECT   t_cabang.nm_cabang , sum(t_master_debitur.plafond_akhir) as plafond_akhir FROM t_cabang inner join t_master_debitur on t_cabang.kd_cab = t_master_debitur.kode_cabang inner join t_pk on t_pk.idmasterdebitur = t_master_debitur.id where t_cabang.nm_cabang like '%capem%' and t_pk.status_data = '2' and MONTH(tanggal_release) = '$month' group by t_cabang.nm_cabang order by plafond_akhir DESC limit 10")->result();
            $no =1;
          
            foreach($query as $row){

                if($no == 1){
                   $title1 .= $row->nm_cabang;
                   $value1 += $row->plafond_akhir;
                }
                if($no == 2){
                   $title2 .= $row->nm_cabang;
                   $value2 += $row->plafond_akhir;
                }
                if($no == 3){
                   $title3 .= $row->nm_cabang;
                   $value3 += $row->plafond_akhir;
                }
                if($no == 4){
                   $title4.= $row->nm_cabang;
                   $value4 += $row->plafond_akhir;
                }
                if($no == 5){
                   $title5 .= $row->nm_cabang;
                   $value5 += $row->plafond_akhir;
                }
                if($no == 6){
                   $title6 .= $row->nm_cabang;
                   $value6 += $row->plafond_akhir;
                }
                if($no == 7){
                   $title7 .= $row->nm_cabang;
                   $value7 += $row->plafond_akhir;
                }
                if($no == 8){
                   $title8 .= $row->nm_cabang;
                   $value8 += $row->plafond_akhir;
                }
                if($no == 9){
                   $title9 .= $row->nm_cabang;
                   $value9 += $row->plafond_akhir;
                }
                if($no == 10){
                   $title10 .= $row->nm_cabang;
                   $value10 += $row->plafond_akhir;
                }
                $no++;
            }

        }

        $d['title1'] = $title1;
        $d['value1'] = $value1;
        $d['title2'] = $title2;
        $d['value2'] = $value2;
        $d['title3'] = $title3;
        $d['value3'] = $value3;
        $d['title4'] = $title4;
        $d['value4'] = $value4;
        $d['title5'] = $title5;
        $d['value5'] = $value5;
        $d['title6'] = $title6;
        $d['value6'] = $value6;
        $d['title7'] = $title7;
        $d['value7'] = $value7;
        $d['title8'] = $title8;
        $d['value8'] = $value8;
        $d['title9'] = $title9;
        $d['value9'] = $value9;
        $d['title10'] = $title10;
        $d['value10'] = $value10;


        // echo "<pre />";
        // print_r($d);
        // die();
        $d['nm_cabang'] =$nm_cabang;
        $d['level'] =$level;
        $d['judul']="Grafik";
        $d['class'] = "grafik";
        $d['content'] = 'grafik_new/index';
        $this->load->view('home',$d);

    }

}