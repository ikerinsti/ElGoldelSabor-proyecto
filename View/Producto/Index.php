<table style="width:60%; border:1px solid black; justify-content: center; text-align: center;">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Descricion</th>
        <th>Precio</th>
        <th>Id_descuento</th>
        <th>Id_categoria</th>
    </tr>
    <?php
    foreach ($listaProductos as $producto) { ?>
        <tr>
            <td><?= $producto->getId_producto(); ?></td>
            <td><?= $producto->getNombre(); ?></td>
            <td><?= $producto->getDescripcion(); ?></td>
            <td><?= $producto->getPrecio(); ?></td>
            <td><?= $producto->getId_descuento(); ?></td>
            <td><?= $producto->getId_categoria(); ?></td>
        </tr>
    <?php } ?>
</table>