<?php 
    require '..//config/database.php';
    require '..//config/config.php';
    require '..//header.php';

    if(!isset($_SESSION['user_type'])){
        header('Location: ../index.php');
        exit;
    }
    if($_SESSION['user_type'] != 'admin'){
        header('Location: ../../index.php');
        exit;
    }
    $db = new Database();
    $con= $db->conectar();
    
    $id = $_POST['id_product'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $sql = "UPDATE products SET nombre = ?, descripcion = ?, precio=?, activo = 1 WHERE id_product = ?";
    $stm = $con->prepare($sql);
    if($stm ->execute([$nombre,$descripcion,$precio,$id])){

        if($_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK){
            $dir = '../../img/products/'.$id.'/';
            $permitidos = ['jpeg','jpg','png'];
            $arregloImagen = explode('.',$_FILES['imagen_principal']['name']);
            $extension = strtolower(end($arregloImagen));
            if(in_array($extension,$permitidos)){
                if(!file_exists($dir)){
                    mkdir($dir,0777,true);
                }
                $ruta_img = $dir.'principal.'.$extension;
                if(move_uploaded_file($_FILES['imagen_principal']['tmp_name'],$ruta_img)){
                    echo "El archivo se cargo correctamente";
                }else {
                    echo "Error al cargar el archivo";
                }
            }else {
                echo "Archivo no permitido";
            }
        }else {
            echo "No se envio archivo";
        }
    }
        //Subir otras imagenes
        if(isset($_FILES['otras_imagenes'])){
            $dir = '../../img/products/'.$id.'/';
            $permitidos = ['jpeg','jpg','png'];

            if(!file_exists($dir)){
                mkdir($dir,0777,true);
            }
            $contador = 1;
            foreach($_FILES['otras_imagenes']['tmp_name'] as $key => $tmp_name){
                $fileName = $_FILES['otras_imagenes']['name'][$key];                
                $arregloImagen = explode('.',$fileName);
                $extension = strtolower(end($arregloImagen));
                $nuevoNombre =  $dir.uniqid().'.'.$extension;


                if(in_array($extension,$permitidos)){
                    if(move_uploaded_file($tmp_name, $nuevoNombre)){
                        echo "El archivo se cargo correctamente";
                    }else {
                        echo "Error al cargar el archivo";
                    }
                }else {
                    echo "Archivo no permitido";
                }
            }

        }
    
    header("Location:index.php");
?>