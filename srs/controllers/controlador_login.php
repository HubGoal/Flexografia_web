<?php
    if(!empty($_POST["btn_ingresar"])){
        if (!empty($_POST["correo"]) and !empty($_POST["password"]) ) {
        $correo = $_POST["correo"];
        $password = $_POST["password"];
        $sql= $conexion ->query("select * from users where correo = '$correo' and contrasena ='$password' ");
        if ($datos= $sql->fetch_object()) {
            $_SESSION["id"] = $datos->id;
            $_SESSION["nombre"] = $datos->nombre;
            $_SESSION['type'] = $datos->type;
            header("location:../index.php");
        } else {
            echo"<script>alert('Acceso denegado')</script>";
        }
        
    } else {
        echo"<script>alert('Campos Vacios!')</script>";
    }

    }
?>