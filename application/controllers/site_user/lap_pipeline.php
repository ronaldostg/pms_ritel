<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_pipeline extends CI_Controller {

//	*
//	 * Index Page for this controller.
//	 * Programmer : Deddy Rusdiansyah.S.Kom
//	 * http://deddyrusdiansyah.blogspot.com
//	 * http://softwarebanten.com
//	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			$d['judul']="Laporan Data Pipeline";
			$d['class'] = "laporan";
			
			$d['content']= 'site_user/lap_pipeline/form';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}

	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
		
	public function cari_data()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

			$posisi_data = $this->input->post('posisi_data');
			$status_prospek = $this->input->post('status_prospek');
			$status_kondisi_data = $this->input->post('status_kondisi_data');

						$where = "WHERE id_user_pic='$username' AND status_data='2' ";
						$q = $this->db->query("SELECT SUM(nominal_prospek_awal) AS nominal_prospek FROM v_lap_prospek $where ");
						$dt['data'] = $q;
						echo $this->load->view('site_user/lap_pipeline/view',$dt);		
										

		}else{
			redirect('login','refresh');
		}
	}

	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	
	public function cari_semua_data_prospek()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){
//			$id['id_prospek'] = $this->input->post('kode');
//			
//			$dt['id_prospek'] = $this->input->post('kode');
//			$dt['id_user_pic'] = $username;
			$where = "WHERE id_user_pic='$username' AND status_data='2' ";
			
			$q = $this->db->query("SELECT * FROM v_prospek $where ");
			$dt['data'] = $q;
			
			echo $this->load->view('site_user/lap_pipeline/view',$dt);
			
		}else{
			redirect('login','refresh');
		}
	
	}
	
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	
	public function cetak_lap_prospek()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			
			$posisi_data = $this->input->post('thak');
			$smt = $this->input->post('semester');
			$nim = $this->session->userdata('username');
			
			$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$posisi_data' AND semester='$smt' AND nim='$nim' ");
			$r = $q->num_rows();
			
			if($r>0){
				$sess_data['posisi_data'] = $posisi_data;
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
	
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	
	public function cetak_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

//			$jlh_prospek = $this->model_data->sum_data_prospek($username);
//			$jlh_target = $this->model_data->sum_data_target($username);
//			$jlh_data_coll = $this->model_data->sum_data_data_coll($username);
//			$jlh_analisa = $this->model_data->sum_data_analisa($username);
//			$jlh_komite = $this->model_data->sum_data_komite($username);
//			$jlh_sppk = $this->model_data->sum_data_sppk($username);
//			$jlh_pk = $this->model_data->sum_data_pk($username);
//			$jlh_on_book = $this->model_data->sum_data_on_book($username);
//			$jlh_prospekxx = $this->model_data->sum_data_nominal_tabel("t_prospek","nominal_prospek_awal","user",$username);

			$jlh_prospek = $this->model_data->sum_data_nominal_tabel("t_prospek","nominal_prospek_awal","user",$username);
			$jlh_target = $this->model_data->sum_data_nominal_tabel("t_target","nominal","user",$username);
			$jlh_data_coll = $this->model_data->sum_data_nominal_tabel("t_data_collect","nominal","user",$username);
			$jlh_analisa = $this->model_data->sum_data_nominal_tabel("t_analisa","nominal","user",$username);
			$jlh_komite = $this->model_data->sum_data_nominal_tabel("t_komite","nominal","user",$username);
			$jlh_sppk = $this->model_data->sum_data_nominal_tabel("t_sppk","nominal","user",$username);
			$jlh_pk = $this->model_data->sum_data_nominal_tabel("t_pk","nominal","user",$username);
			$jlh_on_book = $this->model_data->sum_data_nominal_tabel("t_on_book","nominal","user",$username);

			
			$jlh_prospek1=0.3*$jlh_prospek;
			$jlh_prospek2=0.6*$jlh_prospek1;
			$jlh_prospek3=0.7*$jlh_prospek2;
			$jlh_prospek4=0.8*$jlh_prospek3;
			$jlh_prospek5=0.8*$jlh_prospek4;
			$jlh_prospek6=0.8*$jlh_prospek5;
			$jlh_prospek7=0.6*$jlh_prospek6;

			$jlh_target2=0.6*$jlh_target;
			$jlh_target3=0.7*$jlh_target2;
			$jlh_target4=0.8*$jlh_target3;
			$jlh_target5=0.8*$jlh_target4;
			$jlh_target6=0.8*$jlh_target5;
			$jlh_target7=0.6*$jlh_target6;

			$jlh_data_coll3=0.7*$jlh_data_coll;
			$jlh_data_coll4=0.8*$jlh_data_coll3;
			$jlh_data_coll5=0.8*$jlh_data_coll4;
			$jlh_data_coll6=0.8*$jlh_data_coll5;
			$jlh_data_coll7=0.6*$jlh_data_coll6;

			$jlh_analisa4=0.8*$jlh_analisa;
			$jlh_analisa5=0.8*$jlh_analisa4;
			$jlh_analisa6=0.8*$jlh_analisa5;
			$jlh_analisa7=0.6*$jlh_analisa6;
						
			$jlh_komite5=0.8*$jlh_komite;
			$jlh_komite6=0.8*$jlh_komite5;
			$jlh_komite7=0.6*$jlh_komite6;

			$jlh_sppk6=0.8*$jlh_sppk;
			$jlh_sppk7=0.6*$jlh_sppk6;
									
			$jlh_pk7=0.6*$jlh_pk;
			
			$jlh_jlh_on_book=$jlh_prospek7+$jlh_target7+$jlh_data_coll7+$jlh_analisa7+$jlh_komite7+$jlh_sppk7+$jlh_pk7;


			$sess_data['jlh_prospek'] = $jlh_prospek;
			$sess_data['jlh_target'] = $jlh_target;
			$sess_data['jlh_data_coll'] = $jlh_data_coll;
			$sess_data['jlh_analisa'] = $jlh_analisa;
			$sess_data['jlh_komite'] = $jlh_komite;
			$sess_data['jlh_sppk'] = $jlh_sppk;	
			$sess_data['jlh_pk'] = $jlh_pk;	
			$sess_data['jlh_on_book'] = $jlh_on_book;	
			
			$sess_data['jlh_prospek7'] = $jlh_prospek7;
			$sess_data['jlh_target7'] = $jlh_target7;
			$sess_data['jlh_data_coll7'] = $jlh_data_coll7;
			$sess_data['jlh_analisa7'] = $jlh_analisa7;
			$sess_data['jlh_komite7'] = $jlh_komite7;
			$sess_data['jlh_sppk7'] = $jlh_sppk7;	
			$sess_data['jlh_pk7'] = $jlh_pk7;	
			$sess_data['jlh_jlh_on_book'] = $jlh_jlh_on_book;	
//			echo $username;	
//			echo "khh";			
//			$sess_data['nama_user'] = $this->model_data->ambil_data_user("nama_user",$username);			
			$sess_data['nama_user'] = $this->model_data->ambil_data_user("nama_user","user",$username);

			$sess_data['rp_target_tumbuh'] = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_target_tumbuh","user",$username,date("Y"));
			$sess_data['rp_existing_debitur'] = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_existing_debitur","user",$username,date("Y"));
			$sess_data['rp_pelunasan'] = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_pelunasan","user",$username,date("Y"));

//			$sess_data['rp_target_tumbuh'] = $this->model_data->ambil_data_rencana_kerja("rp_target_tumbuh",$username,date("Y"));
//			$sess_data['rp_existing_debitur'] = $this->model_data->ambil_data_rencana_kerja("rp_existing_debitur",$username,date("Y"));
//			$sess_data['rp_pelunasan'] = $this->model_data->ambil_data_rencana_kerja("rp_pelunasan",$username,date("Y"));



		
			$this->session->set_userdata($sess_data);
			echo "Sukses";
	
		}else{
			redirect('login','refresh');
		}
	}
	
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		
	public function print_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

//						$where = "WHERE status_data='6' AND id_user_pic='$username' AND status_data='2' AND kode_status='0' ";
//						$q = $this->db->query("SELECT * FROM v_lap_on_book $where ");
//						$r = $q->num_rows();					
//		
//			if($r>0){
				$jlh_prospek = $this->session->userdata('jlh_prospek');
				$jlh_target = $this->session->userdata('jlh_target');
				$jlh_data_coll = $this->session->userdata('jlh_data_coll');
				$jlh_analisa = $this->session->userdata('jlh_analisa');
				$jlh_komite = $this->session->userdata('jlh_komite');
				$jlh_sppk = $this->session->userdata('jlh_sppk');
				$jlh_pk = $this->session->userdata('jlh_pk');
				$jlh_on_book = $this->session->userdata('jlh_on_book');


				$jlh_prospek7 = $this->session->userdata('jlh_prospek7');
				$jlh_target7 = $this->session->userdata('jlh_target7');
				$jlh_data_coll7 = $this->session->userdata('jlh_data_coll7');
				$jlh_analisa7 = $this->session->userdata('jlh_analisa7');
				$jlh_komite7 = $this->session->userdata('jlh_komite7');
				$jlh_sppk7 = $this->session->userdata('jlh_sppk7');
				$jlh_pk7 = $this->session->userdata('jlh_pk7');
				$jlh_jlh_on_book = $this->session->userdata('jlh_jlh_on_book');
				$nama_user = $this->session->userdata('nama_user');


				$rp_target_tumbuh = $this->session->userdata('rp_target_tumbuh');
				$rp_existing_debitur = $this->session->userdata('rp_existing_debitur');
				$rp_pelunasan = $this->session->userdata('rp_pelunasan');
				$rp_wajib_expansi = $this->session->userdata('rp_target_tumbuh')+$this->session->userdata('rp_pelunasan');
				$rp_target_os = $this->session->userdata('rp_target_tumbuh')+$this->session->userdata('rp_existing_debitur');
				$rp_potensi_on_book = $this->session->userdata('jlh_jlh_on_book');
				$rp_lebih_kurang = $rp_potensi_on_book-$rp_wajib_expansi;
	
				
							
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
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(6);

					
					//$w = array(10,25,30,30,80,10,30,35,25);
					

						$pdf->Cell(200,4,'Laporan Data Pipeline',0,1,'C');
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(190,4,'Nama RM : '.$nama_user ,0,1,'C');
						$pdf->Ln(5);	

						$w = array(112,80);
						//Header
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'Pipeline Kredit',1,0,'C');
						$pdf->Cell($w[1],$h,'Rencana Kerja',1,0,'C');
						$pdf->Ln();

											
						$w = array(10,25,30,17,30,10,40,30);
						//Header
						$pdf->SetFont('Arial','',8);
						$pdf->Cell($w[0],$h,'No',1,0,'C');
						$pdf->Cell($w[1],$h,'Aktivitas',1,0,'C');
						$pdf->Cell($w[2],$h,'Jumlah (Rp)',1,0,'C');
						$pdf->Cell($w[3],$h,'Asumsi (%)',1,0,'C');
						$pdf->Cell($w[4],$h,'Jumlah Potensi',1,0,'C');
						$pdf->Cell($w[5],$h,'No',1,0,'C');
						$pdf->Cell($w[6],$h,'Perhitungan',1,0,'C');
						$pdf->Cell($w[7],$h,'Jumlah (Rp)',1,0,'C');

					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$pdf->SetFont('Arial','',8);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$total=0;
//					foreach($q->result() as $row)
//					{
						//$sing = $this->model_data->singkat_jurusan($row->kd_prodi);
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'Prospek','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_prospek,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"30%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_prospek7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Target Tumbuh','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_target_tumbuh,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'Target','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_target,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"60%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_target7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Existing Debitur','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_existing_debitur,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'Data Coll','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_data_coll,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"70%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_data_coll7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Rencana Pelunasan','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_pelunasan,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'Analisa','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_analisa,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"80%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_analisa7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Wajib Ekspansi','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_wajib_expansi,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'Komite','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_komite,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"80%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_komite7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Target OS','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_target_os,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'SPPK','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_sppk,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"80%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_sppk7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Potensi On Book','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_potensi_on_book,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'PK','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_pk,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"60%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($jlh_pk7,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'Lebih / Kurang','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,number_format($rp_lebih_kurang,0),'LR',0,'R',$fill);	
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						$pdf->Cell($w[0],$h,$no,'LR',0,'C',$fill);
						$pdf->Cell($w[1],$h,'On Book','LR',0,'L',$fill);
						$pdf->Cell($w[2],$h,number_format($jlh_on_book,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);
						$pdf->Cell($w[3],$h,"0%",'LR',0,'C',$fill);	
						$pdf->Cell($w[4],$h,number_format($rp_potensi_on_book,0),'LR',0,'R',$fill);	
						$pdf->Cell($w[5],$h,'','LR',0,'C',$fill);
						$pdf->Cell($w[6],$h,'','LR',0,'L',$fill);
						$pdf->Cell($w[7],$h,'','LR',0,'R',$fill);	

						
//						$pdf->Cell($w[3],$h,$row->kode_status,'LR',0,'L',$fill);						
//						$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,35),'LR',0,'L',$fill);


///////************
//							$pdf->Cell($w[4],$h,substr($row->nama_bidang_usaha,0,30),'LR',0,'L',$fill);
//							$pdf->Cell($w[5],$h,substr($row->no_identitas,0,20),'LR',0,'L',$fill);
//							$pdf->Cell($w[6],$h,substr($row->lm_usaha,0,20),'LR',0,'C',$fill);
//							if($row->bi_checking==1){
//								 $pdf->Cell($w[7],$h,"Baik",'LR',0,'L',$fill);	
//							}else{
//							if($row->bi_checking==2){
//								$pdf->Cell($w[7],$h,"Tidak Baik",'LR',0,'L',$fill);	
//							}else{
//							if($row->bi_checking==3){
//								$pdf->Cell($w[7],$h,"Baik Dgn Catatan",'LR',0,'L',$fill);	
//							}else{						
//								$pdf->Cell($w[7],$h," ",'LR',0,'L',$fill);
//									}
//								}
//							}		
//							
//							if($row->siup==1){
//								 $pdf->Cell($w[8],$h,"Ada",'LR',0,'L',$fill);	
//							}else{
//							if($row->siup==2){
//								$pdf->Cell($w[8],$h,"Tidak Ada",'LR',0,'L',$fill);	
//							}else{
//							if($row->siup==3){
//								$pdf->Cell($w[8],$h,"Ada Dgn Catatan",'LR',0,'L',$fill);	
//							}else{						
//								$pdf->Cell($w[8],$h," ",'LR',0,'L',$fill);
//									}
//								}
//							}	
//																					
//							$pdf->Cell($w[9],$h,substr($row->target_tgl_booking,0,20),'LR',0,'C',$fill);
//							$pdf->Cell($w[10],$h,number_format($row->nominal,0),'LR',0,'R',$fill);		
//							$total = $total + $row->nominal;		
//////*************
						
//						$pdf->Cell($w[5],$h,number_format($row->nominal_prospek_awal,0),'LR',0,'R',$fill);
//						$pdf->Cell($w[6],$h,$row->hp,'LR',0,'L',$fill);
//						$pdf->Cell($w[7],$h,$row->kota,'LR',0,'L',$fill);
//						$pdf->Cell($w[8],$h,$row->status,'LR',0,'C',$fill);
						$pdf->Ln();
						$fill = !$fill;
						$no++;
						
//					}





						$pdf->SetFont('Arial','B',8);
						$pdf->Cell($w[0],$h,'',1,0,'C');
						$pdf->Cell($w[1],$h,'',1,0,'C');
						$pdf->Cell($w[2],$h,'',1,0,'C');
						$pdf->Cell($w[3],$h,'',1,0,'C');
						$pdf->Cell($w[4],$h,'',1,0,'C');
						$pdf->Cell($w[5],$h,'',1,0,'C');
						$pdf->Cell($w[6],$h,'',1,0,'C');
						$pdf->Cell($w[7],$h,'',1,0,'C');
//						$pdf->Cell($w[8],$h,'',1,0,'C');
//						$pdf->Cell($w[9],$h,'Total','1',0,'C');
//						$pdf->Cell($w[10],$h,number_format($total,0),'1',0,'R');						
						$pdf->SetFont('Arial','',8);						
						// Closing line
//						$pdf->Cell(array_sum($w),0,'','T');
						$pdf->Ln(10);
						$pdf->SetX(150);
						$pdf->Cell(150,$h,'Medan, '.$this->model_global->tgl_indo(date('Y-m-d')),'C');
						$pdf->Ln(20);
						$pdf->SetX(150);
						$pdf->Cell(150,$h,'___________________','C');


					
					
				//}
					
				//}
				//$pdf->Output('Lap_Mahasiswa.pdf','D');
				//$pdf->Output('Lap_Prospek'.$th_ak.'_'.$smt.'_'.$kd_dosen.'.pdf','D');	
				$pdf->Output('Lap_Data_Pipeline'.$this->model_global->tgl_indo(date('Y-m-d')).'.pdf','D');	
//			}else{
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data'.$status_kondisi_data.'</center>');
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data1'.$username.'</center>');
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data1'.$status_kondisi_data.'</center>');
//				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				//echo $status_kondisi_data;
				
//				redirect('site_user/lap_pipeline');
				//echo "Maaf Tidak ada data";
//			}
		}else{
			redirect('login','refresh');
		}
					

	}
	
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//	&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//  &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
	public function print_excel()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$kd_cabang = $this->session->userdata('kd_cabang');
		$username = $this->session->userdata('username');
		if(!empty($cek) && $level=='user'){

				$jlh_prospek = $this->session->userdata('jlh_prospek');
				$jlh_target = $this->session->userdata('jlh_target');
				$jlh_data_coll = $this->session->userdata('jlh_data_coll');
				$jlh_analisa = $this->session->userdata('jlh_analisa');
				$jlh_komite = $this->session->userdata('jlh_komite');
				$jlh_sppk = $this->session->userdata('jlh_sppk');
				$jlh_pk = $this->session->userdata('jlh_pk');
				$jlh_on_book = $this->session->userdata('jlh_on_book');


				$jlh_prospek7 = $this->session->userdata('jlh_prospek7');
				$jlh_target7 = $this->session->userdata('jlh_target7');
				$jlh_data_coll7 = $this->session->userdata('jlh_data_coll7');
				$jlh_analisa7 = $this->session->userdata('jlh_analisa7');
				$jlh_komite7 = $this->session->userdata('jlh_komite7');
				$jlh_sppk7 = $this->session->userdata('jlh_sppk7');
				$jlh_pk7 = $this->session->userdata('jlh_pk7');
				$jlh_jlh_on_book = $this->session->userdata('jlh_jlh_on_book');
				$nama_user = $this->session->userdata('nama_user');


				$rp_target_tumbuh = $this->session->userdata('rp_target_tumbuh');
				$rp_existing_debitur = $this->session->userdata('rp_existing_debitur');
				$rp_pelunasan = $this->session->userdata('rp_pelunasan');
				$rp_wajib_expansi = $this->session->userdata('rp_target_tumbuh')+$this->session->userdata('rp_pelunasan');
				$rp_target_os = $this->session->userdata('rp_target_tumbuh')+$this->session->userdata('rp_existing_debitur');
				$rp_potensi_on_book = $this->session->userdata('jlh_jlh_on_book');
				$rp_lebih_kurang = $rp_potensi_on_book-$rp_wajib_expansi;
				
				$no=1;
	
				
			
//			if($r>0){
				
				header("Content-type: application/octet-stream");
				//header("Content-Disposition: attachment; filename=MUTASI_MAHASISWA_".$th_ak.'_'.$smt.".xls");
				header("Content-Disposition: attachment; filename=Lap_Prospek_".$this->model_global->tgl_indo(date('Y-m-d')).".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN DATA PIPELINE</p>
            <p>Nama RM : <?php echo $nama_user; ?> <p>
            <p></p>
 
						<table border="1">
							<thead>
                                <td>Pipeline Kredit</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
                                <td>Rencana Kerja</td>  
                                    <td></td>
                                    <td></td>                                                          
								<tr>
									<td>No</td>
									<td>Aktivitas</td>
									<td>Jumlah (Rp)</td>
									<td>Asumsi (%)</td>
									<td>Jumlah Potensi</td>
                                    <td>No</td>
                                    <td>Perhitungan</td>
                                    <td>Jumlah (Rp)</td>
								</tr>


								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'Prospek';?></td>
									<td><?php echo number_format($jlh_prospek,0);?></td>
									<td><?php echo '30%';?></td>
									<td><?php echo number_format($jlh_prospek7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Target Tumbuh';?></td>
                                    <td><?php echo number_format($rp_target_tumbuh,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'Target';?></td>
									<td><?php echo number_format($jlh_target,0);?></td>
									<td><?php echo '60%';?></td>
									<td><?php echo number_format($jlh_target7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Existing Debitur';?></td>
                                    <td><?php echo number_format($rp_existing_debitur,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>  
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'Data Coll';?></td>
									<td><?php echo number_format($jlh_data_coll,0);?></td>
									<td><?php echo '70%';?></td>
									<td><?php echo number_format($jlh_data_coll7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Rencana Pelunasan';?></td>
                                    <td><?php echo number_format($rp_pelunasan,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>                                
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'Analisa';?></td>
									<td><?php echo number_format($jlh_analisa,0);?></td>
									<td><?php echo '80%';?></td>
									<td><?php echo number_format($jlh_analisa7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Wajib Ekspansi';?></td>
                                    <td><?php echo number_format($rp_wajib_expansi,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>                                
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'Komite';?></td>
									<td><?php echo number_format($jlh_komite,0);?></td>
									<td><?php echo '80%';?></td>
									<td><?php echo number_format($jlh_komite7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Target OS';?></td>
                                    <td><?php echo number_format($rp_target_os,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>                                
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'SPPK';?></td>
									<td><?php echo number_format($jlh_sppk,0);?></td>
									<td><?php echo '80%';?></td>
									<td><?php echo number_format($jlh_sppk7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Potensi On Book';?></td>
                                    <td><?php echo number_format($rp_potensi_on_book,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>                                
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'PK';?></td>
									<td><?php echo number_format($jlh_pk,0);?></td>
									<td><?php echo '60%';?></td>
									<td><?php echo number_format($jlh_pk7,0);?></td>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo 'Lebih / Kurang';?></td>
                                    <td><?php echo number_format($rp_lebih_kurang,0);?></td>
								</tr>
								<?php
                                    $no++;	
                                ?>             
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo 'On Book';?></td>
									<td><?php echo number_format($jlh_on_book,0);?></td>
									<td><?php echo '0%';?></td>
									<td><?php echo number_format($jlh_jlh_on_book,0);?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
								</tr>
								<?php
                                    $no++;	
                                ?>                                                                 
                                                                                    
							</thead>
							<tbody>

							</tbody>
						   </table>                        


             <?php
			}
//		}else{
//			redirect('login','refresh');
//		}
	}	
	
}
	//*******************************************************************************************************************
	//*******************************************************************************************************************
	//*******************************************************************************************************************		

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */