document.addEventListener("DOMContentLoaded", () => {

    cargarPedidos();

    const formPedido = document.getElementById('formPedido');

    formPedido.addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('pedido_id').value;
        const id_usuario = document.getElementById('pedido_id_usuario').value;
        const fecha = document.getElementById('pedido_fecha').value;
        const estado = document.getElementById('pedido_estado').value;
        const total = document.getElementById('pedido_total').value;
        const direccion = document.getElementById('pedido_direccion').value;

        fetch('api.php?controller=api&action=editPedido', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id,
                id_usuario,
                fecha,
                estado,
                total,
                direccion_pedido: direccion,
                tipo_entrega: 'domicilio'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                cargarPedidos();

                const modalEl = document.getElementById('modalPedido');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                alert("Pedido actualizado");
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(err => console.error("Error fetch:", err));
    });
});




// Cargar lista de pedidos
function cargarPedidos() {
    fetch('api.php?controller=api&action=getPedidos')
        .then(res => res.json())
        .then(pedidos => {
            const container = document.getElementById('pedidosList');
            container.innerHTML = "";

            pedidos.forEach(pedido => {
                const div = document.createElement('div');
                div.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');

                div.innerHTML = `
                    <div>
                        <strong>ID: ${pedido.id_pedido}</strong> - Usuario:<strong> ${pedido.id_usuario}</strong> ${pedido.nombre} - ${pedido.fecha} - Estado: ${pedido.estado} - Total: ${pedido.total}€
                    </div>
                    <div>
                        <button class="btn btn-sm btn-warning me-2" onclick="editarPedido(${pedido.id_pedido})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarPedido(${pedido.id_pedido})">Eliminar</button>
                    </div>
                `;
                container.appendChild(div);
            });
        })
        .catch(err => console.error("Error cargando pedidos:", err));
}

// Abrir modal y cargar datos para editar pedido
function editarPedido(id) {
    fetch(`api.php?controller=api&action=getPedidoById&id=${id}`)
        .then(res => res.json())
        .then(pedido => {
            if (pedido.error) {
                alert(pedido.error);
                return;
            }

            document.getElementById('pedido_id').value = pedido.id_pedido;
            document.getElementById('pedido_id_usuario').value = pedido.id_usuario;

            // Solo informativo
            document.getElementById('pedido_cliente_texto').textContent = pedido.nombre;

            document.getElementById('pedido_fecha').value = pedido.fecha;
            document.getElementById('pedido_estado').value = pedido.estado;
            document.getElementById('pedido_total').value = pedido.total;
            document.getElementById('pedido_direccion').value = pedido.direccion_pedido;

            const modalEl = document.getElementById('modalPedido');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        })
        .catch(err => console.error("Error al cargar pedido:", err));
}



// Eliminar pedido
function eliminarPedido(id) {
    if (!confirm("¿Eliminar este pedido?")) return;

    fetch(`api.php?controller=api&action=deletePedido&id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                cargarPedidos();
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(err => console.error("Error al eliminar pedido:", err));
}
