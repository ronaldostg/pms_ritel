<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {


    public function index(){


        echo "DDD";
        die();
        $nm_cabang = $this->session->userdata('nm_cabang');
        $d['nm_cabang'] =$nm_cabang;
        $d['judul']="Laporan Realisasi";
        $d['class'] = "report";
        $d['vue'] = "report";
        $d['content'] = 'site_supervisi/index';
        $this->load->view('home',$d);


    }

    public function cariuser(){


        $kode_cab = $this->input->post('kode_cab');
        $result = $this->db->query("SELECT * FROM t_user where kd_cab = '$kode_cab'")->result();

        echo json_encode($result);

    }

    public function viewdata(){

        $kd_cabang = $this->session->userdata('kd_cabang');
        $user_ao = $this->input->post('user_ao');
        $jenis_guna = $this->input->post('jenis_guna');
        $snd = $this->input->post('snd');
      

        if($user_ao == 'all' || $user_ao == ''){
            $where = "";
        }else{
            $where = "and t_pk.id_user_pic  = '$user_ao'";
        }

        if($jenis_guna == 'all'){
            $where .= '';
        }else{
             $where  .= " and t_master_debitur.jenis_guna = '$jenis_guna'";
        }

        if($snd == 'all'){
            $where .= '';
        }else{
            $where .= " and t_master_debitur.snd = '$snd'";
        }

        $row = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha where t_master_debitur.kode_cabang  = '$kd_cabang' ")->result();

        echo json_encode($row);
        
    }


}