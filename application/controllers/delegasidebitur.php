<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delegasidebitur extends CI_Controller {


    public function index(){


        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$nm_cabang = $this->session->userdata('nm_cabang');
        $akses = $this->session->userdata('akses');

        $kd_cb = $this->session->userdata('kd_cabang');
        $userao =  $this->model_data->ambil_user_ao($kd_cb);


        $hitungsemuadatadebitur = count($this->db->query("SELECT * FROM t_master_debitur")->result());
        $hitungyangudaadapetugas = count($this->db->query("SELECT * FROM t_master_debitur where user_petugas != ''")->result());

        $instansi = $this->db->query("SELECT nama_instansi FROM t_master_debitur where kode_cabang = '$kd_cb' and status_prospek != '1' GROUP BY nama_instansi")->result();

        if($hitungsemuadatadebitur == $hitungyangudaadapetugas){

            $btn = false;
        }else{
            $btn = true;
        }

        // var_dump($instansi);

        // die();

        if(!empty($cek) && $level == 'admin' || !empty($cek) && $level == 'supervisi'){

            $d['nm_cabang'] =$nm_cabang;
            $d['judul']="Delegasi Debitur";
            $d['class'] = "masterdebitur";
            $d['vue'] = "delegasidebitur";
            $d['userao'] = $userao;
            $d['btndelegasi'] = $btn;
            $d['instansi'] = $instansi;
            
            $d['content'] = 'masterdebitursupervisi/v_delegasidebitur';
            $this->load->view('home',$d);

        }else{
            redirect('login' , 'refresh');
        }

    }

    public function user_ao(){
        $this->load->model('model_data');
        $data = json_decode(file_get_contents("php://input"));

      
        if($data->kd_cab != ''){
            $res = $this->model_data->ambil_user_ao($data->kd_cab);
        }else{
            $kd_cb = $this->session->userdata('kd_cabang');
            $res =  $this->model_data->ambil_user_ao($kd_cb);
        }
        $output = [ 
            'type' => 'ok',
            'items' => $res,
            'count'=> count($res),
        ];

        echo json_encode($output);
    }

    public function get_data_master(){

        $data = json_decode(file_get_contents("php://input"));

        $kodecabang = $this->session->userdata('kd_cabang');
        $pageSize = $data->pageSize;
        $currentPage = $data->currentPage;
        $text_cari = $data->textCari;
        $nama_instansi = $data->nama_instansi;


        if($text_cari != ''){
                    
            $like = "and nik_debitur LIKE '%" .$text_cari. "%' or nama_debitur LIKE '%" .$text_cari. "%'";

        }else{
            $like = "";
        }
        
        $where = "where t_master_debitur.kode_cabang = '$kodecabang' and t_master_debitur.status_prospek in (2,3,4,5,6,7)";
       // $where = "where t_master_debitur.kode_cabang = '$kodecabang' and t_master_debitur.status_prospek in (2,3,4,5,6,7) and nama_instansi = '$nama_instansi'";
    
        $query =  KonHelpers::showDataWithPagination('t_master_debitur' , "left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang", $where ,$like , 'id' , 'desc' , $currentPage , $pageSize);
       
        echo json_encode($query);

    }

    public function proses(){

        $data = json_decode(file_get_contents("php://input"));

        $id = $data->iddata;
        $userinput = $data->userinput;
        $exuserinput = explode('-' , $userinput);
        $iduserpic = $exuserinput[0];
        $namauserpic = $exuserinput[1];
        $username= $this->session->userdata('username');

        $this->load->model('model_data');
        $Detail = $this->model_data->detail_master_debitur($id);
        $kdcabang = $Detail->kode_cabang;
        $kd_bidang_usaha = $Detail->kd_bidang_usaha;
        $no_telepon = $Detail->no_telepon;
        $no_handphone = $Detail->no_handphone;
        $email = $Detail->email;
        $kategori_debitur = $Detail->kategori_debitur;
        $nama_debitur = strtoupper($Detail->nama_debitur);
        $alamat = strtoupper($Detail->alamat);

        // === UPDATE STATUS
        $data = array(
            'user_petugas' => $iduserpic,
            'status_prospek' => 4,
            'user_supervisi' => $username,
            'tanggal_supervisi' => date('Y-m-d H:i:s'),
        );
    
        $res = $this->db->where('id', $id );
        $res = $this->db->update('t_master_debitur', $data);

        // ADD TO PROSPEK
        $data2 = array(
            'kd_cab' => $kdcabang,
            'nama_prospek' => $nama_debitur,
            'alamat_prospek' => $alamat,
            'kode_status' => $kategori_debitur,
            'kd_bidang_usaha' => $kd_bidang_usaha,
            'telp' => $no_telepon,
            'hp' => $no_handphone,
            'email' => $email,
            'pic_prospek' => $namauserpic,
            'id_user_input' => $iduserpic,
            'id_user_pic' => $iduserpic,
            'tgl_input' => date('Y-m-d H:i:s'),
            'status_data' => 0,
            'tgl_status_data' => date('Y-m-d H:i:s'),
            'id_masterdebitur' => $id,
        );
    
        $this->db->insert('t_prospek', $data2);

     
        $output = [ 
            'type' => 'ok',
            'message' => 'Sukses update data ! Data telah masuk ke tahap prospek!',
        ];

        echo json_encode($output);

        // 


    }   

    public function delegasiallsemuaao(){

        $this->load->model('model_data');
        $userao = $this->input->post("userao");
        $nama_instansi = $this->input->post("nama_instansi");
        $username= $this->session->userdata('username');

        $namaao = KonHelpers::joinGampang('t_user' , 'id_user' , $userao , 'nama_user');

        $query = $this->db->query("SELECT * FROM t_master_debitur where nama_instansi = '$nama_instansi'")->result();



        // === UPDATE STATUS
        $data = array(
            'user_petugas' => $userao,
            'status_prospek' => 4,
            'user_supervisi' => $username,
            'tanggal_supervisi' => date('Y-m-d H:i:s'),
        );

        $res = $this->db->where('nama_instansi', $nama_instansi );
        $res = $this->db->update('t_master_debitur', $data);

        if($res){
            $count = 0;
            foreach($query as $row){

                $idprimary = $row->id;
                $kdcabang = $row->kode_cabang;
                // $kd_bidang_usaha = $row->kd_bidang_usaha;
                $no_telepon = $row->no_telepon;
                $no_handphone = $row->no_handphone;
                $email = $row->email;
                $kategori_debitur = $row->kategori_debitur;
                $nama_debitur = strtoupper($row->nama_debitur);
                $alamat = strtoupper($row->alamat);

                $data2 = array(
                    'kd_cab' => $kdcabang,
                    'nama_prospek' => $nama_debitur,
                    'alamat_prospek' => $alamat,
                    'kode_status' => $kategori_debitur,
                    'telp' => $no_telepon,
                    'hp' => $no_handphone,
                    'email' => $email,
                    'id_user_input' => $userao,
                    'id_user_pic' => $userao,
                    'tgl_input' => date('Y-m-d H:i:s'),
                    'status_data' => 0,
                    'tgl_status_data' => date('Y-m-d H:i:s'),
                    'id_masterdebitur' => $idprimary,
                );
                
                $this->db->insert('t_prospek', $data2);

                $count += 1;

            }

            $this->session->set_flashdata('msg', "Berhasil mendelegasi data debitur pada $nama_instansi ke account officer $namaao ! $count Data telah masuk ke tahap prospek untuk account officer $namaao!");

        }else{


            $this->session->set_flashdata('msg', "Gagal delegasi user");

        }

       
        redirect('/index.php/delegasidebitur');


    }

    public function delegasiall(){


        $this->load->model('model_data');
        $iddata = $_POST['iddata'];
        $userao = $_POST['userao'];
        $jumlahdata = count($iddata);
        $jumlahdatauserao = count($userao);
        $username= $this->session->userdata('username');
       

        // var_dump($userao);
        // die();
     
        // if(in_array("" , $userao)){

        //     $this->session->set_flashdata('msg', "Ada user ao yang masih kosong");

        // }else{
      

            $suksesnumber = 0;
            $cekuserao = 0;
            for($i = 0; $i < $jumlahdata ; $i++){

                    $idprimary = $iddata[$i];
                    $userid = $userao[$i];

                    $testnama = KonHelpers::joinGampang('t_master_debitur' , 'id' , $idprimary , 'nama_debitur');

                    // echo $testnama;
                    // die();

                    if($userid != ""){

                            $cekuserao += 1;

                            $Detail = $this->model_data->detail_master_debitur($idprimary);
                            $kdcabang = $Detail->kode_cabang;
                            $kd_bidang_usaha = $Detail->kd_bidang_usaha;
                            $no_telepon = $Detail->no_telepon;
                            $no_handphone = $Detail->no_handphone;
                            $email = $Detail->email;
                            $kategori_debitur = $Detail->kategori_debitur;
                            $nama_debitur = strtoupper($Detail->nama_debitur);
                            $alamat = strtoupper($Detail->alamat);

                                
                            // === UPDATE STATUS
                            $data = array(
                                'user_petugas' => $userid,
                                'status_prospek' => 4,
                                'user_supervisi' => $username,
                                'tanggal_supervisi' => date('Y-m-d H:i:s'),
                            );
                        
                            $res = $this->db->where('id', $idprimary );
                            $res = $this->db->update('t_master_debitur', $data);

                            if($res){

                                $suksesnumber +=1;

                                // ADD TO PROSPEK
                                $data2 = array(
                                    'kd_cab' => $kdcabang,
                                    'nama_prospek' => $nama_debitur,
                                    'alamat_prospek' => $alamat,
                                    'kode_status' => $kategori_debitur,
                                    'kd_bidang_usaha' => $kd_bidang_usaha,
                                    'telp' => $no_telepon,
                                    'hp' => $no_handphone,
                                    'email' => $email,
                                    'id_user_input' => $userid,
                                    'id_user_pic' => $userid,
                                    'tgl_input' => date('Y-m-d H:i:s'),
                                    'status_data' => 0,
                                    'tgl_status_data' => date('Y-m-d H:i:s'),
                                    'id_masterdebitur' => $idprimary,
                                );
                                
                                $this->db->insert('t_prospek', $data2);

                            }else{

                                $suksesnumber +=0;
                                

                            }
                       
                    }
                  
                  

                

            }

          

            $this->session->set_flashdata('msg', "Berhasil mendelegasi ke $suksesnumber user ! $suksesnumber Data telah masuk ke tahap prospek!");

        // }

      
            redirect('/index.php/delegasidebitur');


    }

    public function updateuserao(){


        $useao = $_POST['useao'];
        $id_master = $_POST['id_master'];

        if($this->db->query("UPDATE t_master_debitur set user_petugas = '$useao' where id = '$id_master'")){

            $this->session->set_flashdata('msg', "Berhasil update user petugas");

        }else{

            $this->session->set_flashdata('msg', "Gagal update user petugas");


        }

        redirect('/index.php/delegasidebitur');

    }


}