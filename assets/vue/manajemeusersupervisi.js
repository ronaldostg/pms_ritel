function deletedata(id){

    let url = general.base_url;
    if(confirm(`Apakah anda yakin ingin menghapus user ${id}`)){
        $.ajax({
            url : `${url}manajemenuser/deleteusersupervisi`,
            type : "POST",
            data : `id_user=${id}`,
            dataType : "json",
            success : function(data){

                $.gritter.add({
                    title: 'Alert',
                    text: data,
                    class_name: 'gritter-success' 
                });

                setTimeout(() => {

                    location.reload();

                }, 1000);

            }
        });
    }
}

function updatedata(id){
    let url = general.base_url;

    $('#tambahuser').modal('show');
    document.getElementById("juduledit").innerHTML = 'Mutasi ke cabang';
    document.getElementById("act").value = 'edit';
    $.ajax({
        url : `${url}manajemenuser/showusersupervisi`,
        type : "POST",
        data : `id_user=${id}`,
        dataType : "json",
        success : function(data){

            // console.log(data);
           $("#username").val(data.username);
           $("#kode_cabang").val(data.kd_cab);
           $("#nama_lengkap").val(data.nama_lengkap);

        }
    });

    // alert(id)

}

$(document).ready(function(){

  
    $("#buttonsaveuser").on('click' , function(){

        let url = general.base_url;

        let act = $("#act").val();
        

        if(!$("#username").val() ){
            $.gritter.add({
                title: 'Alert',
                text: 'Username tidak boleh kosong',
                class_name: 'gritter-error' 
            });
     
            return false;
        }

        if(!$("#nama_lengkap").val()){
            $.gritter.add({
                title: 'Alert',
                text: 'Nama lengkap tidak boleh kosong',
                class_name: 'gritter-error' 
            });
     
            return false;
        }

        if(act != 'edit'){
            if(!$("#password").val()){
                $.gritter.add({
                    title: 'Alert',
                    text: 'Password tidak boleh kosong',
                    class_name: 'gritter-error' 
                });
        
                return false;
            }
        }

        if($("#password").val() != $("#ulangi_password").val()){
            $.gritter.add({
                title: 'Alert',
                text: 'Password tidak sama',
                class_name: 'gritter-error' 
            });
     
            return false;
        }

        let form = $("#formdata").serialize();
        $.ajax({
            url : `${url}manajemenuser/addusersupervisi`,
            data : form,
            type : "POST",
            dataType : "JSON",
            success : function(data){

                //console.log(data);
                $.gritter.add({
                    title: 'Alert',
                    text: data,
                    class_name: 'gritter-success' 
                });

                setTimeout(() => {

                    location.reload();

                }, 1000);

                

            },
        });

      $('#tambahuser').modal('hide');

      
      
    });
    
});