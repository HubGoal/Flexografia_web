<?php
require_once '../models/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23Publicidad</title>
    <link rel="icon" type="images/x-icon" href="img/23Logo.png">
    <link rel="stylesheet" href="..//views/css/style.css">
    <script type="importmap">
        {
          "imports": {
            "three": "https://unpkg.com/three@0.162.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@three@0.162.0/examples/jsm/"
          }
        }
      </script>
</head>

<body>
    <header>
        <?php
        include_once('../views/tools/header.php');
        ?>
    </header>

    <main class="contenedor">
        <div class="main__3D contenedor">
            <div class="main__product__info">
                <h1 class="main__product__title">Visualizador 3D</h1>

                <div class="canvas-container">
                    <canvas class="WebGL"></canvas>
                </div>
            </div>

            <div class="main__product__options">
                <div class="pasos_container">
                    <form action="">
                        <div class="form-one step-form active">
                            <p>Advertencia: Este es un visualizador experimental
                                y podria no ser del todo acertado al producto final.</p>
                            <br>
                            <div class="">
                                <p>Modelo</p>
                                <select class="select__model" name="select_model" id="select_model">
                                    <option value="cup">Vaso</option>
                                    <option value="box">Caja</option>
                                </select>
                            </div>

                            <div>
                                <p>Tipo de etiqueta</p>
                                <select class="select__model" name="select_stycker_type" id="select_styckertype">
                                    <option value="squared">Cuadrada</option>
                                    <option value="rectangular">Rectangular</option>
                                </select>
                            </div>
                            <div>
                                <div id="colorSelector">
                                    <p>Color</p>
                                    <span class="circle" style="background-color: #ffffff;"></span>
                                    <span class="circle" style="background-color: #d6c6b0;"></span>
                                    <span class="circle" style="background-color: #cad6b0;"></span>
                                    <span class="circle" style="background-color: #beb3e3;"></span>
                                    <span class="circle" style="background-color: #000000;"></span>
                                    <span class="circle" style="background-color: #e88b8b;"></span>
                                    <span class="circle" style="background-color: #ade0e0;"></span>

                                </div>
                            </div>
                    </form>
                </div class="product__buttonsgroup">
            </div>
        </div>
    </main>


    <footer>
        <?php
        include_once('../views/tools/footer.php');
        ?>
    </footer>
    <script src="js/3DVisualizer.js" type="module"></script>
</body>

</html>