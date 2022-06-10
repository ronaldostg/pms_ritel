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
		var nasabah_setuju	= $("#nasabah_setuju").val();

		
		
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
								
		if(nasabah_setuju.length==0){
			alert('Maaf, Nasabah Setuju tidak boleh kosong');
			$("#nasabah_setuju").focus();
			return false();
		}

		
						
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/sppk/simpan",
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
		var nasabah_setuju	= $("#nasabah_setuju").val();

		
		
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
								
		if(nasabah_setuju.length==0){
			alert('Maaf, Nasabah Setuju tidak boleh kosong');
			$("#nasabah_setuju").focus();
			return false();
		}

				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/sppk/ajukan",
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
			url		: "<?php echo site_url(); ?>/sppk/hapus",
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
		$('#nasabah_setuju').val('');
		$('#nominal').val('');
		$('#nama_prospek').val('');
		$('#alamat').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/sppk/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#id_prospek').val(data.id_prospek);
			$('#nasabah_setuju').val(data.nasabah_setuju);
			$('#nominal').val(data.nominal);
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

            <th class="center" width="50">Nasabah Setuju</th>
            <th class="center" width="60">Nominal (Rp.)</th>
            <th class="center" width="20">Status</th>

        </tr>
    </thead>
    <tbody>
    	<?php 
		$username = $this->session->userdata('username');
//		$data = $this->model_data->data_sppk($username);		
		$data = $this->model_data->data_sppk("admin",$username);		
		
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td ><?php echo substr($dt->nama_prospek,0,25);?></td>

   
           <td class="center"><?php 
					if($dt->nasabah_setuju==1){
						 echo "Ya";
					}else{
					if($dt->nasabah_setuju==2){
						echo "Tidak";
						}else{
						if($dt->nasabah_setuju==3){
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
            SPPK
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
                    <label class="control-label" for="form-field-1">Nasabah Setuju</label>
                    <div class="controls">
                        <select disabled name="nasabah_setuju" id="nasabah_setuju" class="span5" >
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