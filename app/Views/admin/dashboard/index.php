<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Dashboard' ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>$150,000</h3>
                        <p>Ventas Hoy</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <a href="<?= base_url('admin/ordenes') ?>" class="small-box-footer">
                        Ver órdenes <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Tasa de Crecimiento</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <a href="<?= base_url('admin/productos') ?>" class="small-box-footer">
                        Gestión de Productos <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>Nuevos Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Ver Usuarios <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Órdenes Pendientes</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-bag-fill"></i>
                    </div>
                    <a href="<?= base_url('admin/ordenes/pendientes') ?>" class="small-box-footer">
                        Ir a pendientes <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Reporte de Ventas Mensuales</h5>
                    </div>
                    <div class="card-body">
                        <p>Aquí se cargaría una gráfica de ventas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>