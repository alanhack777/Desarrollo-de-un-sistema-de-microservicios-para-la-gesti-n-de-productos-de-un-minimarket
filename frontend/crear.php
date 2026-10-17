<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nombre' => $_POST['nombre'],
        'proveedor' => $_POST['proveedor'],
        'fechaVencimiento' => $_POST['fecha_vencimiento'],
        'precio' => (float)$_POST['precio'],
        'stock' => (int)$_POST['stock']
    ];
    apiRequest('POST', API_URL, $data);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto - Minimarket PRO-413</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            background: white;
            max-width: 700px;
            margin: 0 auto;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        .input-group-text {
            border-radius: 8px 0 0 8px;
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control.with-icon {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-shop me-2"></i>Minimarket PRO-413
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="card form-card p-4 p-md-5">
            
            <!-- Encabezado del Formulario -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-plus-lg fs-2"></i>
                </div>
                <h3 class="fw-bold text-dark">Registrar Nuevo Producto</h3>
                <p class="text-muted">Ingresa los datos para agregar un producto al inventario</p>
            </div>

            <!-- Formulario -->
            <form method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Nombre del Producto</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-box-seam text-muted"></i></span>
                        <input type="text" name="nombre" class="form-control with-icon" placeholder="Ej. Leche Gloria 1L" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Proveedor</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-truck text-muted"></i></span>
                        <input type="text" name="proveedor" class="form-control with-icon" placeholder="Ej. Gloria" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Fecha de Vencimiento</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-event text-muted"></i></span>
                            <input type="date" name="fecha_vencimiento" class="form-control with-icon" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-secondary">Precio (S/)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-currency-dollar text-muted"></i></span>
                            <input type="number" step="0.01" name="precio" class="form-control with-icon" placeholder="0.00" required>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary">Stock (Cantidad)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-boxes text-muted"></i></span>
                        <input type="number" name="stock" class="form-control with-icon" placeholder="Ej. 50" required>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <a href="index.php" class="btn btn-light border shadow-sm px-4">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success shadow-sm px-4 text-white fw-semibold">
                        <i class="bi bi-check-circle me-1"></i> Guardar Producto
                    </button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>