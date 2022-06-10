<script type="text/javascript">
function simpan_nilai(id){
	var nilai = $("#nilai_"+id).val();
	//alert(nilai);
	var string = "id="+id+"&nilai="+nilai;
	
	//alert(string);
	$.ajax({
		type	: 'POST',
		url		: "<?php echo site_url(); ?>/site_dosen/isi_nilai/simpan_nilai",
		data	: string,
		cache	: false,
		success	: function(data){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: data,
				class_name: 'gritter-info' 
			});
		}
	});
		
}
</script>
<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">NIM</th>
            <th class="center">Nama</th>
            <th class="center">L/P</th>
            <th class="center">Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$data_mhs = $this->model_data->cari_data_mhs_lengkap($dt->nim);
			$nama = $data_mhs['nama'];
			$sex = $data_mhs['sex'];
			$nilai = $dt->nilai_akhir;
		?>
        <tr>
        	<td class="center span1"><?php echo $i;?></td>
            <td ><?php echo $dt->nim;?>
           	<input type="hidden" name="nim_<?php echo $i;?>" id="nim_<?php echo $i;?>" value="<?php echo $dt->nim;?>" /> 
            </td>
            <td ><?php echo $nama;?></td>
            <td class="center"><?php echo $sex;?></td>
            <td class="center span2">
            <select name="nilai_<?php echo $dt->id_krs;?>" id="nilai_<?php echo $dt->id_krs;?>" class="span1" onchange="simpan_nilai('<?php echo $dt->id_krs;?>')">
            <?php
			if(empty($nilai)){
			?>
            	<option value="" selected="selected">-</option>
            <?php } 
			$data = $this->model_data->nilai();
			foreach($data as $dt){
				if($dt==$nilai){
			?>
            	<option value="<?php echo $dt;?>" selected="selected"><?php echo $dt;?></option>
            <?php }else{ ?>
            	<option value="<?php echo $dt;?>"><?php echo $dt;?></option>
            <?php } 
			}?>
            </select>
			
            </td>
        </tr>
		<?php 
		$i++;
		} ?>
    </tbody>
    <input type="hidden" name="jml_data" id="jml_data" value="<?php echo $i-1;?>" />
</table>
