<script type="text/javascript">
$(document).ready(function(){

//	$("#kode").keyup(function(e){
//		var isi = $(e.target).val();
//		$(e.target).val(isi.toUpperCase());	
//	});

//	$("#id_prospek").keyup(function(e){
//		var isi = $(e.target).val();
//		$(e.target).val(isi.toUpperCase());	
//	});
	
		
		
			
	$("#simpan").click(function(){
		//var kode	= $("#kode").val();
		var id_prospek	= $("#id_prospek").val();
		var nominal	= $("#nominal").val();
		var mampu_memenuhi_tagihan	= $("#mampu_memenuhi_tagihan").val();
		var id_jenis_pembiayaan	= $("#id_jenis_pembiayaan").val();
		var cukup_agunan	= $("#cukup_agunan").val();
		var pembiayaan_wajar	= $("#pembiayaan_wajar").val();
		
		
		var string = $("#my-form").serialize();
		
		
//		if(kode.length==0){
//			alert('Maaf, Kode Tidak boleh kosong');
//			$("#kode").focus();
//			return false();
//		}
		
		if(id_prospek.length==0){
			alert('Maaf, Surat Permohonan tidak boleh kosong');
			$("#id_prospek").focus();
			return false();
		}		
			
		if(nominal.length==0){
			alert('Maaf, Nominal tidak boleh kosong');
			$("#nominal").focus();
			return false();
		}	
								
		if(mampu_memenuhi_tagihan.length==0){
			alert('Maaf, Kemampuan Memenuhi Tagihan tidak boleh kosong');
			$("#mampu_memenuhi_tagihan").focus();
			return false();
		}

		if(cukup_agunan==0){
			alert('Maaf, Cukup Agunan tidak boleh kosong');
			$("#cukup_agunan").focus();
			return false();
		}
		
		if(id_jenis_pembiayaan==0){
			alert('Maaf, Jenis Pembiayaan tidak boleh kosong');
			$("#id_jenis_pembiayaan").focus();
			return false();
		}		
				

		if(pembiayaan_wajar==0){
			alert('Maaf, Pembiayaan Wajar tidak boleh kosong');
			$("#pembiayaan_wajar").focus();
			return false();
		}
		
						
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/analisa/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});
	
	
	
	
	$("#ajukan").click(function(){
		//var kode	= $("#kode").val();
		var id_prospek	= $("#id_prospek").val();
		var nominal	= $("#nominal").val();
		var mampu_memenuhi_tagihan	= $("#mampu_memenuhi_tagihan").val();
		var id_jenis_pembiayaan	= $("#id_jenis_pembiayaan").val();
		var cukup_agunan	= $("#cukup_agunan").val();
		
		
		var string = $("#my-form").serialize();
		
		
//		if(kode.length==0){
//			alert('Maaf, Kode Tidak boleh kosong');
//			$("#kode").focus();
//			return false();
//		}
		
		if(id_prospek.length==0){
			alert('Maaf, Surat Permohonan tidak boleh kosong');
			$("#id_prospek").focus();
			return false();
		}		
			
		if(nominal.length==0){
			alert('Maaf, Nominal tidak boleh kosong');
			$("#nominal").focus();
			return false();
		}	
								
		if(mampu_memenuhi_tagihan.length==0){
			alert('Maaf, Kemampuan Memenuhi Tagihan tidak boleh kosong');
			$("#mampu_memenuhi_tagihan").focus();
			return false();
		}

		if(id_jenis_pembiayaan==0){
			alert('Maaf, Jenis Pembiayaan tidak boleh kosong');
			$("#id_jenis_pembiayaan").focus();
			return false();
		}
		
		if(cukup_agunan==0){
			alert('Maaf, Cukup Agunan tidak boleh kosong');
			$("#cukup_agunan").focus();
			return false();
		}
		
				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/analisa/ajukan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});	
	
	
	
	

	$("#hapus").click(function(){
		
		var string = $("#my-form").serialize();
			
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/analisa/hapus",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});	
	
		
	
	
	$("#tambah").click(function(){
		$('#kode').val('');
		$('#kode').attr("readonly",false);
		$('#id_prospek').val('');		
		$('#mampu_memenuhi_tagihan').val('');
		$('#cukup_agunan').val('');
		$('#nominal').val('');
		$('#pembiayaan_wajar').val('');
		$('#id_jenis_pembiayaan').val('');
		$('#nama_prospek').val('');
		$('#alamat').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/analisa/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#id_prospek').val(data.id_prospek);
			$('#mampu_memenuhi_tagihan').val(data.mampu_memenuhi_tagihan);
			$('#cukup_agunan').val(data.cukup_agunan);
			$('#nominal').val(data.nominal);
			$('#pembiayaan_wajar').val(data.pembiayaan_wajar);
			$('#id_jenis_pembiayaan').val(data.id_jenis_pembiayaan);
			$('#nama_prospek').val(data.nama_prospek);
			$('#alamat').val(data.alamat);

		
			
			
		}
	});
	
}



</script>
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
    <div class="widget-toolbar no-border pull-right">

    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" width="5">No</th>
            <th class="center" width="80">Nama</th>

            <th class="center" width="35">Jns Pemby.</th>
            <th class="center" width="55">Mampu Penuhi Tagihan</th>
            <th class="center" width="65">Cukup Agunan</th>
            <th class="center" width="50">Pembiayaan Wajar</th>
            <th class="center" width="60">Nominal (Rp.)</th>
            <th class="center" width="20">Status</th>

        </tr>
    </thead>
    <tbody>
    	<?php 
		$username = $this->session->userdata('username');
//		$data = $this->model_data->data_analisa($username);
		$data = $this->model_data->data_analisa("admin",$username);					
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td ><?php echo substr($dt->nama_prospek,0,25);?></td>

            <td ><?php echo substr($dt->nama_jenis_pembiayaan,0,25);?></td>
   
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
								echo "";	
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
								echo "";	
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
								echo "";	
						}
					}
					
				};?>
            </td>   


 
            
            <td style="text-align:right">  <?php echo number_format($dt->nominal,0);?></td>
            



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
							if($dt->status_data==8){
								echo "Ditolak";							
								}else{						
									echo "Blm Diajukan";	
								}
						}
					}
					
				};?>
            </td>  
            
                                               
            
        </tr>
		<?php } ?>
    </tbody>
</table>
</div>

<div id="modal-table" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Analisa
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                                
                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>
                
                <input type="hidden" name="kode" id="kode"/>
                <input type="hidden" name="id_prospek" id="id_prospek"/>
                
                                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama</label>

                    <div class="controls">
                       <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama" readonly="true" />
                    </div>
                </div>
                

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>

                    <div class="controls">
                       <input type="text" name="alamat" id="alamat" placeholder="Alamat" readonly="true" />
                    </div>
                </div>
                                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Jenis Pembiayaan</label>
                    <div class="controls">
                        <select disabled name="id_jenis_pembiayaan" id="id_jenis_pembiayaan" class="span6" >
                            <option value="" selected="selected">-Pilih-</option>
                            <?php
                            $data = $this->model_data->kd_pembiayaan();
                            foreach($data->result() as $dt){
                            ?>
                                <option value="<?php echo $dt->id_jenis_pembiayaan;?>"><?php echo $dt->nama_jenis_pembiayaan;?></option>
                            <?php } ?>
                            </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="form-field-1">Mampu Memenuhi Tagihan</label>
                    <div class="controls">
                        <select disabled name="mampu_memenuhi_tagihan" id="mampu_memenuhi_tagihan" class="span5" >
                        	<option value="1" selected="selected">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Ya Dengan Catatan</option>
                        </select>
                    </div>
                </div>  
                
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Cukup Agunan</label>
                    <div class="controls">
                        <select disabled name="cukup_agunan" id="cukup_agunan" class="span5" >
                        	<option value="1" selected="selected">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Ya Dengan Catatan</option>
                        </select>
                    </div>
                </div> 
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Pembiayaan Wajar</label>
                    <div class="controls">
                        <select disabled name="pembiayaan_wajar" id="pembiayaan_wajar" class="span5">
                        	<option value="1" selected="selected">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Ya Dengan Catatan</option>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nominal (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Nominal"  />
                    </div>
                </div>





                                                
			</form>                
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
        <button type="button" name="ajukan" id="ajukan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Ajukan
        </button>        
		</div>
    </div>
</div>   