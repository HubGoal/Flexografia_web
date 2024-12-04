<?php 
$sql = $con->prepare("SELECT id_product, nombre, img_url FROM products WHERE activo = 1 LIMIT 8");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($resultado as $row) { ?>
            <div class="product">
                <?php
                $id = $row['id_product'];
                $imagen = "..//views/img/products/" . $id . "/principal.png";
                if (!file_exists($imagen)) {
                    $imagen = "..//views/img/products/Redonda.png";
                }
                $title = $row["nombre"];
                ?>
                <a href="..//views/product.php?id=<?php echo $row['id_product']; ?>&token=<?php echo
                       hash_hmac('sha1', $row['id_product'], KEY_TOKEN); ?> "><img src="<?php echo $imagen; ?>"
                        alt="" class="product__img"></a>
                <h3 class="product__title">
                    <?php echo $title; ?>
                </h3>
            </div>
        <?php } ?>

