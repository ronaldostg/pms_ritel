<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai extends CI_Controller {

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
			$d['judul']="Nilai Semester";
			$d['class'] = "transaksi";
			$this->db->group_by(array('th_akademik','semester','kd_mk'));
			$this->db->order_by('id_krs','desc');
			$d['data'] = $this->db->get("krs");
			$d['content'] = 'nilai/view_data';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Nilai Semester";
			$d['class'] = "transaksi";
			
			$d['content'] = 'nilai/form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
	
	public function cari_mata_kuliah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$th_ak	= $this->input->post('th_ak');
			$kd_prodi	= $this->input->post('kd_prodi');
			$smt	= $this->input->post('smt');
			
			$q = $this->db->query("SELECT a.id_krs,a.smt,a.kd_mk,a.nama_mk,a.sks,a.kd_dosen,a.nm_dosen
								FROM krs as a
								JOIN jadwal as b
								ON a.id_jadwal = b.id_jadwal
								WHERE a.th_akademik ='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi'
								GROUP BY a.smt,a.kd_mk,a.kd_dosen
								ORDER BY a.smt,a.kd_mk");
			
			$row = $q->num_rows();
			if($row>0){
			?>
            <option value="" selected="selected">-Pilih Mata Kuliah-</option>
            <?php
				foreach($q->result() as $dt){
				?>
                	<option value="<?php echo $dt->kd_mk;?>"><?php echo $dt->smt;?> - <?php echo $dt->kd_mk;?> - <?php echo $dt->nama_mk;?> - <?php echo $dt->kd_dosen;?> - <?php echo $dt->nm_dosen;?> </option>
                <?php
				}
			}else{
			?>
            <option value="" selected="selected">-Tidak Ada Mata Kuliah-</option>
            <?php } 
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			
			$id['th_akademik'] = $this->input->post('th_ak');
			$id['semester'] = $this->input->post('semester');
			$id['nim'] = $this->input->post('nim');
			$id['kd_mk'] = $this->input->post('kd_mk');
			
			$nilai = str_replace('*','+',$this->input->post('nilai'));
			$dt['nilai_akhir'] = $nilai;
			
			
			$q_krs = $this->db->get_where("krs",$id);
			$row = $q_krs->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("krs",$dt,$id);
				echo "Update";
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
	
	public function cari_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$th_ak	= $this->input->post('th_ak');
			$kd_prodi= $this->input->post('kd_prodi');
			$smt= $this->input->post('smt');
			$kd_mk	= $this->input->post('kd_mk');
			
			//$this->db->order('hari','pukul');
			$d['data'] = $this->db->query("SELECT a.id_krs,a.nim,a.nilai_akhir
								FROM krs as a
								JOIN jadwal as b
								ON a.id_jadwal = b.id_jadwal
								WHERE a.th_akademik ='$th_ak' AND a.semester='$smt' AND b.kd_prodi='$kd_prodi' AND a.kd_mk='$kd_mk'
								ORDER BY a.nim");
			echo $this->load->view('nilai/view',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */