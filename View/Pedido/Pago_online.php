<div class="pago-online-page">

    <h2 class="titulo-pago">Pago online</h2>

    <div class="pago-contenido">

        <form method="POST" action="index.php?controller=pedido&action=procesarPagoOnline" class="form-tarjeta">

            <p class="bloque-titulo">Datos de la tarjeta</p>

            <label class="form-label">
                Nombre del titular
                <input type="text" name="titular" required class="form-input">
            </label>

            <label class="form-label">
                Número de tarjeta
                <input type="text" name="numero" maxlength="16" required class="form-input">
            </label>

            <div class="fila">
                <label class="form-label">
                    Fecha caducidad
                    <input type="month" name="caducidad" required class="form-input">
                </label>

                <label class="form-label cvv">
                    CVV
                    <input type="text" name="cvv" maxlength="3" required class="form-input">
                </label>
            </div>

            <div class="resumen-precio">
                <p>Subtotal: <span><?= number_format($subtotal, 2) ?> €</span></p>
                <p>Descuento: <span><?= number_format($descuentoTotal, 2) ?> €</span></p>
                <p class="total">Total: <span><?= number_format($total, 2) ?> €</span></p>
            </div>

            <button type="submit" class="btn btn-primary">
                Pagar <?= number_format($total, 2) ?> €
            </button>

        </form>
    </div>

</div>

<style>
    /* Contenedor principal */
.pago-online-page {
    max-width: 700px;
    margin: 40px auto;
    font-family: Arial, sans-serif;
}

/* Título */
.titulo-pago {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

/* Card del contenido */
.pago-contenido {
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Bloque de título dentro del form */
.bloque-titulo {
    font-weight: bold;
    margin-bottom: 15px;
    color: #555;
}

/* Labels del formulario */
.form-label {
    display: block;
    margin-bottom: 15px;
    color: #555;
}

/* Inputs */
.form-input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

/* Fila para fecha y CVV */
.fila {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.fila .cvv {
    flex: 0 0 100px;
}

/* Resumen de precios */
.resumen-precio {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 25px;
    border: 1px solid #eee;
}

.resumen-precio p {
    margin: 5px 0;
    color: #555;
}

.resumen-precio p.total {
    margin-top: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.resumen-precio p span {
    font-weight: bold;
}

.resumen-precio p:nth-child(2) span {
    color: #e74c3c; /* rojo para descuento */
}

/* Botón de pago */
.btn-pago {
    width: 100%;
    padding: 15px;
    background-color: #27ae60;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-pago:hover {
    background-color: #1e874b;
}

</style>
