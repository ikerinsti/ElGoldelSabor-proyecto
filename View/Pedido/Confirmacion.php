<div class="confirmacion-page">

    <div class="confirmacion-card">

        <h2 class="titulo-confirmacion">¡Pedido recibido!</h2>

        <p class="mensaje">Gracias por tu pedido, <?= htmlspecialchars($usuarioNombre) ?>.</p>

        <div class="detalle-pedido">
            <p><strong>Número de pedido:</strong> <?= $pedido->getId_pedido() ?></p>
            <p><strong>Estado:</strong> <?= ucfirst($pedido->getEstado()) ?></p>
            <p><strong>Método de pago:</strong> <?= htmlspecialchars($pedido->getTipo_entrega()) ?></p>
            <p><strong>Total:</strong> <?= number_format($pedido->getTotal(), 2) ?> €</p>
        </div>

        <p class="mensaje-secundario">En breve recibirás un correo de confirmación (simulado en este proyecto).</p>

        <a href="?controller=Home&action=index" class="btn-volver">Volver al inicio</a>

    </div>

</div>

<style>
    .confirmacion-page {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    padding: 20px;
}

.confirmacion-card {
    background-color: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    max-width: 500px;
    width: 100%;
    text-align: center;
}

.titulo-confirmacion {
    font-size: 28px;
    color: #27ae60;
    margin-bottom: 20px;
}

.mensaje {
    font-size: 16px;
    color: #555;
    margin-bottom: 25px;
}

.detalle-pedido p {
    font-size: 16px;
    color: #333;
    margin: 8px 0;
}

.mensaje-secundario {
    font-size: 14px;
    color: #777;
    margin-top: 25px;
}

.btn-volver {
    display: inline-block;
    margin-top: 30px;
    padding: 12px 25px;
    background-color: #27ae60;
    color: #fff;
    font-weight: bold;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.2s;
}

.btn-volver:hover {
    background-color: #1e874b;
}

</style>