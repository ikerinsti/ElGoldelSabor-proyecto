<section class="producto-detalle">

    <?php if (!$producto): ?>
        <p class="producto-error">Producto no encontrado.</p>
        <?php return; ?>
    <?php endif; ?>

    <div class="producto-card">

        <!-- IMAGEN DEL PRODUCTO -->
        <?php if ($producto->img_producto()): ?>
            <div class="producto-imagen">
                <img 
                    src="<?= htmlspecialchars($producto->img_producto()) ?>" 
                    alt="<?= htmlspecialchars($producto->getNombre()) ?>">
            </div>
        <?php endif; ?>

        <header class="producto-header">
            <h1><?= htmlspecialchars($producto->getNombre()) ?></h1>
            <p class="producto-precio">
                <?= number_format($producto->getPrecio(), 2) ?> €
            </p>
        </header>

        <div class="producto-descripcion">
            <?= nl2br(htmlspecialchars($producto->getDescripcion())) ?>
        </div>

        <div class="producto-ingredientes">
            <h3>Ingredientes</h3>

            <?php if (!empty($ingredientes)): ?>
                <ul>
                    <?php foreach ($ingredientes as $ingrediente): ?>
                        <li><?= htmlspecialchars($ingrediente) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="sin-ingredientes">Este producto no tiene ingredientes.</p>
            <?php endif; ?>
        </div>

        <div class="producto-carrito">
            <h3>Añadir al carrito</h3>

            <form method="POST" action="index.php?controller=Carrito&action=add">
                <input type="hidden" name="producto_id" value="<?= $producto->getId_producto() ?>">

                <div class="campo-cantidad">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" value="1" min="1">
                </div>

                <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? 'index.php?controller=carta&action=index') ?>">

                <button type="submit" class="btn-carrito">
                    Añadir al carrito
                </button>
            </form>
        </div>

    </div>
</section>

<style>
.producto-detalle {
    display: flex;
    justify-content: center;
    padding: 2rem;
}

.producto-card {
    max-width: 700px;
    width: 100%;
    background: #fff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.producto-imagen {
    text-align: center;
    margin-bottom: 1.5rem;
}

.producto-imagen img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

.producto-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 1rem;
    margin-bottom: 1rem;
}

.producto-header h1 {
    margin: 0;
    font-size: 1.8rem;
}

.producto-precio {
    font-size: 1.5rem;
    font-weight: bold;
    color: #c0392b;
}

.producto-descripcion {
    margin-bottom: 1.5rem;
    line-height: 1.6;
    color: #444;
}

.producto-ingredientes h3,
.producto-carrito h3 {
    margin-bottom: 0.5rem;
}

.producto-ingredientes ul {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.producto-ingredientes li {
    background: #f2f2f2;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    font-size: 0.9rem;
}

.sin-ingredientes {
    font-style: italic;
    color: #777;
}

.producto-carrito {
    margin-top: 2rem;
    border-top: 1px solid #eee;
    padding-top: 1.5rem;
}

.campo-cantidad {
    margin-bottom: 1rem;
}

.campo-cantidad input {
    width: 80px;
    padding: 0.4rem;
}

.btn-carrito {
    background: #0033A0;
    color: #fff;
    border: none;
    padding: 0.7rem 1.4rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
}

.btn-carrito:hover {
    background: #002080;
}

.producto-error {
    color: red;
    text-align: center;
}
</style>
