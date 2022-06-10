const App = {
    data() {
      return {
        title: 'Testing App',
        file: '',
        duplicaterror: false,
        datas: [],
        detail : [],
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
        loading : true,
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
      //  alert("das");
        $("#kabselect").css('display' , 'block');
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
      setValue(param , value){
          if(param === 'kabupaten'){
            $("#kabselect").css('display' , 'none');
            this.kabupaten = value;
          }
      },
      cariSelect(param){
        console.log("test");
      },
      searchData(){
        this.getData();
        this.setPaging();
      },
      setPaging(){
          this.pageNumber = Math.ceil(this.rowData/this.pageSize)
          this.total = this.rowData
      },
      getData() {

        console.log(this.text_cari);
        const url = general.base_url;
        this.loading = true;
        axios.post(`${url}ajukansupervisisnd/getDatamasterdebitur` , {
          provinsi : this.provinsi,
          kabupaten : this.kabupaten,
          pageSize : this.pageSize,
          currentPage : this.currentPage,
          textCari : this.text_cari,
        }).then(response => {
              //  console.log(response.data);
              this.datas = response.data.results;
              this.rowData = response.data.count;
              this.offset = response.data.offset;
              this.setPaging()

          })
          .catch(function (error) {
            console.log(error);
          }).finally(() => {
            this.loading = false;
            
          });
         
      },
      showModal(param , kd_cab = '') {
           
        const url = general.base_url;
        this.kd_cab = kd_cab;

        axios.post(`${url}masterdebitur/getDetailMasterDebitur`, {
            iddata: param,
        }).then(response => {
          
            this.detail = response.data.items;
            

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
      cariSelect(param){

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
          this.getData();
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
    }
  }
  
  Vue.createApp(App).mount('#app')