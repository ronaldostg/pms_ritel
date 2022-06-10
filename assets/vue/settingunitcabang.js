const App = {
    data() {
      return {
        title: 'Testing App',
        file: '',
        duplicaterror: false,
        datas: [],
        rowData : 0,
        dtProvinsi : [],
        provinsi : '',
        dtKabupaten : [],
        kabupaten : '',
        dtKecamatan : [],
        kecamatan : '',
        uploadProses : false,
        msgGagal : '',
        duplicateMSg : '',
        msgSukses : '',
        showError : false,
        cabangunits : [],
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
      getUnitcabang(){
        const url = general.base_url;
        axios.get(`${url}datacabang/index`).then(response => {
            // console.log(response.data.items);
            this.cabangunits = response.data.items;
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
             // console.log(response.data.items);
              this.datas = response.data.items;
          })
          .catch(function (error) {
            console.log(error);
          }).finally(() => {
            
          });
      },
      uploadimage() {
  
        this.uploadProses = true;
  
        const url = general.base_url;
        console.log(url);
        this.file = this.$refs.file.files[0];
        var formData = new FormData();
        formData.append('file', this.file);
  
        axios.post(`${url}masterdebitur/upload`, formData, {
          header: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(response => {
          this.showError = true;
  
          console.log(response.data);
          const res = response.data;
          // if (res.cgagal > 0) {
            // alert(`${res.duplicate}`);
            this.msgGagal = res.gagalCount;
            this.duplicateMSg = res.duplicate;
          // }
  
          if (res.csukses > 0) {
            this.msgSukses = res.suksesCount;
          }
          // this.duplicatErrorMsg = 'dasasd';
          $('#modaluploadmaster').modal('hide');
  
        }).catch(function (error) {
          console.log(error);
        }).finally(() => {
          this.getData(this.provinsi , this.kabupaten ,  this.kecamatan);
          document.getElementById('filexl').value = "";
          this.uploadProses = false;
        });
        $('#modaluploadmaster').modal('hide');
      }
    },
    mounted() {
      this.getData(this.provinsi , this.kabupaten ,  this.kecamatan);
      this.getProvinsi();
      this.getUnitcabang();
    }
  }
  
  Vue.createApp(App).mount('#app')