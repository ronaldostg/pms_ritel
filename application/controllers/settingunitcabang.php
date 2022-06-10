<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settingunitcabang extends CI_Controller {


    public function index(){

        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$nm_cabang = $this->session->userdata('nm_cabang');

        if(!empty($cek) && $level=='admin'){

            $d['nm_cabang'] =$nm_cabang;
			$d['judul']="Setting Unit Cabang";
			$d['class'] = "masterdebitur";
            $d['vue'] = "settingunitcabang";
			
			$d['content'] = 'masterdebitur/v_settingcabang.php';
			$this->load->view('home',$d);

        }else{
            redirect('login','refresh');
        }

      
    }

    public function update(){

        $cabangunits = $_POST['cabangunits'];
        $iddata = $_POST['iddata'];
        $jumlahdata = count($cabangunits);
    
        for($i = 0; $i < $jumlahdata ; $i++){

            $idprimary = $iddata[$i];
            $data = array(
                'tanggal_update' => date('Y-m-d'),
                'kode_cabang' => $cabangunits[$i],
                'tanggal_snd_update' => date('Y-m-d H:i:s'),
            );
        
            $this->db->where('id', $idprimary );
            $this->db->update('t_master_debitur', $data);



        }
        $this->session->set_flashdata('msg', "Berhasil update kode cabang");
        redirect('/index.php/settingunitcabang');


    }


}