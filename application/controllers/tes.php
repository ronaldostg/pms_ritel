<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	
	public function tampil(){
		echo $this->data_chart('55-201');
	}
	
	public function data_chart($key){
		$q = $this->db->query("SELECT th_akademik FROM krs group by th_akademik");
		$data = array();
		foreach($q->result() as $dt){
			$th = $dt->th_akademik;
			 $q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key'");
			 $data[] = $q2->num_rows();
			 /*
			 foreach($q2->result() as $dt2){
				 $data[] = $dt->
			 }
			 */
		}
		return json_encode($data);
	}
	
	public function load_data(){
		$kat = $this->kategori();
		$r = count($kat);
		echo $kat;
	}
	
	public function kategori(){
		$q = $this->db->query("SELECT th_akademik FROM krs group by th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		$hasil .= $x+9;
		return $hasil;
	}
	
	public function kategori1(){
		$q = $this->db->query("SELECT th_akademik FROM krs group by th_akademik");
		
		$i=1;
		foreach($q->result() as $dt){
			$hasil[] =$dt->th_akademik;
			$i++;
		}
		echo json_encode($hasil);
		
	}
	
	public function kategori2(){
		$result = array();
		$result['total'] = $this->db->query("SELECT th_akademik FROM krs group by th_akademik")->num_rows();
		$row = array();	
		
		$q = $this->db->query("SELECT th_akademik FROM krs group by th_akademik");
		
		
		foreach($q->result() as $data)
		{	
			$row[] = array(
				'th'=>$data->th_akademik
			);
		}
		$result=array_merge($result,array('rows'=>$row));
		echo json_encode($result);
	}
	
	public function kategori3(){
		$result = array();
		//$result['total'] = $this->db->query("SELECT th_akademik FROM krs group by th_akademik")->num_rows();
		$row = array();	
		
		$q = $this->db->query("SELECT th_akademik,kd_mk,sks FROM krs group by th_akademik");
		
		
		foreach($q->result() as $data)
		{	
			$row[] = array(
				'name'=>$data->kd_mk,
				'data'=>array($this->isi_data($data->th_akademik))
			);
		}
		$result=array_merge($result,array('series'=>$row));
		echo json_encode($result);
	}
	
	public function isi_data($th){
		$q = $this->db->query("SELECT count(*) as total FROM krs WHERE th_akademik='$th'");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->total.',';
			$x = $dt->total;
		}
		$hasil .= $x*0;
		return $hasil;
	}
	
	function data(){
		echo "series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4]
    
            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5]
    
            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3]
    
            }]";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */