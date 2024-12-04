<?php 
        $path = dirname (__FILE__). DIRECTORY_SEPARATOR;
        require_once  $path.'database.php';
        require_once  $path.'../views/admin/controllers/cifrado.php';
    
        $db = new Database();
        $con= $db->conectar();
        $sql = "SELECT nombre,valor FROM configuracion ";
        $resultado = $con->query($sql);
        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $config = [];
    
        foreach($datos as $dato){
            $config[$dato['nombre']] = $dato['valor'];
        }

    define("SITE_URL","http://flexografia.test/");
    define("KEY_TOKEN","APR.wqc-354*");
    define("MONEDA","$");
    
    define("MAIL_HOST", $config['correo_SMTP']);
    define("MAIL_USER", $config['correo_email']);
    define("MAIL_PASS", descifrar($config['correo_password']));
    define("MAIL_PORT",$config['correo_puerto']);
    

    session_start();


    $num_cart = 0;
    if (isset($_SESSION['carrito']['productos'])) {
        $num_cart = count($_SESSION['carrito']['productos']);
    }
?>