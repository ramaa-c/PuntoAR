<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="<?= base_url('admin') ?>" class="brand-link">
            <span class="brand-text fw-light">Administrador PuntoAR</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation">
                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Vista Principal (Dashboard)</p>
                    </a>
                </li>

                <li class="nav-header">GESTIÓN DE CONTENIDO</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Productos y Catálogo
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/productos') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Lista de Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/productos/crear') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Agregar Nuevo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/categorias') ?>" class="nav-link">
                                <i class="nav-icon bi bi-tags-fill"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">GESTIÓN DE CARRUSELES</li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/carrusel') ?>" class="nav-link">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Carrusel Principal</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/carrusel/productos') ?>" class="nav-link">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Carrusel Productos</p>
                    </a>
                </li>

                <li class="nav-header">NEGOCIO</li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/ordenes') ?>" class="nav-link">
                        <i class="nav-icon bi bi-cart-fill"></i>
                        <p>Órdenes de Venta</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<main class="app-main">