<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $response = [
        'status'=> 500,
        'error' => 'Something bad happened, please contact to support'
        ];

    if(isset($_GET['route']) && isset($_GET['old_name']) && isset($_GET['rename'])  ){

        if(is_dir('../'.$_GET['route'])){

            if(in_array($_GET['old_name'],scandir('../'.$_GET['route'])) ){
                
                if(! in_array($_GET['rename'],scandir('../'.$_GET['route'])) ){
                    $rename = rename('../'.$_GET['route'].'/'.$_GET['old_name'],'../'.$_GET['route'].'/'.$_GET['rename']);
                    if($rename){
                        $response =[
                            'status'=> 200
                        ];
                
                    }else{
                        $response =[
                            'status'=> 500,
                            'error' => 'Can\'t rename the file'
                        ];
                    }
                }else{
                    $response =[
                        'status'=> 404,
                        'error' => '¡The file already exists!'
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
            'error' => 'Please specify the route, old name and new name of file you want to rename'
        ];
    }
    echo json_encode($response);

}else{
    header('HTTP/1.1 405 Method not allowed');
    exit;
}

?>