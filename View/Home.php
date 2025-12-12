<section id="banner-home">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active w-50" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" class="w-50" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" class="w-50" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/elgoldelsabor/Public/Assets/Banner1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>First slide label</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/elgoldelsabor/Public/Assets/Banner1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>First slide label</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/elgoldelsabor/Public/Assets/Banner1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block bg-opacity-75">
                    <h2>First slide label</h2>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <svg width="60" height="60" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="bg-white bg-opacity-75 rounded-circle p-3">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8545 5.46967C15.1474 5.76256 15.1474 6.23744 14.8545 6.53033L9.38488 12L14.8545 17.4697C15.1474 17.7626 15.1474 18.2374 14.8545 18.5303C14.5617 18.8232 14.0868 18.8232 13.7939 18.5303L7.79389 12.5303C7.501 12.2374 7.501 11.7626 7.79389 11.4697L13.7939 5.46967C14.0868 5.17678 14.5617 5.17678 14.8545 5.46967Z" fill="black" />
            </svg>

            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="bg-white bg-opacity-75 rounded-circle p-3">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.46967 5.46967C9.76256 5.17678 10.2374 5.17678 10.5303 5.46967L16.5303 11.4697C16.8232 11.7626 16.8232 12.2374 16.5303 12.5303L10.5303 18.5303C10.2374 18.8232 9.76256 18.8232 9.46967 18.5303C9.17678 18.2374 9.17678 17.7626 9.46967 17.4697L14.9393 12L9.46967 6.53033C9.17678 6.23744 9.17678 5.76256 9.46967 5.46967Z" fill="black" />
            </svg>

            <span class="visually-hidden">Next</span>
        </button>
    </div>

</section>
<section class="bg-color-secundario" id="OFERTAS">
    <h4 class="text-white text-center text-decoration-underline pt-3">
        OFERTAS
    </h4>
    <div class="d-flex justify-content-center">
        <?php
        foreach ($listadescuentos as $descuentos): ?>
            <div class="card m-3 d-inline-block" style="width: 18rem;">
                <img src="/elgoldelsabor/Public/Assets/Descuentos/<?php echo $descuentos->getImg_oferta(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $descuentos->getNombre(); ?></h5>
                    <p class="card-text"><?php echo $descuentos->getDescripcion(); ?></p>
                    <a href="#" class="btn btn-primary">Ver oferta</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section id="PRODUCTOS">
    <h4 class="text-black text-center text-decoration-underline pt-3">
        PRODUCTOS
    </h4>
    <a href="?controller=Carta&action=index&cat=Entrantes">
        <p class="text-black text-center text-decoration-underline pt-1">
            Ver todos los productos
        </p>
    </a>
    <div class="d-flex justify-content-center flex-wrap">
        <?php
        shuffle($listaproductos);
        $productosAleatorios = array_slice($listaproductos, 0, 8);
        ?>
        <?php foreach ($productosAleatorios as $productos): ?>

            <div class="card m-3 d-block col-3 rounded-4" style="width: 18rem;">
                <img src="/elgoldelsabor/Public/Assets/Productos/<?php echo $productos->img_producto(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $productos->getNombre(); ?></h5>
                    <p class="card-text"><?php echo $productos->getDescripcion(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>