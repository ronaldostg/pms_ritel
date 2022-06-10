<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wisuda extends CI_Controller {

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
			$d['judul']="Input Daftar Wisuda";
			$d['class'] = "master";
			/*
			$th_now = date('Y');
			$th_next = $th_now+1;
			$th_ak	= $th_now.'/'.$th_next;
			*/
			date_default_timezone_set('Asia/Jakarta');
			
			$d['thak'] =  $this->model_global->cari_th_akademik(); 
			$d['tgl'] = date('d-m-Y');
			$d['nim'] = $this->session->userdata('username');
			$d['nama_mhs'] =$this->session->userdata('nama_lengkap');
			
			/** lihat tgl isi Wisuda **/
			$tgl = date('Y-m-d');
			$q_krs = $this->db->query("SELECT * FROM setting WHERE id='2' AND form='Wisuda'");
			foreach($q_krs->result() as $dt_krs){
				$tgl_close = $dt_krs->tgl_close;
			}
			$d['tgl_close'] = $tgl_close;
			
			$status = $this->session->userdata('status');
			if($status=='Lulus'){
				$d['content']= 'site_mahasiswa/wisuda';
			}else{
				if($tgl<=$tgl_close){
					$d['content']= 'site_mahasiswa/wisuda';
				}else{
					$d['content']= 'site_mahasiswa/form_close_wisuda';
				}
			}
			$this->load->view('site_mahasiswa/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			$id['nim']	= $this->session->userdata('username');
			
			$q = $this->db->get_where("wisuda",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_str($dt->tgl_daftar);
					$tgl_sidang = $this->model_global->tgl_str($dt->tgl_sidang);
					$d['thak'] = $dt->th_akademik;
					$d['tgl'] = $tgl;
					$d['nim'] = $dt->nim;
					$d['tgl_sidang'] = $tgl_sidang;
					$d['skripsi'] = $dt->judul_skripsi;
					$d['ipk'] = $dt->ipk;
					$d['validasi'] = $dt->acc_akademik;
				}
				echo json_encode($d);
			}else{
				$d['thak'] =  $this->model_global->cari_th_akademik(); 
				$d['tgl'] = date('d-m-Y');
				$d['nim'] = $this->session->userdata('username');
				$d['tgl_sidang'] = date('d-m-Y');
				$d['skripsi'] = '';
				$d['ipk'] = '';
				$d['validasi'] = 'T';
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			date_default_timezone_set('Asia/Jakarta');
			
			$id['nim'] = $this->session->userdata('username');
			$tgl = $this->model_global->tgl_sql($this->input->post('tgl'));
			$tgl_sidang = $this->model_global->tgl_sql($this->input->post('tgl_sidang'));
			
			$dt['th_akademik'] = $this->input->post('thak');
			$dt['tgl_daftar'] = $tgl;
			$dt['nim'] = $this->session->userdata('username');
			$dt['tgl_sidang'] = $tgl_sidang;
			$dt['judul_skripsi'] = $this->input->post('skripsi');
			$dt['ipk'] = $this->input->post('ipk');
						
			$q = $this->db->get_where("wisuda",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("wisuda",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("wisuda",$dt);
				echo "Data Sukses diSimpan";
			}
			
		}else{
			redirect('login','refresh');
		}
		
	}
	
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='mahasiswa'){
			$nim	= $this->session->userdata('username');
			
			$q = $this->db->query("SELECT * FROM wisuda as a 
									JOIN mahasiswa as b
									ON a.nim=b.nim
									WHERE a.nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				
				foreach($q->result() as $dt){
					$tgl_daftar= $this->model_global->tgl_indo($dt->tgl_daftar);
					$thak 	= $dt->th_akademik;
					$nama	= $dt->nama_mhs;
					if($dt->sex=='L'){
						$sex	= 'Laki-laki';
					}else{
						$sex = 'Perempuan';
					}
					$prodi	= $dt->kd_prodi.'-'.$this->model_data->nama_jurusan($dt->kd_prodi);
					$tmpt_lhr	= $dt->tempat_lahir;
					$tgl_lhr	= $this->model_global->tgl_indo($dt->tanggal_lahir);
					$alamat	= $dt->alamat;
					$tgl_sidang= $this->model_global->tgl_indo($dt->tgl_sidang);
					$skripsi	= $dt->judul_skripsi;
					$ipk	= $dt->ipk;
				}
				
				
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
					$pdf->Cell(190,5,'FORMULIR PENDAFTARAN WISUDA',0,1,'C');
					$pdf->Cell(190,5,$thak,0,1,'C');
					$pdf->Ln(10);
					
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					
					$h = 10;
					$wl = 50;
					$wr = 140;
					$pdf->SetFont('courier','',14);
					$pdf->Cell($wl,$h,'Tanggal :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$tgl_daftar,'TR',1,'L');
					$pdf->Cell($wl,$h,'NIM :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$nim,'TR',1,'L');
					$pdf->Cell($wl,$h,'Nama Lengkap :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$nama,'TR',1,'L');
					$pdf->Cell($wl,$h,'jenis Kelamin :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$sex,'TR',1,'L');
					$pdf->Cell($wl,$h,'Tempat Lahir :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$tmpt_lhr,'TR',1,'L');
					$pdf->Cell($wl,$h,'Tanggal Lahir :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$tgl_lhr,'TR',1,'L');
					$pdf->Cell($wl,$h,'Alamat :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$alamat,'TR',1,'L');
					$pdf->Cell($wl,$h,'Program Studi :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$prodi,'TR',1,'L');
					$pdf->Cell($wl,$h,'Tanggal Sidang :','LTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$tgl_sidang,'TR',1,'L');
					$pdf->Cell(190,$h,'Judul Skripsi :','LTR',1,'C',$fill);
					$fill = false;
					$pdf->MultiCell(190,7,$skripsi,'LTR',1,'L',$fill);
					$fill = true;
					$pdf->Cell($wl,$h,'IPK :','LBTR',0,'R',$fill);
					$pdf->Cell($wr,$h,$ipk,'BTR',1,'L');
					
					
					$h = 7;
					$pdf->Ln(10);
					$pdf->SetX(100);
					$pdf->Cell(80,$h,'Serang, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					$pdf->SetX(100);
					$pdf->Cell(80,$h,'Mahasiswa yang bersangkutan,',0,1,'C');
					$pdf->Ln(20);
					$pdf->SetX(100);
					$pdf->Cell(80,$h,$nama,0,1,'C');
					
					$pdf->footer();
				//}
					
				//}
				$pdf->Output('Pendaftaran_Wisuda_'.$nim.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('site_mahasiswa/wisuda');
				//echo "Maaf Tidak ada data";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */