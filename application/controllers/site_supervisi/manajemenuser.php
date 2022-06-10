<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemenuser extends CI_Controller {

	
	public function index()
	{
		$nm_cabang = $this->session->userdata('nm_cabang');
		$username = $this->session->userdata('username');

        $d['nm_cabang'] =$nm_cabang;	
        $d['judul']="Manajemen User";
        $d['class'] = "manajemenuser";
        $d['vue'] = "manajemeusersupervisi";

    
        $query = $this->db->query("SELECT * FROM t_user inner join t_cabang on t_cabang.kd_cab = t_user.kd_cab where id_user_supervisi1 = '$username'")->result();
        $d['items'] = $query;

        
        $d['content']= 'site_supervisi/manajemenuser/index';
        $this->load->view('site_supervisi/home',$d);

    }

    public function get_user(){

        $query = $this->db->query("SELECT * FROM t_user inner join t_cabang on t_cabang.kd_cab = t_user.kd_cab")->result();
        echo json_encode($query);

    }

    public function adduser(){

    	$kd_cabang = $this->session->userdata('kd_cabang');
    	$username = $this->session->userdata('username');
        $dt['kd_cab'] = $kd_cabang;
        $dt['id_user'] = $this->input->post('username');
        $dt['nama_user'] = $this->input->post('nama_lengkap');
        $dt['password'] = md5($this->input->post('password'));
        $dt['id_user_supervisi1'] = $username;
	    
        
        if($this->db->insert("t_user",$dt)){

            echo json_encode("Data berhasil tersimpan");

        }
        
        // echo json_encode($d);

    }

    public function deleteuser(){

        $id['id_user'] =  $this->input->post('id_user');
       
        if($this->db->delete("t_user",$id)){

            echo json_encode("Data berhasil terhapus");

        }

    }

}