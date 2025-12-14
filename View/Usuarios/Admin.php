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
        <?php
        $usuarios = UsuarioDAO::getUsuarios();
        foreach ($usuarios as $row) { ?>
            <div>
                <div><?php echo $row->getId_usuario() ?></div>
                <div><?php echo $row->getNombre() ?></div>
                <div id="CRUD">
                    <button class="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="61   " height="64" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button class="remove">
                        <svg width="61" height="64" viewBox="0 0 61 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M24.6905 27.3977C25.8937 27.3977 26.869 28.3746 26.869 29.5796L26.869 47.0342C26.869 48.2391 25.8937 49.216 24.6905 49.216C23.4873 49.216 22.5119 48.2391 22.5119 47.0342L22.5119 29.5796C22.5119 28.3746 23.4873 27.3977 24.6905 27.3977Z"
                                fill="black" />
                            <path
                                d="M38.4881 29.5796C38.4881 28.3746 37.5127 27.3977 36.3096 27.3977C35.1064 27.3977 34.131 28.3746 34.131 29.5796V47.0342C34.131 48.2391 35.1064 49.216 36.3096 49.216C37.5127 49.216 38.4881 48.2391 38.4881 47.0342V29.5796Z"
                                fill="black" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.7024 12.8523V9.21591C16.7024 7.09417 17.544 5.05935 19.0421 3.55907C20.5401 2.05877 22.5719 1.21591 24.6905 1.21591H36.3095C38.428 1.21591 40.4599 2.05877 41.9578 3.55907C43.4561 5.05935 44.2976 7.09417 44.2976 9.21591V12.8523H56.6429C57.846 12.8523 58.8214 13.8291 58.8214 15.0341C58.8214 16.2391 57.846 17.2159 56.6429 17.2159H53.0119L53.0119 55.7615C53.0119 57.8831 52.1704 59.918 50.6721 61.4182C49.1741 62.9184 47.1423 63.7615 45.0238 63.7615H15.9762C13.8576 63.7615 11.8258 62.9184 10.3278 61.4182C8.82971 59.918 7.98811 57.8831 7.98811 55.7615L7.98811 17.2159H4.35716C3.15398 17.2159 2.17859 16.2391 2.17859 15.0341C2.17859 13.8291 3.15398 12.8523 4.35716 12.8523H16.7024ZM22.123 6.64463C22.804 5.96265 23.7275 5.57955 24.6905 5.57955H36.3095C37.2725 5.57955 38.1962 5.96265 38.8771 6.64463C39.5579 7.32658 39.9405 8.25149 39.9405 9.21591V12.8523H21.0595V9.21591C21.0595 8.25149 21.4421 7.32658 22.123 6.64463ZM12.3453 17.2159H48.6548L48.6548 55.7615C48.6548 56.7258 48.2722 57.6506 47.5913 58.3328C46.9105 59.0147 45.9868 59.3978 45.0238 59.3978H15.9762C15.0132 59.3978 14.0897 59.0147 13.4087 58.3328C12.7278 57.6506 12.3453 56.7258 12.3453 55.7615L12.3453 17.2159Z"
                                fill="black" />
                        </svg>
                    </button>
                </div>
            </div>
            <?php
        }
        ?>
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

    document.addEventListener("DOMContentLoaded", () => {
        new SidebarController("#sidebar");
    });






    fetch('http://localhost/ElGoldelSabor/Api.php/?controller=carta&action=getCategorias')
        .then(response => response.json())
        .then(data =>
            console.log("Categorias recibidas: ", data));
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