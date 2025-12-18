<section class="d-flex">
    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <ul class="sidebar-menu list-unstyled m-0 p-0">
            <li class="sidebar-item">
                <button id="btn-inicio" class="sidebar-btn active" data-target="#div-inicio"
                    data-remove-class="visually-hidden">
                    <!-- Icono Home -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 3l6 6h-2v4H4v-4H2l6-6z" />
                    </svg>
                    <span>Inicio</span>
                </button>
            </li>

            <li class="sidebar-item">
                <button id="btn-productos" class="sidebar-btn" data-target="#div-productos"
                    data-remove-class="visually-hidden">
                    <!-- Icono Productos -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 2h12v12H2z" />
                    </svg>
                    <span>Productos</span>
                </button>
            </li>

            <li class="sidebar-item">
                <button id="btn-categorias" class="sidebar-btn" data-target="#div-categorias"
                    data-remove-class="visually-hidden">
                    <!-- Icono Categorías -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4 4h8v2H4zM4 7h8v2H4zM4 10h8v2H4z" />
                    </svg>
                    <span>Categorías</span>
                </button>
            </li>

            <li class="sidebar-item">
                <button id="btn-usuarios" class="sidebar-btn" data-target="#div-usuarios"
                    data-remove-class="visually-hidden">
                    <!-- Icono Usuarios -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0-3-3 3 3 0 0 0 3 3zm4 7v-1a4 4 0 0 0-8 0v1z" />
                    </svg>
                    <span>Usuarios</span>
                </button>
            </li>
        </ul>
    </div>

    <div id="div-inicio" class="d-principal visually-hidden w-75">

    </div>
    <div id="div-producos" class="d-principal visually-hidden w-75">

    </div>
    <div id="div-categorias" class="d-principal visually-hidden w-75">
        <?php
        $listaCategorias = CategoriaDAO::getCategorias();
        foreach ($listaCategorias as $categoria) {
            echo "<li>" . $categoria->getNombre() . "</li>";
        }
        ?>
    </div>
    <div id="div-usuarios" class="d-principal visually-hidden w-75">
        <h2>Usuarios</h2>
        <div id="usuariosList" class="list-group">

        </div>
    </div>
</section>
<div class="modal fade" id="modalUsuario" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formUsuario" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Nuevo usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id" id="usuario_id">

                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="usuario_nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="usuario_email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Rol</label>
                        <select name="rol" id="usuario_rol" class="form-select">
                            <option value="" disabled selected>
                                Rol actual
                            </option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Direccion</label>
                        <input type="text" name="direccion" id="usuario_direccion" class="form-control">
                    </div>

                    <div class="mb-3 d-none" id="activoGroup">
                        <label>Activo</label>
                        <select name="activo" id="usuario_activo" class="form-select">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Cargar la lista de usuarios al inicio
    cargarUsuarios();

    // Inicializar el formulario de edición UNA sola vez
    const form = document.getElementById("formUsuario");
    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('index.php?controller=api&action=editUsuario', {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if(res.ok){
                // Recargar lista de usuarios
                cargarUsuarios();

                // Cerrar modal correctamente
                const modalEl = document.getElementById('modalUsuario');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if(modal) modal.hide();

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

// Función para eliminar un usuario
function eliminarUsuario(id) {
    if (!confirm("¿Seguro que quieres eliminar este usuario?")) return;

    const formData = new FormData();
    formData.append('id', id);

    fetch('index.php?controller=api&action=deleteUsuario', {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.ok) {
            alert("Usuario eliminado");
            cargarUsuarios();
        } else {
            alert("Error: " + res.error);
        }
    })
    .catch(err => console.error("Error al eliminar usuario:", err));
}

// SidebarController tal como lo tenías
class SidebarController {
    constructor(sidebarSelector) {
        this.sidebar = document.querySelector(sidebarSelector);
        this.buttons = this.sidebar.querySelectorAll(".sidebar-btn");
        this.initEvents();
    }

    initEvents() {
        this.buttons.forEach(btn => {
            btn.addEventListener("click", () => this.onButtonClick(btn));
        });
    }

    onButtonClick(btn) {
        this.clearActiveButtons();
        this.setActiveButton(btn);
        this.updateTargetDiv(btn);
    }

    clearActiveButtons() {
        this.buttons.forEach(b => b.classList.remove("active"));
    }

    setActiveButton(btn) {
        btn.classList.add("active");
    }

    updateTargetDiv(btn) {
        const targetSelector = btn.dataset.target;
        const classToRemove = btn.dataset.removeClass;

        if (!targetSelector || !classToRemove) return;

        const targetDiv = document.querySelector(targetSelector);

        document.querySelectorAll(".d-principal").forEach(div => {
            div.classList.add(classToRemove);
        });

        if (targetDiv) {
            targetDiv.classList.remove(classToRemove);
        }
    }
}
</script>

<style>
    #layout {
        min-height: calc(100vh - 120px);
        display: flex;
    }

    .sidebar {
        width: 70px;
        background: #343a40;
        transition: width 0.3s ease;
        overflow: hidden;
    }

    .sidebar:hover {
        width: 230px;
    }

    .sidebar-menu {
        padding-top: 20px;
    }

    .sidebar-btn {
        width: 100%;
        padding: 15px 20px;
        border: none;
        background: transparent;
        color: white;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .sidebar-btn svg {
        min-width: 22px;
    }

    .sidebar-btn span {
        opacity: 0;
        white-space: nowrap;
        transition: opacity 0.2s ease;
    }

    .sidebar:hover .sidebar-btn span {
        opacity: 1;
    }

    .sidebar-btn:hover {
        background: #495057;
    }

    .sidebar-btn.active {
        background: #0033A0;
        color: White;
        font-weight: bold;
    }
</style>