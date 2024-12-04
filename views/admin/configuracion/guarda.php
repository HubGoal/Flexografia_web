<?php
    require_once '..//config/database   .php';
    require_once '..//config/config.php';
    require_once '..//header.php';
    require_once  '..//controllers/cifrado.php';

    $db = new Database();
    $con= $db->conectar();

    $smtp = $_POST['smtp'];
    $email = $_POST['email'];
    $password = cifrar($_POST['password']);
    $puerto = $_POST['puerto'];


    $sql = $con-> prepare("UPDATE configuracion SET valor = ? where nombre = ?");
    $sql->execute([$smtp,'correo_SMTP']);
    $sql->execute([$email,'correo_email']);
    $sql->execute([$password,'correo_password']);
    $sql->execute([$puerto,'correo_puerto']);

?>
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Configuracion Actualizada</h2>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
    </div>
</main>

<?php include '..//footer.php';?>