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
		var kd_bidang_usaha	= $("#kd_bidang_usaha").val();
		var id_user	= $("#id_user").val();
		var kode_status	= $("#kode_status").val();
			
		
		
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
		
		if(kd_bidang_usaha.length==0){
			alert('Maaf, Kode Bidang Usaha tidak boleh kosong');
			$("#kd_bidang_usaha").focus();
			return false();
		}		
						
		if(id_user.length==0){
			alert('Maaf, id User tidak boleh kosong');
			$("#id_user").focus();
			return false();
		}		
						
		if(kode_status.length==0){
			alert('Maaf, Mutasikan Ke User tidak boleh kosong');
			$("#kode_status").focus();
			return false();
		}		
			

				
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>site_supervisi/mutasi_data/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				alert(data);
				location.reload();
			}
		});
		
	});
	

	$("#reject").click(function(){
		//var kode	= $("#kode").val();
		//var nama_prospek	= $("#nama_prospek").val();
		//var nominal	= $("#nominal").val();
		//var alamat	= $("#alamat").val();
		//var pic	= $("#pic").val();
		//var sumber_referensi	= $("#sumber_referensi").val();
		
		
		var string = $("#my-form").serialize();

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>site_supervisi/mutasi_data/reject",
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
		$('#status_data_sebelumnya').val('');
		$('#id_user_pic').val('');
		$('#kode').focus();
	});
});

	


function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>site_supervisi/mutasi_data/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
			//alert(data.ref);
			$('#kode').val(data.kode);
			$('#kode').attr("readonly","true");
			$('#nama_prospek').val(data.nama_prospek);
			$('#alamat').val(data.alamat);
			$('#kode_status').val(data.kode_status);
			$('#kd_bidang_usaha').val(data.kd_bidang_usaha);
			$('#telp').val(data.telp);
			$('#hp').val(data.hp);
			$('#email').val(data.email);
			$('#nominal').val(data.nominal);
			$('#pic').val(data.pic);
			$('#sumber_referensi').val(data.sumber_referensi);
			$('#status_data_sebelumnya').val(data.status_data_sebelumnya);
			$('#id_user').val(data.id_user);
//			$('#keterangan').val(data.keterangan);
			
			
			
			
			
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
            <th class="center" width="100">Nama Prospek</th>
            <th class="center" width="80">Alamat</th>
            <th class="center" width="100">Bidang Usaha</th>
			<th class="center" width="90">Mhn Mutasi Ke</th>
            <th class="center" width="60">Nominal</th>
            <th class="center" width="20">Status</th>
            <th class="center" width="20">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php
		$username = $this->session->userdata('username');
//		$data = $this->model_data->data_prospek_supervisi_mutasi($username);
		$data = $this->model_data->data_prospek_mutasi("supervisi",$username);
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td ><?php echo substr($dt->nama_prospek,0,25);?></td>
            <td ><?php echo substr($dt->alamat_prospek,0,25);?></td>
            <td ><?php echo substr($dt->nama_bidang_usaha,0,30);?></td>
            <td class="center"><?php echo $dt->keterangan;?></td>
            <td style="text-align:right">  <?php echo number_format($dt->nominal_prospek_awal,0);?></td>
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
            
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->id_prospek;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>
            





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
            Mutasi Data Pipeline
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
                
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Prospek</label>

                    <div class="controls">
                        <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama Prospek" readonly="true"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Status Prospek</label>
                    <div class="controls">
                        <select disabled name="kode_status" id="kode_status" class="span5" readonly="true">
                        	<option value="0" selected="selected">Perorangan</option>
                            <option value="1">Perusahaan</option>
                        </select>
                    </div>
                </div>                
                

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Bidang Usaha</label>
                    <div class="controls">
                        <select disabled name="kd_bidang_usaha" id="kd_bidang_usaha" class="span6" readonly="true">
                            <option value="" selected="selected">-Pilih-</option>
                            <?php
                            $data = $this->model_data->kd_bidang_usaha();
                            foreach($data->result() as $dt){
                            ?>
                                <option value="<?php echo $dt->kd_bidang_usaha;?>"><?php echo $dt->nama_bidang_usaha;?></option>
                            <?php } ?>
                            </select>
                    </div>
                </div>
                
                

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>

                    <div class="controls">
                        <input type="text" name="alamat" id="alamat"  placeholder="Alamat" class="span10" readonly="true"/>
                    </div>
                </div>
                

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nominal (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Nominal"  readonly="true" />
                    </div>
                </div>
                        

                
                <input type="hidden" name="telp" id="telp"/>
                <input type="hidden" name="hp" id="hp"/>
                <input type="hidden" name="email" id="email"/>
                <input type="hidden" name="pic" id="pic"/>
                <input type="hidden" name="sumber_referensi" id="sumber_referensi"/>
                <input type="hidden" name="status_data_sebelumnya" id="status_data_sebelumnya"/>




                <div class="control-group">
                    <label class="control-label" for="form-field-1">Mutasikan Ke User ==> </label>
                     <div class="controls">
                        <input list="id_user_select" name="id_user" id="id_user">
						<datalist id="id_user_select">
							 <?php
                            $data = $this->model_data->id_user();
                            foreach($data->result() as $dt){
                            ?>
                                <option value="<?php echo $dt->id_user;?>"><?php echo $dt->id_user; echo "==>"; echo $dt->nama_user;?></option>
                            <?php } ?>
						 <!--  <option value="Internet Explorer">
						  <option value="Firefox">
						  <option value="Chrome">
						  <option value="Opera">
						  <option value="Safari"> -->
						</datalist> 

                        <!-- <select name="id_user" id="id_user" class="span6">
                            <option value="" selected="selected">-Pilih-</option>
                            <?php
                            $data = $this->model_data->id_user();
                            foreach($data->result() as $dt){
                            ?>
                                <option value="<?php echo $dt->id_user;?>"><?php echo $dt->id_user; echo "==>"; echo $dt->nama_user;?></option>
                            <?php } ?>
                            </select> -->
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
            Approve
        </button>
        <button type="button" class="btn btn-small btn-danger pull-left" name="reject" id="reject" >
            <i class="icon-remove"></i>
            Reject
        </button>       
		</div>
    </div>
</div>   