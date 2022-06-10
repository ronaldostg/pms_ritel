<script type="text/javascript">
$(document).ready(function(){
//	$('.date-picker').datepicker().next().on(ace.click_event, function(){
//		$(this).prev().focus();
//	});	


    //datepicker yg udah ok
    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true,  
    });	
	
//    //datepicker yg udah ok
//    $('.date-picker').datepicker({
//        autoclose: true,
//        format: "yyyy-mm-dd",
//        todayHighlight: true,
//        orientation: "top auto",
//        todayBtn: true,
//        todayHighlight: true,  
//    });
		
//	$("#kode").keyup(function(e){
//		var isi = $(e.target).val();
//		$(e.target).val(isi.toUpperCase());	
//	});

	$("#lm_usaha").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	
		
		
			
	$("#simpan").click(function(){
		//var kode	= $("#kode").val();
		var lm_usaha	= $("#lm_usaha").val();
		var nominal	= $("#nominal").val();
//		var bi_checking	= $("#bi_checking").val();
//		var siup	= $("#siup").val();
		
		
		var string = $("#my-form").serialize();
		
		
//		if(kode.length==0){
//			alert('Maaf, Kode Tidak boleh kosong');
//			$("#kode").focus();
//			return false();
//		}
		
		if(lm_usaha.length==0){
			alert('Maaf, Lama Usaha tidak boleh kosong');
			$("#lm_usaha").focus();
			return false();
		}		
			
		if(nominal.length==0){
			alert('Maaf, Nominal tidak boleh kosong');
			$("#nominal").focus();
			return false();
		}	
								
//		if(bi_checking.length==0){
//			alert('Maaf, Keterangan BI Checking tidak boleh kosong');
//			$("#bi_checking").focus();
//			return false();
//		}
//
//		if(siup==0){
//			alert('Maaf, Keterangan SIUP tidak boleh kosong');
//			$("#siup").focus();
//			return false();
//		}
//		
				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/target/simpan",
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
		var lm_usaha	= $("#lm_usaha").val();
		var nominal	= $("#nominal").val();
//		var bi_checking	= $("#bi_checking").val();
//		var siup	= $("#siup").val();
		
		
		var string = $("#my-form").serialize();
		
		
//		if(kode.length==0){
//			alert('Maaf, Kode Tidak boleh kosong');
//			$("#kode").focus();
//			return false();
//		}
		
		if(lm_usaha.length==0){
			alert('Maaf, Lama Usaha tidak boleh kosong');
			$("#lm_usaha").focus();
			return false();
		}		
			
		if(nominal.length==0){
			alert('Maaf, Nominal tidak boleh kosong');
			$("#nominal").focus();
			return false();
		}	
								
//		if(bi_checking.length==0){
//			alert('Maaf, Keterangan BI Checking tidak boleh kosong');
//			$("#bi_checking").focus();
//			return false();
//		}
//
//		if(siup==0){
//			alert('Maaf, Keterangan SIUP tidak boleh kosong');
//			$("#siup").focus();
//			return false();
//		}
//		
				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/target/ajukan",
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
			url		: "<?php echo site_url(); ?>/target/hapus",
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
		$('#lm_usaha').val('');		
		$('#bi_checking').val('');
		$('#siup').val('');
		$('#nominal').val('');
		$('#target_tgl_booking').val('');
		$('#no_identitas').val('');
		$('#nama_prospek').val('');
		$('#alamat').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/target/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#lm_usaha').val(data.lm_usaha);
			$('#bi_checking').val(data.bi_checking);
			$('#siup').val(data.siup);
			$('#nominal').val(data.nominal);
			$('#target_tgl_booking').val(data.target_tgl_booking);
			$('#no_identitas').val(data.no_identitas);
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
            <th class="center" width="50">Usaha (Thn)</th>
            <th class="center" width="55">BI Check</th>
            <th class="center" width="55">SIUP</th>
            <th class="center" width="60">Nominal (Rp.)</th>
            <th class="center" width="45">Target Tgl Booking</th>
            <th class="center" width="20">Status</th>

        </tr>
    </thead>
    <tbody>
    	<?php 
		$username = $this->session->userdata('username');
//		$data = $this->model_data->data_target($username);
		$data = $this->model_data->data_target("admin",$username);		
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td ><?php echo substr($dt->nama_prospek,0,25);?></td>

            <td class="center"><?php echo $dt->lm_usaha;?></td>
            
           <td class="center"><?php 
					if($dt->bi_checking==1){
						 echo "Baik";
					}else{
					if($dt->bi_checking==2){
						echo "Tidak Baik";
						}else{
						if($dt->bi_checking==3){
							echo "Baik Dgn Catatan";
							}else{						
								echo "";	
						}
					}
					
				};?>
            </td>   

            <td class="center"><?php 
					if($dt->siup==1){
						 echo "Ada";
					}else{
					if($dt->siup==2){
						echo "Tidak Ada";
						}else{
						if($dt->siup==3){
							echo "Ada Dgn Catatan";
							}else{						
								echo "";	
						}
					}
					
				};?>
            </td>  
            
            <td style="text-align:right">  <?php echo number_format($dt->nominal,0);?></td>
            <td style="text-align:right">  <?php echo date('d-M-y', strtotime($dt->target_tgl_booking));?></td>



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
            Data target
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
                    <label class="control-label" for="form-field-1">Lama Usaha (Thn)</label>

                    <div class="controls">
                       <input type="text" name="lm_usaha" id="lm_usaha" placeholder="Lama Usaha"  />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">No Identitas</label>

                    <div class="controls">
                       <input type="text" name="no_identitas" id="no_identitas" placeholder="No Identitas"  />
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="form-field-1">Target Tgl Booking</label>
                    <div class="controls">
                        <input type="text" name="target_tgl_booking" id="target_tgl_booking" class="span5 date-picker"  data-date-format="dd-mm-yyyy"/>
                    </div>
                </div>
                
                                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">BI Checking</label>
                    <div class="controls">
                        <select disabled name="bi_checking" id="bi_checking" class="span5" >
                        	<option value="1" selected="selected">Baik</option>
                            <option value="2">Tidak Baik</option>
                            <option value="3">Baik Dengan Catatan</option>
                        </select>
                    </div>
                </div>  

                <div class="control-group">
                    <label class="control-label" for="form-field-1">SIUP</label>
                    <div class="controls">
                        <select disabled name="siup" id="siup" class="span5" >
                        	<option value="1" selected="selected">Ada</option>
                            <option value="2">Tidak Ada</option>
                            <option value="3">Ada Dengan Catatan</option>
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