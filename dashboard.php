<?php
// dashboard.php - Página protegida
session_start();

// Verificar autenticación
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== "SI") {
    header("Location: login.html");
    exit;
}

require 'db.php';
$database = new Database();
$pdo = $database->getConnection();

// Obtener historial de intentos
$audit_stmt = $pdo->prepare("SELECT * FROM login_audit ORDER BY attempt_time DESC LIMIT 10");
$audit_stmt->execute();
$attempts = $audit_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .user-info {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .audit-table {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        .success { color: #28a745; }
        .fail { color: #dc3545; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1> Dashboard del Sistema</h1>
        <div class="user-info">
            <strong>Usuario autenticado:</strong> <?php echo htmlspecialchars($_SESSION['user']); ?><br>
            <strong>ID de sesión:</strong> <?php echo session_id(); ?><br>
            <strong>Hora de acceso:</strong> <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>

    <div class="audit-table">
        <h2> Últimos intentos de login</h2>
        <?php if (count($attempts) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>IP</th>
                        <th>Fecha/Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attempts as $attempt): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($attempt['username']); ?></td>
                        <td class="<?php echo $attempt['status']; ?>">
                            <?php 
                            echo $attempt['status'] === 'success' ? ' Éxito' : ' Fallido';
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($attempt['ip_address']); ?></td>
                        <td><?php echo $attempt['attempt_time']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay registros de intentos de login.</p>
        <?php endif; ?>
    </div>

    <a href="logout.php" class="btn"> Cerrar Sesión</a>

    <div style="margin-top: 30px; font-size: 12px; color: #666;">
        <strong>Información de sesión:</strong><br>
        ID de sesión: <?php echo session_id(); ?><br>
        Tiempo de inicio: <?php echo date('Y-m-d H:i:s', $_SESSION['_started'] ?? time()); ?>
    </div>
</body>
</html>