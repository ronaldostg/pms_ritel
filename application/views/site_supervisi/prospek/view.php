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
	
	$("#pic").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
	
	$("#sumber_referensi").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());	
	});
		
		
			
	$("#simpan").click(function(){
		//var kode	= $("#kode").val();
		var nama_prospek	= $("#nama_prospek").val();
		var nominal	= $("#nominal").val();
		var alamat	= $("#alamat").val();
		var pic	= $("#pic").val();
		var sumber_referensi	= $("#sumber_referensi").val();
		
		
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
		
		if(pic.length==0){
			alert('Maaf, PIC tidak boleh kosong');
			$("#pic_prospek").focus();
			return false();
		}
		
		if(sumber_referensi.length==0){
			alert('Maaf, Sumber Referensi tidak boleh kosong');
			$("#pic_prospek").focus();
			return false();
		}				
				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>index.php/site_supervisi/prospek/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
				// console.log(data);
			}
		});
		
	});
	
	
	$("#kembalikan").click(function(){
		//var kode	= $("#kode").val();
		//var nama_prospek	= $("#nama_prospek").val();
		//var nominal	= $("#nominal").val();
		//var alamat	= $("#alamat").val();
		//var pic	= $("#pic").val();
		//var sumber_referensi	= $("#sumber_referensi").val();
		
		
		var string = $("#my-form").serialize();
		
		
//		if(kode.length==0){
//			alert('Maaf, Kode Tidak boleh kosong');
//			$("#kode").focus();
//			return false();
//		}
		//
//		if(nama_prospek.length==0){
//			alert('Maaf, Nama Prospek tidak boleh kosong');
//			$("#nama_prospek").focus();
//			return false();
//		}
//		
//		if(alamat.length==0){
//			alert('Maaf, Alamat Prospek tidak boleh kosong');
//			$("#alamat").focus();
//			return false();
//		}
//				
//		if(nominal.length==0){
//			alert('Maaf, Nominal Prospek tidak boleh kosong');
//			$("#nominal").focus();
//			return false();
//		}
//		
//		if(pic.length==0){
//			alert('Maaf, PIC tidak boleh kosong');
//			$("#pic_prospek").focus();
//			return false();
//		}
//		
//		if(sumber_referensi.length==0){
//			alert('Maaf, Sumber Referensi tidak boleh kosong');
//			$("#pic_prospek").focus();
//			return false();
//		}				
				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>index.php/site_supervisi/prospek/kembalikan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});	
	

	$("#tolak").click(function(){

		var string = $("#my-form").serialize();
	
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>index.php/site_supervisi/prospek/tolak",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});	
	

	$("#hapus").click(function(){
		
//		var string = $("#my-form").serialize();
			
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>index.php/site_supervisi/prospek/hapus",
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
		$('#nama_prospek').val('');
		$('#kode_status').val('');
		$('#alamat').val('');
		$('#telp').val('');
		$('#hp').val('');
		$('#email').val('');
		$('#nominal').val('');
		$('#pic').val('');
		$('#sumber_referensi').val('');
		$('#id_user_pic').val('');
		$('#status_data').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>index.php/site_supervisi/prospek/cari",
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
			$('#detail_sumber_referensi').val(data.detail_sumber_referensi);
			$('#id_user_pic').val(data.id_user_pic);
			$('#status_data').val(data.status_data);
			
			
	
			
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
            <th class="center">No</th>
            <th class="center">Nama Prospek</th>
            <th class="center">Alamat</th>
            <th class="center">Telp</th>
            <th class="center">PIC</th>
            <th class="center">Nominal</th>
            <!-- <th class="center">Status</th> -->
            <!-- <th class="center">Aksi</th> -->
        </tr>
    </thead>
    <tbody>
    	<?php 
//		$data = $this->model_data->data_prospek_supervisi();
		$username = $this->session->userdata('username');
		$data = $this->model_data->data_prospek("supervisi",$username);
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td ><?php echo $dt->nama_prospek;?></td>
            <td ><?php echo $dt->alamat_prospek;?></td>
            <td class="center"><?php echo $dt->telp;?></td>
            <td ><?php echo $dt->pic_prospek;?></td>
            <td style="text-align:right">  <?php echo number_format($dt->nominal_prospek_awal,2);?></td>
            <!-- <td class="center"><?php 
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
								if($dt->status_data==5){
									echo "Dihapus";	
									}else{
									if($dt->status_data==8){
										echo "Ditolak";	
										}else{										
										if($dt->status_data==0){
											echo "Blm Diajukan";																								
											}else{						
												echo " ";
											}
										}
									}
								}
							}
					}
					
				};?>
            </td>               -->
            <!-- <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                <?php if($dt->status_data==2){ 
				
					  }else{ ?>
                    <a class="green" href="#modal-table" 
                    onclick="javascript:editData('<?php echo $dt->id_prospek;?>')" data-toggle="modal">
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
            </td> -->
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
                <input type="hidden" name="status_data" id="status_data"/> 
                

                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>
                                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Prospek</label>

                    <div class="controls">
                        <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama Prospek" readonly="readonly"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Status Prospek</label>
                    <div class="controls">
                        <select disabled name="kode_status" id="kode_status" class="span5" readonly="readonly">
                        	<option value="2" readonly="readonly" selected="selected">Perorangan</option>
                            <option value="1" readonly="readonly">Perusahaan</option>
                        </select>
                    </div>
                </div>                
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>

                    <div class="controls">
                        <input type="text" name="alamat" id="alamat"  placeholder="Alamat" class="span10" readonly="readonly"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Telp</label>

                    <div class="controls">
                       <input type="text" name="telp" id="telp" placeholder="Telp" readonly="readonly" />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">HP</label>

                    <div class="controls">
                       <input type="text" name="hp" id="hp" placeholder="HP" readonly="readonly" />
                    </div>
                </div>        

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Email</label>
                    <div class="controls">
                         <input type="text" name="email" id="email" placeholder="email" readonly="readonly" />
                    </div>
                </div>
                                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nominal (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Nominal"  readonly="readonly" class="ratakanan" />
                    </div>
                </div>
                        
                <div class="control-group">
                    <label class="control-label" for="form-field-1">PIC</label>
                    <div class="controls">
                        <input type="text" name="pic" id="pic" placeholder="PIC"  readonly="readonly" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Sumber Referensi</label>
                    <div class="controls">
                        <input type="text" name="sumber_referensi" id="sumber_referensi" placeholder="Sumber Referensi"  readonly="readonly" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Detail Sumber Referensi</label>
                    <div class="controls">
                      <input type="text" name="detail_sumber_referensi" id="detail_sumber_referensi"  placeholder="Detail Sumber Referensi"  readonly="readonly"/>
                      
                      <!--	<input type="text" name="detail_sumber_referensi"  />	-->
                    </div>
                </div>
                                
                <input type="hidden" name="id_user_pic" id="id_user_pic"/>


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
            Approve
        </button>
        <button type="button" class="btn btn-small btn-danger pull-left" name="kembalikan" id="kembalikan" >
            <i class="icon-remove"></i>
            Kembalikan
        </button>    
        <button type="button" class="btn btn-small btn-danger pull-left" name="tolak" id="tolak" >
            <i class="icon-remove"></i>
            Tolak
        </button>  
        

        
        
                   
		</div>
    </div>
</div>   









