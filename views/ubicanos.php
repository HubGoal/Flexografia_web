<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../views/css/ubicanos.css">
</head>

<body>
    <header>
        <?php
        include_once('../views/tools/header.php');
        ?>
    </header>
    <div class="map__container">
        <iframe class="mapa"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.3118593829668!2d-104.65741712382761!3d24.020065478487403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bb7e163b5effd%3A0x6570340c0d46e34f!2s23%20Publicidad!5e0!3m2!1ses-419!2smx!4v1709011393345!5m2!1ses-419!2smx"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="infoMapa">
        <h1>Dirección:</h1>
        <li>Blvd. Cnel. Enrique Carrola Antuna 1011, Ciénega, Durango, Dgo.</li>
    </div>
        <div class="contact">
            <div class="contact__left">
                <br><h2>Contactanos</h2>
                <form action="">
                    <div class="contact__form--inputgroup">
                        <label for="name_input">Nombre</label>
                        <input type="text" name="name_input" id="name_input" placeholder="Nombre">

                        <label for="email_input">E-Mail</label>
                        <input type="text" name="email_input" id="email_input" placeholder="E-Mail">

                        <label for="msg_input">Mensaje</label>
                        <textarea name="msg_input" id="msg_input" cols="30" rows="10" placeholder="Mensaje"></textarea>

                        <input class="contact_btn" type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
        <footer>
            <?php
            include_once('../views/tools/footer.php');
            ?>
        </footer>
</body>
<script src="../views/js/script.js"></script>


</html>