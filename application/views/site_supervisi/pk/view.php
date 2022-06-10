<script type="text/javascript">
$(document).ready(function() {

    $("#stsapprove").val(1);
    $("#statuspengembalian").val(1);
    $("#alasan_kembali").val('');
    //	$("#kode").keyup(function(e){
    //		var isi = $(e.target).val();
    //		$(e.target).val(isi.toUpperCase());	
    //	});

    //	$("#id_jenis_pembiayaan").keyup(function(e){
    //		var isi = $(e.target).val();
    //		$(e.target).val(isi.toUpperCase());	
    //	});




    $("#simpan").click(function() {
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

        // if (nasabah_setuju.length == 0) {
        //     alert('Maaf, Nasabah Setuju tidak boleh kosong');
        //     $("#nasabah_setuju").focus();
        //     return false();
        // }



        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/simpan",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
                location.reload();
                // console.log(data);
            }
        });

    });

    $("#cekcifnomorrekening").on("click" , function(){

        let nomor_rekening = $("#nomor_rekening").val();
        let nikval = $("#nikval").val();
        let baki_debet_lama = $("#baki_debet_lama").val();

        $("#loading").html('<img src="<?=base_url()?>/assets/icon/loadinggif.gif" style="width: 16px; height:16px;"  alt="load">'+"Mohon tunggu...");

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/cekrekeningpinjaman",
            data: `nomor_rekening=${nomor_rekening}&nikval=${nikval}&baki_debet_lama=${baki_debet_lama}`,
            success: function(data) {
                let result = JSON.parse(data);

                $("#nominal").val(result.plafond_akhir);
                $("#baki_debet_lama").val(result.baki_debet_lama);
                $("#sisa_baki_debet").val(result.realisareal);
                $("#tanggal_release").val(result.tanggal_realisasi);
                

                $("#loading").html("");
                $("#permohonanbaru_topup").attr("disabled" , false);
                // console.log(result);
            }
        });

        

    });


    $("#permohonanbaru_topup").on("change" , function(){

        let value = $(this).val();

        if(value === '1'){
            $("#baki_debet_lama").attr("readonly" , false);
        }else{
            $("#baki_debet_lama").attr("readonly" , true);
        }

    });


    $("#baki_debet_lama").on("change" , function(){

        let nominal = $("#nominal").val();
        let baki_debet_lama  = $(this).val();

        $("#loading").html(`<p style="margin-bottom : 20px;">Mohon tunggu sedang mengitung ulang realisasi real</p>`);
        

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/permohonantopup",
            data: `nominal=${nominal}&baki_debet_lama=${baki_debet_lama}`,
            success: function(data) {
                let result = JSON.parse(data);
                $("#nominal").val(result.plafond_akhir);
                $("#baki_debet_lama").val(result.baki_debet_lama);
                $("#sisa_baki_debet").val(result.realisareal);
                $("#loading").html("");
                // console.log(data);
            }
        });



    });


    $("#kembalikan").click(function() {
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
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/kembalikan",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });

    });



    $("#tolak").click(function() {

        var string = $("#my-form").serialize();


        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/tolak",
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
            url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/hapus",
            data: string,
            cache: false,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });

    });

    $("#stsapprove").on('change', function() {

        var stsapprove = $(this).val();
        if (stsapprove == '1') {

            $(".text-sts").html('Approve');
            // $(".spbtn").addClass('btn-success');
            $(".spbtn").addClass('btn-success');
            $(".spbtn").removeClass('btn-warning');
            $(".spbtn").removeClass('btn-info');
            $(".kembalike").hide();
            $(".catatan_pengembalian").hide();

        } else if (stsapprove == '2') {
            $(".text-sts").html('Kembalikan');
            $(".spbtn").removeClass('btn-success');
            $(".spbtn").removeClass('btn-warning');
            $(".spbtn").addClass('btn-info');
            $(".kembalike").show();
            $(".catatan_pengembalian").show();

        } else {
            $(".text-sts").html('Tolak');
            $(".spbtn").removeClass('btn-success');
            $(".spbtn").addClass('btn-warning');
            $(".spbtn").removeClass('btn-info');
            $(".kembalike").hide();
            $(".catatan_pengembalian").show();
            // $(".spbtn").addClass('btn-warning');
        }
        // alert(stsapprove)

    });



    $("#tambah").click(function() {
        $('#kode').val('');
        $('#kode').attr("readonly", false);
        $('#id_prospek').val('');
        $('#nasabah_setuju').val('');
        $('#nominal').val('');
        $('#nama_prospek').val('');
        $('#alamat').val('');
        $('#id_user_pic').val('');
        $('#kode').focus();
    });
});

function editData(ID) {


    var cari = ID;
    $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>index.php/site_supervisi/pk/cari",
        data: "cari=" + cari,
        dataType: "json",
        success: function(data) {
            //alert(data.ref);
            // console.log(data.tanggal_release);
            if (data.komite_setuju != '0') {

            }

            $("#tanggal_release").val(data.tanggal_release);

            $('#kode').val(data.kode);
            $('#kode').attr("readonly", "true");
            $('#id_prospek').val(data.id_prospek);
            $('#nasabah_setuju').val(data.nasabah_setuju);
            $('#komite_setuju').val(data.komite_setuju);
            $('#nomor_rekening').val(data.nomor_rekening);
            $('#baki_debet_lama').val(data.baki_debet_lama);
            $('#sisa_baki_debet').val(data.sisa_baki_debet);
            $('#nominal').val(data.nominal);
            $('.nominal_').html('Rp. ' + data.nominal);
            $('#nama_prospek').val(data.nama_prospek);
            $('#alamat').val(data.alamat);
            $('#id_user_pic').val(data.id_user_pic);
            $('.namaprospek').html(data.nama_prospek);
            $('.alamat_p').html(data.alamat);
            $('.nik').html(data.nik);
            $("#nikval").val(data.nik);
            $('#kode_status').html(data.kode_status);
            $('#kd_bidang_usaha').html(data.kd_bidang_usaha);
            $('#provinsi').html(data.provinsi);
            $('#kab_kota').html(data.kab_kota);
            $('#kecamatan').html(data.kecamatan);

            if(data.permohonbaru_topup != ""){
                $('#permohonanbaru_topup').val(data.permohonbaru_topup);
                // alert(data.permohonbaru_topup);
            }

            if (data.telp != '') {
                $('#telp').html(data.telp);
            } else {
                $('#telp').html('-');
            }
            $('#hp').html(data.hp);
            $('#email').html(data.email);
            $('#target_tgl_booking').html(data.target_tgl_booking);
            if (data.bi_checking == "1") {
                $('#bi_checking').html("Baik");
            } else if (data.bi_checking == "2") {
                $('#bi_checking').html("Tidak Baik");
            } else {
                $('#bi_checking').html("Baik Dengan Catatan");
            }

            if (data.siup == "1") {
                $('#siup').html("Ada");
            } else if (data.siup == "2") {
                $('#siup').html("Tidak Ada");
            } else {
                $('#siup').html("Ada Dengan Catatan");

            }

            if (data.surat_permohonan == "1") {
                $('#surat_permohonan').html("Ada");
            } else if (data.surat_permohonan == "2") {
                $('#surat_permohonan').html("Tidak Ada");
            } else {
                $('#surat_permohonan').html("Ada Dengan Catatan");

            }

            if (data.lap_keuangan_2thn_terakhir == "1") {
                $('#lap_keuangan_2thn_terakhir').html("Ada");
            } else if (data.lap_keuangan_2thn_terakhir == "2") {
                $('#lap_keuangan_2thn_terakhir').html("Tidak Ada");
            } else {
                $('#lap_keuangan_2thn_terakhir').html("Ada Dengan Catatan");

            }

            if (data.agunan == "1") {
                $('#agunan').html("Ada");
            } else if (data.agunan == "2") {
                $('#agunan').html("Tidak Ada");
            } else {
                $('#agunan').html("Ada Dengan Catatan");

            }

            if (data.dokumen_pendukung_lain == "1") {
                $('#dokumen_pendukung_lain').html("Ada");
            } else if (data.dokumen_pendukung_lain == "2") {
                $('#dokumen_pendukung_lain').html("Tidak Ada");
            } else {
                $('#dokumen_pendukung_lain').html("Ada Dengan Catatan");

            }

            if (data.mampu_memenuhi_tagihan == "1") {
                $('#mampu_memenuhi_tagihan').html("Ada");
            } else if (data.mampu_memenuhi_tagihan == "2") {
                $('#mampu_memenuhi_tagihan').html("Tidak Ada");
            } else {
                $('#mampu_memenuhi_tagihan').html("Ada Dengan Catatan");

            }

            if (data.cukup_agunan == "1") {
                $('#cukup_agunan').html("Ada");
            } else if (data.cukup_agunan == "2") {
                $('#cukup_agunan').html("Tidak Ada");
            } else {
                $('#cukup_agunan').html("Ada Dengan Catatan");

            }

            if (data.pembiayaan_wajar == "1") {
                $('#pembiayaan_wajar').html("Ada");
            } else if (data.pembiayaan_wajar == "2") {
                $('#pembiayaan_wajar').html("Tidak Ada");
            } else {
                $('#pembiayaan_wajar').html("Ada Dengan Catatan");

            }

            $('#nama_daerah').html(data.nama_daerah);
            $('#jenis_guna').val(data.jenis_guna);
            $('.jenis_guna').html(data.jenis_guna);
            $('#jenis_kredit').val(data.jenis_kredit);
            $('.jenis_kredit').html(data.jenis_kredit);
            $('#lm_usaha').html(data.lm_usaha + ' Tahun');




        }
    });

    // this example uses the id selector & no options passed    
    jQuery(function($) {
        $('#nominal').autoNumeric('init', {
            alwaysAllowDecimalCharacter : false
        });
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

                <th class="center" width="50">Nasabah Setuju</th>
                <th class="center" width="60">Nominal (Rp.)</th>
                <th class="center" width="20">Status</th>
                <th class="center" width="40">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
		$username = $this->session->userdata('username');
		$data = $this->model_data->data_pk("supervisi",$username);									
		$i=1;
		foreach($data->result() as $dt){ ?>
            <tr>
                <td class="center span1"><?php echo $i++?></td>
                <td><?php echo substr($dt->nama_prospek,0,25);?></td>


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
							echo "Dikembalikan";
							}else{						
								echo "Blm Diajukan";	
						}
					}
					
				};?>
                </td>

                <td class="td-actions">
                    <center>
                        <div class="hidden-phone visible-desktop action-buttons">
                            <?php if($dt->status_data==2){ 
				
                    }else{ ?>

                            <a class="green" href="#modal-table"
                                onclick="javascript:editData('<?php echo $dt->id_pk;?>')" data-toggle="modal">
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
                <form class="form-horizontal" name="my-form" id="my-form">


                    <input type="hidden" name="kode" id="kode" />
                    <input type="hidden" name="id_prospek" id="id_prospek" />
                    <input type="hidden" name="id_user_pic" id="id_user_pic" />

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
                                    <p class="nik"></p>
                                </li>
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospek"></p>
                                </li>
                                <li>
                                    <strong>Status Prospek</strong>
                                    <p id="kode_status"></p>
                                </li>
                                <li>
                                    <strong>Bidang Usaha</strong>
                                    <p id="kd_bidang_usaha"></p>
                                </li>

                                <li>
                                    <strong>Email</strong>
                                    <p id="email"></p>
                                </li>
                                <li>
                                    <strong>Telp</strong>
                                    <p id="telp"></p>
                                </li>
                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">

                                <li>
                                    <strong>Handphone</strong>
                                    <p id="hp"></p>
                                </li>
                                <li>
                                    <strong>Alamat Prospek</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Provinsi</strong>
                                    <p id="provinsi"></p>
                                </li>
                                <li>
                                    <strong>Kabupaten/Kota</strong>
                                    <p id="kab_kota"></p>
                                </li>
                                <!-- <li>
                                    <strong>Kecamatan</strong>
                                    <p id="kecamatan"></p>
                                </li> -->


                            </ul>

                        </div>


                    </div>
                    <div id="tab-2" class="tabs border-r border-l border-b rounded p-4 ">

                        <div style="display : flex; justify-content: space-between;">
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Nomor Identitas</strong>
                                    <p class="nik"></p>
                                </li>
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospek"></p>
                                </li>
                                <li>
                                    <strong>Alamat Prospek</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Lama Usaha (Thn)</strong>
                                    <p id="lm_usaha"></p>
                                </li>
                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Target Tanggal Booking</strong>
                                    <p id="target_tgl_booking"></p>
                                </li>
                                <li>
                                    <strong>BI Checking</strong>
                                    <p id="bi_checking"></p>
                                </li>
                                <li>
                                    <strong>SIUP</strong>
                                    <p id="siup"></p>
                                </li>
                                <li>
                                    <strong>Nominal</strong>
                                    <p class="nominal_"></p>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div id="tab-3" class="tabs border-r border-l border-b rounded p-4 ">

                        <div style="display : flex; justify-content: space-between;">
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <!-- <li>
                                    <strong>Nomor Identitas</strong>
                                    <p class="nik"></p>
                                </li> -->
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospek"></p>
                                </li>
                                <li>
                                    <strong>Alamat Prospek</strong>
                                    <p class="alamat_p"></p>
                                </li>
                                <li>
                                    <strong>Surat Permohonan</strong>
                                    <p id="surat_permohonan"></p>
                                </li>
                                <li>
                                    <strong>Laporan Keuangan 2tahun terakhir</strong>
                                    <p id="lap_keuangan_2thn_terakhir"></p>
                                </li>
                            </ul>
                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Agunan</strong>
                                    <p id="agunan"></p>
                                </li>
                                <li>
                                    <strong>Dokumen Pendukung</strong>
                                    <p id="dokumen_pendukung_lain"></p>
                                </li>
                                <li>
                                    <strong>Lokasi Proyek</strong>
                                    <p id="nama_daerah"></p>
                                </li>
                                <li>
                                    <strong>Nominal</strong>
                                    <p class="nominal_"></p>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div id="tab-4" class="tabs border-r border-l border-b rounded p-4 ">

                        <div style="display : flex; justify-content: space-between;">

                            <ul class="unstyled" style="text-transform : uppercase;">
                                <li>
                                    <strong>Nama Prospek</strong>
                                    <p class="namaprospek"></p>
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
                                    <p id="mampu_memenuhi_tagihan"></p>
                                </li>
                                <li>
                                    <strong>Cukup anggunan</strong>
                                    <p id="cukup_agunan"></p>
                                </li>
                                <li>
                                    <strong>Pembiayaan Wajar</strong>
                                    <p id="pembiayaan_wajar"></p>
                                </li>
                                <li>
                                    <strong>Nominal</strong>
                                    <p class="nominal_"></p>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div id="tab-5" class="tabs border-r border-l border-b rounded p-4 active">

                        <!-- <input type="hidden" name="kode" id="kode" />
                        <input type="hidden" name="id_prospek" id="id_prospek" /> -->

                        <span id="loading"></span>

                     

                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Nik Debitur</label>

                            <div class="controls">
                            <input type="text" name="nikval" id="nikval">
                                 <!-- <button type="button" id="cekcifnomorrekening" class="btn btn-small btn-info">Cari</button> -->
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Masukan Nomor Rekening</label>

                            <div class="controls">
                                <input type="number" name="nomor_rekening" id="nomor_rekening" placeholder="Nomor Rekening"
                                 />
                                 <button type="button" id="cekcifnomorrekening" class="btn btn-small btn-info">Cari</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Permohonan Baru/Topup</label>
                            <div class="controls">
                                <select readonly="true" name="permohonanbaru_topup" id="permohonanbaru_topup" class="span5">
                                    <option value="" >Pilih</option>
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
                                <input type="text" name="baki_debet_lama" value="0" id="baki_debet_lama" placeholder="Baki Debet Lama" readonly="true"  class="ratakanan" 
                                 />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Realisasi Real</label>

                            <div class="controls">
                               
                                <input type="hidden" name="plafond" value="0" id="plafond" placeholder="Realisasi Real" readonly="true"
                                 />
                                <input type="text" name="sisa_baki_debet" value="0" id="sisa_baki_debet" placeholder="Realisasi Real" readonly="true"  class="ratakanan" 
                                 />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Tanggal Release</label>

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
                            <label class="control-label" for="form-field-1">Komite Setuju</label>
                            <div class="controls">
                                <select  name="komite_setuju" id="komite_setuju" class="span5">
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


                        <!-- <div class="control-group">
                            <label class="control-label" for="form-field-1">Penajuan Plafond (Rp.)</label>
                            <div class="controls">
                                <input type="text" name="nominal" id="nominal" placeholder="Penajuan Plafond" readonly="true"
                                    class="ratakanan" />
                            </div>
                        </div> -->

                        <div class="control-group">
                            <label class="control-label" for="form-field-1">Status Approval</label>
                            <div class="controls">
                                <select name="stsapprove" id="stsapprove" class="span5">
                                    <option value="1" selected>Approve</option>
                                    <option value="2">Kembalikan</option>
                                    <option value="3">Tolak</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group kembalike" style="display:none;">
                            <label class="control-label" for="form-field-1">Dikembalikan Ke?</label>
                            <div class="controls">
                                <select name="statuspengembalian" id="statuspengembalian" class="span5">
                                    <option value="1">Prospek</option>
                                    <option value="2">Target</option>
                                    <option value="3">Data Coll</option>
                                    <option value="4">Analisa</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group catatan_pengembalian" style="display:none;">
                            <label class="control-label" for="form-field-1">Catatan Pengembalian</label>

                            <div class="controls">
                                <input type="text" name="alasan_kembali" id="alasan_kembali" placeholder="Catatan" />
                            </div>
                        </div>
                        <!-- <div id="form-tambahan-pengembalian" style="display :none;">
                            <div class="control-group">
                                <label class="control-label" for="form-field-1">Dikembalikan Ke?</label>
                                <div class="controls">
                                    <select name="statuspengembalian" id="statuspengembalian" class="span5">
                                        <option value="">Prospek</option>
                                        <option value="2">Target</option>
                                        <option value="3">Data Coll</option>
                                        <option value="4">Analisa</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="form-field-1">Catatan Pengembalian</label>

                                <div class="controls">
                                    <input type="text" name="alasan_kembali" id="alasan_kembali"
                                        placeholder="Catatan" />
                                </div>
                            </div>
                        </div> -->


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
            <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left spbtn">
                <i class="icon-save"></i>
                <span class="text-sts">Approve</span>
            </button>
            <!-- <button type="button" class="btn btn-small btn-danger pull-left" name="kembalikan" id="kembalikan">
                <i class="icon-remove"></i>
                Kembalikan
            </button>
            <button type="button" class="btn btn-small btn-danger pull-left" name="tolak" id="tolak">
                <i class="icon-remove"></i>
                Tolak
            </button> -->
        </div>
    </div>
</div>