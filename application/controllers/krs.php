<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Krs extends CI_Controller {

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
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Kartu Rencana Studi";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query("SELECT a.id_krs,a.id_jadwal,a.th_akademik,a.semester,b.kd_prodi 
										FROM krs as a
										JOIN jadwal as b
										ON a.id_jadwal = b.id_jadwal
										 GROUP BY a.th_akademik,a.semester,b.kd_prodi");
			$d['content'] = 'krs/view_data';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function view_detail()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['id_jadwal'] = $this->uri->segment(3);
			
			$q = $this->db->get_where('krs',$id);
			if($q->num_rows>0){
				foreach($q->result() as $dt){
					$th_ak = $dt->th_akademik;
					$kd_prodi = $dt->kd_prodi;
					$prodi = $this->model_data->nama_jurusan($kd_prodi);
					$key = $dt->id_jadwal;
				}
				$d['judul']="Detail Pengambilan KRS Tahun Akademik ".$th_ak." Program Studi ".$prodi;
				$d['class'] = "transaksi";
				/*
				$this->db->form('krs');
				$this->db->join('mahasiswa','krs.nim=mahasiswa.nim');
				$this->db->where('id_krs',$key);
				$query = $this->db->get();
				$d['data'] = $query;
				*/

				$d['data'] = $this->db->query("SELECT a.id_krs,a.id_jadwal,a.th_akademik,
											b.nim,b.nama_mhs,b.kd_prodi,b.status 
											FROM krs as a
											JOIN mahasiswa as b
											ON a.nim = b.nim
											WHERE a.id_jadwal='$key'");
	
				$d['content'] = 'krs/view_data_detail';
				$this->load->view('home',$d);
			}else{
				redirect('krs','refresh');
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Kartu Rencana Studi";
			$d['class'] = "transaksi";
			
			$d['content'] = 'krs/form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
	
	public function cari_nim()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$th_ak = $this->input->post('th_ak');
			$id['nim']	= $this->input->post('nim');
			
			$q = $this->db->get_where("mahasiswa",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['nama'] = $dt->nama_mhs;
					$d['kd_prodi'] = $dt->kd_prodi;
					$d['nm_prodi'] = $this->model_data->nama_jurusan($dt->kd_prodi);
					$d['smt'] = $this->model_global->semester($dt->nim,$th_ak);
				}
				echo json_encode($d);
			}else{
				$d['nama'] = '';
				$d['kd_prodi'] = '';
				$d['nm_prodi'] = '';
				$d['smt'] = '';
				echo json_encode($d);
			}
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
				foreach($q->result() as $dt){
					$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
					$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
				?>
                	<option value="<?php echo $dt->id_jadwal;?>"><?php echo $dt->kd_mk;?> - <?php echo $nama_mk;?> - <?php echo $dt->kd_dosen;?> - <?php echo $nama_dosen;?> - <?php echo $dt->hari.' - '.$dt->pukul.' - '.$dt->ruang;?></option>
                <?php
				}
			}else{
				echo "<option value=''>Belum Ada Jadwal ..!!!</option>";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$id_jadwal = $this->input->post('id_jadwal'); //'4';//
			
			$th_ak = $this->input->post('th_ak'); //'2014/2015';//
			$smt = $this->input->post('semester'); //'ganjil';//
			$nim = $this->input->post('nim'); //'TI20140001';//
			
			/** Validasi JUMLAH SKS **/
			$jml_sks = $this->model_data->cari_jml_sks_krs($th_ak,$smt,$nim);
			$sks = $this->model_data->cari_sks_jadwal($id_jadwal);
			$t_sks = $jml_sks+$sks;
			$max_sks = $this->input->post('max_sks');
			if($t_sks>$max_sks){
				echo "Anda tidak boleh melebihi ".$max_sks." SKS";
			}else{
				
				$id['th_akademik'] = $this->input->post('th_ak');
				$id['semester'] = $this->input->post('semester');
				$id['nim'] = $this->input->post('nim');
				$id['smt'] = $this->input->post('smt');
				$id['id_jadwal'] = $id_jadwal;
				
				$dt['th_akademik'] = $this->input->post('th_ak');
				$dt['semester'] = $this->input->post('semester');
				$dt['nim'] = $this->input->post('nim');
				$dt['smt'] = $this->input->post('smt');
				$dt['id_jadwal'] = $id_jadwal;
				$dt['kd_prodi'] = $this->model_data->cari_kd_prodi_mhs($nim);
				//cari kd_mk
				$q = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal='$id_jadwal'");
				foreach($q->result() as $dt_j){
					$kd_mk = $dt_j->kd_mk;
					$kd_dosen = $dt_j->kd_dosen;
					
					$dt['kd_mk'] = $kd_mk;
					$dt['kd_dosen'] = $kd_dosen;
					$dt['ruang'] = $dt_j->ruang;
					$dt['hari'] = $dt_j->hari;
					$dt['pukul'] = $dt_j->pukul;
				}
				//cari nama_mk
				$q_mk = $this->db->query("SELECT * FROM mata_kuliah WHERE kd_mk='$kd_mk'");
				foreach($q_mk->result() as $dt_mk){
					$dt['nama_mk'] = $dt_mk->nama_mk;
					$dt['sks'] = $dt_mk->sks;
				}
				//cari nama dosen 
				$dt['nm_dosen'] = $this->model_data->cari_nama_dosen($kd_dosen);
				
				$q_krs = $this->db->get_where("krs",$id);
				$row = $q_krs->num_rows();
				if($row>0){
					$dt['tgl_update'] = date('Y-m-d h:i:s');
					$this->db->update("krs",$dt,$id);
					echo "Data Sukses diUpdate";
				}else{
					$dt['tgl_insert'] = date('Y-m-d h:i:s');
					$this->db->insert("krs",$dt);
					echo "Data Sukses diSimpan";
				}
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['id_krs']	= $this->input->post('id');
			
			$q = $this->db->get_where("krs",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("krs",$id);
				echo "Data sukses dihapus";
			}
			//redirect('krs','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function cari_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['th_akademik']	= $this->input->post('th_ak');
			$id['nim']	= $this->input->post('nim');
			$id['semester']	= $this->input->post('smt');
			
			//$this->db->order('hari','pukul');
			$d['data'] = $this->db->get_where("krs",$id);
			echo $this->load->view('krs/view',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
	public function cetak_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$th_ak = $this->input->post('th_ak');
			$smt = $this->input->post('semester');
			$nim = $this->input->post('nim');
			
			$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				$sess_data['th_ak'] = $th_ak;
				$sess_data['smt'] = $smt;
				$sess_data['nim'] = $nim;
				$this->session->set_userdata($sess_data);
				echo "Sukses";		
			}else{
				echo "Maaf, Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function print_krs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$th_ak = $this->session->userdata('th_ak');
			$smt = $this->session->userdata('smt');
			$nim = $this->session->userdata('nim');
			
			$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				
				$nama 	= $this->model_data->cari_nama_mhs($nim);
				$kd_prodi	= $this->model_data->cari_kd_prodi_mhs($nim);
				$prodi = $this->model_data->nama_jurusan($kd_prodi);
				$semester = $this->model_data->cari_smt_krs($th_ak,$smt,$nim);
				$ip_lalu = $this->model_data->cari_ipk_lalu($semester,$nim);
				
				
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
					$pdf->SetFont('Times','B',18);
					$pdf->Cell(198,7,$this->config->item('nama_pendek'),0,1,'C');
					$pdf->SetFont('Times','B',14);
					$pdf->Cell(198,7,$this->config->item('nama_instansi'),0,1,'C');
					$pdf->SetFont('Times','',10);
					$pdf->Cell(198,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'C');
					$pdf->Ln(8);
					
					//Column widths
					$pdf->SetFont('Arial','B',16);
					$pdf->Cell(198,4,'KARTU RENCANA STUDI (KRS) MAHASISWA',0,1,'C');
					$pdf->Ln(5);
					
					$h = 6;
					
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(30,$h,'NIM',0,0,'L');
					$pdf->Cell(50,$h,': '.$nim,0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(35,$h,'Tahun Akademik ',0,0,'L');
					$pdf->Cell(50,$h,': '.$th_ak,0,1,'L');	
					
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(30,$h,'Nama',0,0,'L');
					$pdf->Cell(50,$h,': '.strtoupper($nama),0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(35,$h,'Semester ',0,0,'L');
					$pdf->Cell(50,$h,': '.strtoupper($smt).'/'.$semester,0,1,'L');
					
					$pdf->SetFont('Arial','',12);
					$pdf->Cell(30,$h,'PRODI',0,0,'L');
					$pdf->Cell(50,$h,': S1 - '.$prodi,0,0,'L');
					$pdf->SetX(120);
					$pdf->Cell(35,$h,'IP smt. Lalu ',0,0,'L');
					$pdf->Cell(50,$h,': '.$ip_lalu,0,1,'L');					
					
					
					$w = array(10,75,10,15,20,20,40);
					
					//Header

					$pdf->SetFont('Arial','B',11);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No','TB',0,'C',$fill);
					$pdf->Cell($w[1],$h,'Mata Kuliah','TB',0,'C',$fill);
					$pdf->Cell($w[2],$h,'SKS','TB',0,'C',$fill);
					$pdf->Cell($w[3],$h,'Hari','TB',0,'C',$fill);
					$pdf->Cell($w[4],$h,'Pukul','TB',0,'C',$fill);
					$pdf->Cell($w[5],$h,'Ruang','TB',0,'C',$fill);
					$pdf->Cell($w[6],$h,'Dosen','TB',0,'C',$fill);
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
						$pdf->Cell($w[0],$h,$no,0,0,'C',$fill);
						$pdf->Cell($w[1],$h,$row->kd_mk.'-'.$row->nama_mk,0,0,'L',$fill);
						$pdf->Cell($w[2],$h,$row->sks,0,0,'C',$fill);
						$pdf->Cell($w[3],$h,$row->hari,0,0,'C',$fill);
						$pdf->Cell($w[4],$h,$row->pukul,0,0,'C',$fill);
						$pdf->Cell($w[5],$h,$row->ruang,0,0,'C',$fill);
						$pdf->Cell($w[6],$h,$row->nm_dosen,0,0,'L',$fill);
						$pdf->Ln();
						$fill = !$fill;
						$jmlsks = $jmlsks+$row->sks;
						$no++;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
					$pdf->Ln();
					$pdf->Cell(85,$h,'Jumlah SKS :',0,0,'R');
					$pdf->Cell(10,$h, $jmlsks,0,0,'C');
					
					$pdf->Ln(10);
					$h = 5;
					$pdf->Cell(50,$h,'Menyetujui',0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					$pdf->Cell(50,$h,'Dosen Pembimbing,',0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,'Mahasiswa',0,1,'C');
					$pdf->Ln(20);
					$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,$nama,0,1,'C');
					$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(110);
					$pdf->Cell(100,$h,'NIM :'.$nim,0,1,'C');
				//}
					
				//}
				$pdf->Output('KRS_'.$th_ak.'_'.$smt.'_'.$nim.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('krs');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */