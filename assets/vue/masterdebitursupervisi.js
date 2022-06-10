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
            cabangunits: [],
            cabang: '',
            detail: [],
            isLoading: false,
            message : '',
            typeMsg : '',
        }
    },
    methods: {
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
            const kodecabang = this.cabang;
            //console.log(kodecabang);
            axios.post(`${url}masterdebitur/getDataByCabang`, {
                kodecabang: kodecabang,
                pageSize : this.pageSize,
                currentPage : this.currentPage,
                textCari : this.text_cari,
            }).then(response => {
                 console.log(response.data);
                this.datas = response.data.results;
                this.rowData = response.data.count;
                this.offset = response.data.offset;
                this.setPaging();
                this.isLoading = false;
            }).catch(function (error) {
                console.log(error);
            }).finally(() => {

            });
        },
        nextPage(){

            this.loading = true;
            this.currentPage = this.pageNumber;
            this.getData();
            
        },
        backPage(){
    
            this.loading = true;
            this.currentPage = this.pageNumber - 1;
            this.getData();
    
        },
        showModal(param) {
            const url = general.base_url;
            axios.post(`${url}masterdebitur/getDetailMasterDebitur`, {
                iddata: param,
            }).then(response => {
                //    console.log(response.data);
                this.detail = response.data.items;
            }).catch(function (error) {
                console.log(error);
            }).finally(() => {

            });
        },
        approve( id , param) {
            const url = general.base_url;
            axios.post(`${url}masterdebitur/approve`, {
                id: id,
                param: param,
            }).then(response => {
            //    console.log(response.data);
                this.message = response.data.message;
                this.typeMsg = response.data.type;
                this.getData();
                $('#approve').modal('hide');

            }).catch(function (error) {
                console.log(error);
            }).finally(() => {

            });
            // console.log(id);
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
    }
}

Vue.createApp(App).mount('#app')