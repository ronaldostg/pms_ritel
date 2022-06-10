<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datacabang extends CI_Controller {


    public function index(){

        $query = $this->db->query("SELECT * FROM t_cabang order by kd_cab asc")->result();
        $output = [
            'type' => 'success',
            'items' => $query,
        ];
        echo json_encode($output);
       
    }

}