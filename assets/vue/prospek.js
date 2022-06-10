$("#cekexisting").on("click" , function(){
    document.getElementById('kabupaten').disabled = false;
    const url = general.base_url;
    let nikprospek = $("#nikprospek").val();
    $.ajax({
        url : `${url}site_user/prospek/dataexsiting`,
        method : "POST",
        data : `nikprospek=${nikprospek}`,
        dataType : 'json',
        success : function(data){


            let kab = data.kabupaten;
            
        
            // console.log(data);
            // return false;

            

            if(data.msg != 'error'){

                alert("Data existing ditemukan");
                let res = data.results;
             
                // console.log(res);
                // return false;
                $("#nama_prospek").val(res.nama_debitur);
                $("#nomor_rekening_tabungan").val(res.nomor_rekening);
                $("#nomor_rekening_pinjaman").val(res.no_rekening_pinjaman);
                $("#cif").val(res.cif);
                $("#nama_instansi").val(res.nama_instansi);
                $("#gaji_bruto").val(res.gaji_bruto);
                $("#angsuran_kredit").val(res.angsuran_kredit);
                $("#kode_status").val(res.kode_status);
                $("#kode_status").val(res.jenis_debitur);
                $("#kd_bidang_usaha").val(res.kategori_debitur);
                $("#alamat").val(res.alamat);
                $("#telp").val(res.no_telepon);
                $("#hp").val(res.no_handphone);
                $("#email").val(res.email);
                $("#nominal").val(res.plafond_akhir);
                $("#kode_wilayah").val(res.kode_provinsi);

                let kabupaten =  document.getElementById('kabupaten');
                kab.forEach(item => {

                    kabupaten.innerHTML += `
                        <option value='${item.kode_wilayah}'>${item.wilayah}</option>
                    `;
    
                });

                $("#kabupaten").val(res.kode_wilayah);

                


         

            }else{

                alert("Data debitur baru. silahkan lengkapi data tersebut");
                $("#nama_prospek").val();
                $("#nomor_rekening_tabungan").val();
                $("#nomor_rekening_pinjaman").val();
                $("#cif").val();
                $("#nama_instansi").val();
                $("#gaji_bruto").val();
                $("#angsuran_kredit").val();
                $("#kode_status").val();
                $("#kode_status").val();
                $("#kd_bidang_usaha").val();
                $("#alamat").val();
                $("#telp").val();
                $("#hp").val();
                $("#email").val();
                $("#nominal").val();

            }
        //    if(res.length > 0){

        //         alert(res.nama_debitur)

        //    }else{

        //         alert("Tidak ditemukan data existing");

        //    }
            

        }
    });

    

});