<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul; echo " ==> ";  echo $nm_cabang;?>
    </div>

    <div style="margin-top : 20px;">
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
    <?php 
        if(!empty($this->session->flashdata('msg'))){
    ?>
    <div class="alert alert-info" style="margin-top: 20px;">
       <?=$this->session->flashdata('msg')?>
    </div>
    <?php }?>
    <div style="margin-top: 20px;">
        <form action="<?=base_url()?>settingunitcabang/update" method="post">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">No</th>
                        <th class="center">NIK</th>
                        <th class="center">Nama Debitur</th>
                        <th class="center">Kode Wilayah</th>
                        <th class="center">Kode Kabupaten</th>
                        <th class="center">Kode Kecamatan</th>
                        <th class="center">Unit Cabang</th>
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
                        <td>
                            <select name="cabangunits[]">
                                <option v-for="cabangunit in cabangunits" :selected="data.kode_cabang === cabangunit.kd_cab" :value="cabangunit.kd_cab">{{cabangunit.nm_cabang}}</option>
                            </select>
                            <input type="hidden" name="iddata[]" :value="data.id">
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr colspan="6">
                        <td>Data tidak ditemukan silahkan pilih wilayah</td>
                    </tr>
                </tbody>
            </table>
            <div  v-if="datas != 0">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update Unit Cabang</button>
            </div>
        </form>
    </div>

</div>