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
?>
<style>
    .ck-editor__editable[role = "textbox"]{
        min-height: 200px;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<main>
    <div class="container-fluid px-4">
        <h2 class="mt-3">Nuevo Producto</h2>
        <form action="guarda.php" method="post" autocomplete="off" enctype= "multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label"><i class="fas fa-notes-medical"></i>Nombre
                </label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"placeholder="" required autofocus
                >
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label"><i class="fas fa-notes-medical"></i>descripcion
                </label>
                <textarea class="form-control" name="descripcion" id="editor" aria-describedby="helpId"placeholder=""  
                > </textarea>
            </div>
            <div class="row mb-2">
                <div class="col">
                        <label for="imagen_principal" class="form-label">Imagen Principal</label>
                        <input
                            type="file"
                            class="form-control"
                            name="imagen_principal"
                            id="imagen_principal"
                            accept="image/jpeg"
                            required
                        />
                    
                </div>
                <div class="col">
                        <label for="otras_imagenes" class="form-label">Otras Imagenes</label>
                        <input
                            type="file"
                            class="form-control"
                            name="otras_imagenes[]"
                            id="otras_imagenes"
                            accept="image/jpeg"
                            multiple
                        />
                    
                </div>
                <div class="col">Column</div>
            </div>
            

            <div class="row">
                <div class="col-2 mb-3">
                    <label for="precio" class="form-label"><i class="fas fa-notes-medical"></i>precio
                    </label>
                    <input type="number" class="form-control" name="precio" id="precio" aria-describedby="helpId"placeholder="" required  >
                </div>
                <div class="col-2 mb-3">
                    <label for="activo" class="form-label"><i class="fas fa-notes-medical"></i>activo
                    </label>
                    <input type="number" class="form-control" name="activo" id="activo" aria-describedby="helpId"placeholder=""   >
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
</script>



<?php
    require_once '..//footer.php';


?>