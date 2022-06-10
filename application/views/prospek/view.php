<script type="text/javascript">
$(document).ready(function(){
//	$("#kode").keyup(function(e){
//		var isi = $(e.target).val();
//		$(e.target).val(isi.toUpperCase());	
//	});
	$("#nama_prospek").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	$("#alamat").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});	
	$("#telp").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	
	$("#simpan").click(function(){
		//var kode	= $("#kode").val();
		var nama_prospek	= $("#nama_prospek").val();
		var nominal	= $("#nominal").val();
		var alamat	= $("#alamat").val();
		
		var string = $("#my-form").serialize();
		
		
//		if(kode.length==0){
//			alert('Maaf, Kode Tidak boleh kosong');
//			$("#kode").focus();
//			return false();
//		}
		
		if(nama_prospek.length==0){
			alert('Maaf, Nama Prospek tidak boleh kosong');
			$("#nama_prospek").focus();
			return false();
		}
		
		if(alamat.length==0){
			alert('Maaf, Alamat Prospek tidak boleh kosong');
			$("#alamat").focus();
			return false();
		}
				
		if(nominal.length==0){
			alert('Maaf, Nominal Prospek tidak boleh kosong');
			$("#nominal").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/index.php/prospek/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});
	
	$('#simpan_user').click(function(e){
            e.preventDefault(); 

        var form = $('#form_upload_excel_all')[0];
        // var formData = new FormData(form);
            // e.preventDefault(); 
                 $.ajax({
                    url:"<?php echo site_url(); ?>/index.php/prospek/upload",
	                method:"POST",  
	                data:new FormData(form),  
	                contentType:false,  
	                processData:false,
	                dataType: "JSON", 
                      success: function(data){
                      	alert('berhasil upload');
                      	// do_upload_excel_all(data.data.datas)
                      	// alert(data.data.data);
                          // alert("Upload Image Berhasil."); //alert jika upload berhasil
                   }
                 });
});
	$("#tambah").click(function(){
		$('#kode').val('');
		$('#kode').attr("readonly",false);
		$('#nama_prospek').val('');
		$('#kode_status').val('');
		$('#alamat').val('');
		$('#telp').val('');
		$('#hp').val('');
		$('#email').val('');
		$('#nominal').val('');
		$('#pic').val('');
		$('#sumber_referensi').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/index.php/prospek/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#nama_prospek').val(data.nama_prospek);
			$('#alamat').val(data.alamat);
			$('#kode_status').val(data.kode_status);
			$('#telp').val(data.telp);
			$('#hp').val(data.hp);
			$('#email').val(data.email);
			$('#nominal').val(data.nominal);
			$('#pic').val(data.pic);
			$('#sumber_referensi').val(data.sumber_referensi);
			
			
		}
	});
	
  // this example uses the id selector & no options passed    
  jQuery(function($) {
      $('#nominal').autoNumeric('init');    
  });
	
}

    
</script>

<script src="<?php echo base_url();?>assets/autonumeric/autoNumeric.js"></script>

	<style>
	.ratakanan { text-align : right; }
	</style>	
    
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
    <div class="widget-toolbar no-border pull-right">
 <a href="#modal-table-user" class="btn btn-small btn-info"  role="button" data-toggle="modal" name="tambah" id="tambah" >
        <i class="icon-document"></i>
        Upload User
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">Nama Prospek</th>
            <th class="center">Alamat</th>
            <th class="center">Telp/Hp</th>
            <th class="center">PIC</th>
            <th class="center">Nominal</th>
            <th class="center" width="20">Status</th>

        </tr>
    </thead>
    <tbody>
    	<?php 
//		$data = $this->model_data->data_prospek();
		$username = $this->session->userdata('username');
		$data = $this->model_data->data_prospek("admin",$username);
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td ><?php echo $dt->nama_prospek;?></td>
            <td ><?php echo $dt->alamat_prospek;?></td>
            <td class="center"><?php echo $dt->telp;?></td>
            <td ><?php echo $dt->pic_prospek;?></td>
            <td style="text-align:right">  <?php echo number_format($dt->nominal_prospek_awal,2);?></td>

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
								echo "Mhn Hapus";							
								}else{
								if($dt->status_data==0){
									echo "Blm Diajukan";	
									}else{
									if($dt->status_data==6){
										echo "Mhn Mutasi";			
										}else{
										if($dt->status_data==8){
											echo "Ditolak";																																				
												}else{						
													echo " ";	
												}
										}
									}
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
            Data Prospek
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                
                <input type="hidden" name="kode" id="kode"/>

                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>
                                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Prospek</label>

                    <div class="controls">
                        <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama Prospek"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Status Prospek</label>
                    <div class="controls">
                        <select disabled name="kode_status" id="kode_status" class="span5">
                        	<option value="0" selected="selected">Perorangan</option>
                            <option value="1">Perusahaan</option>
                        </select>
                    </div>
                </div>                
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>

                    <div class="controls">
                        <input type="text" name="alamat" id="alamat"  placeholder="Alamat" class="span10"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Telp</label>

                    <div class="controls">
                       <input type="text" name="telp" id="telp" placeholder="Telp"  />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">HP</label>

                    <div class="controls">
                       <input type="text" name="hp" id="hp" placeholder="HP"  />
                    </div>
                </div>        

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Email</label>
                    <div class="controls">
                         <input type="text" name="email" id="email" placeholder="email" />
                    </div>
                </div>
                                

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nominal (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Nominal" class="ratakanan" />
                    </div>
                </div>
                                        
                <div class="control-group">
                    <label class="control-label" for="form-field-1">PIC</label>
                    <div class="controls">
                        <input type="text" name="pic" id="pic" placeholder="PIC"  />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Sumber Referensi</label>
                    <div class="controls">
                        <input type="text" name="sumber_referensi" id="sumber_referensi" placeholder="Sumber Referensi"  />
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
		</div>
    </div>
</div>   




<div id="modal-table-user" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             Upload User
        </div>
    </div>



    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" enctype="multipart/form-data" name="my-form-user" id="form_upload_excel_all">
                
                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>
                                
                <input type="hidden" name="kode" id="kode"/>
                <input type="hidden" name="status_data" id="status_data"/>
                
                
           
               
                
                        
                <div class="control-group">
                    <label class="control-label" for="form-field-1">File Excell</label>
                    <div class="controls">
                        <input type="file" name="file_excel_all" id="file_excel_all" />
                    </div>
                </div>

				

         



		             
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="button" name="simpan_user" id="simpan_user" class="btn btn-small btn-success pull-left" >
            <i class="icon-save"></i>
            Upload
        </button>
        
        
        
      
		</div>
    </div>
    	</form>   
</div>   

