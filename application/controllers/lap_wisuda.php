<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_wisuda extends CI_Controller {

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
			$d['judul']="Laporan Wisuda";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/lap_wisuda';
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
			$kd_prodi = $this->input->post('kd_prodi');
			
			$query = "SELECT a.id_wisuda,a.th_akademik,a.tgl_daftar,a.nim,a.judul_skripsi,a.ipk,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM wisuda as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			$r = $q->num_rows;
			if($r>0){
				$dt['data'] = $q;
				echo $this->load->view('laporan/view_lap_wisuda',$dt);
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
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$th_ak = $this->input->post('th_ak');
			$kd_prodi = $this->input->post('kd_prodi');
			
			$query = "SELECT a.id_wisuda,a.th_akademik,a.tgl_daftar,a.nim,a.judul_skripsi,a.ipk,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM wisuda as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			
			$r = $q->num_rows();
			if($r>0){
				$sess_data['th_ak'] = $th_ak;
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
	
	
	
	public function print_excel()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$th_ak = $this->session->userdata('th_ak');
			$kd_prodi = $this->session->userdata('kd_prodi');
			$prodi = $this->model_data->nama_jurusan($kd_prodi);
			
			$query = "SELECT a.id_wisuda,a.th_akademik,a.tgl_daftar,a.nim,a.judul_skripsi,a.ipk,
						b.nama_mhs,b.sex,b.kd_prodi
						FROM wisuda as a
						JOIN mahasiswa as b
						ON a.nim=b.nim
					WHERE a.th_akademik='$th_ak' AND b.kd_prodi='$kd_prodi'";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=LAPORAN_WISUDA_".$th_ak.'_'.$kd_prodi.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN WISUDA MAHASISWA</p>
            <p><?php echo $th_ak.' - '.$prodi;?></p>
            <table border="1">
            	<thead>
                	<tr>
                    	<td>No</td>
                        <td>NIM</td>
                        <td>NAMA</td>
                        <td>L/P</td>
                        <td>PRODI</td>
                        <td>TANGGAL DAFTAR</td>
                        <td>JUDUL SKRIPSI</td>
                        <td>IPK</td>
					</tr>
				</thead>
                <tbody>
                <?php
				$no=1;
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_indo($dt->tgl_daftar);
					$prodi = $this->model_data->nama_jurusan($dt->kd_prodi);
				?>
                <tr>
                	<td><?php echo $no;?></td>  
					<td><?php echo $dt->nim;?></td>
                    <td><?php echo $dt->nama_mhs;?></td>
                     <td><?php echo $dt->sex;?></td>
                    <td><?php echo $prodi;?></td>  
                    <td><?php echo $tgl;?></td>  
                    <td><?php echo $dt->judul_skripsi;?></td>                    
                    <td><?php echo $dt->ipk;?></td>                    
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