<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-book blue"></i>
            <?php echo $judul;?>
        </h4>
    </div>

    <div class="widget-body">
    	<div class="widget-main">
        	<form action="<?php echo site_url();?>/mata_kuliah/view_data" method="post">
            <div class="control-group">
                    <label class="control-label" for="form-field-1">Pilih Jurusan</label>
                    <div class="controls">
                    <select name="cari_jurusan" id="cari_jurusan">
                        <?php
                        $data = $this->model_data->data_jurusan();
                        foreach($data->result() as $dt){
                        ?>
                        <option value="<?php echo $dt->kd_prodi;?>"><?php echo $dt->prodi;?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <button type="submit" name="lanjut" id="lanjut" class="btn btn-small btn-success" >
                    Lanjut
                    <i class="icon-arrow-right icon-on-right bigger-110"></i>
                    </button>
			</div>                    
            </form>
        </div>
    </div>
</div>    