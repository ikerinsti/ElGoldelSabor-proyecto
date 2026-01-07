<section class="carrito-page">

    <!-- COLUMNA IZQUIERDA -->
    <div class="carrito-col carrito-productos">
        <h2 class="carrito-titulo">Tu pedido</h2>

        <?php if (empty($productosCarrito)): ?>
            <p class="carrito-vacio">Tu carrito está vacío</p>
        <?php else: ?>
            <?php foreach ($productosCarrito as $producto): ?>
                <div class="producto-carrito-card">

                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">

                    <div class="producto-info">
                        <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
                        <p class="producto-precio"><?= number_format($producto['precio'], 2) ?> €</p>
                    </div>

                    <!-- CANTIDAD Y ELIMINAR -->
                    <div class="producto-cantidad-eliminar">

                        <!-- BAJAR -->
                        <form method="POST" action="?controller=carrito&action=bajar">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <button type="submit"
                                class="btn-cantidad <?= $producto['cantidad'] <= 1 ? 'disabled' : '' ?>">−</button>
                        </form>

                        <!-- CANTIDAD -->
                        <span class="cantidad"><?= $producto['cantidad'] ?></span>

                        <!-- SUBIR -->
                        <form method="POST" action="?controller=carrito&action=subir">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <button type="submit" class="btn-cantidad">+</button>
                        </form>

                        <!-- ELIMINAR -->
                        <form method="POST" action="?controller=carrito&action=eliminar">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <button type="submit" class="btn-eliminar">
                                <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_59_48)">
                                        <path
                                            d="M9.30953 10.2741C9.76319 10.2741 10.131 10.6405 10.131 11.0924L10.131 17.6378C10.131 18.0897 9.76319 18.456 9.30953 18.456C8.85587 18.456 8.4881 18.0897 8.4881 17.6378L8.4881 11.0924C8.4881 10.6405 8.85587 10.2741 9.30953 10.2741Z"
                                            fill="#FF0000" />
                                        <path
                                            d="M14.5119 11.0924C14.5119 10.6405 14.1441 10.2741 13.6904 10.2741C13.2368 10.2741 12.869 10.6405 12.869 11.0924L12.869 17.6378C12.869 18.0897 13.2368 18.456 13.6904 18.456C14.1441 18.456 14.5119 18.0897 14.5119 17.6378L14.5119 11.0924Z"
                                            fill="#FF0000" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.2976 4.8196L6.2976 3.45596C6.2976 2.66031 6.61492 1.89725 7.17977 1.33465C7.74461 0.772033 8.51069 0.455963 9.30951 0.455963H13.6905C14.4892 0.455963 15.2553 0.772033 15.8201 1.33465C16.3851 1.89725 16.7024 2.66031 16.7024 3.45596V4.8196H21.3571C21.8108 4.8196 22.1786 5.18592 22.1786 5.63778C22.1786 6.08965 21.8108 6.45596 21.3571 6.45596H19.9881L19.9881 20.9105C19.9881 21.7061 19.6708 22.4692 19.1059 23.0318C18.541 23.5944 17.7749 23.9105 16.9762 23.9105H6.02379C5.22498 23.9105 4.45889 23.5944 3.89406 23.0318C3.32921 22.4692 3.01189 21.7061 3.01189 20.9105L3.01189 6.45596H1.64284C1.18918 6.45596 0.821411 6.08965 0.821411 5.63778C0.821411 5.18592 1.18918 4.8196 1.64284 4.8196H6.2976ZM8.34145 2.49173C8.59819 2.23599 8.94641 2.09233 9.30951 2.09233H13.6905C14.0535 2.09233 14.4018 2.23599 14.6585 2.49173C14.9153 2.74746 15.0595 3.09431 15.0595 3.45596V4.8196H7.94046L7.94046 3.45596C7.94046 3.09431 8.0847 2.74746 8.34145 2.49173ZM4.65474 6.45596H18.3452L18.3452 20.9105C18.3452 21.2722 18.201 21.619 17.9443 21.8748C17.6875 22.1305 17.3392 22.2742 16.9762 22.2742H6.02379C5.6607 22.2742 5.31248 22.1305 5.05573 21.8748C4.79899 21.619 4.65474 21.2722 4.65474 20.9105L4.65474 6.45596Z"
                                            fill="#FF0000" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_59_48">
                                            <rect width="23" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                        </form>

                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- COLUMNA DERECHA -->
    <div class="carrito-col carrito-resumen">
    <h2 class="carrito-titulo">Detalles del pedido</h2>

    <form method="POST" action="?controller=pedido&action=procesarPago" class="form-pago">

        <div class="bloque-pago">
            <p class="bloque-titulo">Método de pago</p>

            <p class="bloque-subtitulo">Pagar online:</p>
            <label class="pago-card">
                <input type="radio" name="metodo_pago" value="tarjeta" required>
                <span>Tarjeta</span>
            </label>

            <p class="bloque-subtitulo">Pagar en el establecimiento:</p>
            <label class="pago-card">
                <input type="radio" name="metodo_pago" value="tarjeta_local">
                <span>Tarjeta</span>
            </label>
            <label class="pago-card">
                <input type="radio" name="metodo_pago" value="efectivo">
                <span>Efectivo</span>
            </label>
        </div>

        <label class="aviso-legal">
            <input type="checkbox" required>
            He leído y acepto el Aviso Legal y las Condiciones Generales y los Términos y condiciones pago online
        </label>

        <div class="resumen-precio">
            <p>Subtotal: <span><?= number_format($subtotal, 2) ?> €</span></p>
            <p>Descuento: <span><?= number_format($descuentoTotal, 2) ?> €</span></p>
            <p class="total">Total: <span><?= number_format($total, 2) ?> €</span></p>
        </div>

        <button type="submit" class="btn-pago">Proceder al pago</button>
    </form>
</div>


</section>
<style>
    /* ================== CARRITO PAGE ================== */
.carrito-page {
    display: grid !important;
    grid-template-columns: 2fr 1.2fr !important;
    gap: 2rem !important;
    padding: 2rem !important;
}

/* ================== COLUMNAS ================== */
.carrito-col {
    background: #fff !important;
    border-radius: 14px !important;
    padding: 1.5rem !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
}

/* ================== TITULOS ================== */
.carrito-titulo {
    background: #0b1f3b !important;
    color: #fff !important;
    padding: 0.7rem !important;
    border-radius: 10px !important;
    text-align: center !important;
    margin-bottom: 1.5rem !important;
    font-size: 1.3rem !important;
}

/* ================== PRODUCTOS ================== */
.producto-carrito-card {
    display: grid !important;
    grid-template-columns: 80px 1fr auto !important;
    align-items: center !important;
    gap: 1rem !important;
    padding: 1rem !important;
    border-radius: 10px !important;
    background: #f8f9fb !important;
    margin-bottom: 1rem !important;
}

.producto-carrito-card img {
    width: 80px !important;
    border-radius: 8px !important;
}

.producto-info h3 {
    margin: 0 !important;
    font-size: 1rem !important;
    color: #0b1f3b !important;
}

.producto-precio {
    font-weight: bold !important;
}

/* ================== CANTIDAD Y ELIMINAR ================== */
.producto-cantidad-eliminar {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
}

.producto-cantidad-eliminar form {
    display: inline !important;
    margin: 0 !important;
}

/* Botones de cantidad */
.btn-cantidad {
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    background: #0b1f3b !important;
    color: #fff !important;
    font-weight: bold !important;
    font-size: 1rem !important;
    line-height: 32px !important;
    border: none !important;
    cursor: pointer !important;
    transition: background 0.2s !important;
}

.btn-cantidad:hover:not(.disabled) {
    background: #0033a0 !important;
}

.btn-cantidad.disabled {
    background: #ccc !important;
    cursor: not-allowed !important;
}

/* Cantidad */
.cantidad {
    min-width: 20px !important;
    text-align: center !important;
    font-weight: bold !important;
}

/* Botón eliminar */
.btn-eliminar {
    background: transparent !important;
    border: none !important;
    cursor: pointer !important;
    font-size: 1.2rem !important;
    color: #ff0000 !important;
    transition: color 0.2s !important;
}

.btn-eliminar:hover {
    color: #c00000 !important;
}

/* ================== FORM PAGO ================== */
.form-pago {
    display: flex !important;
    flex-direction: column !important;
    gap: 1.2rem !important;
    width: 100% !important;
}

.pago-card {
    display: flex !important;
    align-items: center !important;
    gap: 0.8rem !important;
    background: #f0f2f5 !important;
    padding: 0.8rem 1rem !important;
    border-radius: 12px !important;
    cursor: pointer !important;
    transition: background 0.2s, box-shadow 0.2s !important;
    border: 2px solid transparent !important;
}

.pago-card input[type="radio"] {
    accent-color: #0033a0 !important;
    width: 18px !important;
    height: 18px !important;
    margin: 0 !important;
}

.pago-card span {
    font-weight: 500 !important;
    color: #0b1f3b !important;
}

.pago-card:hover {
    background: #e3e8f0 !important;
}

.pago-card input[type="radio"]:checked + span {
    font-weight: 600 !important;
    color: #0033a0 !important;
}

.bloque-titulo {
    font-weight: 600 !important;
    font-size: 1.1rem !important;
    margin-bottom: 0.5rem !important;
}

.bloque-subtitulo {
    margin-top: 0.5rem !important;
    margin-bottom: 0.3rem !important;
    font-weight: 500 !important;
    color: #333 !important;
}

.aviso-legal {
    font-size: 0.9rem !important;
    color: #555 !important;
}

/* ================== CHECKBOX ================== */
.aviso-legal {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;  /* espacio entre checkbox y texto */
    font-size: 0.9rem !important;
    color: #555 !important;
}

.aviso-legal input[type="checkbox"] {
    width: 18px !important;
    height: 18px !important;
    cursor: pointer !important;
    accent-color: #0033a0 !important;
    margin: 0 !important;
}


/* ================== RESUMEN PRECIO ================== */
.resumen-precio {
    background: #f8f9fb !important;
    border-radius: 12px !important;
    padding: 1rem !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 0.3rem !important;
}

.resumen-precio p {
    display: flex !important;
    justify-content: space-between !important;
    margin: 0 !important;
}

.total {
    font-weight: 700 !important;
    font-size: 1.2rem !important;
    color: #0b1f3b !important;
}

/* ================== BOTON PAGO ================== */
.btn-pago {
    width: 100% !important;
    background: #0033a0 !important;
    color: #fff !important;
    border: none !important;
    padding: 0.9rem !important;
    border-radius: 30px !important;
    font-size: 1rem !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: background 0.3s !important;
}

.btn-pago:hover {
    background: #001f70 !important;
}

/* ================== RESPONSIVE ================== */
@media screen and (max-width: 900px) {
    .carrito-page {
        grid-template-columns: 1fr !important;
        padding: 1rem !important;
    }
}

</style>