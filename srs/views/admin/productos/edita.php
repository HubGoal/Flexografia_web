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
    $id = $_GET['id'];

    $sql = $con->prepare("SELECT id_product, nombre, descripcion, precio FROM products WHERE id_product = ? and activo = 1 ");
    $sql->execute([$id]);
    $producto = $sql->fetch(PDO::FETCH_ASSOC);

    $rutaImagenes = "../../img/products/".$id.'/';
    $imagenPrincipal = $rutaImagenes.'principal.png';

    $imagenes = [];
    $dirInit = dir($rutaImagenes);
    while(($archivo = $dirInit->read() ) !== false) {
        if ($archivo != 'principal.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))) {
            $image = $rutaImagenes . $archivo;
            $imagenes[] = $image;
        }
    }
    $dirInit->close();
?>
<style>
    .ck-editor__editable[role = "textbox"]{
        min-height: 200px;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<main>
    <div class="container-fluid px-3">
        <h2 class="mt-2">Modifica producto</h2>
        <form action="actualiza.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name = "id_product" 
            value= "<?php echo $producto['id_product'];?>" >

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars( 
                $producto['nombre'],ENT_QUOTES);?>" required autofocus>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" name="descripcion" id="editor" required > <?php echo 
                $producto['descripcion']; ?></textarea>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6">
                   <label for="imagen_principal" class="form-label">Imagen principal:</label>
                    <input type="file" class="form-control" name="imagen_principal" id="imagen_principal" 
                    accept="image/jpeg" >
                </div>
                <div class="col-12 col-md-6">
                    <label for="otras_imagenes" class="form-label">Otras imágenes:</label>
                    <input type="file" class="form-control" name="otras_imagenes[]" id="otras_imagenes" 
                    accept="image/jpeg" multiple>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <?php if(file_exists($imagenPrincipal)){ ?>
                        <?php echo $imagenPrincipal;?>
                    <img width="250px" src="<?php echo $imagenPrincipal;?>" alt="" class="img-thumbnail my-3"> <br>
                    <button class="btn btn-danger btn-sm" onclick="eliminaImagen('<?php echo $imagenPrincipal;?>')">Eliminar</button>
                    
                     <?php } ?>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <?php foreach($imagenes as $imagen){ ?>
                            <div class="col-4">

                                <img  src="<?php echo $imagen;?>" alt="" class="img-thumbnail my-3"> <br>
                                <button class="btn btn-danger btn-sm" onclick="eliminaImagen('<?php echo $imagen;?>')">Eliminar</button>

                                
                            </div>
                            <?php } ?>
                    </div>
                </div>
            </div>


            <div class="row">
            <div class="col-12 col-md-4 mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" name="precio" id="precio" value="<?php echo 
                $producto['precio']; ?>"  required>
            </div>
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Guarda
            </button>
        </form>
    </div>
</main>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

function eliminaImagen(urlImagen){
    let url = 'eliminar_imagen.php'
    let formData = new FormData()
    formData.append('urlImagen',urlImagen)
    fetch(url,{
        method:'POST',
        body:formData
    })
    .then((response)=>{
        if(response.ok){
            location.reload()
        }
    })
}
</script>



<?php
    require_once '..//footer.php';


?>