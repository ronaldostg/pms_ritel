const App = {
    data() {
        return {
            title: 'Testing App',
            datas: [],
            pageSize : 50,
            currentPage : 1,
            pageNumber : 0,
            total : 0,
            rowData : 0,
            offset : 0,
            text_cari : '', 
            nama_instansi : '',
            cabangunits: [],
            cabang: '',
            detail: [],
            isLoading: false,
            message : '',
            typeMsg : '',
            aouser : '',
            kd_cab : '',
            countUser : '',
            users : [],
        }
    },
    methods: {
        getUserao(){
            const url = general.base_url;
            axios.post(`${url}delegasidebitur/user_ao` , {
                kd_cab : this.kd_cab,
            }).then(response => {
                // console.log(response.data);
                this.users = response.data.items;
                this.countUser =  response.data.count;
            });
        },
        getUnitcabang() {
            const url = general.base_url;
            axios.get(`${url}datacabang/index`).then(response => {
                // console.log(response.data.items);
                this.cabangunits = response.data.items;
            });
        },
        setPaging(){
            this.pageNumber = Math.ceil(this.rowData/this.pageSize)
            this.total = this.rowData
        },
        getData() {
            this.isLoading = true;
            const url = general.base_url;
            //console.log(kodecabang);
            axios.post(`${url}delegasidebitur/get_data_master`, {
                kodecabang: this.cabang,
                pageSize : this.pageSize,
                currentPage : this.currentPage,
                nama_instansi : this.nama_instansi,
                textCari : this.text_cari,
            }).then(response => {
                
                console.log(response.data);

                this.datas = response.data.results;
                this.rowData = response.data.count;
                this.offset = response.data.offset;
                this.isLoading = false;
                this.setPaging();
                
            }).catch(function (error) {
                console.log(error);
            }).finally(() => {

            });
        },
        searchData(){
            this.getData();
            this.setPaging();
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
        delegasiuser(param){
            const userinput = this.aouser;
            const url = general.base_url;
            axios.post(`${url}delegasidebitur/proses`, {
                iddata: param,
                userinput: userinput,
            }).then(response => {
                //   console.log(response.data);
                // this.detail = response.data.items;
                this.message = response.data.message;
                this.typeMsg = response.data.type;
                $('#delegasi').modal('hide');
                this.getData();
            }).catch(function (error) {
                console.log(error);
            }).finally(() => {
            });
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace('.', ',');
            let hasil = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
            return hasil;
          },
    },
    mounted() {
        this.getData();
        this.getUnitcabang();
        this.getUserao();
    }
}

Vue.createApp(App).mount('#app')