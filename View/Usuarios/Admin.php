<section class="d-flex">
    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <ul class="sidebar-menu list-unstyled m-0 p-0">
            <li class="sidebar-item">
                <button id="btn-inicio" class="sidebar-btn active" data-target="#div-inicio" data-remove-class="visually-hidden">
                    <!-- Icono Home -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 3l6 6h-2v4H4v-4H2l6-6z" />
                    </svg>
                    <span>Inicio</span>
                </button>
            </li>

            <li class="sidebar-item">
                <button id="btn-productos" class="sidebar-btn" data-target="#div-productos" data-remove-class="visually-hidden">
                    <!-- Icono Productos -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 2h12v12H2z" />
                    </svg>
                    <span>Productos</span>
                </button>
            </li>

            <li class="sidebar-item">
                <button id="btn-categorias" class="sidebar-btn" data-target="#div-categorias" data-remove-class="visually-hidden">
                    <!-- Icono Categorías -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4 4h8v2H4zM4 7h8v2H4zM4 10h8v2H4z" />
                    </svg>
                    <span>Categorías</span>
                </button>
            </li>

            <li class="sidebar-item">
                <button id="btn-usuarios" class="sidebar-btn" data-target="#div-usuarios" data-remove-class="visually-hidden">
                    <!-- Icono Usuarios -->
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0-3-3 3 3 0 0 0 3 3zm4 7v-1a4 4 0 0 0-8 0v1z" />
                    </svg>
                    <span>Usuarios</span>
                </button>
            </li>
        </ul>
    </div>

    <div id="div-inicio" class="d-principal visually-hidden">

    </div>
    <div id="div-producos" class="d-principal visually-hidden">

    </div>
    <div id="div-categorias" class="d-principal visually-hidden">
        <?php
        $listaCategorias = CategoriaDAO::getCategorias();
        foreach ($listaCategorias as $categoria) {
            echo "<li>" . $categoria->getNombre() . "</li>";
        }
        ?>
    </div>
    <div id="div-usuarios" class="visually-hidden">

    </div>
</section>
<script>
    class SidebarController {
        constructor(sidebarSelector) {
            this.sidebar = document.querySelector(sidebarSelector);
            this.buttons = this.sidebar.querySelectorAll(".sidebar-btn");

            // Inicializamos los listeners
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

    // Activación de la clase cuando el DOM cargue
    document.addEventListener("DOMContentLoaded", () => {
        new SidebarController("#sidebar");
    });

    




    fetch('http://localhost/ElGoldelSabor/Api.php/?controller=carta&action=getCategorias')
        .then(response => response.json())
        .then(data =>
            console.log("Categorias recibidas: ", data));
</script>
<style>
    /* Contenedor general entre NAV y FOOTER */
    #layout {
        min-height: calc(100vh - 120px);
        /* ajusta según la altura de tu nav+footer */
        display: flex;
    }

    /* Sidebar */
    .sidebar {
        width: 70px;
        background: #343a40;
        transition: width 0.3s ease;
        overflow: hidden;
    }

    /* Al pasar el mouse se expande */
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

    /* Cuando el sidebar está expandido aparece el texto */
    .sidebar:hover .sidebar-btn span {
        opacity: 1;
    }

    /* Hover */
    .sidebar-btn:hover {
        background: #495057;
    }

    /* Activo */
    .sidebar-btn.active {
        background: #0033A0;
        color: White;
        font-weight: bold;
    }
</style>