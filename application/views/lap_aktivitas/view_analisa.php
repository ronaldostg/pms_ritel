<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="10">No</th>
            <th class="center span2">Nama Prospek</th>
            <th class="center span2">Alamat</th>
            <th class="center" width="5">Status</th>
            <th class="center span2">Bidang Usaha</th>
            <th class="center" width="5">Pembiayaan</th>
            <th class="center" width="20">Mampu Penuhi Tagihan</th>
            <th class="center" width="20">Cukup Agunan</th>
            <th class="center" width="20">Pemb. Wajar</th>
            <th class="center" width="20">Nominal</th>
            <th class="center" width="5">Status</th>

            
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
            <td class="span2"><?php echo substr($dt->nama_jenis_pembiayaan,0,15);?></td>
            <td class="center"><?php 
					if($dt->mampu_memenuhi_tagihan==1){
						 echo "Ya";
					}else{
					if($dt->mampu_memenuhi_tagihan==2){
						echo "Tidak";
					}else{
					if($dt->mampu_memenuhi_tagihan==3){
						echo "Ya Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>  
            <td class="center"><?php 
					if($dt->cukup_agunan==1){
						 echo "Ya";
					}else{
					if($dt->cukup_agunan==2){
						echo "Tidak";
					}else{
					if($dt->cukup_agunan==3){
						echo "Ya Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>  
            <td class="center"><?php 
					if($dt->pembiayaan_wajar==1){
						 echo "Ya";
					}else{
					if($dt->pembiayaan_wajar==2){
						echo "Tidak";
					}else{
					if($dt->pembiayaan_wajar==3){
						echo "Ya Dgn Catatan";
					}else{						
						echo " ";	
						}
					}
				};?>
            </td>  
            <td class="span" style="text-align:right">  <?php echo number_format($dt->nominal,0);?></td>            
            <td class="center"><?php 
					if($dt->status_data==1){
						 echo "Waiting";
					}else{
					if($dt->status_data==2){
						echo "Approved";
						}else{
						if($dt->status_data==3){
							echo "Dikembalikan";
							}else{
							if($dt->status_data==4){
								echo "Mohon Dihapus";
								}else{
								if($dt->status_data==5){
									echo "Sudah Dihapus";
									}else{
									if($dt->status_data==6){
										echo "Mhn Mutasi";
										}else{
										if($dt->status_data==8){
											echo "Ditolak";							
											}else{						
												echo "Blm Diajukan";	
										}
									}
								}
							}
						}
					}
					
				};?>
            </td>                
            
        </tr>
		<?php 
//			$t_sks = $t_sks+$dt->sks;
			$total = $total + $dt->nominal;
		} 
		//$ip =$t_nilai/$t_sks;
		?>
        <tr>
        	<td colspan="9" class="center"><strong>T o t a l</strong></td>
            <td style="text-align:right"><strong><?php echo number_format($total,0);?></strong></td>
        </tr>
   
    </tbody>
</table>