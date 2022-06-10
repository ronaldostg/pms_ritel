<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center span2">Nama Prospek</th>
            <th class="center span2">Alamat</th>
            <th class="center" width="5">Status</th>
            <th class="center span2">Bidang Usaha</th>
            <th class="center" width="20">Surat Permohonan</th>
            <th class="center" width="20">Lap Keuangan 2 Thn</th>
            <th class="center" width="20">Agunan</th>
            <th class="center" width="20">Dokumen Pendukung</th>
            <th class="center" width="20">Daerah</th>
            <th class="center" width="20">Nominal</th>

            
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		$total=0;
//		$t_nilai = 0;
//		$nilai = 0;
//		$ip = 0;
		foreach($data->result() as $dt){ 
//			$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
//			$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
//			$angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
//			$sks = $dt->sks;
//			$nilai = $angka*$sks;
//			$ip = $this->model_data->cari_ipk($dt->smt,$dt->nim);
			
			$sing = $this->model_data->singkat_prospek($dt->id_user_pic);
		?>
        <tr>
        	<td class="center"><?php echo $i++?></td>
            
            
            <td class="span2"><?php echo substr($dt->nama_prospek,0,25);?></td>
            <td class="span2"><?php echo substr($dt->alamat_prospek,0,25);?></td>
                     

            <td class="center"><?php 
					if($dt->kode_status==1){
						 echo "Perusahaan";
					}else{
					if($dt->kode_status==0){
						echo "Perorangan";
							}else{						
								echo " ";	
						}
					
				};?>
            </td>  


            <td class="span2"><?php echo substr($dt->nama_bidang_usaha,0,28);?></td>
            <td class="center"><?php 
					if($dt->surat_permohonan==1){
						 echo "Ada";
					}else{
					if($dt->surat_permohonan==2){
						echo "Tidak Ada";
					}else{
					if($dt->surat_permohonan==3){
						echo "Ada Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>  
            <td class="center"><?php 
					if($dt->lap_keuangan_2thn_terakhir==1){
						 echo "Ada";
					}else{
					if($dt->lap_keuangan_2thn_terakhir==2){
						echo "Tidak Ada";
					}else{
					if($dt->lap_keuangan_2thn_terakhir==3){
						echo "Ada Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>  
            <td class="center"><?php 
					if($dt->agunan==1){
						 echo "Ada";
					}else{
					if($dt->agunan==2){
						echo "Tidak Ada";
					}else{
					if($dt->agunan==3){
						echo "Ada Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>    
            <td class="center"><?php 
					if($dt->dokumen_pendukung_lain==1){
						 echo "Ada";
					}else{
					if($dt->dokumen_pendukung_lain==2){
						echo "Tidak Ada";
					}else{
					if($dt->dokumen_pendukung_lain==3){
						echo "Ada Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>   
            <td class="span2"><?php echo substr($dt->nama_daerah,0,28);?></td>
            <td class="span" style="text-align:right">  <?php echo number_format($dt->nominal,0);?></td>            
            
            
        </tr>
		<?php 
//			$t_sks = $t_sks+$dt->sks;
			$total = $total + $dt->nominal;
		} 
		//$ip =$t_nilai/$t_sks;
		?>
        <tr>
        	<td colspan="10" class="center"><strong>T o t a l</strong></td>
            <td style="text-align:right"><strong><?php echo number_format($total,0);?></strong></td>
        </tr>
   
    </tbody>
</table>