<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

if(isset($_GET['route'])){
    $route = $_GET['route'];
}else{
    $route = 'files';
}

$response = [];

if(is_dir('../'.$route)){

    $files = scandir('../'.$route);
    
    foreach($files as $file){
        if($file != '.' && $file != '..')
        {
            array_push($response,
            [
                'name_file'=>$file,
                'type_file'=> filetype('../'.$route.'/'.$file) == 'file' ? pathinfo('../'.$route.'/'.$file)['extension'] : filetype('../'.$route.'/'.$file),
                'size_file'=> convertBytes(filesize('../'.$route.'/'.$file)),
                'route' => substr('../'.$route,3),
                'root' => dirname('../'.$route,1)
            ]);
        }
    }
}else{
    $response = [
        'status'=> 400,
        'error' => 'The route doesn\'t exists'
        ];
}

echo json_encode($response);

function convertBytes($bytes){
    $floats = 0;
    $s = array('B', 'Kb', 'MB', 'GB', 'TB', 'PB');
    $e = floor(log($bytes,1024));
    return $bytes != 0 ? round($bytes / pow(1024,$e),$floats).$s[$e] : $bytes.$s[$bytes];
}


?>