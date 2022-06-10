<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_dosen extends CI_Controller {

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
			$d['judul']="Laporan Dosen";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_dosen';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$kd_prodi = $this->input->post('kd_prodi');
			$jenjang = $this->input->post('jenjang');
			
			$where = "WHERE status='Aktif'";
			if(!empty($kd_prodi)){
				$where .=" AND kd_prodi='$kd_prodi'";
			}
			
			if(!empty($jenjang)){
				$where .=" AND pendidikan='$jenjang'";
			}
			
			$q = $this->db->query("SELECT * FROM dosen $where ");
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/view_lap_dosen',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$kd_prodi = $this->input->post('kd_prodi');
			$jenjang = $this->input->post('jenjang');
			
			$where = "WHERE status='Aktif'";
			if(!empty($kd_prodi)){
				$where .=" AND kd_prodi='$kd_prodi'";
			}
			
			if(!empty($jenjang)){
				$where .=" AND pendidikan='$jenjang'";
			}
			
			$q = $this->db->query("SELECT * FROM dosen $where ");
			
			$r = $q->num_rows();
			
			if($r>0){
			
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
					$pdf->SetFont('Times','B',14);
					$pdf->SetX(6);
					$pdf->Cell(198,4,$this->config->item('nama_instansi'),0,1,'L');
					$pdf->SetX(6);
					$pdf->SetFont('Times','',10);
					$pdf->Cell(198,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'L');
					$pdf->Ln(5);
					
					//Column widths
					$pdf->SetFont('Arial','B',14);
					$pdf->SetX(6);
					$pdf->Cell(290,4,'Laporan Dosen',0,1,'C');
					$pdf->Ln(5);
					
					$w = array(10,30,20,20,85,10,30,70);
					
					//Header
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell($w[0],$h,'No',1,0,'C');
					$pdf->Cell($w[1],$h,'PRODI',1,0,'C');
					$pdf->Cell($w[2],$h,'Kode',1,0,'C');
					$pdf->Cell($w[3],$h,'NIDN',1,0,'C');
					$pdf->Cell($w[4],$h,'NAMA',1,0,'C');
					$pdf->Cell($w[5],$h,'L/P',1,0,'C');
					$pdf->Cell($w[6],$h,'HP',1,0,'C');
					$pdf->Cell($w[7],$h,'Pendidikan',1,0,'C');
					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$pdf->SetFont('Arial','',9);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					foreach($q->result() as $row)
					{
						$sing = $this->model_data->singkat_jurusan($row->kd_prodi);
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,$row->kd_prodi.'('.$sing.')','LR',0,'C',$fill);
						$pdf->Cell($w[2],$h,$row->kd_dosen,'LR',0,'C',$fill);
						$pdf->Cell($w[3],$h,$row->nidn,'LR',0,'C',$fill);
						$pdf->Cell($w[4],$h,$row->nama_dosen,'LR',0,'L',$fill);
						$pdf->Cell($w[5],$h,$row->sex,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,$row->hp,'LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,$row->pendidikan.'-'.$row->prodi,'LR',0,'L',$fill);
						$pdf->Ln();
						$fill = !$fill;
						$no++;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
					$pdf->Ln(10);
					$pdf->SetX(200);
					$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
					$pdf->Ln(20);
					$pdf->SetX(200);
					$pdf->Cell(100,$h,'___________________','C');
				//}
					
				//}
				$pdf->Output('Lap_Dosen.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('lap_dosen');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */