<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_mutasi_mhs extends CI_Controller {

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
			$d['judul']="Laporan Mutasi Mahasiswa";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_mutasi_mhs';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$th_ak = $this->input->post('th_ak');
			$smt = $this->input->post('smt');
			$kd_prodi = $this->input->post('kd_prodi');
			
			$query = "SELECT a.id_mutasi,a.th_akademik,a.semester,a.tgl_mutasi,a.nim,a.status,a.ket,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM mutasi_mhs as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/view_lap_mutasi_mhs',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$th_ak = $this->input->post('th_ak');
			$smt = $this->input->post('smt');
			$kd_prodi = $this->input->post('kd_prodi');
			
			$query = "SELECT a.id_mutasi,a.th_akademik,a.semester,a.tgl_mutasi,a.nim,a.status,a.ket,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM mutasi_mhs as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$sess_data['th_ak'] = $th_ak;
				$sess_data['smt'] = $smt;
				$sess_data['kd_prodi'] = $kd_prodi;
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
			
			$th_ak = $this->session->userdata('th_ak');
			$smt = $this->session->userdata('smt');
			$kd_prodi = $this->session->userdata('kd_prodi');
			
			$query = "SELECT a.id_mutasi,a.th_akademik,a.semester,a.tgl_mutasi,a.nim,a.status,a.ket,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM mutasi_mhs as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			
			$r = $q->num_rows();
			
			if($r>0){
				
				
			  $pdf=new reportProduct();
			  $pdf->setKriteria("cetak_laporan");
			  $pdf->setNama("CETAK LAPORAN");
			  $pdf->AliasNbPages();
			  $pdf->AddPage("P","A4");
				//foreach($data->result() as $t){
					$A4[0]=210;
					$A4[1]=297;
					$Q[0]=216;
					$Q[1]=279;
					$pdf->SetTitle('Laporan Aplikasi');
					$pdf->SetCreator('Programmer IT with fpdf');
					
					$h = 7;
					$w = 190;
					$pdf->SetFont('Times','B',18);
					$pdf->Cell($w,$h,$this->config->item('nama_pendek'),0,1,'C');
					$pdf->SetFont('Times','B',14);
					$pdf->Cell($w,$h,$this->config->item('nama_instansi'),0,1,'C');
					$pdf->SetFont('Times','',10);
					$pdf->Cell($w,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'C');
					$pdf->Ln(8);
					
					//Column widths
					$h= 5;
					$pdf->SetFont('Arial','B',14);
					$pdf->Cell($w,$h,'MUTASI MAHASISWA',0,1,'C');
					$pdf->Cell($w,$h,$th_ak.' - '.strtoupper($smt),0,1,'C');
					$pdf->Ln(5);
										
					
					$l=10;
					$w = array(10,30,80,10,40,20);
					
					//Header

					$pdf->SetFont('Arial','B',11);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No',1,0,'C',$fill);
					$pdf->Cell($w[1],$h,'NIM',1,0,'C',$fill);
					$pdf->Cell($w[2],$h,'NAMA MAHASISWA',1,0,'C',$fill);
					$pdf->Cell($w[3],$h,'L/P',1,0,'C',$fill);
					$pdf->Cell($w[4],$h,'TANGGAL',1,0,'C',$fill);
					$pdf->Cell($w[5],$h,'STATUS',1,0,'C',$fill);
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
					foreach($q->result() as $row){
						$tgl = $this->model_global->tgl_indo($row->tgl_mutasi);
						$pdf->Cell($w[0],$h,$no,1,0,'C');
						$pdf->Cell($w[1],$h,$row->nim,1,0,'C');
						$pdf->Cell($w[2],$h,strtoupper($row->nama_mhs),1,0,'L');
						$pdf->Cell($w[3],$h,$row->sex,1,0,'C');
						$pdf->Cell($w[4],$h,$tgl,1,0,'C');
						$pdf->Cell($w[5],$h,$row->status,1,0,'C');
						
						$pdf->Ln();
						$fill = !$fill;
						$no++;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
	
					
					$pdf->Ln(10);
					$h = 5;
					//$pdf->Cell(50,$h,'Menyetujui',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					//$pdf->Cell(50,$h,'Ketua Program Studi,',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'Bagian Akademik,',0,1,'C');
					$pdf->Ln(20);
					//$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'_____________________',0,1,'C');
					//$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'NIP :',0,1,'L');
				//}
					
				//}
				$pdf->Output('MUTASI_MAHASISWA_'.$th_ak.'_'.$smt.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('lap_mutasi_mhs');
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
			
			$th_ak = $this->session->userdata('th_ak');
			$smt = $this->session->userdata('smt');
			$kd_prodi = $this->session->userdata('kd_prodi');
			
			$query = "SELECT a.id_mutasi,a.th_akademik,a.semester,a.tgl_mutasi,a.nim,a.status,a.ket,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM mutasi_mhs as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=MUTASI_MAHASISWA_".$th_ak.'_'.$smt.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN MUTASI MAHASISWA</p>
            <p><?php echo $th_ak.' - '.$smt;?></p>
            <table border="1">
            	<thead>
                	<tr>
                    	<td>No</td>
                        <td>NIM</td>
                        <td>NAMA</td>
                        <td>L/P</td>
                        <td>PRODI</td>
                        <td>TANGGAL</td>
                        <td>STATUS</td>
					</tr>
				</thead>
                <tbody>
                <?php
				$no=1;
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_indo($dt->tgl_mutasi);
					$prodi = $this->model_data->nama_jurusan($dt->kd_prodi);
				?>
                <tr>
                	<td><?php echo $no;?></td>  
					<td><?php echo $dt->nim;?></td>
                    <td><?php echo $dt->nama_mhs;?></td>
                     <td><?php echo $dt->sex;?></td>
                    <td><?php echo $prodi;?></td>  
                    <td><?php echo $tgl;?></td>  
                    <td><?php echo $dt->status;?></td>                    
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