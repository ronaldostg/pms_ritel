const App = {
    data() {
      return {
        title: 'Testing App',
        file: '',
        duplicaterror: false,
        datas: [],
        detail : [],
        rowData : 0,
        dtProvinsi : [],
        provinsi : '',
        dtKabupaten : [],
        kabupaten : '',
        dtKecamatan : [],
        kecamatan : '',
        uploadProses : false,
        countSukses : '',
        countError : '',
        msgError : '',
        msgSukses : '',
        showMsg : false,
      }
    },
    methods: {
      getProvinsi(){
        const url = general.base_url;
        axios.get(`${url}wilayah/index`).then(response => {
  
          // console.log(response.data);
          this.dtProvinsi = response.data.items;
  
        });
      },
      getKabupaten(event){
        const url = general.base_url;
        const provinsi = event.target.value;
        // console.log(provinsi);
        axios.post(`${url}wilayah/kabupaten` , {provinsi : provinsi}).then(response => {
            //console.log(response.data.items);
            this.dtKabupaten = response.data.items;
        });
      },
      getKecamatan(event){
        const url = general.base_url;
        const kabkota = event.target.value;
        axios.post(`${url}wilayah/kecamatan` , {kabkota : kabkota}).then(response => {
          //console.log(response.data.items);
          this.dtKecamatan = response.data.items;
        });
      },
      getData( provinsi , kabupaten , kecamatan) {
        const url = general.base_url;
        // console.log(provinsi);
        axios.post(`${url}masterdebitur/getDatamasterdebitur` , {
          provinsi : provinsi,
          kabupaten : kabupaten,
          kecamatan : kecamatan,
        })
          .then(response => {
            //  console.log(response.data.items);
              this.datas = response.data.items;
          })
          .catch(function (error) {
            console.log(error);
          }).finally(() => {
            
          });
      },
      searchData(){
        this.getData();
        this.setPaging();
      },
      showModal(param , kd_cab = '') {
             
        const url = general.base_url;
        this.kd_cab = kd_cab;
        this.getUserao();
        axios.post(`${url}masterdebitur/getDetailMasterDebitur`, {
            iddata: param,
        }).then(response => {
          
            this.detail = response.data.items;
            
  
        }).catch(function (error) {
            console.log(error);
        }).finally(() => {
  
        });
      },
      uploadimage() {
        $('#modaluploadmaster').modal('hide');
  
        this.uploadProses = true;
        this.showMsg = false;
      
        const url = general.base_url;
        console.log(url);
        this.file = this.$refs.file.files[0];
        var formData = new FormData();
        formData.append('file', this.file);
  
        axios.post(`${url}masterdebitur/upload2`, formData, {
          header: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(response => {
          this.showMsg = true;
        
          const res = response.data;
          this.countSukses = res.csukses;
          this.countError = res.cgagal;
          this.msgError = res.errormsg;
          this.msgSukses = res.suksesmsg;
        
          console.log(response.data);
          // console.log("Respon 1");
  
        }).catch(function (error) {
          console.log(error);
          // this.showError = true;
          // this.msgSukses = "Gagal upload data";
  
          // console.log("Gagal");
  
        }).finally(() => {
      
          document.getElementById('filexl').value = "";
          this.uploadProses = false;
          // this.showError = true;
          // this.msgSukses = "Berhasil upload data";
          // console.log("Respon finalyyy");
  
  
        });
      
      },
      formatPrice(value) {
        let val = (value / 1).toFixed(0).replace('.', ',');
        let hasil = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
        return hasil;
      },
    },
    mounted() {
      // this.getData(this.provinsi , this.kabupaten ,  this.kecamatan);
      // this.getProvinsi();
      // console.log(general.base_url);
    }
  }
  
  Vue.createApp(App).mount('#app')