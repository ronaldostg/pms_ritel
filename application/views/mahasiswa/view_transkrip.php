<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center">Mata Kuliah</th>
            <th class="center" width="10">SKS</th>
            <th class="center" width="10">SMT</th>
            <th class="center">Dosen</th>
            <th class="center span1">N.Huruf</th>
            <th class="center span1">N.Angka</th>
            <th class="center span1">N.Bobot</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		$t_sks=0;
		$t_nilai = 0;
		$nilai = 0;
		$ip=0;
		foreach($data->result() as $dt){ 
			$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
			$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
			$angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
			$sks = $dt->sks;
			$nilai = $angka*$sks;
			$ip = $this->model_data->cari_ip($dt->nim);
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            <td ><?php echo $dt->kd_mk.' - '.$nama_mk;?></td>
            <td class="center"><?php echo $dt->sks;?></td>
            <td class="center"><?php echo $dt->smt;?></td>
            <td ><?php echo $dt->kd_dosen.' - '.$nama_dosen;?></td>
            <td class="center"><?php echo $dt->nilai_akhir;?></td>
            <td class="center"><?php echo $angka;?></td>
            <td class="center"><?php echo $nilai;?></td>
        </tr>
		<?php 
		$t_sks = $t_sks+$dt->sks;
		$t_nilai = $t_nilai + $nilai;
		} 
		//@$ip =$t_nilai/$t_sks;
		?>
        <tr>
        	<td colspan="2" class="center">Total SKS</td>
            <td class="center"><?php echo $t_sks;?></td>
            <td colspan="4" class="center"></td>
            <td class="center"><?php echo $t_nilai;?></td>
        </tr>
        <tr>
        	<td colspan="5" class="center">Indeks Prestasi Komulatif (IPK) </td>
            <td colspan="3" class="center"><strong><?php echo number_format($ip,2);?></strong></td>
		</tr>            
    </tbody>
</table>