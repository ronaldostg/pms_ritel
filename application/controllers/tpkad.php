<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tpkad extends CI_Controller {

    public function index(){
  




     

        // echo $result_url;

        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$nm_cabang = $this->session->userdata('nm_cabang');
		if(!empty($cek) && $level=='admin' || !empty($cek) && $level=='supervisi'){
			$d['nm_cabang'] =$nm_cabang;
			$d['judul']="Pengajuan Kredit TPKAD";
			$d['class'] = "master";
			$d['vue'] = "";
			$d['content'] = 'tpkad/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}





    }
}