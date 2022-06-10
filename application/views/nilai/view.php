<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">NIM</th>
            <th class="center">Nama</th>
            <th class="center">Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
			$nama_mhs = $this->model_data->cari_nama_mhs($dt->nim);
			$nilai = $dt->nilai_akhir;
		?>
        <tr>
        	<td class="center span1"><?php echo $i;?></td>
            <td ><?php echo $dt->nim;?>
           	<input type="hidden" name="nim_<?php echo $i;?>" id="nim_<?php echo $i;?>" value="<?php echo $dt->nim;?>" /> 
            </td>
            <td ><?php echo $nama_mhs;?></td>
            <td class="center span2">
            <select name="nilai_<?php echo $i;?>" id="nilai_<?php echo $i;?>" class="span1">
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
