<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supervisiapprove extends CI_Controller {


    public function index(){

        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$nm_cabang = $this->session->userdata('nm_cabang');

        if(!empty($cek) && $level=='admin' || !empty($cek) && $level == 'supervisi'){
            $d['nm_cabang'] =$nm_cabang;
			$d['judul']="Debitur Approve";
			$d['class'] = "masterdebitur";
            $d['vue'] = "supervisiapprove";
			
			$d['content'] = 'masterdebitur/v_supervisiapp';
			$this->load->view('home',$d);
        }else{
            redirect('login','refresh');
        }

    }

    public function showapprove(){

        $cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
        $kd_cabang = $this->session->userdata('kd_cabang');


        // echo $level;
        // die();
        if(!empty($cek) && $level=='admin' || !empty($cek) && $level=='supervisi'){

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

                if($level == 'supervisi'){

                    $where = "where t_master_debitur.kode_cabang = '$kd_cabang'";

                }else{


                    $where = "where t_master_debitur.kode_wilayah = '$getkodeKab'";

                }


                $items = KonHelpers::showDataWithPagination('t_master_debitur' , "left join t_jenis_debitur ON t_jenis_debitur.idjenisdebitur = t_master_debitur.jenis_debitur left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_master_debitur.kategori_debitur left join pembagian_wilayah on pembagian_wilayah.kode_wilayah = t_master_debitur.kode_wilayah left join t_cabang on t_cabang.kd_cab  = t_master_debitur.kode_cabang", $where , $like , 'id' , 'desc' , $currentPage , $pageSize);
    

                echo json_encode($items);


        }else{
            redirect('login','refresh');
        }

    }


    public function cetakexcel(){

        $kabupaten = $this->input->post('kabupaten');

        if(empty($kabupaten)){

            $sql = $this->db->query("SELECT * FROM t_master_debitur where kode_wilayah = ''")->result_array();

        }else{

            $kodekabupaten = KonHelpers::joinGampang('pembagian_wilayah' , 'nama_wilayah' , $kabupaten , 'kode_wilayah');
            $sql = $this->db->query("SELECT * FROM t_master_debitur where kode_wilayah = '$kodekabupaten'")->result_array();

        }

        

        // echo "<pre />";
        // print_r($this->db->query("SELECT * FROM t_bidang_usaha")->result());
        // die();


        
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=data_debitur_$kabupaten".$this->model_global->tgl_indo(date('Y-m-d')).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        


?>





        <h1>DATA PMS RITEL KABUPATEN <?=$kabupaten?></h1>
        <p></p> 
        <table border="1">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nomor Rekening </th>
                    <th>CIF</th>
                    <th>Jenis Debitur</th>
                    <th>Kategori Debitur</th>
                    <th>Kode Kantor Cabang</th>
                    <th>NIK</th>
                    <th>Nama Debitur/Penerima Gaji</th>
                    <th>Nomor Handphone</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Wilayah</th>
                    <th>Nama Instansi</th>
                    <th>Gaji Bruto</th>
                    <th>Jenis Kredit</th>
                    <th>Permohonan Top UP</th>
                    <th>SND</th>
                    <th>Angsuran Kredit</th>
                    <th>Nomor Rekening Pinhaman</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    foreach($sql as $row){
                ?>  

                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$row['nomor_rekening']?></td>
                        <td><?=$row['cif']?></td>
                        <td><?=$row['jenis_debitur']?></td>
                        <td><?=KonHelpers::joinGampang('t_bidang_usaha' , 'kd_bidang_usaha' , $row['kategori_debitur'] , 'nama_bidang_usaha')?></td>
                        <td><?=$row['kode_cabang']?></td>
                        <td><?=str_pad($row['nik_debitur'] ,  25 , " ")?></td>
                        <td><?=$row['nama_debitur']?></td>
                        <td><?=$row['no_handphone']?></td>
                        <td><?=$row['no_telepon']?></td>
                        <td><?=$row['alamat']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$kabupaten?></td>
                        <td><?=$row['nama_instansi']?></td>
                        <td><?=$row['gaji_bruto']?></td>
                        <td><?=$row['jenis_kredit']?></td>
                        <td><?=$row['permohonbaru_topup']?></td>
                        <td><?=$row['snd']?></td>
                        <td><?=$row['angsuran_kredit']?></td>
                        <td><?=$row['no_rekening_pinjaman']?></td>

                    </tr>
                <?php }?>
            </tbody>
        </table>


<?php 
    }

}

?>