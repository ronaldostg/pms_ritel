window.jumlahdata = 0;

$("#view").on("click", function () {

    
    let kode_cabang = $("#kode_cabang").val();

    let type = $("#type").val();
    let bulan = $("#bulan").val();


    if(type != 'realisasisnd'){
        if (!kode_cabang) {
            $.gritter.add({
                title: 'Alert',
                text: 'Harus mengisi kode cabang telebih dahulu',
                class_name: 'gritter-error'
            });
            return false;
        }
    }
    if(bulan === ''){
        $.gritter.add({
            title: 'Alert',
            text: 'Bulan harus dipilih',
            class_name: 'gritter-error'
        });
        return false;
    }
    const url = general.base_url;
    let myform = $("#my-form").serialize();
    document.getElementById("viewreport").style.display = 'block';
    document.getElementById("cetak").style.display = 'block';
    $.ajax({
        type: 'POST',
        url: `${url}report/viewdata`,
        data: myform,
        dataType: "json",
        success: function (data) {


            const items = data;

            const viewTbody = document.querySelector('#viewTbody');
            let sum = 1;
            let totalData = 0;
            let tp = 0;

            viewTbody.innerHTML = '';
            $("#tp").html('');

            if (items.length != 0) {
                items.forEach(item => {

                    viewTbody.innerHTML += `
                            <tr>
                                <td>${sum++}</td>
                                <td>${item.nama_debitur}</td>
                                <td>Rp. ${formatPrice(item.plafond_akhir)}</td>
                                <td>${formatPrice(item.baki_debet_lama)}</td>
                                <td>${formatPrice(item.sisa_baki_debet)}</td>
                                <td>${item.tanggal_release}</td>
                                <td>${item.nama_user}</td>
                            </tr>
                        `;

                    totalData += 1;
                    tp += parseInt(item.plafond_akhir);

                });

                jumlahdata = totalData;

                $("#totaldata").html(totalData);
                $("#tp").html(`Rp. ${formatPrice(tp)}`);

                // console.log(tp)

            } else {

                viewTbody.innerHTML += `
                        <tr>
                        <td colspan="6">Tidak ada data</td>
                        </tr>
                    `;

                jumlahdata = 0;


                $("#totaldata").html(0);

            }






        }
    });


});


$("#kode_cabang").on("change", function () {

    let val = $(this).val();
    let type = $("#type").val();
    const url = general.base_url;
    if(type === 'realisasiao'){
        document.getElementById('user_ao').disabled = false;
    }

    if(type === 'realisasisnd'){
        document.getElementById('snd').disabled = false;
    }

    if(type === 'jenisguna'){
        document.getElementById('jenis_guna').disabled = false;
    }
   

    $.ajax({
        type: 'POST',
        url: `${url}report/cariuser`,
        data: `kode_cab=${val}`,
        dataType: "json",
        success: function (data) {

            const items = data;
            // console.log(items)
            const user_ao = document.querySelector('#user_ao');

            user_ao.innerHTML = '';

            user_ao.innerHTML += ` <option value="all">All</option>`;

            items.forEach(item => {

                user_ao.innerHTML += `
                    <option value='${item.id_user}'>${item.nama_user}</option>
                `;

            });

        }
    });

});

$("#cetak_pdf").on("click", function () {

    const url = general.base_url;
    let kode_cabang = $("#kode_cabang").val();
    let user_ao = $("#user_ao").val();
    let jenis_guna = $("#jenis_guna").val();
    let snd = $("#snd").val();
    let type = $("#type").val();
    let bulan = $("#bulan").val();


    if (jumlahdata > 0) {

        if(type === 'realisasiao'){
            window.open(`${url}report/print_pdf?kode_cabang=${kode_cabang}&userao=${user_ao}&bulan=${bulan}`, '_blank');

        }
    
        if(type === 'jenisguna'){
            window.open(`${url}report/print_pdf?kode_cabang=${kode_cabang}&jenisguna=${jenis_guna}&bulan=${bulan}`, '_blank');
        }
    
        if(type === 'realisasisnd'){
            window.open(`${url}report/print_pdf?snd=${snd}&bulan=${bulan}`, '_blank');
        }
       
    } else {
        $.gritter.add({
            title: 'Alert',
            text: 'Maaf data kosong. tidak dapat dicetak',
            class_name: 'gritter-error'
        });

    }


});

$("#cetak_excel").on("click", function () {

    const url = general.base_url;
    let kode_cabang = $("#kode_cabang").val();
    let user_ao = $("#user_ao").val();
    let jenis_guna = $("#jenis_guna").val();
    let snd = $("#snd").val();

    let type = $("#type").val();
    let bulan = $("#bulan").val();


    if (jumlahdata > 0) {
        // window.open(`${url}report/print_excel?kode_cabang=${kode_cabang}&userao=${user_ao}&jenisguna=${jenis_guna}&snd=${snd}`, '_blank');
        if(type === 'realisasiao'){
            window.open(`${url}report/print_excel?kode_cabang=${kode_cabang}&userao=${user_ao}&bulan=${bulan}`, '_blank');
        }else if(type === 'jenisguna'){
            window.open(`${url}report/print_excel?kode_cabang=${kode_cabang}&jenisguna=${jenis_guna}&bulan=${bulan}`, '_blank');
        }else{
            window.open(`${url}report/print_excel?snd=${snd}&bulan=${bulan}`, '_blank');
        }
    } else {
        $.gritter.add({
            title: 'Alert',
            text: 'Maaf data kosong. tidak dapat dicetak',
            class_name: 'gritter-error'
        });

    }


});

function formatPrice(value) {
    let val = (value / 1).toFixed(0).replace('.', ',');
    let hasil = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    return hasil;
}