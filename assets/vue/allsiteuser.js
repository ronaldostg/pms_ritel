const App = {
    data() {
        return {
            title: "Testing",
            dtProvinsi : [],
            provinsi : '',
            dtKabupaten : [],
            kabupaten : '',
            dtKecamatan : [],
            kecamatan : '',
        }
    },
    methods: {
        getProvinsi() {
            const url = general.base_url;
            axios.get(`${url}wilayah/index`).then(response => {

                // console.log(response.data);
                this.dtProvinsi = response.data.items;

            });
        },
        getKabupaten(event) {
            const url = general.base_url;
            const provinsi = event.target.value;
            // console.log(provinsi);
            axios.post(`${url}wilayah/kabupaten`, { provinsi: provinsi }).then(response => {
                //console.log(response.data.items);
                this.dtKabupaten = response.data.items;
            });
        },
        getKecamatan(event) {
            const url = general.base_url;
            const kabkota = event.target.value;
            axios.post(`${url}wilayah/kecamatan`, { kabkota: kabkota }).then(response => {
                //console.log(response.data.items);
                this.dtKecamatan = response.data.items;
            });
        },
        sendSavedata(){
            alert("test");
        }
    },
    mounted(){
        this.getProvinsi();
    },
    
}

Vue.createApp(App).mount('#app')