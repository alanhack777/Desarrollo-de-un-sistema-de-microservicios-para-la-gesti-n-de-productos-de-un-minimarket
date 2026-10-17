<?php
require 'config.php';
$res = apiRequest('GET', API_URL);
$productos = $res['body'] ?? [];

// Cálculos para las tarjetas de resumen
$totalProductos = count($productos);
$valorInventario = 0;
$bajoStock = 0;

foreach ($productos as $p) {
    $valorInventario += ($p['precio'] * $p['stock']);
    if ($p['stock'] <= 10) {
        $bajoStock++;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Minimarket PRO-413</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --bg-color: #f8f9fc;
        }
        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .kpi-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 20px;
        }
        .table thead th {
            border-bottom: 2px solid #e9ecef;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }
        .table tbody tr {
            transition: background-color 0.2s;
        }
        .table tbody tr:hover {
            background-color: #f1f3f9;
        }
        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .btn-action {
            border-radius: 8px;
            padding: 5px 12px;
        }
        /* Ocultar filas para el buscador */
        .d-none {
            display: none !important;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-shop me-2"></i>Minimarket PRO-413
            </a>
            <div class="d-flex">
                <span class="navbar-text text-light">
                    <i class="bi bi-person-circle me-1"></i> Administrador
                </span>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        
        <!-- Tarjetas de Resumen (KPIs) -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card kpi-card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Productos</h6>
                            <h3 class="mb-0 fw-bold"><?= $totalProductos ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card kpi-card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Valor Inventario</h6>
                            <h3 class="mb-0 fw-bold">S/ <?= number_format($valorInventario, 2) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card kpi-card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Bajo Stock (≤ 10)</h6>
                            <h3 class="mb-0 fw-bold"><?= $bajoStock ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenedor de la Tabla -->
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h5 class="fw-bold mb-0 text-secondary">Lista de Productos Activos</h5>
                
                <div class="d-flex gap-2">
                    <!-- Buscador -->
                    <div class="input-group shadow-sm" style="width: 250px;">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Buscar producto...">
                    </div>
                    <!-- Botón Nuevo -->
                    <a href="crear.php" class="btn btn-primary shadow-sm px-4">
                        <i class="bi bi-plus-lg me-1"></i> Nuevo
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle" id="productTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Proveedor</th>
                            <th>Vencimiento</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td class="text-muted fw-bold">#<?= $p['id'] ?></td>
                            <td class="fw-semibold text-dark"><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= htmlspecialchars($p['proveedor']) ?></td>
                            <td>
                                <i class="bi bi-calendar3 text-muted me-1"></i>
                                <?= $p['fechaVencimiento'] ?>
                            </td>
                            <td class="fw-bold text-success">S/ <?= number_format($p['precio'], 2) ?></td>
                            <td>
                                <?php if ($p['stock'] > 10): ?>
                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                                        <?= $p['stock'] ?> uds.
                                    </span>
                                <?php else: ?>
                                    <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2">
                                        <i class="bi bi-arrow-down-circle me-1"></i><?= $p['stock'] ?> uds.
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-outline-warning btn-action shadow-sm" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="eliminar.php?id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar lógicamente este producto?')" class="btn btn-outline-danger btn-action shadow-sm ms-1" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if(empty($productos)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3 text-secondary"></i>
                                No hay productos activos en el inventario.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script para el buscador en vivo -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#productTable tbody tr');
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                if(text.includes(filter)) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>