<nav class="navbar">
            <a href="../index.php" class="navbar__logo"><img src="../views/img/23LogoText.png" alt=""></a>
            <ul class="navmenu">
                <li class="nav--item">
                    <a href="../index.php" class="nav-link">Productos</a>
                </li>
                <li class="nav--item">
                    <a href="../views/ubicanos.php" class="nav-link">Ubicanos</a>
                </li>
                <li class="nav--item">
                <?php
                // print_r($_SESSION);
                if (isset($_SESSION['user_id'])) {
                        ?>
                        <p>Welcome <?php echo $_SESSION['user_name']?></p>
                        <a href="../controllers/controlador_cerrar_sesion.php">Cerrar sesion</a>
                        <?php
                } else {
                    echo '<a href="../views/login.php">Iniciar Sesión</a>';
                }
                ?>
                </li>
                <li class="nav--item">
                    <a href="/views/checkout.php" class="nav-link">Carrito <span id="num_cart" class= ""></span></a>
                </li>
            </ul>
            <div class="navbar--hamburguer">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
