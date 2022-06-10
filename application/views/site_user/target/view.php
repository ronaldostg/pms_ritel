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
	

//	
//$.datepicker.setDefaults({
//  showOn: "both",
//  buttonImageOnly: true,
//  buttonImage: "calendar.gif",
//  buttonText: "Calendar"
//});

//$('.date-picker').datepicker()
//    .on(picker_event, function(e) {
//        // `e` here contains the extra attributes
//    });
//	
//	
	
//	$('.date-picker').datepicker().next().on(ace.click_event, function(){
//		$(this).prev().focus();
//	});
	
//	$('.date-picker').datepicker().next().onclick, function(){
//		$(this).prev().focus();
//	});	

//$('#datepicker').on('click', function(){
//    // clear array of available time slots
//	$(this).prev().focus();
//});

//$('#datepicker').datepicker({
//    onSelect: function(dateText, inst) { 
//        window.location = 'http://mysite/events/Pages/default.aspx?dt=' + dateText;
//    }
//});


//	$('.date-picker').datepicker().next().on(ace.click_event, function(){
//		$(this).prev().focus().click();$(this).remove();
//	});	


//$(document).on('click','.datedisplay',function()
// {
//    $(this).siblings('[type="date"]').removeClass('hidden').focus().click();
//    $(this).remove();
// });


//    $("#datepicker").click(function() {
//        $(this).datepicker().datepicker( "show" )
//    });

	
//    $( "#start_date" ).datepicker({
//      defaultDate: "+1w",
//      dateFormat: "yy-mm-dd",
//      changeMonth: true,
//      numberOfMonths: 3,
//      onClose: function( selectedDate ) {
//        $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
//      }
//    }).datepicker("setDate", "0");
//	
//	
	
	
   //datepicker
//    $('.datepicker').datepicker({
//        autoclose: true,
//        format: "yyyy-mm-dd",
//        todayHighlight: true,
//        orientation: "top auto",
//        todayBtn: true,
//        todayHighlight: true,  
//    });
 
//    //set input/textarea/select event when change value, remove class error and remove text help block 
//    $("input").change(function(){
//        $(this).parent().parent().removeClass('has-error');
//        $(this).next().empty();
//    });
//    $("textarea").change(function(){
//        $(this).parent().parent().removeClass('has-error');
//        $(this).next().empty();
//    });
//    $("select").change(function(){
//        $(this).parent().parent().removeClass('has-error');
//        $(this).next().empty();
//    });
// 

	
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
			url		: "<?php echo site_url(); ?>site_user/target/simpan",
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
			url		: "<?php echo site_url(); ?>site_user/target/ajukan",
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
			url		: "<?php echo site_url(); ?>site_user/target/hapus",
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
		url		: "<?php echo site_url(); ?>site_user/target/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
            console.log(data);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#lm_usaha').val(data.lm_usaha);
			$('#bi_checking').val(data.bi_checking);
			$('#status_data').val(data.status_data);
			$('#siup').val(data.siup);
			$('#nominal').val(data.nominal);
			$('#target_tgl_booking').val(data.target_tgl_booking);
			$('#no_identitas').val(data.nikdebitur);
			$('#nama_prospek').val(data.nama_prospek);
			$('#alamat').val(data.alamat);
			$('#id_prospek').val(data.id_prospek);

		
			
			
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
            <th class="center" width="40">Aksi</th>
        </tr>
    </thead>
    <tbody>
    
    
 
     
    
    
    	<?php 
		$username = $this->session->userdata('username');
//		$data = $this->model_data->data_target($username);	
		$data = $this->model_data->data_target("user",$username);	
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
						echo "Terima";
						}else{
						if($dt->status_data==3){
                            echo "Dikembalikan ke "." ".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'dikembalikan_ke' , "status_perbaikan = '0' and status = '2'")." (".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'alasan' , "status_perbaikan = '0' and status = '2'").")";
							}else{
							if($dt->status_data==8){
								echo "Ditolak karena ".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'alasan' , "status = '1'");							
								}else{						
									echo "Belum diproses";	
								}
						}
					}
					
				};?>
            </td>  
            
                                               
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                <?php if($dt->status_data==2 or $dt->status_data==8){ 
				
                    }else{ ?>
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->id_target;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>
                    <?php
                    }?>


                </div>

                <div class="hidden-desktop visible-phone">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-caret-down icon-only bigger-120"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green">
                                        <i class="icon-edit bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                        <i class="icon-trash bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </center>
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
                <input type="hidden" name="status_data" id="status_data" />
                <input type="hidden" name="id_prospek" id="id_prospek"/>

                
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
                       <input type="text" name="lm_usaha" id="lm_usaha" placeholder="Lama Usaha" maxlength="3"  onkeypress="return isNumberKey(event)"/>
                    </div>

       
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">No Identitas</label>

                    <div class="controls">
                       <input type="text" name="no_identitas" id="no_identitas" placeholder="No Identitas" maxlength="16"   onkeypress="return isNumberKey(event)" readonly="true"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="form-field-1">Target Tgl Booking</label>
                    <div class="controls">
                        <input type="text" name="target_tgl_booking"  placeholder="dd-mm-yyyy" id="target_tgl_booking" class="span5 date-picker"  data-date-format="dd-mm-yyyy"/>
                    </div>
                </div>


                                                        
                <div class="control-group">
                    <label class="control-label" for="form-field-1">BI Checking</label>
                    <div class="controls">
                        <select name="bi_checking" id="bi_checking" class="span5" >
                        	<option value="1" selected="selected">Baik</option>
                            <option value="2">Tidak Baik</option>
                            <option value="3">Baik Dengan Catatan</option>
                        </select>
                    </div>
                </div>  

                <div class="control-group">
                    <label class="control-label" for="form-field-1">SIUP</label>
                    <div class="controls">
                        <select name="siup" id="siup" class="span5" >
                        	<option value="1" selected="selected">Ada</option>
                            <option value="2">Tidak Ada</option>
                            <option value="3">Ada Dengan Catatan</option>
                        </select>
                    </div>
                </div> 

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nominal (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Nominal" class="ratakanan" />
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
            Terima
        </button>
        <!-- <button type="button" name="ajukan" id="ajukan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Ajukan
        </button>         -->
		</div>
    </div>
</div>   


             <SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>

