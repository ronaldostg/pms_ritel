<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_mahasiswa extends CI_Controller {

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
			$d['judul']="Laporan Mahasiswa";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_mahasiswa';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$th_ak = $this->input->post('th_ak');
			$kd_prodi = $this->input->post('kd_prodi');
			$status = $this->input->post('status');
			
			$where = "WHERE th_akademik='$th_ak' ";
			if(!empty($status)){
				$where .=" AND status='$status' ";
			}
			if(!empty($kd_prodi)){
				$where .=" AND kd_prodi='$kd_prodi'";
			}
			
			$q = $this->db->query("SELECT * FROM mahasiswa $where ");
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/view_lap_mhs',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data_mhs_aktif()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$where = "WHERE status='Aktif' ";
			
			$q = $this->db->query("SELECT * FROM mahasiswa $where ");
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/view_lap_mhs',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$th_ak = $this->input->post('th_ak');
			$prodi = $this->input->post('kd_prodi');
			
			if(empty($th_ak)){
				$this->session->set_flashdata('result_info', '<center>Tahun Akademik Tidak boleh kosong</center>');
				redirect('lap_mahasiswa');
				return false();
			}
			
			$where = "WHERE status='Aktif' AND th_akademik='$th_ak' ";
			
			if(!empty($prodi)){
				$where .=" AND kd_prodi='$prodi'";
			}
			
			$q = $this->db->query("SELECT * FROM mahasiswa $where ");
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
					$pdf->Cell(290,4,'Laporan Mahasiswa',0,1,'C');
					$pdf->Ln(5);
					
					$w = array(10,25,30,30,80,10,30,35,25);
					
					//Header
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell($w[0],$h,'No',1,0,'C');
					$pdf->Cell($w[1],$h,'Th Akademik',1,0,'C');
					$pdf->Cell($w[2],$h,'PRODI',1,0,'C');
					$pdf->Cell($w[3],$h,'NIM',1,0,'C');
					$pdf->Cell($w[4],$h,'NAMA',1,0,'C');
					$pdf->Cell($w[5],$h,'L/P',1,0,'C');
					$pdf->Cell($w[6],$h,'HP',1,0,'C');
					$pdf->Cell($w[7],$h,'Kota',1,0,'C');
					$pdf->Cell($w[8],$h,'Status',1,0,'C');
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
						$pdf->Cell($w[1],$h,$row->th_akademik,'LR',0,'C',$fill);
						$pdf->Cell($w[2],$h,$row->kd_prodi.'('.$sing.')','LR',0,'C',$fill);
						$pdf->Cell($w[3],$h,$row->nim,'LR',0,'C',$fill);
						$pdf->Cell($w[4],$h,$row->nama_mhs,'LR',0,'L',$fill);
						$pdf->Cell($w[5],$h,$row->sex,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,$row->hp,'LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,$row->kota,'LR',0,'L',$fill);
						$pdf->Cell($w[8],$h,$row->status,'LR',0,'C',$fill);
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
				$pdf->Output('Lap_Mahasiswa.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('lap_mahasiswa');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */