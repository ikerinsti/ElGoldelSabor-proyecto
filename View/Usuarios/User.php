<div class="user-panel">

    <h2>Mis Datos</h2>
    <form method="POST">
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuario->getNombre()) ?>" placeholder="Nombre">
        <input type="email" name="email" value="<?= htmlspecialchars($usuario->getEmail()) ?>" placeholder="Email">
        <input type="text" name="direccion" value="<?= htmlspecialchars($usuario->getDireccion()) ?>" placeholder="Dirección">
        <button type="submit" name="guardar_datos">Guardar cambios</button>
    </form>
    <a href="http://localhost/ElGoldelSabor/?controller=Login&action=logout" class="btn bg-secondary text-decoration-none text-white mb-4">Cerrar session</a>
    
    <h3>Historial de Pedidos</h3>
    <div class="pedidos-container">
        <?php if(!empty($pedidos)): ?>
            <?php foreach($pedidos as $pedido): ?>
            <div class="pedido-card">
                <h4>Pedido #<?= $pedido->getId_pedido() ?> - <?= $pedido->getFecha() ?> - Total: $<?= $pedido->getTotal() ?></h4>
                <ul>
                    <?php foreach($pedidos_detalles[$pedido->getId_pedido()] as $d): ?>
                        <li><?= $d['cantidad'] ?>x Producto <?= $d['producto'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No has realizado pedidos todavía.</p>
        <?php endif; ?>
    </div>

</div>

<style>
    /* Contenedor principal */
.user-panel {
    max-width: 900px;
    margin: 30px auto;
    padding: 25px;
    background-color: #fdfdfd;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

/* Titulos */
.user-panel h2, .user-panel h3 {
    color: #222;
    margin-bottom: 15px;
}

/* Formulario */
.user-panel form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 30px;
}

.user-panel input {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: all 0.2s;
}

.user-panel input:focus {
    border-color: #0033A0;
    outline: none;
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

.user-panel button {
    width: 150px;
    padding: 10px;
    font-size: 14px;
    background-color: #0033A0;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

.user-panel button:hover {
    background-color: #0056b3;
}

/* Pedidos */
.pedidos-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.pedido-card {
    background-color: #f7f9fc;
    padding: 15px 20px;
    border-left: 5px solid #007bff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.pedido-card h4 {
    margin: 0 0 8px 0;
    color: #007bff;
    font-size: 16px;
}

.pedido-card ul {
    padding-left: 15px;
    margin: 0;
}

.pedido-card ul li {
    padding: 4px 0;
    font-size: 14px;
    border-bottom: 1px solid #e0e0e0;
}

.pedido-card ul li:last-child {
    border-bottom: none;
}
</style>