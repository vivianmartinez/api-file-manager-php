<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    $response = [
        'status'=> 500,
        'error' => 'Something bad happened, please contact to support'
        ];

    if(isset($_GET['route']) && isset($_GET['name_file'])){

        if(is_dir('../'.$_GET['route'])){

            if(in_array($_GET['name_file'],scandir('../'.$_GET['route'])) ){
                $delete = unlink('../'.$_GET['route'].'/'.$_GET['name_file']);

                if($delete){
                    $response =[
                        'status'=> 200
                    ];
                }
            }else{
                $response =[
                    'status'=> 404,
                    'error' => 'The file doesn\'t exists'
                ];
            }
        }
        
    }else{
        $response =[
            'status'=> 400,
            'error' => 'Please specify the route and name of file you want to delete.'
        ];
    }
    echo json_encode($response);
}else{
    header('HTTP/1.1 405 Method not allowed');
    exit;
}

?>