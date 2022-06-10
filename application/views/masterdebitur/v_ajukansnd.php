<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>

    </div>
    <form action="<?=base_url()?>index.php/ajukansupervisisnd/ajukan" method="post">

    <div style="margin-top : 20px;">
        <p>Filter Berdasarkan Wilayah :</p>
        <div class="form-inline form-flex">
            <div>
                <select @change="getKabupaten($event)" v-model="provinsi">
                    <option value="">Pilih wilayah</option>
                    <option v-for="value in dtProvinsi" :value="value.wilayah">{{value.wilayah}}</option>
                </select>
            </div>
            <!-- <div class="select-two">
                <input type="text" v-if="dtKabupaten != ''" v-on:keyup="cariSelect" :value="kabupaten" placeholder="Cari kabupaten">
                <input type="text" v-else disabled placeholder="Cari kabupaten">
                <ul class="select-value" id="kabselect">
                    <li v-for="value in dtKabupaten" @click="setValue( 'kabupaten' , value.wilayah )">{{ value.wilayah }}</li>
                </ul>
            </div> -->
            <div>
                <select name="kabupaten" v-if="dtKabupaten != ''" @change="getKecamatan($event)" v-model="kabupaten">
                    <option value="">Pilih Kabupaten</option>
                    <option v-for="value in dtKabupaten" :value="value.wilayah">{{value.wilayah}}</option>
                </select>
                <select v-else disabled>
                    <option>Pilih kabupaten</option>
                </select>
            </div>
            <div>
                <button type="button" class="btn btn-mini btn-primary" v-if="provinsi != '' && kabupaten != ''"
                    @click="getData()">View data</button>
                <button class="btn btn-mini btn-primary" v-else disabled>View data</button>
            </div>

            <div v-if="datas != 0">
                <button type="submit" class="btn btn-mini btn-success"><i class="fa fa-edit"></i> Sebarkan ke unit kantor</button>
            </div>
        </div>
    </div>


    <div style="margin-top : 20px; display : flex; flex; justify-content: space-between; align-items: center;" >

        <div>
            <input type="text" placeholder="Ketik nik/nama debitur" @keyup="searchData" v-model="text_cari">
        </div>

        <div style="margin-bottom: 10px; display: flex; align-items: center;"  v-if="datas != 0">

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

    <div class="alert alert-info" v-if="loading === true" style="margin-top: 30px;">
        Loading .....
    </div>

    <div style="margin-top: 20px;">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">No</th>
                        <th class="center">NIK</th>
                        <th class="center">Nama Debitur</th>
                        <th class="center">No. Handphone</th>
                        <th class="center">Nama Cabang</th>
                        <th class="center">Gaji</th>
                        <th class="center">Angsuran Kredit</th>
                        <th class="center">#</th>
                    </tr>
                </thead>
                <tbody v-if="datas != 0">
                    <tr v-for="(data, index) in datas" :key="index">
                        <td>{{ index+ 1 + offset }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nik_debitur }}</td>
                        <td style="text-transform  : uppercase;">{{ data.nama_debitur }}</td>
                        <td style="text-transform  : uppercase; text-align: center;">
                            <span v-if="data.no_handphone != '0'">
                                {{ data.no_handphone }}
                            </span>
                            <span v-else>-</span>
                        </td>
                        <td style="text-transform  : uppercase; text-align: center;">
                           {{data.nm_cabang}}
                        </td>
                        <td style="text-transform  : uppercase; text-align: right;">Rp. {{ formatPrice(data.gaji_bruto) }}</td>
                        <td style="text-transform  : uppercase; text-align: right;"> 
                            <span v-if="data.angsuran_kredit">
                               <span v-if="data.angsuran_kredit != '0'">
                                    Rp. {{ formatPrice(data.angsuran_kredit) }}
                               </span>
                               <span v-else>-</span>
                            </span>    
                            <span v-else>-</span>
                            <input type="hidden" name="iddata[]" :value="data.id">
                        </td>
                        <td>
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

<!-- MODAL -->

<div id="modaluploadmaster" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Upload User
        </div>
    </div>



    <div class="modal-body no-padding">
        <div class="row-fluid">

            <div class="form-horizontal">
                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>

                <input type="hidden" name="kode" id="kode" />
                <input type="hidden" name="status_data" id="status_data" />

                <div class="control-group">
                    <label class="control-label" for="form-field-1">File Excell</label>
                    <div class="controls">
                        <input type="file" id="filexl" ref="file" />
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
            <button @click="uploadimage" class="btn btn-small btn-success pull-left">
                <i class="icon-save"></i>
                Upload
            </button>
        </div>
    </div>
    </form>
</div>