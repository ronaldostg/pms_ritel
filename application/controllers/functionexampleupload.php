public function upload(){

$this->load->library('excel');



header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Jakarta');
$namafile =  $_FILES['file']["name"];
$ukuranfile = $_FILES["file"]["size"];
$typefile = $_FILES["file"]["type"];
$path = $_FILES["file"]["tmp_name"];

if (!file_exists($path)) {
    $output = [
        'type' => 'error',
        'message' => 'upload_again',

    ];

}else{

    $object = PHPExcel_IOFactory::load($path);
    $datas = [];

    foreach ($object->getWorksheetIterator() as $worksheet) {

        $highest_row = $worksheet->getHighestRow();
        $highest_column = $worksheet->getHighestColumn();

        for($row = 2; $row <= $highest_row; $row++)
        {
            $example_name = $worksheet->
            getCellByColumnAndRow(0, $row)->
            getValue();

            $status = $worksheet->
            getCellByColumnAndRow(1, $row)->
            getValue();

            $tanggal_input = $worksheet->
            getCellByColumnAndRow(2, $row)->
            getValue();

            $tanggal_update = $worksheet->
            getCellByColumnAndRow(3, $row)->
            getValue();




            
        
            $obj = new \stdClass;
            $obj->example_name = $example_name;
            $obj->status = $status;
            $obj->tanggal_input = date('Y-m-d H:i:s');
            $obj->tanggal_update = '0000-00-00 00:00:00';




            $obj->path = $path;




            $datas[] = $obj;


        }
        $row++;

    }

    $output = [

        'type' => 'success',
        'datas' => $datas,

    ];


    // echo ;

   $this->do_upload(json_encode($output));
}



}
// == Upload

// ==DO Upload
public function do_upload($data){
$datas = json_decode($data);

foreach ($datas->datas as $key => $r_data) {
    $dt['example_name'] =  $r_data->example_name;
    $dt['status'] = $r_data->status;
    $dt['tanggal_input'] = $r_data->tanggal_input;
    $dt['tanggal_update'] = $r_data->tanggal_update;

    $res = $this->db->insert('example_input_excel',$dt);
    if($res){
        $output = [
            'type' => 'success',
            'message' => 'Success Upload Data EXcel',
        ];

        echo json_encode($output);
    }else{
        $output = [
            'type' => 'gagal',
            'message' => 'Gagal Upload Data EXcel',
        ];

        echo json_encode($output);
    }

}

}