<section class="d-flex">


    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <ul class="sidebar-menu list-unstyled m-0 p-0">

            <li class="sidebar-item">
                <button id="btn-pedidos" class="sidebar-btn active" data-target="#div-pedidos"
                    data-remove-class="visually-hidden">
                    <!-- Icono Pedidos -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm0 
                        1h10v14H3V1zm2 2h6v1H5V3zm0 2h6v1H5V5zm0 2h6v1H5V7zm0 2h6v1H5V9zm0 2h6v1H5v-1z" />
                    </svg>

                    <span>Pedidos</span>
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


    <!-- CONTENIDO PRINCIPAL -->

    <div id="div-pedidos" class="d-principal w-75">
        <h2 class="m-3">Pedidos</h2>
        <div id="pedidosList" class="list-group m-3">

        </div>
    </div>

    <div id="div-productos" class="d-principal visually-hidden w-75">
        <h2 class="m-3">Productos</h2>
        <div class="m-3">
            <button class="btn btn-primary" onclick="abrirModalProducto()">Nuevo Producto</button>
        </div>
        <div id="productosList" class="list-group m-3">

        </div>
    </div>

    <div id="div-usuarios" class="d-principal visually-hidden w-75">
        <h2 class="m-3">Usuarios</h2>
        <div id="usuariosList" class="list-group m-3">

        </div>
        <a href="http://localhost/ElGoldelSabor/?controller=Login&action=logout" class="btn bg-secondary text-decoration-none text-white m-3">Cerrar session</a>
    </div>
</section>



<!-- MODAL USUARIO -->

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
                    <button type="submit" class="btn btn-primary" onclick="actualizarUsuario()">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- MODAL PEDIDOS -->

<div class="modal fade" id="modalPedido" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPedido">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pedido_id">

                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <p class="form-control-plaintext" id="pedido_cliente_texto"></p>
                    </div>

                    <div class="mb-3">
                        <label for="pedido_fecha" class="form-label">Fecha</label>
                        <input type="date" id="pedido_fecha" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="pedido_estado" class="form-label">Estado</label>
                        <input type="text" id="pedido_estado" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="pedido_total" class="form-label">Total (€)</label>
                        <input type="number" step="0.01" id="pedido_total" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="pedido_direccion" class="form-label">Dirección</label>
                        <input type="text" id="pedido_direccion" class="form-control">
                    </div>
                    <input type="hidden" id="pedido_id_usuario">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL PRODUCTO -->
<div class="modal fade" id="modalProducto" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formProducto">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="producto_id">

                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" id="producto_nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Descripción</label>
                        <textarea id="producto_descripcion" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Imagen (URL)</label>
                        <input type="text" id="producto_img" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Precio (€)</label>
                        <input type="number" step="0.01" id="producto_precio" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Descuento (ID)</label>
                        <input type="number" id="producto_id_descuento" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Categoría (ID)</label>
                        <input type="number" id="producto_id_categoria" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="Public/JS/SideBar.JS"></script>
<script src="Public/JS/AdminUsers.JS"></script>
<script src="Public/JS/AdminPedidos.JS"></script>
<script src="Public/JS/AdminProductos.JS"></script>

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