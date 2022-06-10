<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {


    public function index(){


        $nm_cabang = $this->session->userdata('nm_cabang');
        $kd_cabang = $this->session->userdata('kd_cabang');
        $level = $this->session->userdata('level');

        if($level == 'supervisi'){
            $userao = $this->db->query("SELECT * FROM t_user where kd_cab = '$kd_cabang'")->result();
        }else{
            $userao = array();
        }

        // print_r($userao);
        // die();
        $d['nm_cabang'] =$nm_cabang;
        $d['level'] =$level;
        $d['judul']="Laporan Realisasi";
        $d['class'] = "report";
        $d['vue'] = "report";
        $d['userao'] = $userao;
        $d['content'] = 'report/index';
        $this->load->view('home',$d);


    }

    public function cariuser(){


        $kode_cab = $this->input->post('kode_cab');
        if($kode_cab == 'all'){
            $where = '';
        }else{
            $where = "where kd_cab = '$kode_cab'";
        }
        $result = $this->db->query("SELECT * FROM t_user  $where")->result();

        echo json_encode($result);

    }

    public function viewdata(){

        $level = $this->session->userdata('level');

        if($level == 'supervisi'){
            $kode_cabang = $this->session->userdata('kd_cabang');
        }else{
            $kode_cabang = $this->input->post('kode_cabang');
        }


        $bulan = $this->input->post('bulan');
        $user_ao = $this->input->post('user_ao');
        $jenis_guna = $this->input->post('jenis_guna');
        $snd = $this->input->post('snd');

        // echo $bulan;
        // die();
      
      
        if($user_ao == 'all' || $user_ao == ''){
            $where = "";
        }else{
            $where = "and t_pk.id_user_pic  = '$user_ao'";
        }

        if($kode_cabang == 'all' || $kode_cabang == ''){
            $where .='';
        }else{
            $where .= " and t_master_debitur.kode_cabang = '$kode_cabang'";
        }

        if($jenis_guna == 'all' || $jenis_guna == ''){
            $where .= '';
        }else{
             $where  .= " and t_master_debitur.jenis_guna = '$jenis_guna'";
        }

        if($snd == 'all' || $snd == ''){
            $where .= '';
        }else{
            $where .= " and t_master_debitur.snd = '$snd'";
        }

        if($bulan == 'all'){
            $where .= '';
        }else{
            $where .= " and MONTH(tanggal_release) = '$bulan'";
        }

        // print_r("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha left join t_user on t_user.id_user = t_pk.id_user_pic where t_pk.status_data = '2' $where");
    
        // die();

        $row = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha left join t_user on t_user.id_user = t_pk.id_user_pic where t_pk.status_data = '2' $where")->result();

        echo json_encode($row);
        
    }


 

    public function print_pdf(){

        $level = $this->session->userdata('level');

        if($level == 'supervisi'){
            $kode_cabang = $this->session->userdata('kd_cabang');
        }else{
            $kode_cabang = $this->input->get('kode_cabang');
        }
        $userao = $this->input->get('userao');
        $jenisguna = $this->input->get('jenisguna');
        $snd = $this->input->get('snd');
        $bulan = $this->input->get('bulan');

        if($userao == 'all' || $userao == ''){
            $where = "";
        }else{
            $where = "and t_pk.id_user_pic  = '$userao'";
        }

        if($kode_cabang == 'all' || $kode_cabang == ''){
            $where .='';
        }else{
            $where .= " and t_master_debitur.kode_cabang = '$kode_cabang'";
        }

        if($jenisguna){
            if($jenisguna == 'all'){
                $where .= '';
            }else{
                $where  .= " and t_master_debitur.jenis_guna = '$jenisguna'";
            }
        }
        if($snd){
            if($snd == 'all'){
                $where .= '';
            }else{
                $where .= " and t_master_debitur.snd = '$snd'";
            }
        }

        if($bulan == 'all'){
            $where .= '';
        }else{
            $where .= " and MONTH(tanggal_release) = '$bulan'";
        }

        $items = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha left join t_user on t_user.id_user = t_pk.id_user_pic left join t_cabang on t_cabang.kd_cab = t_master_debitur.kode_cabang where t_pk.status_data = '2' $where")->result();

        // print_r($where);

        // die();

        $pdf=new reportProduct();
        $pdf->setKriteria("cetak_laporan");
        $pdf->setNama("CETAK LAPORAN");
        $pdf->AliasNbPages();
        $pdf->AddPage("L","A4");

        $A4[0]=210;
		$A4[1]=297;
	    $Q[0]=216;
		$Q[1]=279;
		$pdf->SetTitle('Laporan Aplikasi');
		$pdf->SetCreator('Programmer IT with fpdf');

        $h = 7;
        $pdf->SetFont('Times','B',14);
        $pdf->SetX(6);
        $pdf->Cell(198,4,$this->config->item('nama_instansi'),0,1,'L');
        $pdf->SetX(6);
        $pdf->SetFont('Times','',10);
        $pdf->Cell(198,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'L');
        $pdf->Ln(5);
        
        //Column widths
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(6);


        $pdf->Ln(5);						
        $w = array(10,20,40,35,35,20,35,35 ,35);
        //Header
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell($w[0],$h,'No',1,0,'C');
        $pdf->Cell($w[1],$h,'Kode SND',1,0,'C');
        $pdf->Cell($w[2],$h,'Nama Cabang',1,0,'C');
        $pdf->Cell($w[3],$h,'User Petugas',1,0,'C');
        $pdf->Cell($w[4],$h,'Nama Prospek',1,0,'C');
        $pdf->Cell($w[5],$h,'Tgl Realisasi',1,0,'C');
        $pdf->Cell($w[6],$h,'Realisasi Plafond',1,0,'C');
        $pdf->Cell($w[7],$h,'Baki Debet `   `',1,0,'C');
        $pdf->Cell($w[8],$h,'Realisasi Real',1,0,'C');
      
    

        $pdf->Ln();
					
        //data
        //$pdf->SetFillColor(224,235,255);
        $pdf->SetFont('Arial','',8);
        $pdf->SetFillColor(204,204,204);
        $pdf->SetTextColor(0);
        $fill = false;
        $no=1;
        $total=0;
        $plafond =0;
        $totalsisabakidebet = 0;

        foreach($items as $item){

            $pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
            $pdf->Cell($w[1],$h,$item->snd,'LR',0,'L',$fill);
            $pdf->Cell($w[2],$h,$item->nm_cabang,'LR',0,'L',$fill);
            $pdf->Cell($w[3],$h,$item->nama_user,'LR',0,'L',$fill);
            $pdf->Cell($w[4],$h,$item->nama_debitur,'LR',0,'L',$fill);
            $pdf->Cell($w[5],$h,date('d-m-Y' , strtotime($item->tanggal_release)),'LR',0,'L',$fill);
            $pdf->Cell($w[6],$h,"Rp. ".number_format($item->plafond_akhir , 0 , '.' , '.'),'LR',0,'R',$fill);
            $pdf->Cell($w[7],$h,"Rp. ".number_format($item->baki_debet_lama , 0 , '.' , '.'),'LR',0,'R',$fill);
            $pdf->Cell($w[8],$h,"Rp. ".number_format($item->sisa_baki_debet , 0 , '.' , '.'),'LR',0,'R',$fill);
         

            $total += 1;
            $plafond += $item->plafond_akhir;
            $totalsisabakidebet += $item->baki_debet_lama;
            $pdf->Ln();
            $fill = !$fill;
            $no++;

        }

        $totalrealisasireal = $plafond - $totalsisabakidebet;


        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(230,$h,'Total data','1',0,'C');
        $pdf->Cell($w[8],$h,number_format($total,0),'1',0,'R');
        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(230,$h,'Total Realisasi Plafond','1',0,'C');
        $pdf->Cell($w[8],$h,"Rp. ".number_format($plafond,0),'1',0,'R');
        $pdf->SetFont('Arial','',8);
        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(230,$h,'Total  Realisasi Real','1',0,'C');
        $pdf->Cell($w[8],$h,"Rp. ".number_format($totalrealisasireal,0),'1',0,'R');
        $pdf->SetFont('Arial','',8);
        // Closing line
        //$pdf->Cell(array_sum($w),0,'','T');
        $pdf->Ln(10);
        $pdf->SetX(160);
        $pdf->Cell(160,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
        $pdf->Ln(20);
        $pdf->SetX(160);
        $pdf->Cell(160,$h,'___________________','C');




	    $pdf->Output('Laporan_pms_'.$this->model_global->tgl_indo(date('Y-m-d')).'.pdf','D');	

       

    }

    public function print_excel(){

        
        $level = $this->session->userdata('level');

        if($level == 'supervisi'){
            $kode_cabang = $this->session->userdata('kd_cabang');
        }else{
            $kode_cabang = $this->input->get('kode_cabang');
        }

        $userao = $this->input->get('userao');
        $jenisguna = $this->input->get('jenisguna');
        $snd = $this->input->get('snd');
        $bulan = $this->input->get('bulan');

        if($userao == 'all' || $userao == ''){
            $where = "";
        }else{
            $where = "and t_pk.id_user_pic  = '$userao'";
        }

        if($kode_cabang == 'all' || $kode_cabang == ''){
            $where .='';
        }else{
            $where .= " and t_master_debitur.kode_cabang = '$kode_cabang'";
        }

        if($jenisguna){
            if($jenisguna == 'all'){
                $where .= '';
            }else{
                $where  .= " and t_master_debitur.jenis_guna = '$jenisguna'";
            }
        }
        if($snd){
            if($snd == 'all'){
                $where .= '';
            }else{
                $where .= " and t_master_debitur.snd = '$snd'";
            }
        }


        if($bulan == 'all'){
            $where .= '';
        }else{
            $where .= " and MONTH(tanggal_release) = '$bulan'";
        }
     
        $items = $this->db->query("SELECT * FROM t_pk left join t_prospek on t_prospek.id_prospek = t_pk.id_prospek  left join t_analisa on t_prospek.id_prospek = t_analisa.id_prospek left join t_jenis_pembiayaan on t_analisa.id_jenis_pembiayaan = t_jenis_pembiayaan.id_jenis_pembiayaan left join t_master_debitur on t_master_debitur.id = t_pk.idmasterdebitur  left join t_jenis_debitur on t_jenis_debitur.idjenisdebitur = t_prospek.kode_status left join t_bidang_usaha on t_bidang_usaha.kd_bidang_usaha = t_prospek.kd_bidang_usaha left join t_user on t_user.id_user = t_pk.id_user_pic left join t_cabang on t_cabang.kd_cab = t_master_debitur.kode_cabang where t_pk.status_data = '2' $where")->result();

        // print_r($where);
        // die();

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Laporan_pms_".$this->model_global->tgl_indo(date('Y-m-d')).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");


?>

        <p>LAPORAN DATA PENCAIRAN KREDIT</p>
        <p></p> 
        <table border="1">
            <thead>
                <tr>
                    <td>No. </td>
                    <td>Kode SND </td>
                    <td>Nama cabang </td>
                    <td>Nama Petugas </td>
                    <td>Nama Prospek</td>
                    <td>Tanggal Realisasi</td>
                    <td>Realisasi Plafond	</td>
                    <td>Baki Debet Lama</td>
                    <td>Realisasi Real</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    $total = 0;
                    $tp = 0;
                    $sisabakidebet = 0;
                    foreach($items as $item){
                        
                ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><?=$item->snd?></td>
                    <td><?=$item->nm_cabang?></td>
                    <td><?=$item->nama_user?></td>
                    <td><?=$item->nama_debitur?></td>
                    <td><?=date('d-m-Y' , strtotime($item->tanggal_release))?></td>
                    <td><?=number_format($item->plafond_akhir , 0)?></td>
                    <td><?=number_format($item->baki_debet_lama ,0)?></td>
                    <td><?=number_format($item->sisa_baki_debet , 0)?></td>
                </tr>
                <?php $no++;
                    $total +=1;
                    $tp += $item->plafond_akhir;
                    $sisabakidebet += $item->baki_debet_lama;
                 }
                    $totalreal = $tp - $sisabakidebet;
                 ?>
                <tr>
                    <td colspan="8">Total</td>
                    <td><?=number_format($total , 0 );?></td>
                </tr>
                <tr>
                    <td colspan="8">Total Realisasi Plafond</td>
                    <td><?=number_format($tp , 0 );?></td>
                </tr>
                <tr>
                    <td colspan="8">Total Realisasi Real</td>
                    <td><?=number_format($totalreal , 0 );?></td>
                </tr>
            </tbody>
        </table>


<?php 
    }
}
?>
