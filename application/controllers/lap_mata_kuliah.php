<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_mata_kuliah extends CI_Controller {

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
			$d['judul']="Laporan Mata Kuliah";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_mata_kuliah';
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
			$smt = $this->input->post('smt');
			
			$where = "WHERE aktif='Ya'";
			if(!empty($kd_prodi)){
				$where .=" AND kd_prodi='$kd_prodi'";
			}
			
			if(!empty($smt)){
				$where .=" AND smt='$smt'";
			}
			
			
			
			$q = $this->db->query("SELECT * FROM mata_kuliah $where ");
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/view_lap_mata_kuliah',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$kd_prodi = $this->input->post('kd_prodi');
			$smt = $this->input->post('smt');
			
			$where = "WHERE aktif='Ya'";
			if(!empty($kd_prodi)){
				$where .=" AND kd_prodi='$kd_prodi'";
			}
			
			if(!empty($smt)){
				$where .=" AND smt='$smt'";
			}
			
			$q = $this->db->query("SELECT * FROM mata_kuliah $where ");
			
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
					$pdf->Cell(210,4,'DAFTAR MATA KULIAH',0,1,'C');
					$pdf->Ln(5);
					
					$w = array(10,30,30,100,10,10);
					
					//Header
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell($w[0],$h,'No',1,0,'C');
					$pdf->Cell($w[1],$h,'PRODI',1,0,'C');
					$pdf->Cell($w[2],$h,'KODE',1,0,'C');
					$pdf->Cell($w[3],$h,'NAMA MATA KULIAH',1,0,'C');
					$pdf->Cell($w[4],$h,'SKS',1,0,'C');
					$pdf->Cell($w[5],$h,'SMT',1,0,'C');
					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$pdf->SetFont('Arial','',9);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$t_sks = 0;
					foreach($q->result() as $row)
					{
						$sing = $this->model_data->singkat_jurusan($row->kd_prodi);
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,$row->kd_prodi.'('.$sing.')','LR',0,'C',$fill);
						$pdf->Cell($w[2],$h,$row->kd_mk,'LR',0,'C',$fill);
						$pdf->Cell($w[3],$h,$row->nama_mk,'LR',0,'L',$fill);
						$pdf->Cell($w[4],$h,$row->sks,'LR',0,'C',$fill);
						$pdf->Cell($w[5],$h,$row->smt,'LR',0,'C',$fill);
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$t_sks = $t_sks+$row->sks;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
					$pdf->Ln();
					$pdf->Cell(170,$h,'Total SKS',0,0,'C');
					$pdf->Cell(10,$h,$t_sks,0,0,'C');
					
					$pdf->Ln(10);
					$pdf->SetX(150);
					$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
					$pdf->Ln(20);
					$pdf->SetX(150);
					$pdf->Cell(100,$h,'___________________','C');
				//}
					
				//}
				$pdf->Output('Lap_Mata_Kuliah.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('lap_mata_kuliah');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */