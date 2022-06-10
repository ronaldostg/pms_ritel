<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
        <div class="widget-toolbar no-border pull-right">
            <a href="#tambahuser" class="btn btn-small btn-info" role="button" data-toggle="modal" name="tambah"
                id="tambah">
                <i class="icon-plus"></i>
                Tambah data
            </a>
        </div>
    </div>

    <table class="table fpTable lcnp table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center" width="5">No</th>
                <th class="center" width="80">Nama</th>
                <th class="center" width="50">Username</th>
                <th class="center" width="60">Cabang</th>
                <th class="center" width="5">#</th>

            </tr>
        </thead>
        <tbody id="viewData">
            <?php 
                    $no =1;
                    foreach($items as $item){
                ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$item->nama_user?></td>
                <td><?=$item->id_user?></td>
                <td><?=$item->nm_cabang?></td>
                <td class="td-actions">
                    <center>
                        <div class="hidden-phone visible-desktop action-buttons">

                            <a class="red" href="javascript:void(0)" onclick="deletedata('<?=$item->id_user?>')">
                                <i class="icon-trash bigger-130"></i>
                            </a>
                            <a href="javascript:void(0)" class="tooltip-success" data-rel="tooltip" onclick="updatedata('<?=$item->id_user?>')" title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                            </a>
                        </div>

                        <div class="hidden-desktop visible-phone">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>
                                <ul
                                    class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="javascript:void(0)" class="tooltip-success" data-rel="tooltip" title="Edit">
                                            <span class="green">
                                                <i class="icon-edit bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="tooltip-error" data-rel="tooltip" title="Delete" onclick="deletedata(<?=$item->id_user?>)">
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
            <?php }?>
        </tbody>
    </table>
</div>


<div id="tambahuser" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Tambah user
        </div>
    </div>

    <form id="formdata" method="post">

        <div class="modal-body no-padding">
            <div class="row-fluid">

                <div class="form-horizontal">
                    <div class="control-group">
                        <div class="controls">
                        </div>
                    </div>

                    <?php 
                        $level = $this->session->userdata('level');
                        if($level != 'supervisi'){
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1" id="juduledit">Pilih cabang</label>
                        <div class="controls">
                            <select name="kode_cabang" id="kode_cabang" >
                                <option value="" selected="selected">-Pilih-</option>
                                <?php 
                                    $cabang = $this->db->query("SELECT * FROM t_cabang")->result();
                                    foreach($cabang as $row_cabang){
                                ?>
                                <?php 
                                        if($row_cabang->kd_cab != '001'){
                                    ?>
                                <option value="<?=$row_cabang->kd_cab?>"><?=$row_cabang->nm_cabang;?>
                                    (<?=$row_cabang->kd_cab?>)</option>
                                <?php }?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }else{
                          $kde_cabang = $this->session->userdata('kd_cabang');    
                    ?>
                     <div class="control-group">
                        <label class="control-label" for="form-field-1" id="juduledit">Pilih cabang</label>
                        <div class="controls">
                            <select name="kode_cabang" id="kode_cabang" readonly="true">
                               
                                <?php 

                                  

                                    $cabang = $this->db->query("SELECT * FROM t_cabang")->result();
                                    foreach($cabang as $row_cabang){

                                        
                                ?>
                                    <?php 
                                        if($row_cabang->kd_cab != '001'){
                                    ?>
                                        <option value="<?=$row_cabang->kd_cab?>" <?php if($kde_cabang == $row_cabang->kd_cab){ echo "selected='selected'"; }else{ echo ""; }?>><?=$row_cabang->nm_cabang;?> (<?=$row_cabang->kd_cab?>)</option>
                                    <?php }?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }?>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Username</label>
                        <div class="controls">
                            <input type="text" name="username" id="username" />
                            <input type="hidden" name="act" id="act" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Nama lengkap</label>
                        <div class="controls">
                            <input type="text" name="nama_lengkap" id="nama_lengkap" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1" id="juduledit">Pilih supervisi</label>
                        <div class="controls">
                            <select name="supervisi" id="supervisi">
                               
                                <?php 

                                  

                                    $admins = $this->db->query("SELECT * FROM admins where kategori_admin = '1'")->result();
                                    foreach($admins as $admin){

                                        
                                ?>
                                   
                                    <option value="<?=$admin->username?>"><?=$admin->nama_lengkap;?> (<?=$admin->username?>)</option>
                                  
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Ulangi password</label>
                        <div class="controls">
                            <input type="password" id="ulangi_password" name="ulangi_password" />
                        </div>
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
                <button type="button" id="buttonsaveuser" class="btn btn-small btn-success pull-left">
                    <i class="icon-save"></i>
                    Simpan
                </button>
            </div>
        </div>

    </form>
</div>