<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
    </div>
    <form action="<?=base_url()?>index.php/delegasidebitur/delegasiall" method="post">
        <div style="margin-top : 20px;">
            <!-- <p>Pilih instansi :</p> -->
            <div class="form-inline form-flex">
                <!-- <div>
                    
                    <select name="nama_instansi" v-model="nama_instansi" <?php if(empty($instansi)){ echo "disabled"; } else { echo ""; }?>>
                        <option value="">--- Pilih instansi ---</option>
                        <?php 
                        foreach($instansi as $rinstansi){
                    ?>
                        <option value="<?=$rinstansi->nama_instansi?>"><?=$rinstansi->nama_instansi?></option>
                        <?php }?>
                    </select>
                </div>
                <?php 
                    if(!empty($instansi)){
                ?>
                    <div>
                        <button type="button" class="btn btn-mini btn-primary" @click="getData()">View data</button>
                    </div>
                <?php }?> -->


            </div>
        </div>

        <div style="margin-top : 20px; display : flex; flex; justify-content: space-between; align-items: center;">

            <div>
                <input type="text" placeholder="Ketik nik/nama debitur" @keyup="searchData" v-model="text_cari">
            </div>

            <div style="margin-bottom: 10px; display: flex; align-items: center;" v-if="datas != 0">

                <div class="display: flex; align-items: center;">
                    <p>Halaman {{ currentPage }} dari {{ pageNumber }} halaman</p>
                </div>

                <div style="display: flex; align-items: center; margin-left : 10px;">
                    <div style="">
                        <div v-if="currentPage === 1">
                            <button type="button" class="btn btn-inverse" disabled>Back</button>
                        </div>
                        <div v-else>
                            <div v-if="currentPage > 1">
                                <button type="button" class="btn btn-inverse" @click="backPage">Back</button>
                            </div>
                            <div v-else>
                                <button type="button" class="btn btn-inverse" disabled>Back</button>
                            </div>
                        </div>
                    </div>
                    <div style="margin-left:10px; margin-right:10px;">
                        <h5>{{ currentPage }}</h5>
                    </div>
                    <div style="">

                        <div v-if="currentPage === pageNumber">
                            <button type="button" class="btn btn-primary" disabled>Next</button>
                        </div>
                        <div v-else>
                            <button type="button" class="btn btn-primary" @click="nextPage">Next</button>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="alert alert-info" v-if="isLoading === true" style="margin-top: 30px;">
            Loading .....
        </div>


        <?php 
        if(!empty($this->session->flashdata('msg'))){
    ?>
        <div class="alert alert-info" style="margin-top: 20px;">
            <?=$this->session->flashdata('msg')?>
        </div>
        <?php }?>
        <div style="margin-top: 20px;">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">No</th>
                        <th class="center">NIK</th>
                        <th class="center">Nama Debitur</th>
                        <th class="center">Nama Instansi</th>
                        <th class="center">Unit Kantor</th>
                        <th class="center">Status</th>
                        <th class="center">User AO</th>
                        <th class="center">#</th>
                    </tr>
                </thead>
                <tbody v-if="datas != 0">
                    <tr v-for="(data, index) in datas" :key="index">
                        <td>{{ index+ 1 }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nik_debitur }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nama_debitur }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nama_instansi }}</td>
                        <td style="text-transform  : uppercase;">{{  data.nm_cabang }}</td>
                        <td>
                            <p v-if="detail.status_prospek === '1'"> Data baru</p>
                            <p v-if="detail.status_prospek === '2'">Distribusi data diterima unit kantor</p>
                            <p v-if="detail.status_prospek === '3'">Approve</p>
                            <p v-if="detail.status_prospek === '4'">On Progress Prospek</p>
                            <p v-if="detail.status_prospek === '5'">Prospek Finish</p>
                            <p v-if="detail.status_prospek === '6'">Analisa Finish</p>
                            <p v-if="detail.status_prospek === '7'">Pencairan Finish</p>
                        </td>
                        <td>
                            <div v-if="data.user_petugas === '' || data.user_petugas === null"
                                style="text-align:center;">
                                <!-- <p>-</p> -->
                                <select name="userao[]">

                                    <?php 
                                    if(empty($userao)){
                                ?>
                                    <option value="">User tidak ditemukan</option>
                                    <?php }else{?>
                                    <option value="">Pilih username</option>
                                    <?php 
                                            foreach($userao as $user){    
                                        ?>
                                    <option value="<?=$user->id_user;?>"><?=$user->id_user;?> (<?=$user->nama_user;?>)
                                    </option>
                                    <?php }?>
                                    <?php }?>
                                </select>
                                <input type="hidden" name="iddata[]" :value="data.id">
                            </div>
                            <div style="text-align:center;" v-else>
                                <p>{{ data.user_petugas }}</p>
                            </div>

                        </td>
                        <td>
                            <a href="#lihat" class="btn btn-small btn-info" @click="showModal(data.id)" role="button"
                                data-toggle="modal">Lihat</a>
                            &nbsp;&nbsp;
                            <!-- <a href="#delegasi"
                                v-if="data.status_prospek != '4' && data.status_prospek != '5' && data.status_prospek != '6' && data.status_prospek != '7' && data.status_prospek != '8' && data.status_prospek != '9' && data.status_prospek != '10'"
                                class="btn btn-small btn-success" @click="showModal(data.id , data.kode_cabang)"
                                role="button" data-toggle="modal">Delegasi AO</a>
                            <button type="button" class="btn btn-small btn-success" disabled v-else>Delegasi AO</button> -->
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr v-if="isLoading == false">
                        <td colspan="6">Data tidak ditemukan.</td>
                    </tr>
                </tbody>
            </table>

            <?php 
                if($btndelegasi){
            ?>
                <!-- <div v-if="datas != 0">
                    <select name="userao">

                        <?php 
                                    if(empty($userao)){
                                ?>
                        <option value="">User tidak ditemukan</option>
                        <?php }else{?>
                        <option value="">Pilih username</option>
                        <?php 
                                            foreach($userao as $user){    
                                        ?>
                        <option value="<?=$user->id_user;?>"><?=$user->id_user;?> (<?=$user->nama_user;?>)
                        </option>
                        <?php }?>
                        <?php }?>
                    </select>
                </div> -->
                <div v-if="datas != 0">
                    <button type="submit" class="btn btn-success">Delegasi ke Account Officer</button>
                </div>
            <?php }?>


    </form>
</div>

</div>

<!-- Lihat data -->
<div id="lihat" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Detail data debitur
        </div>
    </div>

    <form method="post" action="<?=base_url()?>delegasidebitur/updateuserao">

        <div class="modal-body">
            <input type="hidden" name="id_master" :value="detail.id">
            <div class="row">
                <div class="span2">
                    <ul class="unstyled" style="text-transform : uppercase;">
                        <li>
                            <strong>Nama Debitur</strong>
                            <p>{{detail.nama_debitur}}</p>
                        </li>
                        <li>
                            <strong>Jenis Debitur</strong>
                            <p>{{detail.jenis_debitur}}</p>
                        </li>
                        <li>
                            <strong>Alamat</strong>
                            <p>{{detail.alamat}}</p>
                        </li>
                        <li>
                            <strong>Gaji Bruto</strong>
                            <p>Rp. {{formatPrice(detail.gaji_bruto)}}</p>
                        </li>
                        <li>
                            <strong>Jenis Kredit</strong>
                            <p>{{detail.jenis_kredit}}</p>
                        </li>
                        <li>
                            <strong>Nomor Telephone</strong>
                            <p v-if="detail.no_telepon">{{ detail.no_telepon }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Provinsi</strong>
                            <p v-if="detail.provinsi">{{ detail.provinsi }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Kabupaten</strong>
                            <p v-if="detail.kab_kota">{{ detail.kab_kota }}</p>
                            <p v-else>-</p>
                        </li>

                    </ul>
                </div>
                <div class="span2">
                    <ul class="unstyled" style="text-transform : uppercase;">
                        <li>
                            <strong>NIK</strong>
                            <p>{{detail.nik_debitur}}</p>
                        </li>
                        <li>
                            <strong>Bidang Usaha</strong>
                            <p>{{detail.nama_bidang_usaha}}</p>
                        </li>
                        <li>
                            <strong>Email</strong>
                            <p>{{detail.email}}</p>
                        </li>
                        <li>
                            <strong>Nomor Handphone</strong>
                            <p v-if="detail.no_handphone">{{ detail.no_handphone }}</p>
                            <p v-else>-</p>
                        </li>

                        <li>
                            <strong>Unit Kantor</strong>
                            <p v-if="detail.nm_cabang">{{ detail.nm_cabang }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Tanggal Update</strong>
                            <p v-if="detail.tanggal_update">{{ detail.tanggal_update }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Status</strong>
                            <p v-if="detail.status_prospek === '1'"> blm diajukan</p>
                            <p v-if="detail.status_prospek === '2'">Waiting Supervisi</p>
                            <p v-if="detail.status_prospek === '3'">Approve</p>
                            <p v-if="detail.status_prospek === '4'">On Progress Prospek</p>
                            <p v-if="detail.status_prospek === '5'">Prospek Finish</p>
                            <p v-if="detail.status_prospek === '6'">Analisa Finish</p>
                            <p v-if="detail.status_prospek === '7'">Pencairan Finish</p>
                        </li>
                        <li>
                            <strong>Dinput Oleh</strong>
                            <p v-if="detail.user_snd">{{ detail.user_snd }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Tanggal Input</strong>
                            <p v-if="detail.tanggal_input">{{ detail.tanggal_input }}</p>
                            <p v-else>-</p>
                        </li>

                    </ul>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <div class="pagination pull-right no-margin">
                <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
                    <i class="icon-remove"></i>
                    Close
                </button>
                <!-- <button type="submit" class="btn btn-small btn-primary pull-left">
                    Update
                </button> -->
            </div>
        </div>
    </form>
</div>
<!-- Lihat data -->
<div id="delegasi" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Apakah anda yakin ingin delegasi data debitur ini?
        </div>
    </div>



    <div class="modal-body">

        <ul class="unstyled" style="text-transform : uppercase;">
            <li>
                <strong>Nama Debitur</strong>
                <p>{{detail.nama_debitur}}</p>
            </li>
            <li>
                <strong>Jenis Debitur</strong>
                <p>{{detail.jenis_debitur}}</p>
            </li>
            <li>
                <strong>Bidang Usaha</strong>
                <p>{{detail.nama_bidang_usaha}}</p>
            </li>
            <li>
                <strong>Unit Kantor</strong>
                <p>{{detail.nm_cabang}}</p>
            </li>
            <!-- <li>
                <strong>Pilih User AO</strong>
                <br />
                <p>{{ detail. }}</p>
            </li> -->
        </ul>

    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
            <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
                <i class="icon-remove"></i>
                Close
            </button>
            <button @click="delegasiuser( detail.id )" v-if="aouser != ''" class="btn btn-small btn-success pull-left">
                <i class="icon-save"></i>
                Simpan
            </button>
            <button v-else class="btn btn-small btn-success pull-left" disabled>Simpan</button>
        </div>
    </div>
</div>