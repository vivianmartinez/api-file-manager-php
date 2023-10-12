<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
header('Access-Control-Allow-Headers', 'X-Request-with,content-type');

if( isset($_POST['route']) ){
    $route = $_POST['route'];
}else{
    $route = 'files';
}

if(isset($_FILES['file'])){
    $file_route = '../'.$route.'/'.$_FILES['file']['name'];

    $existing_files = scandir('../'.$route);
    
    if(in_array($_FILES['file']['name'],$existing_files)){
        echo json_encode([
            'status' => 'failed',
            'file_exists' => true,
            'message' => '¡Ups! The file already exists.'
        ]);
    }elseif(move_uploaded_file($_FILES['file']['tmp_name'],$file_route)){
        echo json_encode([
            'status' => 'ok'
        ]);
    }else{
        echo json_encode([
            'status' => 'failed',
            'message' => 'can\'t upload file'
        ]);
    }
} 

?>