document.addEventListener("DOMContentLoaded", () => {

    cargarProductos();

    const formProducto = document.getElementById('formProducto');
    formProducto.addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('producto_id').value;
        const nombre = document.getElementById('producto_nombre').value;
        const descripcion = document.getElementById('producto_descripcion').value;
        const img_producto = document.getElementById('producto_img').value;
        const precio = document.getElementById('producto_precio').value;
        const id_descuento = document.getElementById('producto_id_descuento').value || null;
        const id_categoria = document.getElementById('producto_id_categoria').value;

        fetch('api.php?controller=api&action=editProducto', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, nombre, descripcion, img_producto, precio, id_descuento, id_categoria })
        })
        .then(res => res.json())
        .then(data => {
            if (data.ok) {
                cargarProductos();
                const modalEl = document.getElementById('modalProducto');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
                alert("Producto guardado correctamente");
            } else {
                alert("Error: " + data.error);
            }
        });
    });
});

// Listar productos
function cargarProductos() {
    fetch('api.php?controller=api&action=getProductos')
        .then(res => res.json())
        .then(productos => {
            const container = document.getElementById('productosList');
            container.innerHTML = "";

            productos.forEach(p => {
                const div = document.createElement('div');
                div.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');

                div.innerHTML = `
                    <div>
                        <strong>${p.nombre}</strong> - ${p.descripcion} - ${p.precio}€ - Cat: ${p.categoria}
                    </div>
                    <div>
                        <button class="btn btn-sm btn-warning me-2" onclick="editarProducto(${p.id_producto})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarProducto(${p.id_producto})">Eliminar</button>
                    </div>
                `;
                container.appendChild(div);
            });
        });
}

// Abrir modal para editar/crear
function editarProducto(id) {
    fetch(`api.php?controller=api&action=getProductoById&id=${id}`)
        .then(res => res.json())
        .then(p => {
            if (p.error) { alert(p.error); return; }

            document.getElementById('producto_id').value = p.id_producto;
            document.getElementById('producto_nombre').value = p.nombre;
            document.getElementById('producto_descripcion').value = p.descripcion;
            document.getElementById('producto_img').value = p.img_producto;
            document.getElementById('producto_precio').value = p.precio;
            document.getElementById('producto_id_descuento').value = p.id_descuento;
            document.getElementById('producto_id_categoria').value = p.id_categoria;

            const modalEl = document.getElementById('modalProducto');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
}

// Abrir modal vacío para crear
function abrirModalProducto() {
    document.getElementById('formProducto').reset();
    document.getElementById('producto_id').value = "";
    const modalEl = document.getElementById('modalProducto');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

// Eliminar producto
function eliminarProducto(id) {
    if (!confirm("¿Eliminar este producto?")) return;

    fetch(`api.php?controller=api&action=deleteProducto&id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.ok) cargarProductos();
            else alert("Error: " + data.error);
        });
}
