<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_absen extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['judul']="Absensi Mahasiswa";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_absen';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_mata_kuliah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['th_akademik']	= $this->input->post('th_ak');
			$id['kd_prodi']	= $this->input->post('kd_prodi');
			$id['semester']	= $this->input->post('smt');
			
			$q = $this->db->get_where("jadwal",$id);
			$row = $q->num_rows();
			if($row>0){
			?>
            	<option value="">-Pilih Mata Kuliah-</option>
            <?php
				foreach($q->result() as $dt){
					$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
					$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
				?>
                	<option value="<?php echo $dt->id_jadwal;?>"><?php echo $dt->kd_mk;?> - <?php echo $nama_mk;?> - <?php echo $dt->kd_dosen;?> - <?php echo $nama_dosen;?> - <?php echo $dt->hari.' - '.$dt->pukul.' - '.$dt->ruang;?></option>
                <?php
				}
			}else{
			?>
            <option value="">-Belum Ada Mata Kuliah-</option>
            <?php }
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$th_ak = $this->input->post('th_ak');
			$smt = $this->input->post('smt');
			$kd_prodi = $this->input->post('kd_prodi');
			$jadwal = $this->input->post('mk');
			
			$query = "SELECT *
						FROM krs as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.id_jadwal='$jadwal'";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$dt['data'] = $q;
				echo $this->load->view('laporan/view_lap_absen',$dt);
			}else{
				echo $this->load->view('laporan/view_kosong');
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$th_ak = $this->input->post('th_ak');
			$smt = $this->input->post('smt');
			$kd_prodi = $this->input->post('kd_prodi');
			$jadwal = $this->input->post('mk');
			
			$query = "SELECT *
						FROM krs as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.id_jadwal='$jadwal'";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$sess_data['id_jadwal'] = $jadwal;
				$this->session->set_userdata($sess_data);
				echo "Sukses";
			}else{
				echo "Maaf, Tidak Ada data";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
	
	
	public function print_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$jadwal = $this->session->userdata('id_jadwal');
			
			$q = $this->db->query("SELECT * FROM krs WHERE id_jadwal='$jadwal' ");
			$r = $q->num_rows();
			
			if($r>0){
				foreach($q->result() as $dt){			
					$th_ak 	= $dt->th_akademik;
					$smt 	= $dt->semester;
					$kd_dosen 	= $dt->kd_dosen;
					$nama_dosen = $dt->nm_dosen;
					$kd_mk	= $dt->kd_mk;
					$nama_mk = $dt->nama_mk;
					$sks = $dt->sks;
					$hari = $dt->hari;
					$pukul = $dt->pukul;
					$ruang = $dt->ruang;
				}
				
			  $pdf=new reportProduct();
			  $pdf->setKriteria("cetak_laporan");
			  $pdf->setNama("CETAK LAPORAN");
			  $pdf->AliasNbPages();
			  $pdf->AddPage("L","A4");
				//foreach($data->result() as $t){
					$A4[0]=210;
					$A4[1]=297;
					$Q[0]=216;
					$Q[1]=279;
					$pdf->SetTitle('Laporan Aplikasi');
					$pdf->SetCreator('Programmer IT with fpdf');
					
					$h = 7;
					$w = 290;
					$pdf->SetFont('Times','B',18);
					$pdf->Cell($w,$h,$this->config->item('nama_pendek'),0,1,'C');
					$pdf->SetFont('Times','B',14);
					$pdf->Cell($w,$h,$this->config->item('nama_instansi'),0,1,'C');
					$pdf->SetFont('Times','',10);
					$pdf->Cell($w,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'C');
					$pdf->Ln(8);
					
					//Column widths
					$pdf->SetFont('Arial','B',16);
					$pdf->Cell($w,$h,'ABSENSI MAHASISWA',0,1,'C');
					$pdf->Cell($w,$h,$th_ak.' - '.strtoupper($smt),0,1,'C');
					$pdf->Ln(5);
					
					$h = 6;
					
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(30,$h,'Mata Kuliah',0,0,'L');
					$pdf->Cell(50,$h,': '.$kd_mk.'-'.$nama_mk,0,0,'L');
					$pdf->SetX(180);
					$pdf->Cell(35,$h,'Hari / Pukul',0,0,'L');
					$pdf->Cell(50,$h,': '.$hari.', '.$pukul,0,1,'L');	
					
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(30,$h,'Nama Dosen',0,0,'L');
					$pdf->Cell(50,$h,': '.$kd_dosen.'-'.strtoupper($nama_dosen),0,0,'L');
					$pdf->SetX(180);
					$pdf->Cell(35,$h,'Ruang ',0,0,'L');
					$pdf->Cell(50,$h,': '.strtoupper($ruang),0,1,'L');
										
					
					$l=10;
					$w = array(10,30,60,$l,$l,$l,$l,$l,$l,15,$l,$l,$l,$l,$l,$l,15,25);
					
					//Header

					$pdf->SetFont('Arial','B',11);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No',1,0,'C',$fill);
					$pdf->Cell($w[1],$h,'NIM',1,0,'C',$fill);
					$pdf->Cell($w[2],$h,'NAMA MAHASISWA',1,0,'C',$fill);
					$pdf->Cell($w[3],$h,'1',1,0,'C',$fill);
					$pdf->Cell($w[4],$h,'2',1,0,'C',$fill);
					$pdf->Cell($w[5],$h,'3',1,0,'C',$fill);
					$pdf->Cell($w[6],$h,'4',1,0,'C',$fill);
					$pdf->Cell($w[7],$h,'5',1,0,'C',$fill);
					$pdf->Cell($w[8],$h,'6',1,0,'C',$fill);
					$pdf->Cell($w[9],$h,'UTS',1,0,'C',$fill);
					$pdf->Cell($w[10],$h,'8',1,0,'C',$fill);
					$pdf->Cell($w[11],$h,'9',1,0,'C',$fill);
					$pdf->Cell($w[12],$h,'10',1,0,'C',$fill);
					$pdf->Cell($w[13],$h,'11',1,0,'C',$fill);
					$pdf->Cell($w[14],$h,'12',1,0,'C',$fill);
					$pdf->Cell($w[15],$h,'13',1,0,'C',$fill);
					$pdf->Cell($w[16],$h,'UAS',1,0,'C',$fill);
					$pdf->Cell($w[17],$h,'KET',1,0,'C',$fill);
					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$h = 7;
					$pdf->SetFont('Arial','',9);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$jmlsks = 0;
					foreach($q->result() as $row)
					{
						$nama_mhs = $this->model_data->cari_nama_mhs($row->nim);
						$pdf->Cell($w[0],$h,$no,1,0,'C');
						$pdf->Cell($w[1],$h,$row->nim,1,0,'C');
						$pdf->Cell($w[2],$h,strtoupper($nama_mhs),1,0,'L');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
						$pdf->Cell($w[5],$h,'',1,0,'C');
						$pdf->Cell($w[6],$h,'',1,0,'C');
						$pdf->Cell($w[7],$h,'',1,0,'C');
						$pdf->Cell($w[8],$h,'',1,0,'C');
						$pdf->Cell($w[9],$h,'',1,0,'C');
						$pdf->Cell($w[10],$h,'',1,0,'C');
						$pdf->Cell($w[11],$h,'',1,0,'C');
						$pdf->Cell($w[12],$h,'',1,0,'C');
						$pdf->Cell($w[13],$h,'',1,0,'C');
						$pdf->Cell($w[14],$h,'',1,0,'C');
						$pdf->Cell($w[15],$h,'',1,0,'C');
						$pdf->Cell($w[16],$h,'',1,0,'C');
						$pdf->Cell($w[17],$h,'',1,0,'C');
						
						$pdf->Ln();
						$fill = !$fill;
						$no++;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
	
					
					$pdf->Ln(10);
					$h = 5;
					$pdf->Cell(50,$h,'Menyetujui',0,0,'C');
					$pdf->SetX(160);
					$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					$pdf->Cell(50,$h,'Ketua Program Studi,',0,0,'C');
					$pdf->SetX(160);
					$pdf->Cell(100,$h,'Dosen Pengampu,',0,1,'C');
					$pdf->Ln(20);
					$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(160);
					$pdf->Cell(100,$h,$nama_dosen,0,1,'C');
					$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(160);
					$pdf->Cell(100,$h,$kd_dosen,0,1,'C');
				//}
					
				//}
				$pdf->Output('ABSENSI_'.$th_ak.'_'.$smt.'_'.$kd_dosen.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('lap_absen');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function print_excel()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$jadwal = $this->session->userdata('id_jadwal');
			
			$q = $this->db->query("SELECT * FROM krs WHERE id_jadwal='$jadwal' ");
			$r = $q->num_rows();
			
			if($r>0){
				foreach($q->result() as $dt){			
					$th_ak 	= $dt->th_akademik;
					$smt 	= $dt->semester;
					$kd_dosen 	= $dt->kd_dosen;
					$nama_dosen = $dt->nm_dosen;
					$kd_mk	= $dt->kd_mk;
					$nama_mk = $dt->nama_mk;
					$sks = $dt->sks;
					$hari = $dt->hari;
					$pukul = $dt->pukul;
					$ruang = $dt->ruang;
				}
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=absensi_".$th_ak.'_'.$smt.'_'.$kd_dosen.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>ABSENSI MAHASISWA</p>
            <p><?php echo $th_ak.' - '.$smt;?></p>
            <p>Mata Kuliah : <?php echo $kd_mk.'-'.$nama_mk;?></p>
            <p>Dosen : <?php echo $kd_dosen.'-'.$nama_dosen;?></p>
            <table border="1" width="100%">
            	<thead>
                	<tr>
                    	<td>No</td>
                        <td>NIM</td>
                        <td>NAMA</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>UTS</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>UAS</td>
                        <td>KET</td>
					</tr>
				</thead>
                <tbody>
                <?php
				$no=1;
				foreach($q->result() as $dt){
					$nama_mhs = $this->model_data->cari_nama_mhs($dt->nim);
				?>
                <tr>
                	<td><?php echo $no;?></td>  
					<td><?php echo $dt->nim;?></td>
                    <td><?php echo $nama_mhs;?></td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>                                                            
                </tr>    
            <?php
				$no++;	
				}
			?>
            	</tbody>
               </table>
             <?php
			}
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */