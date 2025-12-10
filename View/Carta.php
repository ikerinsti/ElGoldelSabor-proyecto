<div class="container">

    <!-- TÍTULO -->
    <h2 class="fw-bold mb-4 mt-4">Carta</h2>

    <!-- NAV CATEGORÍAS PADRE -->
    <ul class="nav nav-tabs mb-4">
        <?php foreach ($listaCategorias as $categoria):
            if ($categoria->getCategoriaPadre() === null):

                $nombre = $categoria->getNombre();
                $active = ($categoriaActiva === $nombre) ? "active" : "";
        ?>
                <li class="nav-item">
                    <a class="nav-link text-black nav-carta <?= $active ?>"
                        href="?controller=carta&action=index&cat=<?= urlencode($nombre) ?>">
                        <?= $nombre ?>
                    </a>
                </li>
        <?php endif;
        endforeach; ?>
    </ul>

    <div class="row">
        <?php
        foreach ($arrayProductosHijas as $nombreCategoriaHija => $productosHija):
        ?>
            <h3 class="fw-bold mt-4 mb-3"><?= $nombreCategoriaHija ?></h3>
            <?php foreach ($productosHija as $productoHija): ?>
                <div class="card m-3 d-block col-3 rounded-4" style="width: 18rem;">
                    <img src="/elgoldelsabor/Public/Assets/Productos/<?php echo $productoHija->img_producto(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $productoHija->getNombre(); ?></h5>
                        <p class="card-text"><?php echo $productoHija->getDescripcion(); ?></p>
                        <?php
                        if ($productoHija->getid_descuento() == null):
                        ?>
                            <p class="text-primary"><?php echo $productoHija->getPrecio(); ?> €</p>
                        <?php
                        else:
                        ?>
                            <s class="text-primary"> <?php echo $productoHija->getPrecio(); ?> € </s>
                            <p class="text-red"> <?php
                                                    $descuento = 0;
                                                    foreach ($listadescuentos as $descuentos) {
                                                        if ($descuentos->getId_descuento() == $productoHija->getid_descuento()) {
                                                            if ($descuentos->getTipo() == 'porcentaje') {
                                                                $descuento = $descuentos->getValor();
                                                                $precioDescontado = $productoHija->getPrecio() * (1 - $descuento / 100);
                                                            } elseif ($descuentos->getTipo() == 'fijo') {
                                                                $descuento = ($descuentos->getValor() / $productoHija->getPrecio()) * 100;
                                                                $precioDescontado = $productoHija->getPrecio() - $descuentos->getValor();
                                                            }
                                                        }
                                                    }
                                                    echo number_format($precioDescontado, 2);
                                                    ?> € </p>
                        <?php endif; ?>
                        <button class="btn btn-primary">
                            <a href="?controller=producto&action=verProducto&id_producto=<?php echo $productoHija->getId_Producto(); ?>" class="text-white text-decoration-none">
                                Ver producto
                            </a>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>