<script type="text/javascript">

		


	$(document).ready(function() {

		
		//	$("#kode").keyup(function(e){
		//		var isi = $(e.target).val();
		//		$(e.target).val(isi.toUpperCase());	
		//	});
		$("#nama_prospek").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
		});
		$("#alamat").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
		});
		$("#telp").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
		});

		$("#simpan").click(function() {
			//var kode	= $("#kode").val();
			var nama_prospek = $("#nama_prospek").val();
			var nominal = $("#nominal").val();
			var alamat = $("#alamat").val();

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

			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/index.php/prospek/simpan",
				data: string,
				cache: false,
				success: function(data) {
					alert(data);
					location.reload();
				}
			});

		});

		$('#simpan_user').click(function(e) {
			e.preventDefault();

			var form = $('#form_upload_excel_all')[0];
			// var formData = new FormData(form);
			// e.preventDefault(); 
			$.ajax({
				url: "<?php echo site_url(); ?>/index.php/prospek/upload",
				method: "POST",
				data: new FormData(form),
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function(data) {
					alert('berhasil upload');
					// do_upload_excel_all(data.data.datas)
					// alert(data.data.data);
					// alert("Upload Image Berhasil."); //alert jika upload berhasil
				}
			});
		});
		$("#tambah").click(function() {
			$('#kode').val('');
			$('#kode').attr("readonly", false);
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

		// $("#detailPengajuan").on('show.bs.modal', function() {
			
		// 	console.log('bisa')
		// 	var id = $(this).data('id');
			
		// 	console.log(id);

		// 	// $('.data-modal').html('loading');

		// 	$.ajax({
		// 		type: "GET",
		// 		url: "http://127.0.0.1:8000/api/data-tpakd/10",

		// 		dataType: "json",
		// 		success: function(data) {
		// 			//alert(data.ref);
		// 			// console.log(data);

		// 		}
		// 	});
		// });


		




	});

	function detailKur(id){
		

		$.ajax({
				type: "GET",
				url: "http://127.0.0.1:8000/api/data-tpakd/"+id,

				dataType: "json",
				success: function(data) {

					

					
					//alert(data.ref);
					items=data.data;
					$('#nama').html(items.nama?items.nama:"(Tidak Ada)");
					$('#noNIK').html(items.noNIK?items.noNIK:"(Tidak Ada)");
					$('#email').html(items.email?items.email:"(Tidak Ada)");
					$('#notelp1').html(items.notelp1?items.notelp1:"(Tidak Ada)");
					$('#notelp2').html(items.notelp2?items.notelp2:"(Tidak Ada)");
					$("#fotoKTP").attr("src", "data:image/jpg;base64," + items.fotoKTP);
					$('#jenisKelamin').html( items.jenisKelamin?items.jenisKelamin:"(Tidak Ada)");
					$('#tgl_lahir').html(items.tgl_lahir?items.tgl_lahir:"(Tidak Ada)");
					$('#usahaKabupaten').html(items.usahaKabupaten?items.usahaKabupaten:"(Tidak Ada)");
					$('#usahaKecamatan').html(items.usahaKecamatan?items.usahaKecamatan:"(Tidak Ada)");
					$('#usahaDesaKel').html(items.usahaDesaKel?items.usahaDesaKel:"(Tidak Ada)");
					$('#detailAlamat').html(items.detailAlamat?items.detailAlamat:"(Tidak Ada)");
					$('#jlhPengajuan').html(items.jlhPengajuan ? "Rp. "+items.jlhPengajuan :"(Tidak Ada)");
					$('#jangkaWaktu').html(items.jangkaWaktu?items.jangkaWaktu:"(Tidak Ada)");
					$('#jnsUsaha').html(items.jnsUsaha?items.jnsUsaha:"(Tidak Ada)");
					$('#ketIzinUsaha').html(items.ketIzinUsaha?items.ketIzinUsaha:"(Tidak Ada)");
					$('#npwp').html(items.npwp?items.npwp:"(Tidak Ada)");
					$('#fotoTempatUsaha').attr("src", "data:image/jpg;base64," + items.fotoTempatUsaha);


				}
			});
	}
	
	


	function editData(ID) {
		var cari = ID;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>/index.php/prospek/cari",
			data: "cari=" + cari,
			dataType: "json",
			success: function(data) {
				//alert(data.ref);
				$('#kode').val(data.kode);
				$('#kode').attr("readonly", "true");
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

<script src="<?php echo base_url(); ?>assets/autonumeric/autoNumeric.js"></script>

<style>
	.ratakanan {
		text-align: right;
	}
</style>

<div class="row-fluid">
	<div class="table-header">
		<?php echo $judul;
		echo " ==> ";
		echo $nm_cabang; ?>
		<!-- <div class="widget-toolbar no-border pull-right">
			<a href="#modal-table-user" class="btn btn-small btn-info" role="button" data-toggle="modal" name="tambah" id="tambah">
				<i class="icon-document"></i>
				Upload User
			</a>
		</div> -->
	</div>

	<table class="table fpTable lcnp table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th class="center" width="5">No</th>
				<th class="center" width="80">Nama Pengaju</th>
				<th class="center" width="55">Jenis Kelamin</th>
				<th class="center" width="35">Tanggal</th>
				<th class="center" width="35">No.Telepon</th>
				<th class="center" width="35">Jumlah Pengajuan (Rp.)</th>
				<th class="center" width="10">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//		$data = $this->model_data->data_prospek();
			$username = $this->session->userdata('username');
			$data = $this->model_data->dataPengajuTpkad("admin", $username);
			$i = 1;

			// echo json_encode($data->data);

			?>
			<?php
			$no = 1;
			if(!empty($data)){

			
				foreach ($data->data as $index => $dt) {
				?>
					<tr>
						<td class="center"><?php echo $no++ ?></td>
						<td class="center"><?php echo $dt->nama ?></td>
						<td class="center"><?php echo $dt->jenisKelamin ?></td>
						<td style="text-align: right;"><?php echo $dt->created_at ?></td>
						<td class="center"><?php echo $this->model_data->decryptData($dt->notelp1) ?></td>
						<td style="text-align: right;"><?php echo $dt->jlhPengajuan ?></td>
						<td>
							<a onclick="detailKur(<?php echo $dt->id?>)" class="btn btn-primary button-detail" 
							data-toggle="modal" 
							data-target="#detailModal"
							data-id="<?php echo $dt->id;?>
							">Lihat</a>
							<!-- <a 
			href="#detailPengajuan" 
			class="btn btn-small btn-info"  
			role="button" 
			data-toggle="modal" name="detailPengajuan" id="detailPengajuan"
			
			
			>
							<i class="icon-eye-open"></i>
						</a> -->


						</td>
					</tr>
			<?php }  } ?>
		</tbody>
	</table>
</div>



<!-- <div id="modal-table-user" class="modal hide fade" tabindex="-1">
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

				<input type="hidden" name="kode" id="kode" />
				<input type="hidden" name="status_data" id="status_data" />






				<div class="control-group">
					<label class="control-label" for="form-field-1">Nama</label>
					<div class="controls">
						efew
					</div>
					<label class="control-label" for="form-field-1">Ins</label>
					<div class="controls">
						ewfdew
					</div>
					<label class="control-label" for="form-field-1">File Excell</label>
					<div class="controls">

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
			<button type="button" name="simpan_user" id="simpan_user" class="btn btn-small btn-success pull-left">
				<i class="icon-save"></i>
				Upload
			</button>




		</div>
	</div>
	</form>
</div> -->

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Detail Pengajuan</h4>
			</div>

			<div class="modal-body">

				<div class="row-fluid form-horizontal">

		 
					<div class="control-group">
					 

						<label class="control-label" for="form-field-1">Nama</label>
						<div class="controls">
							<p id="nama" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">NO. NIK</label>
						<div class="controls">
						 
							<p id="noNIK" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Foto KTP</label>
						<div class="controls">
							<img id="fotoKTP" style="padding-top:0.5em;"/>
						 
						</div>
						<label class="control-label" for="form-field-1">NPWP</label>
						<div class="controls">
							<p id="npwp" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Email</label>
						<div class="controls">
							<p id="email" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">No. Telepon 1</label>
						<div class="controls">
							<p id="notelp1" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">No. Telepon 2</label>
						<div class="controls">
							<p id="notelp2" style="padding-top:0.5em;">   </p>
						</div>
						<label class="control-label" for="form-field-1">Jenis Kelamin</label>
						<div class="controls">
							<p id="jenisKelamin" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Tanggal Lahir</label>
						<div class="controls">
							<p id="tgl_lahir" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Kabupaten</label>
						<div class="controls">
							<p id="usahaKabupaten" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Kecamatan</label>
						<div class="controls">
							<p id="usahaKecamatan" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Desa / Kelurahan</label>
						<div class="controls">
							<p id="usahaDesaKel" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Alamat</label>
						<div class="controls">
							<p id="detailAlamat" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Jumlah Pengajuan </label>
						<div class="controls">
							<p id="jlhPengajuan" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Jangka Waktu </label>
						<div class="controls">
							<p id="jangkaWaktu" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Keterangan Jenis Usaha</label>
						<div class="controls">
							<p id="ketIzinUsaha" style="padding-top:0.5em;"></p>
						 
						</div>
						<label class="control-label" for="form-field-1">Jenis Usaha </label>
						<div class="controls">
							<p id="jnsUsaha" style="padding-top:0.5em;"></p>
						</div>
						<label class="control-label" for="form-field-1">Foto Tempat Usaha</label>
						<div class="controls">
							<img id="fotoTempatUsaha" style="padding-top:0.5em;"/>
						 
						</div>
						



						

					</div>
				</div>



			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>