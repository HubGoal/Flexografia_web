<?php 
    require_once './/models/config.php';    
    require_once './/controllers/clienteFunciones.php';
    $db = new Database();
    $con = $db->conectar();


    $id = isset($_GET['id']) ? $_GET['id'] :'';
    $token = isset($_GET['token']) ? $_GET['token'] :'';
    
    if($id=='' || $token==''){
        header('Location: index.php');
        exit();
    }

    echo validaToken($id, $token,$con);


?>