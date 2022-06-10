<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Isi_krs extends CI_Controller {

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
			$d['judul']="Kartu Rencana Studi (KRS) Mahasiswa";
			$d['class'] = "master";
			
			date_default_timezone_set('Asia/Jakarta');
			$nim = $this->session->userdata('username');
			
			/*** config ***/
			$thak = $this->model_global->cari_th_akademik();
			$d['thak'] = $thak;
			
			$semester = $this->model_global->cari_semester();
			$d['semester'] = $semester;
			if($semester=='ganjil'){
				$ket_smt ='1';
			}else{
				$ket_smt ='2';
			}
			
			
			$smt = $this->model_global->semester($nim,$thak);
			$d['smt'] = $smt;
			
			$ip = $this->model_data->cari_ipk_lalu($smt,$nim);
			$d['ip'] = $ip;
			$d['max_sks'] =  $this->model_global->max_sks($ip);
			
			$d['nim'] = $nim;
			$d['nama'] = $this->session->userdata('nama_lengkap');
			
			$kd_prodi = $this->session->userdata('kd_prodi');
			$d['kd_prodi'] = $kd_prodi;
			$d['nama_prodi'] = $this->model_data->nama_jurusan($kd_prodi);
			
			
			/** lihat tgl isi krs **/
			$tgl = date('Y-m-d');
			$q_krs = $this->db->query("SELECT * FROM setting WHERE id='1' AND form='KRS'");
			foreach($q_krs->result() as $dt_krs){
				$tgl_close = $dt_krs->tgl_close;
			}
			$d['tgl_close'] = $tgl_close;
			
			if($tgl<=$tgl_close){
				$d['content']= 'site_mahasiswa/isi_krs/form';
			}else{
				$d['content']= 'site_mahasiswa/isi_krs/form_close';
			}
			$this->load->view('site_mahasiswa/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_mata_kuliah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			$id['th_akademik']	= $this->input->post('thak');
			$id['kd_prodi']	= $this->input->post('kd_prodi');
			$id['semester']	= $this->input->post('semester');
			
			$q = $this->db->get_where("jadwal",$id);
			$row = $q->num_rows();
			if($row>0){
				echo "<option value=''>-Pilih Mata Kuliah-</option>";
				foreach($q->result() as $dt){
					$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
					$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
				?>
                	<option value="<?php echo $dt->id_jadwal;?>"><?php echo $dt->kd_mk;?> - <?php echo $nama_mk;?> - <?php echo $dt->kd_dosen;?> - <?php echo $nama_dosen;?> - <?php echo $dt->hari.' - '.$dt->pukul.' - '.$dt->ruang;?></option>
                <?php
				}
			}else{
				echo "<option value=''>Belum Ada Mata Kuliah</option>";
			}
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
			//if($q->num_rows()>0){
				$dt['data'] = $q;
				echo $this->load->view('site_mahasiswa/isi_krs/view',$dt);
			//}else{
			//	echo $this->load->view('site_mahasiswa/view_kosong');
			//}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			
			$id_jadwal = $this->input->post('id_jadwal'); //'4';//
			
			$th_ak = $this->input->post('thak'); //'2014/2015';//
			$smt = $this->input->post('semester'); //'ganjil';//
			$nim = $this->session->userdata('username'); //'TI20140001';//
			
			/** Validasi JUMLAH SKS **/
			$jml_sks = $this->model_data->cari_jml_sks_krs($th_ak,$smt,$nim);
			$sks = $this->model_data->cari_sks_jadwal($id_jadwal);
			$t_sks = $jml_sks+$sks;
			$max_sks = $this->input->post('max_sks');
			if($t_sks>$max_sks){
				echo "Anda tidak boleh melebihi ".$max_sks." SKS";
			}else{
				
				$id['th_akademik'] = $this->input->post('thak');
				$id['semester'] = $this->input->post('semester');
				$id['nim'] = $this->session->userdata('username');
				$id['smt'] = $this->input->post('smt');
				$id['id_jadwal'] = $id_jadwal;
				
				$dt['th_akademik'] = $this->input->post('thak');
				$dt['semester'] = $this->input->post('semester');
				$dt['nim'] = $this->session->userdata('username');
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
		if(!empty($cek) && $level=='mahasiswa'){
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
	
	
	public function cetak_krs()
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
	
	public function print_krs()
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
				$ip_lalu = $this->model_data->cari_ipk_lalu($semester,$nim);
				$max_sks = $this->model_global->max_sks($ip_lalu);
				
				
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
					$pdf->Ln(10);
					
					//Column widths
					$pdf->SetFont('courier','B',16);
					$pdf->Cell(198,4,'KARTU RENCANA STUDI (KRS) MAHASISWA',0,1,'C');
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
					$pdf->Cell(35,$h,'IP smt. Lalu ',0,0,'L');
					$pdf->Cell(50,$h,': '.$ip_lalu.' Max '.$max_sks.' SKS',0,1,'L');					
					
					
					$w = array(8,60,10,15,20,20,55);
					
					//Header

					$pdf->SetFont('courier','B',10);
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
					$pdf->SetFont('helvetica','',8);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$jmlsks = 0;
					foreach($q->result() as $row)
					{
						$pdf->Cell($w[0],$h,$no,0,0,'C',$fill);
						$pdf->Cell($w[1],$h,'['.$row->kd_mk.'] '.$row->nama_mk,0,0,'L',$fill);
						$pdf->Cell($w[2],$h,$row->sks,0,0,'C',$fill);
						$pdf->Cell($w[3],$h,$row->hari,0,0,'C',$fill);
						$pdf->Cell($w[4],$h,$row->pukul,0,0,'C',$fill);
						$pdf->Cell($w[5],$h,$row->ruang,0,0,'C',$fill);
						$pdf->Cell($w[6],$h,$row->nm_dosen,0,0,'L',$fill);
						$pdf->Ln();
						//$fill = !$fill;
						$jmlsks = $jmlsks+$row->sks;
						$no++;
					}
					// Closing line
					$pdf->SetFont('courier','B',11);
					$pdf->Cell(array_sum($w),0,'','T');
					$pdf->Ln();
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$pdf->Cell(68,$h,'Jumlah SKS :','TB',0,'R',$fill);
					$pdf->Cell(10,$h, $jmlsks,'TB',0,'C',$fill);
					$pdf->Cell(110,$h, '','TB',0,'C',$fill);
					
					$pdf->SetFont('courier','',11);
					$pdf->Ln(10);
					$h = 5;
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
	
	/*
	function tes(){
		$nim = $this->session->userdata('username');
		$nama 	= $this->model_data->cari_nama_mhs($nim);
				$kd_prodi	= $this->model_data->cari_kd_prodi_mhs($nim);
				$prodi = $this->model_data->nama_jurusan($kd_prodi);
				$nama_ka_prodi = $this->model_data->cari_nama_ka_prodi($kd_prodi);
		echo $nama_ka_prodi['nama'];
	}
	*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */