<?php
    require_once '..//models/config.php'; 
    require_once '..//controllers/clienteFunciones.php';  

    //solicitud ajax, se solicita una url y retorna respuesta para hcerlo en tiempo real
$datos =[];

if (isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == 'existeEmail'){
        $db = new Database();
        $con = $db->conectar();
        $datos['ok'] = emailExiste($_POST['email'], $con); 
    }
}    

echo json_encode($datos);
?>