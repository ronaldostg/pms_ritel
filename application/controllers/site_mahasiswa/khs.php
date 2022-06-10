<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Khs extends CI_Controller {

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
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			$d['judul']="Kartu Hasil Studi (KHS) Mahasiswa";
			$d['class'] = "master";
			
			$d['content']= 'site_mahasiswa/khs/form';
			$this->load->view('site_mahasiswa/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			
			$nim = $this->session->userdata('username');
			$th_ak = $this->input->post('thak');
			$smt = $this->input->post('semester');
			
			$where = "WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim'";
		
			
			$q = $this->db->query("SELECT * FROM krs $where ");
			if($q->num_rows()>0){		
				$dt['data'] = $q;
				echo $this->load->view('site_mahasiswa/khs/view',$dt);
			}else{
				echo $this->load->view('site_mahasiswa/view_kosong');
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak_khs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			
			$th_ak = $this->input->post('thak');
			$smt = $this->input->post('semester');
			$nim = $this->session->userdata('username');
			
			$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				$sess_data['th_ak'] = $th_ak;
				$sess_data['smt'] = $smt;
				$this->session->set_userdata($sess_data);
				echo "Sukses";		
			}else{
				echo "Maaf, Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function print_khs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			
			$th_ak = $this->session->userdata('th_ak');
			$smt = $this->session->userdata('smt');
			$nim = $this->session->userdata('username');
			
			$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				
				$nama 	= $this->model_data->cari_nama_mhs($nim);
				$kd_prodi	= $this->model_data->cari_kd_prodi_mhs($nim);
				$prodi = $this->model_data->nama_jurusan($kd_prodi);
				$data_prodi = $this->model_data->cari_nama_ka_prodi($kd_prodi);
				$nama_ka_prodi = $data_prodi['nama'];
				$nik_ka_prodi = $data_prodi['nik'];
				$semester = $this->model_data->cari_smt_krs($th_ak,$smt,$nim);
				$ip = $this->model_data->cari_ipk($semester,$nim);
				
				
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
					
					$h = 10;
					$pdf->SetFont('Times','B',16);
					$pdf->image(base_url().'assets/img/logo-black.png',95,5,20,20);
					$pdf->Ln(15);
					$pdf->Cell(190,8,$this->config->item('nama_pendek'),0,1,'C');
					$pdf->SetFont('Times','B',14);
					$pdf->Cell(190,5,$this->config->item('nama_instansi'),0,1,'C');
					$pdf->SetFont('Times','',10);
					$pdf->Cell(190,5,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'C');
					$pdf->Ln(7);
					
					//Column widths
					$pdf->SetFont('courier','B',14);
					$pdf->Cell(198,4,'KARTU HASIL STUDI (KHS) MAHASISWA',0,1,'C');
					$pdf->Ln(5);
					
					$h = 6;
					
					$pdf->SetFont('courier','',12);
					$pdf->Cell(30,$h,'NIM',0,0,'L');
					$pdf->Cell(50,$h,': '.$nim,0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(35,$h,'Tahun Akademik ',0,0,'L');
					$pdf->Cell(50,$h,': '.$th_ak,0,1,'L');	
					
					$pdf->Cell(30,$h,'Nama',0,0,'L');
					$pdf->Cell(50,$h,': '.strtoupper($nama),0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(35,$h,'Semester ',0,0,'L');
					$pdf->Cell(50,$h,': '.strtoupper($smt).'/'.$semester,0,1,'L');
					
					$pdf->Cell(30,$h,'PRODI',0,0,'L');
					$pdf->Cell(50,$h,': S1 - '.$prodi,0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(35,$h,'IP ',0,0,'L');
					$pdf->Cell(50,$h,': '.$ip,0,1,'L');					
					
					
					$w = array(10,20,85,10,20,20,20);
					
					//Header

					$pdf->SetFont('courier','B',10);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No.','TB',0,'C',$fill);
					$pdf->Cell($w[1],$h,'Kode','TB',0,'C',$fill);
					$pdf->Cell($w[2],$h,'Mata Kuliah','TB',0,'C',$fill);
					$pdf->Cell($w[3],$h,'SKS','TB',0,'C',$fill);
					$pdf->Cell($w[4],$h,'N.Huruf','TB',0,'C',$fill);
					$pdf->Cell($w[5],$h,'N.Angka','TB',0,'C',$fill);
					$pdf->Cell($w[6],$h,'N.Bobot','TB',0,'C',$fill);
					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$h = 7;
					$pdf->SetFont('courier','',9);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$jmlsks = 0;
					$jmlnilai= 0;
					foreach($q->result() as $row)
					{
						$sks = $row->sks;
						$angka = $this->model_data->cari_nilai_angka($row->nilai_akhir);
						$akhir = $angka*$sks;
						$pdf->Cell($w[0],$h,$no,0,0,'C',$fill);
						$pdf->Cell($w[1],$h,$row->kd_mk,0,0,'C',$fill);
						$pdf->Cell($w[2],$h,$row->nama_mk,0,0,'L',$fill);
						$pdf->Cell($w[3],$h,$row->sks,0,0,'C',$fill);
						$pdf->Cell($w[4],$h,$row->nilai_akhir,0,0,'C',$fill);
						$pdf->Cell($w[5],$h,$angka,0,0,'C',$fill);
						$pdf->Cell($w[6],$h,$akhir,0,0,'C',$fill);
						$pdf->Ln();
						//$fill = !$fill;
						$jmlsks = $jmlsks+$row->sks;
						$jmlnilai = $jmlnilai+$akhir;
						$no++;
					}
					//$ip = $jmlnilai/$jmlsks;
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
					$pdf->Ln();
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=6;
					$pdf->SetFont('courier','B',9);
					$pdf->Cell(115,$h,'J U M L A H :','T',0,'C',$fill);
					$pdf->Cell(10,$h, $jmlsks,'T',0,'C',$fill);
					$pdf->Cell(40,$h, '','T',0,'C',$fill);
					$pdf->Cell(20,$h, $jmlnilai,'T',0,'C',$fill);
					$pdf->Ln();
					$pdf->Cell(115,$h,'Indeks Prestasi (IP) :','TB',0,'C',$fill);
					$pdf->Cell(10,$h, '','TB',0,'C',$fill);
					$pdf->Cell(40,$h, number_format($ip,2),'TB',0,'C',$fill);
					$pdf->Cell(20,$h, '','TB',0,'C',$fill);
					
					$pdf->Ln(10);
					$h = 5;
					$pdf->SetFont('courier','',12);
					$pdf->Cell(50,$h,'Menyetujui',0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					$pdf->Cell(50,$h,'Ketua Program Studi,',0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,'Mahasiswa',0,1,'C');
					$pdf->Ln(20);
					$pdf->Cell(50,$h,$nama_ka_prodi,0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,$nama,0,1,'C');
					$pdf->Cell(50,$h,'NIK : '.$nik_ka_prodi,0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,'NIM :'.$nim,0,1,'C');
					
					
					$pdf->Ln(5);
					$h = 4;
					$pdf->SetFont('courier','B',8);
					$pdf->Cell(100,$h,'Catatan :',0,1,'L');
					$pdf->SetFont('courier','',8);
					$pdf->MultiCell(0,$h,'Jumlah maksimum SKS yang dapat diambil pada semester berikutnya berdasarkan indeks prestasi (IP) adalah sebagai berikut :');
					$pdf->Ln();
					$pdf->Cell(20,$h,'3.00 - 4.00',0,0,'L');
					$pdf->Cell(50,$h,'= 24 SKS',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(20,$h,'2.50 - 2.99',0,0,'L');
					$pdf->Cell(50,$h,'= 22 SKS',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(20,$h,'2.00 - 2.49',0,0,'L');
					$pdf->Cell(50,$h,'= 20 SKS',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(20,$h,'1.50 - 1.99',0,0,'L');
					$pdf->Cell(50,$h,'= 16 SKS',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(20,$h,'1.00 - 1.49',0,0,'L');
					$pdf->Cell(50,$h,'= 14 SKS',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(20,$h,'0.00 - 0.99',0,0,'L');
					$pdf->Cell(50,$h,'= 12 SKS',0,0,'L');
					$pdf->footer();
				//}
					
				//}
				$pdf->Output('KHS_'.$th_ak.'_'.$smt.'_'.$nim.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('khs');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */