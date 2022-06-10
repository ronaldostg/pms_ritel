<script type="text/javascript">
$(document).ready(function(){

//	$("#kode").keyup(function(e){
//		var isi = $(e.target).val();
//		$(e.target).val(isi.toUpperCase());	
//	});

//	$("#id_jenis_pembiayaan").keyup(function(e){
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
			url		: "<?php echo site_url(); ?>site_supervisi/sppk/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
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
			url		: "<?php echo site_url(); ?>site_supervisi/sppk/kembalikan",
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
			url		: "<?php echo site_url(); ?>site_supervisi/sppk/tolak",
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
			url		: "<?php echo site_url(); ?>site_supervisi/sppk/hapus",
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
		$('#id_user_pic').val('');
		$('#kode').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>site_supervisi/sppk/cari",
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
			$('#id_user_pic').val(data.id_user_pic);
			
	
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
            <th class="center" width="5">No</th>
            <th class="center" width="80">Nama</th>

            <th class="center" width="50">Nasabah Setuju</th>
            <th class="center" width="60">Nominal (Rp.)</th>
            <th class="center" width="20">Status</th>
            <th class="center" width="40">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$username = $this->session->userdata('username');
//		$data = $this->model_data->data_sppk_supervisi($username);
		$data = $this->model_data->data_sppk("supervisi",$username);				
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
								echo "Blm Diajukan";	
						}
					}
					
				};?>
            </td>  
                                               
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
              <?php if($dt->status_data==2){ 
				
                    }else{ ?>                  
                
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->id_sppk;?>')" data-toggle="modal">
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
                        <select disabled name="nasabah_setuju" id="nasabah_setuju" class="span5"  readonly="true">
                        	<option value="1" selected="selected">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Ya Dengan Catatan</option>
                        </select>
                    </div>
                </div>  

                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nominal (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Nominal"  readonly="true" class="ratakanan"/>
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