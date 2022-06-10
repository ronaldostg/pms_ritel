<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>

    </div>
    <?php 
        if($this->session->userdata('level') != 'supervisi'){
    ?>

 <form action="<?=base_url()?>index.php/supervisiapprove/cetakexcel" method="post">
    <div style="margin-top : 20px;">
        <p>Filter Berdasarkan Wilayah :</p>
        <div class="form-inline form-flex">
            <div>
                <select @change="getKabupaten($event)" v-model="provinsi">
                    <option value="">Pilih wilayah</option>
                    <option v-for="value in dtProvinsi" :value="value.wilayah">{{value.wilayah}}</option>
                </select>
            </div>
            <div>
                <select v-if="dtKabupaten != ''" @change="getKecamatan($event)" v-model="kabupaten" name="kabupaten">
                    <option value="">Pilih Kabupaten</option>
                    <option v-for="value in dtKabupaten" :value="value.wilayah">{{value.wilayah}}</option>
                </select>
                <select v-else disabled>
                    <option>Pilih kabupaten</option>
                </select>
            </div>
            <!-- <div>
                <select v-if="dtKecamatan != ''" v-model="kecamatan" @change="getKelurahan($event)">
                    <option value="">Pilih Kecamatan</option>
                    <option v-for="value in dtKecamatan" :value="value.wilayah">{{value.wilayah}}</option>
                </select>
                <select v-else disabled>
                    <option>Pilih Kecamatan</option>
                </select>
            </div>
            <div>
                <select v-if="dtKelurahan != ''" v-model="kelurahan">
                    <option value="">Pilih kelurahan</option>
                    <option v-for="value in dtKelurahan" :value="value.kode_wilayah">{{value.wilayah}}</option>
                </select>
                <select v-else disabled>
                    <option>Pilih Kelurahan</option>
                </select>
            </div> -->
            <div>
                <button type="button" class="btn btn-mini btn-primary" v-if="provinsi != '' && kabupaten != ''"
                    @click="getData()">View data</button>
                <button class="btn btn-mini btn-primary" v-else disabled>View data</button>
            </div>
        </div>
    </div>
    <?php }?>

    <?php 
        if(!empty($this->session->flashdata('msg'))){
    ?>
    <div class="alert alert-info" style="margin-top: 20px;">
        <?=$this->session->flashdata('msg')?>
    </div>
    <?php }?>


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

                <div style="margin-left: 10px;">
                    <button type="submit" name="cetak_excel" id="cetak_excel" class="btn btn-success">
                            <i class="icon-print" disabled="true"></i> Downloand EXCEL
                    </button>
                </div>
                </form>

        </div>

    </div>

    <div class="alert alert-info" v-if="loading === true" style="margin-top: 30px;">
        Loading .....
    </div>

    <?php 
     $username = $this->session->userdata('username');
    ?>
    <div style="margin-top: 20px;">
        <form action="<?=base_url()?>masterdebitur/updatetmasterdebitur" method="post">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">No</th>
                        <th class="center">NIK</th>
                        <th class="center">Nama Debitur</th>
                        <th class="center">Nama Instansi</th>
                        <th class="center">No. Handphone</th>
                        <th class="center">Gaji</th>
                        <th class="center">Angsuran Kredit</th>
                        <th class="center">Rekening Pinjaman</th>
                        <th class="center">#</th>
                    </tr>
                </thead>
                <tbody v-if="datas != 0">
                    <tr v-for="(data, index) in datas" :key="index">
                        <td>{{ index+ 1 + offset }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nik_debitur }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nama_debitur }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nama_instansi }}</td>
                        <td style="text-transform  : uppercase; text-align: center;">
                            <span v-if="data.no_handphone != '0'">
                                {{ data.no_handphone }}
                            </span>
                            <span v-else>-</span>
                        </td>
                        <td style="text-transform  : uppercase; text-align: right;">Rp.
                            {{ formatPrice(data.gaji_bruto) }}</td>
                        <td style="text-transform  : uppercase; text-align: right;">
                            <span v-if="data.angsuran_kredit">
                                <span v-if="data.angsuran_kredit != '0'">
                                    Rp. {{ formatPrice(data.angsuran_kredit) }}
                                </span>
                                <span v-else>-</span>
                            </span>
                            <span v-else>-</span>
                           
                        </td>
                        <td style="text-transform  : uppercase; text-align: right;">
                            <p>{{ data.no_rekening_pinjaman }}</p>
                        </td>
                        <td style="text-align: center;">
                            <a href="#lihat" class="btn btn-small btn-info" @click="showModal(data.id)" role="button"
                                data-toggle="modal">Lihat</a>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr v-if="loading == false">
                        <td colspan="6">
                            <p>Data tidak ditemukan</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- <?php 
                if($username == 'u1498'){
            ?>
                <div v-if="datas != 0">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            <?php }?> -->
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
                        <li>
                            <strong>Nomor Rekening</strong>
                            <p v-if="detail.nomor_rekening || detail.nomor_rekening == 0">{{ detail.nomor_rekening }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Nama Instansi</strong>
                            <p v-if="detail.nama_instansi">{{ detail.nama_instansi }}</p>
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
                            <p v-if="detail.nama_bidang_usaha">{{ detail.nama_bidang_usaha }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>Email</strong>
                            <p v-if="detail.email">{{ detail.email }}</p>
                            <p v-else>-</p>
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
                            <p v-if="detail.status_prospek === '1'"> Data baru</p>
                            <p v-if="detail.status_prospek === '2'">Distribusi data diterima unit kantor</p>
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

                        <li>
                            <strong>CIF</strong>
                            <p v-if="detail.cif">{{ detail.cif }}</p>
                            <p v-else>-</p>
                        </li>
                        <li>
                            <strong>No. Rekening Pinjaman</strong>
                            <p v-if="detail.no_rekening_pinjaman">{{ detail.no_rekening_pinjaman }}</p>
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