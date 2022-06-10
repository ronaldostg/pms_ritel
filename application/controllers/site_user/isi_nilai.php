<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Isi_nilai extends CI_Controller {

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
		if(!empty($cek) && $level=='user'){

			$d['judul']="Nilai Mahasiswa";
			$d['class'] = "master";
			
			$d['content']= 'site_user/isi_nilai/form';
			$this->load->view('site_user/home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari_smt()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			$id_user = $this->session->userdata('username');
			$th_ak	= $this->input->post('th_ak');
			if(!empty($th_ak)){
				if(substr($th_ak,4,1)==1){
					$smt = 'ganjil';
				}else{
					$smt = 'genap';
				}
				
				$d['semester'] = $smt;
				//$d['smt'] = $this->model_global->semester($nim,$th_ak);
			}else{
				$d['semester'] = '';
				//$d['smt'] = '';
			}
			echo json_encode($d);

		}else{
			redirect('login','refresh');
		}	
	}
	
	public function cari_mata_kuliah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			$id['th_akademik']	=  $this->input->post('th_ak');
			$id['id_user']	= $this->session->userdata('username');
			/*
			$id['kd_prodi']	= $this->input->post('kd_prodi');
			$id['semester']	= $this->input->post('semester');
			*/
			$this->db->group_by('kd_mk');
			$q = $this->db->get_where("krs",$id);
			$row = $q->num_rows();
			if($row>0){
				echo "<option value=''>-Pilih Mata Kuliah-</option>";
				foreach($q->result() as $dt){
					$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
					$nama_user = $this->model_data->cari_nama_user($dt->id_user);
				?>
 	<option value="<?php echo $dt->kd_mk;?>"><?php echo $dt->kd_mk;?> - <?php echo $nama_mk;?> - <?php echo $dt->id_user;?> - <?php echo $nama_user;?> - <?php echo $dt->hari.' - '.$dt->pukul.' - '.$dt->ruang;?></option>
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
		if(!empty($cek) && $level=='user'){
			
			$id_user = $this->session->userdata('username');
			$th_ak = $this->input->post('thak');
			$kd_mk = $this->input->post('id_jadwal');
			
			$where = "WHERE th_akademik='$th_ak' AND kd_mk='$kd_mk' AND id_user='$id_user'";
		
			
			$q = $this->db->query("SELECT * FROM krs $where ");
			if($q->num_rows()>0){
				$dt['data'] = $q;
				echo $this->load->view('site_user/isi_nilai/view',$dt);
			}else{
				echo $this->load->view('site_user/view_kosong');
			}
				
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan_nilai()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='user'){
			
			$id['id_krs'] = $this->input->post('id');
			
			$nilai = str_replace('*','+',$this->input->post('nilai'));
			$data['nilai_akhir'] = $nilai;
			
			$q = $this->db->get_where("krs",$id);
			if($q->num_rows()>0){
				$this->db->update('krs',$data,$id);
				echo "Nilai Sukses disimpan";
			}else{
				echo "tidak ada aksi";
			}
				
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */