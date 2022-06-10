<script type="text/javascript">
$(document).ready(function() {

    //	$("#kode").keyup(function(e){
    //		var isi = $(e.target).val();
    //		$(e.target).val(isi.toUpperCase());	
    //	});

    //	$("#id_prospek").keyup(function(e){
    //		var isi = $(e.target).val();
    //		$(e.target).val(isi.toUpperCase());	
    //	});




    $("#simpan").click(function() {
        //var kode	= $("#kode").val();
        var id_prospek = $("#id_prospek").val();
        var nominal = $("#nominal").val();
        var nasabah_setuju = $("#nasabah_setuju").val();

        var permohonanbaru_topup = $("#permohonanbaru_topup").val();

        // if(permohonanbaru_topup.length === 0){
        //     alert('Maaf, Permohonan Top Up Harus Dipilih');
        //     $("#permohonanbaru_topup").focus();
        //     return false();
        // }

        var string = $("#my-form").serialize();

         

        //		if(kode.length==0){
        //			alert('Maaf, Kode Tidak boleh kosong');
        //			$("#kode").focus();
        //			return false();
        //		}

        // if (id_prospek.length == 0) {
        //     alert('Maaf, Surat Permohonan tidak boleh kosong');
        //     $("#id_prospek").focus();
        //     return false();
        // }

        if (nominal.length == 0) {
            alert('Maaf, Nominal tidak boleh kosong');
            $("#nominal").focus();
            return false();
        }

        // if (nasabah_setuju.length == 0) {
        //     alert('Maaf, Nasabah Setuju tidak boleh kosong');
        //     $("#nasabah_setuju").focus();
        //     return false();
        // }



        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_user/pk/simpan",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
               // console.log(data);
                $("#ajukan").attr('disabled', false);
                // location.reload();
            }
        });

    });




    $("#ajukan").click(function() {
        //var kode	= $("#kode").val();
        var id_prospek = $("#id_prospek").val();
        var nominal = $("#nominal").val();
        var nasabah_setuju = $("#nasabah_setuju").val();



        var string = $("#my-form").serialize();


        //		if(kode.length==0){
        //			alert('Maaf, Kode Tidak boleh kosong');
        //			$("#kode").focus();
        //			return false();
        //		}

        if (id_prospek.length == 0) {
            alert('Maaf, Surat Permohonan tidak boleh kosong');
            $("#id_prospek").focus();
            return false();
        }

        if (nominal.length == 0) {
            alert('Maaf, Nominal tidak boleh kosong');
            $("#nominal").focus();
            return false();
        }

        if (nasabah_setuju.length == 0) {
            alert('Maaf, Nasabah Setuju tidak boleh kosong');
            $("#nasabah_setuju").focus();
            return false();
        }


        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_user/pk/ajukan",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });

    });





    $("#hapus").click(function() {

        var string = $("#my-form").serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_user/pk/hapus",
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
        $('#id_prospek').val('');
        $('#nasabah_setuju').val('');
        $('#nominal').val('');
        $('#nama_prospek').val('');
        $('#alamat').val('');
        $('#kode').focus();
    });

    $("#baki_debet_lama").on('blur' , function(){

        let baki_debet_lama = $(this).val();
        let plafond = $("#nominal").val();

        // console.log(baki_debet_lama);

        $.ajax({
                type : "POST",
                url: "<?php echo site_url(); ?>index.php/site_user/pk/hitungsisabakidebet",
                data: "plafond=" + plafond + "&baki_debet_lama=" + baki_debet_lama,
                dataType: "json",
                success : function(data){
                   if(data === 'gagal'){
                       alert("Maaf, baki debet lama lebih besar dari plafond")
                   }else{
                    $("#sisa_baki_debet").val(data);
                   }
                }
            });
        
    });


    $("#updatenik").on('click' , function () {

        const nik_dbtr = $("#nik_dbtr").val();
        const idmasterdebitur = $("#idmasterdebitur").val();

        $.ajax({
            type : "POST",
            url : "<?php echo site_url() ?>index.php/site_user/pk/updatenikdebitur",
            data : "nik_dbtr=" + nik_dbtr + "&idmasterdebitur="+ idmasterdebitur,
            dataType: "json",
            success : function(data){
                alert(data);
                location.reload();
            }
        });

    });

    $("#cekcifnomorrekening").on('click' , function() {
        
            const nomor_rek = $("#nomor_rekening").val();
            const niktext = $(".niktext").html();
            $.ajax({
                type : "POST",
                url: "<?php echo site_url(); ?>index.php/site_user/pk/ceknomorrekening",
                data: "nomor_rek=" + nomor_rek + "&niktext=" + niktext,
                dataType: "json",
                success : function(data){
                    const datas = data;
                    const res =datas;
                    if(res.msg == 'error'){

                        alert(res.msgtext);
                        $('#nik_dbtr').attr('disabled' , false);
                        $('#updatenik').attr('disabled' , false);

                    }else{
                        const tgl_release = res.tanggal_realisasi;
                        const plafond = res.plafond;
                    
                        $("#tanggal_release").val(tgl_release);
                        $("#nominal").val(plafond);
                    
                        $("#baki_debet_lama").val(0);
                        $("#sisa_baki_debet").val(res.sisa_baki_debet);
                    }
                    //console.log(datas);
                  
                }
            });
            

    });

    $("#permohonanbaru_topup").on('change'  , function() {

        const val = $(this).val();
        const nominal_plafont = $("#nominal").val();
        if(val != 2){
            $("#baki_debet_lama").attr("readonly" , false);
        }else{
            $("#baki_debet_lama").val(0);
            $("#sisa_baki_debet").val(nominal_plafont);
            $("#baki_debet_lama").attr("readonly" , true);
        }

    });

    cekPermohonanTopup();


});

function formatPrice(value) {
      let val = (value / 1).toFixed(0).replace('.', ',');
      let hasil = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  
      return hasil;
    
}


function cekPermohonanTopup(){
        let value = $("#permohonanbaru_topup").val();
        const nominal_plafont = $("#nominal").val();
        if(value != '2'){
            $("#baki_debet_lama").attr("readonly" , false);
        }else{
            $("#baki_debet_lama").val(0);
            $("#sisa_baki_debet").val(nominal_plafont);
            $("#baki_debet_lama").attr("readonly" , true);
        }
}


function editData(ID , status = '') {
    var cari = ID;
    var dstatus = status;

    // if(dstatus === '3'){
    //    alert('res')
    // }
    if(dstatus === 3){
       $("#ajukan").hide();
       $("#simpan").hide();
    }
    // alert(dstatus);
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>index.php/site_user/pk/cari",
        data: "cari=" + cari,
        dataType: "json",
        success: function(data) {
            //alert(data.ref);
            
            console.log(data);
            // $('#kode').val(data.kode);
            // $('#kode').attr("readonly", "true");
            // $('#id_prospek').val(data.id_prospek);
            // $('#nasabah_setuju').val(data.nasabah_setuju);
            // $('#komite_setuju').val(data.komite_setuju);
            // $('#nominal').val(data.nominal);
            // $('#nama_prospek').val(data.nama_prospek);
            // $('#alamat').val(data.alamat);
            $('#kode').val(data.kode);
            $('#idmasterdebitur').val(data.idmasterdebitur);
            $('#kode_master').val(data.kode_master);
            $('#kode').attr("readonly", "true");
            $('#id_prospek').val(data.id_prospek);

            if(data.nasabah_setuju){
                $('#nasabah_setuju').val(data.nasabah_setuju);
            }
            if(data.komite_setuju){
                $('#komite_setuju').val(data.komite_setuju);
            }
            $('#nomor_rekening').val(data.nomor_rekening);
            $('#permohonanbaru_topup').val(data.permohonbaru_topup);

            var baki_debet_lama = data.baki_debet_lama;
            var nominal = data.plafont;
            // nominal.replace(',' , '');
            $("#plafont").val(nominal);

            $('#baki_debet_lama').val(data.baki_debet_lama);
            $('#sisa_baki_debet').val(data.sisa_baki_debet);
            $("#tanggal_release").val(data.tanggal_release);

            // if(baki_debet_lama === null || baki_debet_lama ===0){
            //     var sisa_baki_debet = nominal;
            //     $('#baki_debet_lama').val(0);
            //     $('#sisa_baki_debet').val(sisa_baki_debet);
            // }else{
               
            //     $('#baki_debet_lama').val(baki_debet_lama);
            //     $('#sisa_baki_debet').val(data.sisa_baki_debet);

            // }
         

            
            $('#nominal').val(data.nominal);
            $('.nominal_').val('Rp. ' + data.nominal);
            $('.nominal__').html('Rp. ' + data.nominal);
            $('#nama_prospek').val(data.nama_prospek);
            $('.sumber_referensi').html(data.sumber_referensi);
            if(data.detail_sumber_referensi != ''){
                $('.detail_sumber_referensi').html(data.    detail_sumber_referensi);
            }else{
                $('.detail_sumber_referensi').html('-');
            }
            $('#alamat').val(data.alamat);
            $('#id_user_pic').val(data.id_user_pic);
            $('.namaprospek').val(data.nama_prospek);
            $('.alamat_p').html(data.alamat);
            $('.nik').val(data.nik);
            $('.niktext').html(data.nik);
            $('.pic_prospek').html(data.pic_prospek);
            $('.namaprospektext').html(data.nama_prospek);
            $('#kode_status').val(data.kode_status);
            $('.kd_bidang_usaha').html(data.kd_bidang_usaha);
            $('.provinsi').html(data.provinsi);
            $('.kab_kota').html(data.kab_kota);
            // $('.kecamatan').html(data.kecamatan);
            // $('.kelurahan').html(data.kelurahan);
            if (data.telp != '') {
                $('.telp').html(data.telp);
            } else {
                $('.telp').html('-');
            }


            if (data.kode_status == '1') {
                $(".stsprospek").html('Perusahaan');
            } else {
                $(".stsprospek").html('Perorangan');
            }

            $('.hp').html(data.hp);
            $('.email').html(data.email);
            $('#target_tgl_booking').val(data.target_tgl_booking);
            $('.target_tgl_booking').html(data.target_tgl_booking);
            if (data.bi_checking == "1") {
                $('#bi_checking').val("Baik");
                $('.bi_checking').html("Baik");

            } else if (data.bi_checking == "2") {
                $('#bi_checking').val("Tidak Baik");
                $('.bi_checking').html("Tidak Baik");

            } else {
                $('#bi_checking').val("Baik Dengan Catatan");
                $('.bi_checking').html("Baik Dengan Catatan");
            }

            if (data.siup == "1") {
                $('#siup').val("Ada");
                $('.siup').html("Ada");

            } else if (data.siup == "2") {
                $('#siup').val("Tidak Ada");
                $('.siup').html("Tidak Ada");

            } else {
                $('#siup').val("Ada Dengan Catatan");
                $('.siup').html("Ada Dengan Catatan");
            }

            if (data.surat_permohonan == "1") {
                $('#surat_permohonan').val("Ada");
                $('.surat_permohonan').html("Ada");
            } else if (data.surat_permohonan == "2") {
                $('#surat_permohonan').val("Tidak Ada");
                $('.surat_permohonan').html("Tidak Ada");
            } else {
                $('#surat_permohonan').val("Ada Dengan Catatan");
                $('.surat_permohonan').html("Ada Dengan Catatan");
            }

            if (data.lap_keuangan_2thn_terakhir == "1") {
                $('#lap_keuangan_2thn_terakhir').val("Ada");
                $('.lap_keuangan_2thn_terakhir').html("Ada");
            } else if (data.lap_keuangan_2thn_terakhir == "2") {
                $('#lap_keuangan_2thn_terakhir').val("Tidak Ada");
                $('.lap_keuangan_2thn_terakhir').html("Tidak Ada");
            } else {
                $('#lap_keuangan_2thn_terakhir').val("Ada Dengan Catatan");
                $('.lap_keuangan_2thn_terakhir').html("Ada Dengan Catatan");
            }

            if (data.agunan == "1") {
                $('#agunan').val("Ada");
                $('.agunan').html("Ada");

            } else if (data.agunan == "2") {
                $('#agunan').val("Tidak Ada");
                $('.agunan').html("Tidak Ada");

            } else {
                $('#agunan').val("Ada Dengan Catatan");
                $('.agunan').html("Ada Dengan Catatan");

            }

            if (data.dokumen_pendukung_lain == "1") {
                $('#dokumen_pendukung_lain').val("Ada");
                $('.dokumen_pendukung_lain').html("Ada");
                
            } else if (data.dokumen_pendukung_lain == "2") {
                $('#dokumen_pendukung_lain').val("Tidak Ada");
                $('.dokumen_pendukung_lain').html("Tidak Ada");
            } else {
                $('#dokumen_pendukung_lain').val("Ada Dengan Catatan");
                $('.dokumen_pendukung_lain').html("Ada Dengan Catatan");
            }

            if (data.mampu_memenuhi_tagihan == "1") {
                $('#mampu_memenuhi_tagihan').val("Ada");
                $('.mampu_memenuhi_tagihan').html("Ada");
            } else if (data.mampu_memenuhi_tagihan == "2") {
                $('#mampu_memenuhi_tagihan').val("Tidak Ada");
                $('.mampu_memenuhi_tagihan').html("Tidak Ada");
            } else {
                $('#mampu_memenuhi_tagihan').val("Ada Dengan Catatan");
                $('.mampu_memenuhi_tagihan').html("Ada Dengan Catatan");
            }

            if (data.cukup_agunan == "1") {
                $('#cukup_agunan').val("Ada");
                $('.cukup_agunan').html("Ada");
            } else if (data.cukup_agunan == "2") {
                $('#cukup_agunan').val("Tidak Ada");
                $('.cukup_agunan').html("Tidak Ada");
            } else {
                $('#cukup_agunan').val("Ada Dengan Catatan");
                $('.cukup_agunan').html("Ada Dengan Catatan");
            }

            if (data.pembiayaan_wajar == "1") {
                $('#pembiayaan_wajar').val("Ada");
                $('.pembiayaan_wajar').html("Ada");
            } else if (data.pembiayaan_wajar == "2") {
                $('#pembiayaan_wajar').val("Tidak Ada");
                $('.pembiayaan_wajar').html("Tidak Ada");
            } else {
                $('#pembiayaan_wajar').val("Ada Dengan Catatan");
                $('.pembiayaan_wajar').html("Ada Dengan Catatan");
            }

            $('#nama_daerah').val(data.nama_daerah);
            $('#jenis_guna').val(data.jenis_guna);
            $('.jenis_guna').html(data.jenis_guna);
            $('#jenis_kredit').val(data.jenis_kredit);
            $('.jenis_kredit').html(data.jenis_kredit);
            $('#lm_usaha').val(data.lm_usaha + ' Tahun');
            $('.lm_usaha').html(data.lm_usaha + ' Tahun');


            // if (data.nasabah_setuju.length > 0) {
            //     $("#ajukan").attr('disabled', false);
            // }
          






        }
    });

  

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
				<option value='${item.wilayah}'>${item.wilayah}</option>
			`;
                    // console.log(item.wilayah);

                });
                //console.log(items);

            }
        });

    }

    // getPronvinsi();

    // this example uses the id selector & no options passed    
    jQuery(function($) {
        $('#nominal').autoNumeric('init');
        $('#baki_debet_lama').autoNumeric('init');
    });

}
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

        </div>
    </div>

    <table class="table fpTable lcnp table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center" width="5">No</th>
                <th class="center" width="80">Nama</th>
                <th class="center" width="50">Komite Setuju</th>
                <th class="center" width="50">Nasabah Setuju</th>
                <th class="center" width="60">Nominal (Rp.)</th>
                <th class="center" width="20">Status</th>
                <th class="center" width="40">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
		$username = $this->session->userdata('username');
		$data = $this->model_data->data_pk("user",$username);							
		
		$i=1;
		foreach($data->result() as $dt){ ?>
            <tr>
                <td class="center span1"><?php echo $i++?></td>
                <td><?php echo substr($dt->nama_prospek,0,25);?></td>
                <td class="center">
                    <?php 
					if($dt->komite_setuju==1){
						 echo "Ya";
					}else{
					if($dt->komite_setuju==2){
						echo "Tidak";
						}else{
						if($dt->komite_setuju==3){
							echo "Ya Dgn Catatan";
							}else{						
								echo "";	
						}
					}
					
				};?>
                </td>

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


                <td style="text-align:right"> <?php echo number_format($dt->nominal,0);?></td>




                <td class="center"><?php 
					if($dt->status_data==1){
						 echo "Waiting";
					}else{
					if($dt->status_data==2){
						echo "Approved";
					}else{
					    if($dt->status_data==3){
                            echo "Dikembalikan ke "." ".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'dikembalikan_ke' , "status_perbaikan = '0' and status = '2'")." (".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'alasan' , "status_perbaikan = '0' and status = '2'").")";
						}else{
							if($dt->status_data==8){
								echo "Ditolak karena ".KonHelpers::joinGampang('record_tidak_di_approve' , 'id_prospek' , $dt->id_prospek , 'alasan' , "status = '1'");								
								}else{						
									echo "Blm Diajukan";	
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
                                onclick="javascript:editData('<?php echo $dt->id_pk;?>' , <?php echo $dt->status_data;?>)" data-toggle="modal">
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
            PK
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">

            <div style="padding : 40px;">
                <div class="alert alert-info">
                    <h6>Harap Periksa kembali sebelum mengajukan</h6>
                </div>
                <form class="form-horizontal" name="my-form" id="my-form">

                    <!-- <div class="control-group">
                        <div class="controls">
                        </div>
                    </div> -->

                    <input type="hidden" name="kode" id="kode" />
                    <input type="hidden" name="kode_master" id="kode_master" />
                    <input type="hidden" name="id_prospek" id="id_prospek" />

                    <div class="tab">
                        <button type="button" data-id="tab-1" class="tablink">Prospek</button>
                        <!-- <button type="button" data-id="tab-2" class="tablink">Target</button>
                        <button type="button" data-id="tab-3" class="tablink">Data Coll</button> -->
                        <button type="button" data-id="tab-4" class="tablink">Analisa</button>
                        <button type="button" data-id="tab-5" class="tablink active-tab">PK</button>
                    </div>

                    <div id="tab-1" class="tabs border-r border-l border-b rounded p-4">

                        <div style="display : flex; justify-content: space-between;">

                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>NIK Prospek</strong>
                                    <p class="niktext"></p>
                                </li>
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospektext"></p>
                                </li>
                                <li>
                                    <strong>Status Prospek</strong>
                                    <p class="stsprospek"></p>
                                </li>
                                <li>
                                    <strong>Bidang Usaha</strong>
                                    <p class="kd_bidang_usaha"></p>
                                </li>
                                <li>
                                    <strong>Alamat</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Telp</strong>
                                    <p class="telp"></p>
                                </li>
                                <li>
                                    <strong>HP</strong>
                                    <p class="hp"></p>
                                </li>
                                <li>
                                    <strong>Email</strong>
                                    <p class="email"></p>
                                </li>

                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>PIC</strong>
                                    <p class="pic_prospek"></p>
                                </li>
                                <li>
                                    <strong>Provinsi</strong>
                                    <p class="provinsi"></p>
                                </li>
                                <li>
                                    <strong>Kabupaten</strong>
                                    <p class="kab_kota"></p>
                                </li>
                                <!-- <li>
                                    <strong>Kecamatan</strong>
                                    <p class="kecamatan"></p>
                                </li>
                                <li>
                                    <strong>Kelurahan</strong>
                                    <p class="kelurahan"></p>
                                </li> -->

                                <li>
                                    <strong>Pengajuan Plafond</strong>
                                    <p class="nominal__"></p>
                                </li>

                                <li>
                                    <strong>Sumber Refrensi</strong>
                                    <p class="sumber_referensi"></p>
                                </li>
                                <li>
                                    <strong>Detail Sumber Referensi</strong>
                                    <p class="detail_sumber_referensi"></p>
                                </li>
                            </ul>


                        </div>

                    </div>
                    <div id="tab-2" class="tabs border-r border-l border-b rounded p-4 ">

                        <div style="display : flex; justify-content: space-between;">
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Nomor Identitas</strong>
                                    <p class="niktext"></p>
                                </li>
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospektext"></p>
                                </li>
                                <li>
                                    <strong>Alamat Prospek</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Lama Usaha (Thn)</strong>
                                    <p class="lm_usaha"></p>
                                </li>
                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Target Tanggal Booking</strong>
                                    <p class="target_tgl_booking"></p>
                                </li>
                                <li>
                                    <strong>BI Checking</strong>
                                    <p class="bi_checking"></p>
                                </li>
                                <li>
                                    <strong>SIUP</strong>
                                    <p class="siup"></p>
                                </li>
                                <li>
                                    <strong>Pengajuan Plafond</strong>
                                    <p class="nominal__"></p>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div id="tab-3" class="tabs border-r border-l border-b rounded p-4 ">

                        <div style="display : flex; justify-content: space-between;">
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospektext"></p>
                                </li>
                                <li>
                                    <strong>Alamat Prospek</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Surat Permohonan</strong>
                                    <p class="surat_permohonan"></p>
                                </li>
                                <li>
                                    <strong>Laporan Keuangan 2tahun terakhir</strong>
                                    <p class="lap_keuangan_2thn_terakhir"></p>
                                </li>
                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Agunan</strong>
                                    <p class="agunan"></p>
                                </li>
                                <li>
                                    <strong>Dokumen Pendukung</strong>
                                    <p class="dokumen_pendukung_lain"></p>
                                </li>
                                <!-- <li>
                                    <strong>Lokasi Proyek</strong>
                                    <p id="nama_daerah"></p>
                                </li> -->
                                <li>
                                    <strong>Pengajuan Plafond</strong>
                                    <p class="nominal__"></p>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div id="tab-4" class="tabs border-r border-l border-b rounded p-4 ">

                        <div style="display : flex; justify-content: space-between;">

                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospektext"></p>
                                </li>
                                <li>
                                    <strong>Alamat Prospek</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Jenis Kredit</strong>
                                    <p class="jenis_kredit"></p>
                                </li>
                                <li>
                                    <strong>Jenis Guna</strong>
                                    <p class="jenis_guna"></p>
                                </li>
                               
                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Mampu Memenuhi Tagihan</strong>
                                    <p class="mampu_memenuhi_tagihan"></p>
                                </li>
                                <li>
                                    <strong>Cukup anggunan</strong>
                                    <p class="cukup_agunan"></p>
                                </li>
                                <li>
                                    <strong>Pembiayaan Wajar</strong>
                                    <p class="pembiayaan_wajar"></p>
                                </li>
                                <li>
                                    <strong>Nominal</strong>
                                    <p class="nominal__"></p>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div id="tab-5" class="tabs border-r border-l border-b rounded p-4 active">
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Nik Debitur</label>

                            <div class="controls">
                                <input type="text"  maxLength="16" disabled="true" name="nik_dbtr" id="nik_dbtr" placeholder="NIK"
                                 />
                                <input type="hidden"   name="idmasterdebitur" id="idmasterdebitur" placeholder="NIK"
                                 />
                                 <button type="button" id="updatenik" disabled="true" class="btn btn-small btn-info">Update</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Masukan Nomor Rekening</label>

                            <div class="controls">
                                <input type="text"  maxLength="14" name="nomor_rekening" id="nomor_rekening" placeholder="Nomor Rekening"
                                 />
                                 <button type="button" id="cekcifnomorrekening" class="btn btn-small btn-info">Cari</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Permohonan Baru/Topup</label>
                            <div class="controls">
                                <select name="permohonanbaru_topup" id="permohonanbaru_topup" class="span5" readonly="true">
                                    <option value="" selected="selected">Pilih</option>
                                    <option value="2">Baru</option>
                                    <option value="1">Top Up</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Realisasi Plafond (Rp.)</label>
                            <div class="controls">
                                <input type="text" name="nominal" id="nominal" value="0" placeholder="Pengajuan Plafond" readonly="true"
                                    class="ratakanan" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Baki Debet Lama</label>

                            <div class="controls">
                                <input type="text" name="baki_debet_lama" value="0" id="baki_debet_lama" placeholder="Baki Debet Lama" readonly="true"
                                 />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Realisasi Real</label>

                            <div class="controls">
                               
                          
                                <input type="text" name="sisa_baki_debet" value="0" id="sisa_baki_debet" placeholder="Realisasi Real" readonly="true"
                                 />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Tanggal Realisasi</label>

                            <div class="controls">
                                <input type="date" name="tanggal_release" readonly="true" value="0" id="tanggal_release" placeholder="Baki Debet Lama"
                                 />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Nama</label>

                            <div class="controls">
                                <input type="text" name="nama_prospek" id="nama_prospek" placeholder="Nama"
                                    readonly="true" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Alamat</label>

                            <div class="controls">
                                <input type="text" name="alamat" id="alamat" placeholder="Alamat" readonly="true" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Komite</label>
                            <div class="controls">
                                <select name="komite_setuju" id="komite_setuju" class="span5">
                                    <option value="1" selected="selected">Ya</option>
                                    <option value="2">Tidak</option>
                                    <option value="3">Ya Dengan Catatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Nasabah Setuju</label>
                            <div class="controls">
                                <select  name="nasabah_setuju" id="nasabah_setuju" class="span5">
                                    <option value="1" selected="selected">Ya</option>
                                    <option value="2">Tidak</option>
                                    <option value="3">Ya Dengan Catatan</option>
                                </select>
                            </div>
                        </div>


                       


                    </div>






                </form>
            </div>

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
            <button type="button" name="ajukan" id="ajukan" class="btn btn-small btn-success pull-left" disabled>
                <i class="icon-save"></i>
                Ajukan
            </button>
        </div>
    </div>
</div>