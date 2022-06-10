<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemenuser extends CI_Controller {


    public function index(){

        $nm_cabang = $this->session->userdata('nm_cabang');
        $level = $this->session->userdata('level');
		$username = $this->session->userdata('username');

        $d['nm_cabang'] =$nm_cabang;	
        $d['judul']="Manajemen User";
        $d['class'] = "manajemenuser";
        $d['vue'] = "manajemeusersupervisi";

   
        $query = $this->db->query("SELECT * FROM admins inner join t_cabang on t_cabang.kd_cab = admins.kd_cab where admins.kategori_admin = '1'")->result();
        $d['items'] = $query;

        
        $d['content']= 'manajemenuser/supervisi';
        $this->load->view('home',$d);

    }

    public function userao(){

        $nm_cabang = $this->session->userdata('nm_cabang');
        $level = $this->session->userdata('level');
		$username = $this->session->userdata('username');

        $d['nm_cabang'] =$nm_cabang;	
        $d['judul']="Manajemen User";
        $d['class'] = "manajemenuser";
        $d['vue'] = "manajemeuser";

        if($level == 'supervisi'){
            $where = "where id_user_supervisi1 = '$username'";
        }else{
            $where = "";
        }
        $query = $this->db->query("SELECT * FROM t_user inner join t_cabang on t_cabang.kd_cab = t_user.kd_cab $where")->result();
        $d['items'] = $query;

        
        $d['content']= 'manajemenuser/userao';
        $this->load->view('home',$d);

    }



    public function get_user(){

        $query = $this->db->query("SELECT * FROM t_user inner join t_cabang on t_cabang.kd_cab = t_user.kd_cab")->result();
        echo json_encode($query);

    }

    public function adduser(){

    	$kd_cabang = $this->session->userdata('kd_cabang');
    	$username = $this->session->userdata('username');
        $level = $this->session->userdata('level');

        $iduser = $this->input->post('username');
        $cekdatauser = $this->db->query("SELECT * FROM t_user where id_user = '$iduser'")->row();

   
        $dt['kd_cab'] = $this->input->post('kode_cabang');

        $kde_cab = $this->input->post('kode_cabang');
        $getsupervisi = $this->db->query("select * from admins where kd_cab = '$kde_cab' and kategori_admin = '1'")->row();
        $idsupervisi = $getsupervisi->username;
        $dt['id_user_supervisi1'] = $idsupervisi;
        
        // if($level == 'supervisi'){
        //     $dt['kd_cab'] = $this->input->post('kode_cabang');
        //     $dt['id_user_supervisi1'] = $username;

        // }else{
        //     $dt['kd_cab'] = $this->input->post('kode_cabang');

        //     $kde_cab = $this->input->post('kode_cabang');
        //     $getsupervisi = $this->db->query("select * from admins where kd_cab = '$kde_cab' and kategori_admin = '1'")->row();
        //     $idsupervisi = $getsupervisi->username;
        //     $dt['id_user_supervisi1'] = $idsupervisi;

        // }

        $dt['id_user'] = $this->input->post('username');
        $dt['id_user_supervisi1'] = $this->input->post('supervisi');
        $dt['nama_user'] = $this->input->post('nama_lengkap');
        $dt['status_user'] = 1;
        $dt['level'] = 'user';
        if(!empty($this->input->post('password'))){
            $dt['password'] = md5($this->input->post('password'));
        }
        
        if(!empty($cekdatauser)){
            $id['id_user']  = $this->input->post('username');
            $res = $this->db->update("t_user",$dt , $id);

        }else{
            $res = $this->db->insert("t_user",$dt);
        }
        if($res){

            echo json_encode("Data berhasil tersimpan");

        }
        
        // echo json_encode($d);

    }

    public function showuser(){

        $iduser =  $this->input->post('id_user');
        $query = $this->db->query("SELECT * FROM t_user where id_user = '$iduser'")->row();

        echo json_encode($query);

    }

    public function showusersupervisi(){

        $iduser =  $this->input->post('id_user');
        $query = $this->db->query("SELECT * FROM admins where username = '$iduser'")->row();

        echo json_encode($query);

    }

    public function deleteuser(){

        $id['id_user'] =  $this->input->post('id_user');
       
        if($this->db->delete("t_user",$id)){

            echo json_encode("Data berhasil terhapus");

        }

    }

    public function deleteusersupervisi(){

        $id['username'] =  $this->input->post('id_user');
       
        if($this->db->delete("admins",$id)){

            echo json_encode("Data berhasil terhapus");

        }

    }

    public function addusersupervisi(){

        $iduser = $this->input->post('username');
        $cekdatauser = $this->db->query("SELECT * FROM admins where username = '$iduser'")->row();


        $dt['username'] = $this->input->post('username');
        $dt['nama_lengkap'] = $this->input->post('nama_lengkap');
        $dt['kd_cab'] = $this->input->post('kode_cabang');
        $dt['kategori_admin'] = 1;
    
        if(!empty($this->input->post('password'))){
            $dt['password'] = md5($this->input->post('password'));
        }
        
        if(!empty($cekdatauser)){
            $id['username']  = $this->input->post('username');
            $res = $this->db->update("admins",$dt , $id);

        }else{
            $res = $this->db->insert("admins",$dt);
        }
        if($res){

            echo json_encode("Data berhasil tersimpan");

        }


    }

  



}