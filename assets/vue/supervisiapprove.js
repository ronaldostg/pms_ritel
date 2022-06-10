const App = {
    data() {
      return {
        title: 'Testing App',
        file: '',
        duplicaterror: false,
        datas: [],
        pageSize : 50,
        currentPage : 1,
        pageNumber : 0,
        total : 0,
        rowData : 0,
        offset : 0,
        text_cari : '', 
        dtProvinsi : [],
        provinsi : '',
        dtKabupaten : [],
        kabupaten : '',
        dtKecamatan : [],
        kecamatan : '',
        dtKelurahan : [],
        kelurahan : '',
        uploadProses : false,
        msgGagal : '',
        duplicateMSg : '',
        msgSukses : '',
        showError : false,
        loading : false,
        detail: [],
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
      getKelurahan(event){
        const url = general.base_url;
        const kecamatan = event.target.value;
        const data = new FormData();
        data.append('kecamatan' , kecamatan);
        axios.post(`${url}wilayah/kelurahan` , data).then(response => {
          //console.log(response.data.items);
          this.dtKelurahan = response.data.items;
        });
        // alert(kecamatan)
      },
      searchData(){
        this.loading = true;
        this.getData();
        this.setPaging();
      },
      setPaging(){
        this.pageNumber = Math.ceil(this.rowData/this.pageSize)
        this.total = this.rowData
      },
      getData() {
        const url = general.base_url;
        this.loading = true;
        // console.log(provinsi);
        axios.post(`${url}supervisiapprove/showapprove` , {
          provinsi : this.provinsi,
          kabupaten : this.kabupaten,
          pageSize : this.pageSize,
          currentPage : this.currentPage,
          textCari : this.text_cari,
        })
          .then(response => {
            console.log(response.data);
             this.datas = response.data.results;
             this.rowData = response.data.count;
             this.offset = response.data.offset;
             this.loading = false;
             this.setPaging()
          })
          .catch(function (error) {
            console.log(error);
          }).finally(() => {
           
          });
      },
      showModal(param , kd_cab = '') {
           
        const url = general.base_url;
        this.kd_cab = kd_cab;
      
        axios.post(`${url}masterdebitur/getDetailMasterDebitur`, {
            iddata: param,
        }).then(response => {
          
            this.detail = response.data.items;
              console.log(response.data.items)

        }).catch(function (error) {
            console.log(error);
        }).finally(() => {

        });
      },
      nextPage(){

        this.loading = true;
        this.currentPage = this.currentPage + 1;
        this.getData();
      
      },
      backPage(){

        this.loading = true;
        this.currentPage = this.currentPage - 1;
        this.getData();

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
  
          // console.log(response.data);
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
      },
      formatPrice(value) {
        let val = (value / 1).toFixed(0).replace('.', ',');
        let hasil = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
        return hasil;
      },
    },
    mounted() {
      this.getData();
      this.getProvinsi();
      // console.log("FFF");
    }
  }
  
  Vue.createApp(App).mount('#app')