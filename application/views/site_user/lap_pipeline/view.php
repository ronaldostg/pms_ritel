
<?php
$username = $this->session->userdata('username');
$nama_user = $this->model_data->ambil_data_user("nama_user","user",$username); ?>
<strong> <?php echo "Nama RM : " .$nama_user; ?> </strong>

                            




<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center span2">Pipeline Kredit</th>
            <th class="center span2">Rencana Kerja</th>
        </tr>    
    </thead>
    <tbody>
        <tr>
            <th class="center span2">
            
            
                <table  class="table fpTable lcnp table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center" width="10">No</th>
                            <th class="center span2">Aktivitas</th>
                            <th class="center span2">Jumlah (Rp.)</th>
                            <th class="center" width="10">Asumsi (%)</th>
                            <th class="center" width="200">Jumlah Potensi (Rp.)</th>
                
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //$username = $this->session->userdata('username');
                        $i=1;
                        $total=0;
                //		$t_nilai = 0;
                //		$nilai = 0;
                //		$ip = 0;
                        foreach($data->result() as $dt){ 
//                            $jlh_prospek = $this->model_data->sum_data_prospek($username);
//                            $jlh_target = $this->model_data->sum_data_target($username);
//                            $jlh_data_coll = $this->model_data->sum_data_data_coll($username);
//                            $jlh_analisa = $this->model_data->sum_data_analisa($username);
//                            $jlh_komite = $this->model_data->sum_data_komite($username);
//                            $jlh_sppk = $this->model_data->sum_data_sppk($username);
//                            $jlh_pk = $this->model_data->sum_data_pk($username);
//                            $jlh_on_book = $this->model_data->sum_data_on_book($username);
//							$jlh_prospekxxx = $this->model_data->sum_data_nominal_tabel("t_prospek","nominal_prospek_awal","user",$username);


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
                                                    
                            $jlh_pk7= 0.8 * 0.8 * 0.6 * $jlh_pk;
                            
                            $jlh_jlh_on_book=$jlh_prospek7+$jlh_target7+$jlh_data_coll7+$jlh_analisa7+$jlh_komite7+$jlh_sppk7+$jlh_pk7;
                                                                
                //			$nama_mk = $this->model_data->cari_nama_mk($dt->kd_mk);
                //			$nama_dosen = $this->model_data->cari_nama_dosen($dt->kd_dosen);
                //			$angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
                //			$sks = $dt->sks;
                //			$nilai = $angka*$sks;
                //			$ip = $this->model_data->cari_ipk($dt->smt,$dt->nim);
                            
                //			$sing = $this->model_data->singkat_prospek($dt->id_user_pic);
				//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        ?>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    Prospek
                                </a>
							</td>     
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_prospek,0);?></td>  
                            <td class="center"><?php echo "30%";?></td>     
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_prospek7,0);?></td>        
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    Target
                                </a>
							</td>    
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_target,0);?></td>  
                            <td class="center"><?php echo "60%";?></td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_target7,0);?></td>            
                        </tr>  
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    Data Coll
                                </a>
							</td>                                
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_data_coll,0);?></td>   
                            <td class="center"><?php echo "70%";?></td>    
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_data_coll7,0);?></td>          
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    Analisa
                                </a>
							</td>       
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_analisa,0);?></td>  
                            <td class="center"><?php echo "80%";?></td>    
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_analisa7,0);?></td>          
                        </tr>  
                        <!-- <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    Komite
                                </a>
							</td>     
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_komite,0);?></td>    
                            <td class="center"><?php echo "80%";?></td>   
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_komite7,0);?></td>           
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    SPPK
                                </a>
							</td>                                                         
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_sppk,0);?></td>    
                            <td class="center"><?php echo "80%";?></td>     
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_sppk7,0);?></td>         
                        </tr>       -->
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    PK
                                </a>
							</td>                            
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_pk,0);?></td>     
                            <!-- <td class="center"><?php echo "60%";?></td>    -->
                            <td class="center"><?php echo "80% + 80% + 60%";?></td>   
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_pk7,0);?></td>          
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span">
                                <a href="<?php echo base_url();?>index.php/site_user/lap_aktivitas">
                                    On Book
                                </a>
							</td>                             
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_on_book,0);?></td>   
                            <td class="center"><?php echo "0%";?></td>   
                            <td style="text-align:right"><strong>0</strong></td>    
                        </tr>                            
                        <?php 
                //			$t_sks = $t_sks+$dt->sks;
                            $total = $jlh_prospek + $jlh_target + $jlh_data_coll + $jlh_analisa + $jlh_komite + $jlh_sppk + $jlh_pk + $jlh_on_book;
                        } 
                        //$ip =$t_nilai/$t_sks;
                        ?>
                        <tr>
                            <td colspan="2" class="center"><strong>T o t a l</strong></td>
                            <td style="text-align:right"><strong><?php echo number_format($total,0);?></strong></td>
                            <td class="span2"><?php echo "";?></td> 
                            <td class="span2" style="text-align:right"><?php echo number_format($jlh_jlh_on_book,0);?></td> 
                        </tr>
                  
                    </tbody>
                </table>            
                            
                            
            
            </th>
            <th class="center span2">
            
            
                <table  class="table fpTable lcnp table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center" width="10">No</th>
                            <th class="center span2">Perhitungan</th>
                            <th class="center span2">Jumlah (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $username = $this->session->userdata('username');
                        $i=1;
                        $total=0;
                //		$t_nilai = 0;
                //		$nilai = 0;
                //		$ip = 0;
                        foreach($data->result() as $dt){ 
                            
                            
                            
//                            $rp_target_tumbuh = $this->model_data->ambil_data_rencana_kerja("rp_target_tumbuh",$username,date("Y"));
//                            $rp_existing_debitur = $this->model_data->ambil_data_rencana_kerja("rp_existing_debitur",$username,date("Y"));
//                            $rp_pelunasan = $this->model_data->ambil_data_rencana_kerja("rp_pelunasan",$username,date("Y"));


				$rp_target_tumbuh = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_target_tumbuh","user",$username,date("Y"));
				$rp_existing_debitur = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_existing_debitur","user",$username,date("Y"));
				$rp_pelunasan = $this->model_data->ambil_data_nominal_tabel_per_thn("t_rencana_kerja",
				"rp_pelunasan","user",$username,date("Y"));


                
                        ?>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Target Tumbuh";?></td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($rp_target_tumbuh,0);?></td>        
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Existing Debitur";?></td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($rp_existing_debitur,0);?></td>            
                        </tr>  
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Rencana Pelunasan";?></td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($rp_pelunasan,0);?></td>          
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Wajib Ekspansi";?>
                                <small>( Target Tumbuh + Rencana Pelunasan )</small>
                            </td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($rp_target_tumbuh+$rp_pelunasan,0);?></td>          
                        </tr>  
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Target OS";?>
                                <small>(Target Tumbuh + Existing Debitur)</small>
                            </td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($rp_target_tumbuh+$rp_existing_debitur,0);?></td>
                        </tr>
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Potensi On Book";?></td>  
                            <td class="span" style="text-align:right">  <?php echo number_format($jlh_jlh_on_book,0);?></td>         
                        </tr>      
                        <tr>
                            <td class="center"><?php echo $i++?></td>
                            <td class="span2"><?php echo "Lebih / Kurang";?>
                                <small>(Jumlah On Book - (Target Tumbuh + Existing Debitur))</small>
                            </td>  
                            <td style="text-align:right"><strong><?php echo number_format($jlh_jlh_on_book-($rp_target_tumbuh+$rp_pelunasan),0);?></strong></td>
                        </tr>
                                        
                        <?php 
                //			$t_sks = $t_sks+$dt->sks;
                //			$total = $jlh_prospek + $jlh_target + $jlh_data_coll + $jlh_analisa + $jlh_komite + $jlh_sppk + $jlh_pk + $jlh_on_book;
                        } 
                        //$ip =$t_nilai/$t_sks;
                        ?>
                  
                    </tbody>
                </table>
            
            
            
            
            </th>
        </tr>      
    </tbody>
</table>


