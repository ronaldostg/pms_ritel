<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
        <div class="widget-toolbar no-border pull-right">
            <a href="#modaluploadmaster" v-if="uploadProses === false" class="btn btn-small btn-info" role="button"
                data-toggle="modal" name="tambah" id="tambah">
                <i class="icon-document"></i>
                Upload Debitur
            </a>
            <button class="btn btn-small btn-info" v-else disabled>Upload Debitur</button>
            <!-- <a href="#modalupdatenorekpinjaman" v-if="uploadProses == false" class="btn btn-small btn-success" role="button"
                data-toggle="modal" name="edit" id="edit">
                <i class="icon-document"></i>
                Edit Rekening Pinjaman
            </a>
            <button class="btn btn-small btn-success" v-else disabled>Edit Rekening Pinjaman</button> -->
            <a href="<?=base_url('assets/file/Template PMS Ritel.xlsx')?>" class="btn" download>Downloand Template Excel</a>
        </div>

    </div>

    <div class="alert alert-info" v-if="uploadProses === true" style="margin-top: 30px;">
        Loading upload data .....
    </div>

    <div class="alert alert-info" v-if="showMsg === true" style="margin-top: 20px;">
        <div>
            <h6>Informasi :</h6>
            <ul>
                <li v-show="countSukses > 0"> {{ msgSukses }}</li>
                <li v-show="countError > 0"> <span v-html="msgError"></span></li>
            </ul>
        </div>
    </div>
    <!-- <div style="margin-top : 20px;">
        <p>Filter Berdasarkan Wilayah :</p>
        <div class="form-inline">
            <select class="span3" @change="getKabupaten($event)" v-model="provinsi">
                <option value="">Pilih wilayah</option>
                <option v-for="value in dtProvinsi" :value="value.wilayah">{{value.wilayah}}</option>
            </select>
            <select v-if="dtKabupaten != ''" class="span3" @change="getKecamatan($event)" v-model="kabupaten">
                <option value="">Pilih Kabupaten</option>
                <option v-for="value in dtKabupaten" :value="value.wilayah">{{value.wilayah}}</option>
            </select>
            <select v-else disabled class="span3">
                <option>Pilih kabupaten</option>
            </select>
            <select v-if="dtKecamatan != ''" class="span3" v-model="kecamatan">
                <option value="">Pilih Kecamatan</option>
                <option v-for="value in dtKecamatan" :value="value.wilayah">{{value.wilayah}}</option>
            </select>
            <select v-else disabled class="span3">
                <option>Pilih Kecamatan</option>
            </select>
            <button class="btn btn-mini btn-primary" v-if="provinsi != '' && kabupaten != '' && kecamatan != ''"
                @click="getData( provinsi , kabupaten , kecamatan )">View data</button>
            <button class="btn btn-mini btn-primary" v-else disabled>View data</button>
        </div>
    </div>

    <div style="margin-top: 20px;">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">No</th>
                    <th class="center">NIK</th>
                    <th class="center">Nama Debitur</th>
                    <th class="center">Kode Wilayah</th>
                    <th class="center">Kode Kabupaten</th>
                    <th class="center">Kode Kecamatan</th>
                </tr>
            </thead>
            <tbody v-if="datas != 0">
                <tr v-for="(data, index) in datas" :key="index">
                    <td>{{ index+ 1 }}</td>
                    <td style="text-transform  : uppercase;">{{ data.nik_debitur }}</td>
                    <td style="text-transform  : uppercase;">{{ data.nama_debitur }}</td>
                    <td style="text-transform  : uppercase;">{{ data.provinsi }}</td>
                    <td style="text-transform  : uppercase;">{{ data.kab_kota }}</td>
                    <td style="text-transform  : uppercase;">{{ data.kecamatan }}</td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr colspan="6">
                    <td>Data tidak ditemukan silahkan pilih wilayah</td>
                </tr>
            </tbody>
        </table>

    </div>

</div> -->

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
<div id="modalupdatenorekpinjaman" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Edit nomor rekening pinjaman
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
                        <input type="file" id="filexl2" ref="file2" />
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
            <button @click="editmaster" class="btn btn-small btn-success pull-left">
                <i class="icon-save"></i>
                Upload
            </button>
        </div>
    </div>
    </form>
</div>