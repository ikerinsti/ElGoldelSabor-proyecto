document.addEventListener("DOMContentLoaded", () => {
    // Cargar la lista de usuarios al inicio
    cargarUsuarios();

    // Listener del formulario de edición (solo UNA vez)
    const form = document.getElementById("formUsuario");
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar envío tradicional

        // Recoger valores del modal
        const id = document.getElementById('usuario_id').value;
        const nombre = document.getElementById('usuario_nombre').value;
        const email = document.getElementById('usuario_email').value;
        const direccion = document.getElementById('usuario_direccion').value;
        const rol = document.getElementById('usuario_rol').value;

        // Enviar PUT con JSON
        fetch('index.php?controller=api&action=editUsuario', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, nombre, email, rol, direccion })
        })
            .then(res => res.json())
            .then(res => {
                if (res.ok) {
                    // Recargar lista de usuarios
                    cargarUsuarios();

                    // Cerrar modal
                    const modalEl = document.getElementById('modalUsuario');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();

                    alert("Usuario actualizado");
                } else {
                    alert("Error: " + res.error);
                }
            })
            .catch(err => console.error("Error al actualizar usuario:", err));
    });

    // Inicializar el sidebar
    new SidebarController("#sidebar");
});

// Función para cargar usuarios desde la API
function cargarUsuarios() {
    fetch('index.php?controller=api&action=getUsuarios')
        .then(res => res.json())
        .then(usuarios => {
            const container = document.getElementById('usuariosList');
            container.innerHTML = ""; // Limpiar antes de cargar

            usuarios.forEach(usuario => {
                const usuarioDiv = document.createElement('div');
                usuarioDiv.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');

                usuarioDiv.innerHTML = `
                    <div>
                        <strong>${usuario.nombre}</strong> - ${usuario.email} - Rol: ${usuario.rol}
                    </div>
                    <div>
                        <button class="btn btn-sm btn-warning me-2" onclick="editarUsuario(${usuario.id_usuario})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarUsuario(${usuario.id_usuario})">Eliminar</button>
                    </div>
                `;

                container.appendChild(usuarioDiv);
            });
        })
        .catch(err => console.error("Error cargando usuarios:", err));
}

// Función para abrir el modal y rellenar los campos para editar
function editarUsuario(id) {
    fetch(`index.php?controller=api&action=getUsuarioById&id=${id}`)
        .then(res => res.json())
        .then(usuario => {
            if (usuario.error) {
                alert(usuario.error);
                return;
            }

            document.getElementById('usuario_id').value = usuario.id_usuario;
            document.getElementById('usuario_nombre').value = usuario.nombre;
            document.getElementById('usuario_email').value = usuario.email;
            document.getElementById('usuario_direccion').value = usuario.direccion;

            const selectRol = document.getElementById('usuario_rol');
            selectRol.selectedIndex = 0;
            selectRol.options[0].text = `Rol actual: ${usuario.rol}`;

            // Abrir modal
            const modalEl = document.getElementById('modalUsuario');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        })
        .catch(err => console.error("Error al cargar usuario:", err));
}


