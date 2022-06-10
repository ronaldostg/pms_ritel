<script type="text/javascript">
$(document).ready(function() {
    //	$("#kode").keyup(function(e){
    //		var isi = $(e.target).val();
    //		$(e.target).val(isi.toUpperCase());	
    //	});


    $("#sumber_referensi").change(function() {
        var sumber_referensi = $("#sumber_referensi").val();
        //		var detail_sumber_referensi_hide	= $("#detail_sumber_referensi_hide").val();



        if (sumber_referensi != "Lainnya") {
            document.getElementById("detail_sumber_referensi").readOnly = true;
            //document.getElementById("detail_sumber_referensi").value = $("#detail_sumber_referensi");
            document.getElementById("detail_sumber_referensi").value = "";
        } else {
            document.getElementById("detail_sumber_referensi").readOnly = false;
            document.getElementById("detail_sumber_referensi").value = "";
        }


    });







    $("#nama_prospek").keyup(function(e) {
        var isi = $(e.target).val();
        $(e.target).val(isi.toUpperCase());
    });
    $("#alamat").keyup(function(e) {
        var isi = $(e.target).val();
        $(e.target).val(isi.toUpperCase());
    });


    $("#pic").keyup(function(e) {
        var isi = $(e.target).val();
        $(e.target).val(isi.toUpperCase());
    });

    $("#sumber_referensi").keyup(function(e) {
        var isi = $(e.target).val();
        $(e.target).val(isi.toUpperCase());
    });

    $("#detail_sumber_referensi").keyup(function(e) {
        var isi = $(e.target).val();
        $(e.target).val(isi.toUpperCase());
    });

    $("#nominal").keyup(function(e) {
        var isi = $(e.target).val();
        //		$(e.target).val(isi.toUpperCase());
        $(e.target).autoNumeric('init');
        //		$('#nominal').autoNumeric('init'); 	
    });


    $('form input[name="email"]').blur(function() {
        var email = $(this).val();
        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
        if (re.test(email)) {
            $('.msg').hide();
            $('.success').show();
        } else {
            $('.msg').hide();
            $('.error').show();

        }

    });



    $("#simpan").click(function() {
        //var kode	= $("#kode").val();
        // alert("Maaf sedang maintance");

        $("#simpan").attr("disabled" , true);
        $("#simpan").html('<img src="<?=base_url()?>/assets/icon/loadinggif.gif" style="width: 16px; height:16px;"  alt="load">'+"Loading...");


        // return false;

        var nama_prospek = $("#nama_prospek").val();
        var kode_status = $("#kode_status").val();
        var kd_bidang_usaha = $("#kd_bidang_usaha").val();
        var alamat = $("#alamat").val();
        var telp = $("#telp").val();
        var hp = $("#hp").val();
        var email = $("#email").val();
        var nominal = $("#nominal").val();
        var pic = $("#pic").val();
        var sumber_referensi = $("#sumber_referensi").val();
        var detail_sumber_referensi = $("#detail_sumber_referensi").val();



        var string = $("#my-form").serialize();


        if (nama_prospek.length == 0) {
            alert('Maaf, Nama Prospek tidak boleh kosong');
            $("#nama_prospek").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        if (kode_status.length == 0) {
            alert('Maaf, Status Prospek tidak boleh kosong');
            $("#kode_status").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        if (kd_bidang_usaha.length == 0) {
            alert('Maaf, Bidang usaha tidak boleh kosong');
            $("#kd_bidang_usaha").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        if (alamat.length == 0) {
            alert('Maaf, Alamat tidak boleh kosong');
            $("#alamat").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        // if (telp.length == 0) {
        //     alert('Maaf, Telp tidak boleh kosong');
        //     $("#telp").focus();
        //     return false();
        // }

        if (hp.length == 0) {
            alert('Maaf, HP tidak boleh kosong');
            $("#hp").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        // if (email.length == 0) {
        //     alert('Maaf, Email tidak boleh kosong');
        //     $("#email").focus();
        //     return false();
        // }



        var email = $("#email").val();
        //         var emailID = document.myForm.EMail.value;
        atpos = email.indexOf("@");
        dotpos = email.lastIndexOf(".");

        // if (atpos < 1 || (dotpos - atpos < 2)) {
        //     alert("Format email masih salah")
        //     //            document.myForm.EMail.focus() ;
        //     $("#email").focus();
        //     return false;
        // }
        //         return( true );					




        if (nominal.length == 0) {
            alert('Maaf, Nominal Prospek tidak boleh kosong');
            $("#nominal").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        if (pic.length == 0) {
            alert('Maaf, PIC tidak boleh kosong');
            $("#pic").focus();
            $("#simpan").attr("disabled" , false);
            $("#simpan").html("simpan");
            return false();
        }

        // if (sumber_referensi.length == 0) {
        //     alert('Maaf, Sumber Referensi tidak boleh kosong');
        //     $("#sumber_referensi").focus();
        //     return false();
        // }

        // if (sumber_referensi == "Lainnya") {
        //     if (detail_sumber_referensi.length == 0) {
        //         alert('Maaf, Detail Sumber Referensi tidak boleh kosong');
        //         $("#detail_sumber_referensi").focus();
        //         return false();
        //     }
        // }




        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_user/prospek/simpan",
            data: string,
            cache: false,
            success: function(data) {
                // alert(string);
                $("#simpan").attr("disabled" , false);
                $("#simpan").html("simpan");
                alert(data);
                location.reload();
        
                // console.log(data);
            }
        });

    });


    $("#ajukan").click(function() {
        //var kode	= $("#kode").val();
        var nama_prospek = $("#nama_prospek").val();
        var nominal = $("#nominal").val();
        var alamat = $("#alamat").val();
        var pic = $("#pic").val();
        var sumber_referensi = $("#sumber_referensi").val();
        var kd_bidang_usaha = $("#kd_bidang_usaha").val();


        var string = $("#my-form").serialize();


        //		if(kode.length==0){
        //			alert('Maaf, Kode Tidak boleh kosong');
        //			$("#kode").focus();
        //			return false();
        //		}

        if (nama_prospek.length == 0) {
            alert('Maaf, Nama Prospek tidak boleh kosong');
            $("#nama_prospek").focus();
            return false();
        }

        if (alamat.length == 0) {
            alert('Maaf, Alamat Prospek tidak boleh kosong');
            $("#alamat").focus();
            return false();
        }

        if (nominal.length == 0) {
            alert('Maaf, Nominal Prospek tidak boleh kosong');
            $("#nominal").focus();
            return false();
        }

        if (pic.length == 0) {
            alert('Maaf, PIC tidak boleh kosong');
            $("#pic_prospek").focus();
            return false();
        }

        if (sumber_referensi.length == 0) {
            alert('Maaf, Sumber Referensi tidak boleh kosong');
            $("#pic_prospek").focus();
            return false();
        }

        if (kd_bidang_usaha.length == 0) {
            alert('Maaf, Kode Bidang Usaha tidak boleh kosong');
            $("#kd_bidang_usaha").focus();
            return false();
        }




        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_user/prospek/ajukan",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });

    });






    $("#hapus").click(function() {

        //		var string = $("#my-form").serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_user/prospek/hapus",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });

    });


    $("#tambah").click(function() {
        $('#kode').val('');
        $('#kode').attr("readonly", false);
        $('#nama_prospek').val('');
        $('#alamat').val('');
        $('#kode_status').val('');
        $('#kd_bidang_usaha').val('');
        $('#telp').val('');
        $('#hp').val('');
        $('#email').val('');

        $('#nominal').val('');
        //		$('#pic').val('');
        $('#pic').val('<?php echo $this->session->userdata('nama_lengkap') ?>');
        $('#sumber_referensi').val('');
        //		$('#detail_sumber_referensi').prop('disabled',true);
        //		$('#detail_sumber_referensi').
        document.getElementById("detail_sumber_referensi").readOnly = true;
        $('#detail_sumber_referensi').val('');
        $('#nama_prospek').focus();
        $('#ajukan').css('display', 'none');

    });


    $('#kode_wilayah').on('change', function() {

        document.getElementById('kabupaten').disabled = false;
        kdwilayah = this.value;
        kbkota = '';
        const kb = document.querySelector('#kabupaten');
        kb.innerHTML = '';
        // console.log();
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/wilayah/kabupaten2",
            data: {
                provinsi: this.value,
            },
            cache: false,
            success: function(data) {
                // alert(string);
                const datas = JSON.parse(data);
                const items = datas.items;
                const kabupaten = document.querySelector('#kabupaten');
              
                items.forEach((item) => {

                    kabupaten.innerHTML += `
					<option value='${item.kode_wilayah}'>${item.wilayah}</option>
					`;
                    //console.log(item.wilayah);

                });
                //console.log(items);

            }
        });


    });

    $('#kabupaten').on('change', function() {

        document.getElementById('kecamatan').disabled = false;
        // console.log()
        const kec = document.querySelector('#kecamatan');
        kec.innerHTML = '';
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/wilayah/kecamatan2",
            data: {
                kabkota: this.value,
            },
            cache: false,
            success: function(data) {
                // alert(string);
                const datas = JSON.parse(data);
                console.log(datas);
                return false;
                const items = datas.items;
                const kecamatan = document.querySelector('#kecamatan');
                items.forEach((item) => {

                    kecamatan.innerHTML += `
					<option value='${item.kode_wilayah}'>${item.wilayah}</option>
					`;
                    //console.log(item.wilayah);

                });
                //console.log(items);

            }
        });


    });


    $('#kecamatan').on('change', function() {

        document.getElementById('kelurahan').disabled = false;
        // console.log();
        const kel = document.querySelector('#kelurahan');
        kel.innerHTML = '';
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/wilayah/kelurahanShow",
            data: {
                kecamatan: this.value,
            },
            cache: false,
            success: function(data) {
                // alert(string);
                const datas = JSON.parse(data);
                const items = datas.items;
                const kelurahan = document.querySelector('#kelurahan');
                items.forEach((item) => {

                    kelurahan.innerHTML += `
            <option value='${item.kode_wilayah}'>${item.wilayah}</option>
            `;
                    //console.log(item.wilayah);

                });
                console.log(data);

            }
        });


    });

});

function editData(ID) {

    document.getElementById('kabupaten').disabled = false;
    // document.getElementById('kecamatan').disabled = false;
    // document.getElementById('kelurahan').disabled = false;

    var cari = ID;
    var url = "<?php echo site_url(); ?>index.php/site_user/prospek/cari";
    // alert(url);
    $.ajax({
        type: "POST",
        url: url,
        data: "cari=" + cari,
        dataType: "json",
        success: function(data) {

           // console.log(data);
            $('#kode').val(data.kode);
            $('#kode').attr("readonly", "true");
            $('#nama_prospek').val(data.nama_prospek);
            $('#snd').val(data.snd);
            $('#idmasterdebitur').val(data.idmasterdebitur);
            $('#alamat').val(data.alamat);
            $('#cif').val(data.cif);
            $('#nama_instansi').val(data.nama_instansi);
            $('#gaji_bruto').val(data.gaji_bruto);
            // $('#angsuran_kredit').val(data.angsuran_kredit);
            $('#kode_status').val(data.kode_status);
            $('#kd_bidang_usaha').val(data.kd_bidang_usaha);
            $('#telp').val(data.telp);
            $('#hp').val(data.hp);
            $('#email').val(data.email);
            $('#nominal').val(data.nominal);
            $('#pic').val(data.pic);
            $('#sumber_referensi').val(data.sumber_referensi);
            $('#detail_sumber_referensi').val(data.detail_sumber_referensi);
            $('#status_data').val(data.status_data);
            $('#nikprospek').val(data.nik_debitur);
            $('#kode_wilayah').val(data.provinsi);
            $('#kabupaten').val(data.kode_wilayah);
            $('#ajukan').css('display', 'block');


            kabupaten.innerHtml = kabupaten.innerHTML += `
            <option value='${data.kode_wilayah}' selected>${data.kode_wilayah}</option>
            `;
         

            var sumber_referensi = $("#sumber_referensi").val();
            if (sumber_referensi == "Lainnya") {
                document.getElementById("detail_sumber_referensi").readOnly = false;
            } else {
                document.getElementById("detail_sumber_referensi").readOnly = true;
            }



            var email = $("#email").val();
            atpos = email.indexOf("@");
            dotpos = email.lastIndexOf(".");

            if (atpos < 1 || (dotpos - atpos < 2)) {
                $("#email").focus();
                return false;
            }




        }
    });

    // this example uses the id selector & no options passed    
    jQuery(function($) {
        $('#nominal').autoNumeric('init');
    });


}

function getPronvinsi() {

    $.ajax({
        type: "GET",
        url: "<?php echo site_url(); ?>index.php/wilayah/index",
        dataType: "json",
        success: function(data) {
            //alert(data.ref);
            const items = data.items;
            const provinsi = document.querySelector('#kode_wilayah');
            items.forEach((item) => {

                provinsi.innerHTML += `
					<option value='${item.kode_wilayah}'>${item.wilayah}</option>
				`;
                // console.log(item.wilayah);

            });
            //console.log(items);

        }
    });

}

getPronvinsi();
</script>


<script src="<?php echo base_url();?>assets/autonumeric/autoNumeric.js"></script>
<style>
.ratakanan {
    text-align: right;
}
</style>
</script>

<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
        <div class="widget-toolbar no-border pull-right">
            <a href="#modal-table" class="btn btn-small btn-success" role="button" data-toggle="modal" name="tambah"
                id="tambah">
                <i class="icon-check"></i>
                Tambah Data
            </a>
        </div>
    </div>

    <table class="table fpTable lcnp table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center" width="5">No</th>
                <th class="center" width="100">Nama Prospek</th>
                <th class="center" width="80">Alamat</th>
                <th class="center" width="100">Bidang Usaha</th>
                <th class="center" width="60">Telp</th>
                <th class="center" width="60">PIC</th>
                <th class="center" width="60">Nominal</th>
                <th class="center" width="20">Status</th>
                <th class="center" width="40">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
		$username = $this->session->userdata('username');
		$data = $this->model_data->data_prospek("user",$username);
		$i=1;
		foreach($data->result() as $dt){ ?>
            <tr>
                <td class="center span1"><?php echo $i++?></td>
                <td><?php echo substr($dt->nama_prospek,0,25);?></td>
                <td><?php echo substr($dt->alamat_prospek,0,25);?></td>
                <td><?php echo substr($dt->nama_bidang_usaha,0,30);?></td>
                <td class="center"><?php echo $dt->telp;?></td>
                <td><?php echo $dt->pic_prospek;?></td>
                <td style="text-align:right"> <?php echo number_format($dt->nominal_prospek_awal,0);?></td>

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
							if($dt->status_data==4){
								echo "Mhn Hapus";							
								}else{
								if($dt->status_data==5){
									echo "Dihapus";							
									}else{									
									if($dt->status_data==0){
										echo "Belum diproses";	
										}else{
										if($dt->status_data==6){
											echo "Mhn Mutasi";			
											}else{
											if($dt->status_data==8){
												echo "Ditolak karena ".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'alasan' , "status = '1'");																																				
													}else{						
														echo " ";	
													}
											}
										}
									}
								}
							}
					}
					
				};?>
                </td>

                <td class="td-actions">
                    <center>
                        <div class="hidden-phone visible-desktop action-buttons">
                            <?php if($dt->status_data==2 or $dt->status_data==8){ 
				
                    }else{ ?>
                            <a class="green" href="#modal-table"
                                onclick="javascript:editData('<?php echo $dt->id_prospek;?>')" data-toggle="modal">
                                <i class="icon-pencil bigger-130"></i>
                            </a>

                            <a class="red"
                                href="<?php echo site_url();?>/site_user/prospek/hapus/<?php echo $dt->id_prospek;?>"
                                onClick="return confirm('Anda yakin ingin menghapus data ini?')">
                                <i class="icon-trash bigger-130"></i>
                            </a>
                            <?php
                    }?>

                        </div>

                        <div class="hidden-desktop visible-phone">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
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
            Data Prospek
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">

                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>

                <input type="hidden" name="kode" id="kode" />
                <input type="hidden" name="status_data" id="status_data" />
                <input type="hidden" name="idmasterdebitur" id="idmasterdebitur">


                <div class="control-group">
                    <label class="control-label" for="form-field-1">NIK Prospek</label>

                    <div class="controls">
                        <input type="text" maxLength="16" name="nikprospek" id="nikprospek" placeholder="NIK Prospek" />
                        <button type="button" class="btn btn-info btn-mini" id="cekexisting">Inquery</button>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Prospek</label>

                    <div class="controls">
                        <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama Prospek" />
                    </div>
                </div>
                <!-- <div class="control-group">
                    <label class="control-label" for="form-field-1">Nomor rekening tabungan</label>

                    <div class="controls">
                        <input type="text" name="nomor_rekening_tabungan" id="nomor_rekening_tabungan" placeholder="Rekening Tabungan" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nomor rekening pinjaman</label>

                    <div class="controls">
                        <input type="text" name="nomor_rekening_pinjaman" id="nomor_rekening_pinjaman" placeholder="Rekening Tabungan" />
                    </div>
                </div> -->
                <div class="control-group">
                    <label class="control-label" for="form-field-1">CIF</label>

                    <div class="controls">
                        <input type="text" name="cif" id="cif" placeholder="CIF" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama instansi</label>

                    <div class="controls">
                        <input type="text" name="nama_instansi" id="nama_instansi" placeholder="Nama instansi" />
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="form-field-1">Gaji Bruto</label>

                    <div class="controls">
                        <input type="text" name="gaji_bruto" id="gaji_bruto" placeholder="Gaji bruto" />
                    </div>
                </div>

                <!-- <div class="control-group">
                    <label class="control-label" for="form-field-1">Angsuran Kredit</label>

                    <div class="controls">
                        <input type="text" name="angsuran_kredit" id="angsuran_kredit" placeholder="Angsuran Kredit" />
                    </div>
                </div> -->



                <div class="control-group">
                    <label class="control-label" for="form-field-1">Jenis debitur</label>
                    <div class="controls">
                        <select name="kode_status" id="kode_status" class="span5">
                            <option value="2" selected="selected">Perorangan</option>
                            <option value="1">Perusahaan</option>
                        </select>
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="form-field-1">Bidang Usaha</label>
                    <div class="controls">
                        <select name="kd_bidang_usaha" id="kd_bidang_usaha" class="span6">
                            <option value="" selected="selected">-Pilih-</option>
                            <?php
                            $data = $this->model_data->kd_bidang_usaha();
                            foreach($data->result() as $dt){
                            ?>
                            <option value="<?php echo $dt->kd_bidang_usaha;?>"><?php echo $dt->nama_bidang_usaha;?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>

                    <div class="controls">
                        <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="span10" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Provinsi</label>
                    <div class="controls">
                        <select name="kode_wilayah" id="kode_wilayah">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Kabupaten</label>
                    <div class="controls">
                        <select name="kabupaten" id="kabupaten" disabled>
                            <option value="">Pilih kabupaten</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="control-group">
                    <label class="control-label" for="form-field-1">Kecamatan</label>
                    <div class="controls">
                        <select name="kecamatan" id="kecamatan" disabled>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Kelurahan</label>
                    <div class="controls">
                        <select name="kelurahan" id="kelurahan" disabled>
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>
                </div> -->

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Telp</label>

                    <div class="controls">
                        <input type="text" name="telp" id="telp" placeholder="Telp"
                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">HP</label>

                    <div class="controls">
                        <input type="text" name="hp" id="hp" placeholder="HP"
                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Email</label>
                    <div class="controls">


                        <input id="email" name="email" type="text" class="required" title="Isi email dengan benar" />
                        <span class="msg error"> Email salah</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Pengajuan Plafond (Rp.)</label>
                    <div class="controls">
                        <input type="text" name="nominal" id="nominal" placeholder="Pengajuan Plafond" class="ratakanan" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">PIC</label>
                    <div class="controls">
                        <input type="text" name="pic" id="pic" placeholder="PIC" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">SND</label>
                    <div class="controls">
                        <select name="snd" id="snd">
                            <option value="">Pilih SND</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="form-field-1">Sumber Referensi</label>
                    <div class="controls">
                        <select name="sumber_referensi" id="sumber_referensi" class="span4">
                            <option value="">-Pilih-</option>
                            <?php
						$data = $this->model_data->isi_sumber_referensi();
						foreach($data as $dt){
						?>
                            <option value="<?php echo $dt;?>"><?php echo $dt;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="form-field-1">Detail Sumber Referensi</label>
                    <div class="controls">
                        <input type="text" name="detail_sumber_referensi" id="detail_sumber_referensi" />

                        <!--	<input type="text" name="detail_sumber_referensi"  />	-->
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
            </button> -->



        </div>
    </div>
</div>