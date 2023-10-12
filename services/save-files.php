<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
header('Access-Control-Allow-Headers', 'X-Request-with,content-type');

$response =[
    'status' => 405,
    'message' => 'can\'t upload file'
];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['route']) ){
        $route = $_POST['route'];
    }else{
        $route = 'files';
    }

    if(isset($_FILES['file'])){
        $file_route = '../'.$route.'/'.$_FILES['file']['name'];

        $existing_files = scandir('../'.$route);
        
        if(in_array($_FILES['file']['name'],$existing_files)){
            $response =[
                'status' => 404,
                'file_exists' => true,
                'message' => '¡Ups! The file already exists.'
            ];
        }elseif(move_uploaded_file($_FILES['file']['tmp_name'],$file_route)){
            $response =[
                'status' => 200
            ];
        }else{
            $response =[
                'status' => 404,
                'message' => 'can\'t upload file'
            ];
        }
    }
}

echo json_encode($response);

?>