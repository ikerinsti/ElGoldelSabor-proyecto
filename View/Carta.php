<div class="container">

    <!-- TÍTULO -->
    <h2 class="fw-bold my-4">Carta</h2>

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

    <!-- CONTENIDO -->
    <div class="row">

        <?php foreach ($arrayProductosHijas as $nombreCategoriaHija => $productosHija): ?>

            <div class="col-12">
                <h3 class="fw-bold mt-4 mb-3"><?= $nombreCategoriaHija ?></h3>
            </div>

            <?php foreach ($productosHija as $productoHija): ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4">

                    <div class="card h-100 rounded-4 shadow-sm">

                        <img src="/elgoldelsabor/Public/Assets/Productos/<?= $productoHija->img_producto(); ?>"
                             class="card-img-top"
                             alt="Producto">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title"><?= $productoHija->getNombre(); ?></h5>

                            <p class="card-text"><?= $productoHija->getDescripcion(); ?></p>

                            <!-- PRECIO -->
                            <?php if ($productoHija->getid_descuento() == null): ?>

                                <p class="text-primary fw-bold">
                                    <?= $productoHija->getPrecio(); ?> €
                                </p>

                            <?php else: ?>

                                <s class="text-muted">
                                    <?= $productoHija->getPrecio(); ?> €
                                </s>

                                <p class="text-danger fw-bold">
                                    <?php
                                    $precioDescontado = $productoHija->getPrecio();

                                    foreach ($listadescuentos as $descuentos) {
                                        if ($descuentos->getId_descuento() == $productoHija->getid_descuento()) {

                                            if ($descuentos->getTipo() == 'porcentaje') {
                                                $precioDescontado = $productoHija->getPrecio() * (1 - $descuentos->getValor() / 100);
                                            } elseif ($descuentos->getTipo() == 'fijo') {
                                                $precioDescontado = $productoHija->getPrecio() - $descuentos->getValor();
                                            }
                                        }
                                    }

                                    echo number_format($precioDescontado, 2);
                                    ?>
                                    €
                                </p>

                            <?php endif; ?>

                            <!-- BOTÓN -->
                            <a href="?controller=producto&action=verProducto&id_producto=<?= $productoHija->getId_Producto(); ?>"
                               class="btn btn-primary mt-auto text-white">
                                Ver producto
                            </a>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php endforeach; ?>

    </div>
</div>