<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testingkoding extends CI_Controller {

    
    public function index(){

        // $data = [
        //     'username'  => 'u2852',
        //     'password'  => '21232f297a57a5a743894a0e4a801fc3',
        //     'nama_lengkap'  => 'Aad',
        //     'kd_cab'  => '001',
        //     'kategori_admin'  => 2,
        // ];
        $data = [
            // 'id'  => 189281,
            'jenis_debitur'  => 2,
            'nama_debitur'  => 'RINTISAN DAKHI',
            'nik_debitur'  => '1204165512540001',
            'alamat'  => 'JL. DIPONEGORO DESA FODO KEC. GUNUNGSITOLI SELATAN KOTA GUNUNGSITOLI.',
            'no_telepon'  => '085261352255',
            'no_handphone'  => '085261352255',
            'kode_wilayah'  => 1278,
            'status_prospek'  => 7,
            'tanggal_input'  => '2021-10-29',
            'tanggal_update'  => '2021-10-29',
            'tanggal_snd_update'  => '2021-10-29 19:20:06',
            'jenis_kredit'  => 'KUR Ritel Investasi',
            'cif'  => '0100945548',
            'gaji_bruto'  => 11100000,
            // 'nama_instansi'  => 2,
            // 'snd'  => 2,
            'no_rekening_pinjaman'  => '27005890000132',
            'jenis_guna'  => 'Konsumtif',
            'baki_debet_lama'  => 0,
            'sisa_baki_debet'  => 100000000,
            'plafond_akhir'  => 100000000,
        ];
        
      
          // $query = $this->db->query("DESC t_pk")->result();
          // $query = $this->db->query("SHOW TABLES")->result();

      //  $query = $this->db->query("DELETE FROM t_master_debitur where kode_wilayah = '1208' and tanggal_input = '2021-11-09' and user_snd = 'u2852'");
      //  $query = $this->db->query("DELETE FROM t_master_debitur where kode_wilayah = '1208' and tanggal_input = '2021-11-09' and user_snd = 'u2852'");
      //  $query = $this->db->query("SELECT * FROM t_master_debitur where kode_wilayah = '1217' and tanggal_input = '2021-11-10'")->result();
      // $query = $this->db->query("UPDATE t_master_debitur set snd = '3' where user_petugas like '%b3490%'");
      // $query = $this->db->query("SELECT * FROM t_master_debitur where user_petugas like '%CMO303%'")->result();


      $query = $this->db->query("SELECT * FROM t_master_debitur where nik_debitur like '%1224076711840001%'")->result();

      //  echo count($query);
      //  die();


          // $query = $this->db->query("SHOW TABLES")->result();
        // $query = $this->db->query("SELECT * FROM pembagian_wilayah where nama_wilayah like '%samosir%'")->result();
       // $query = $this->db->query("SELECT * FROM t_master_debitur where kode_wilayah = '1208' and tanggal_input = '2021-09-11'")->result();
        // /$query = $this->db->query("SELECT * FROM t_master_debitur where nama_debitur like '%NIA ARWI%'")->result();
        //$query = $this->db->query("SELECT * FROM t_master_debitur where kode_wilayah = ''")->result();
       // $query = $this->db->query("SELECT * FROM t_master_debitur where id  = '189281'")->result();
        //$query = $this->db->query("SELECT * FROM t_master_debitur limit 1")->result();
       // $query = $this->db->query("SELECT * FROM t_master_debitur where kode_wilayah = '1278' limit 5")->result();
        //$query = $this->db->query("SELECT * FROM t_prospek where nama_prospek like '%rintisan dakhi%'")->result();
        //$query = $this->db->query("SELECT * FROM t_pk where idmasterdebitur  = '189281'")->result();


       //$query = $this->db->query("SELECT * FROM t_user where id_user = 'u3621'")->result(); 

         //$query = $this->db->insert( 'admins' , $data , ["username" => "u2852"]);
         //$query = $this->db->insert( 't_master_debitur' , $data);
        // $query = $this->db->update( 't_master_debitur' , $data , ["id" => '189281']);


        //$query = $this->db->query("SELECT * FROM t_master_debitur where id = '189184'")->result();
       // $query = $this->db->query("DELETE FROM t_master_debitur where id = '189184'");
        //$query = $this->db->query("SELECT * FROM t_master_debitur where id = '189184'")->result();
        //$query = $this->db->query("SELECT * FROM t_master_debitur where nik_debitur = '1205074208680003'")->result();
      // $query = $this->db->query("UPDATE t_master_debitur set snd = '3' where user_petugas = 'CMO314'");

        // $query = $this->db->query("SELECT * FROM t_pk inner join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur where SUBSTR(tanggal_snd_update , 6 ,2) = '11'")->result();
        //$query = $this->db->query("DELETE FROM t_prospek where id_masterdebitur = '189184'");
        //$query = $this->db->query("DELETE FROM t_prospek where nama_prospek like '%LEGIYEM%'");
        //$query = $this->db->query("SELECT * FROM t_prospek where id_prospek  = '32428'")->result();
        // $query = $this->db->query("SELECT * FROM t_analisa where id_prospek  = '32428'")->result();
        //$query = $this->db->query("SELECT * FROM t_pk where id_user_pic  = 'u2916'")->result();
       // $query = $this->db->query("UPDATE t_prospek set status_data = '0' where id_prospek = '32428'");
        //$query = $this->db->query("DELETE FROM t_analisa where id_prospek  = '32428'");
        //$query = $this->db->query("DELETE FROM t_pk where id_prospek  = '32428'");
        

        //$query = $this->db->query("SELECT * FROM t_prospek where nama_prospek like '%rintisan dakhi%'")->result();



        //$query = $this->db->query("SELECT * FROM admins where username = 'b1458'")->result();
        //$query = $this->db->query("SELECT * FROM t_user where id_user = 'u2917'")->result();
        //$query = $this->db->query("UPDATE t_user set id_user_supervisi1 = 'u1309' where id_user = 'u3621'");
        //$query = $this->db->query("SELECT * FROM t_master_debitur LIMIT 1")->result();
        // $query = $this->db->query("SELECT * FROM t_master_debitur where nik_debitur = '1210026606790005'")->result();
        // $query = $this->db->query("UPDATE t_master_debitur set status_prospek = '5' where id = '5675'");
        //$query = $this->db->query("SELECT * FROM t_pk where id_user_pic = 'u2905'")->result();
        //$query = $this->db->query("DELETE FROM t_pk where id_pk = '52'");
        //$query = $this->db->query("UPDATE t_prospek set status_data = '0' where id_prospek = '32138'");
        // $query = $this->db->query("DELETE FROM t_pk where id_prospek = '32132'");
        // $query = $this->db->query("DELETE FROM t_analisa where id_user_pic = 'u2905'");
       // $query = $this->db->query("DELETE FROM t_master_debitur where nik_debitur = '1204165512540001'");

        // $query = $this->db->query("UPDATE t_master_debitur set nik_debitur = '' where nik_debitur = '1210024308740003'");

        // die();
        echo "<pre />";
        print_r($query);


    }


}