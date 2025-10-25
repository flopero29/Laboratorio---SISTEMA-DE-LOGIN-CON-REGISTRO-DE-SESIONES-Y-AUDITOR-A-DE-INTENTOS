<?php
// login.php - Procesar autenticación
session_start();
require 'db.php';

$database = new Database();
$pdo = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Buscar usuario en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $status = 'fail';
    $message = '';
    
    if ($user && password_verify($password, $user['password'])) {
        // Login exitoso
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['autenticado'] = "SI";
        $status = 'success';
        $message = " Bienvenido, " . htmlspecialchars($user['username']);
        
        // Redirigir al dashboard después de 2 segundos
        header("Refresh: 2; URL=dashboard.php");
        
    } else {
        // Login fallido
        $message = " Usuario o contraseña incorrectos";
    }
    
    // Registrar intento en auditoría
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $audit_stmt = $pdo->prepare("INSERT INTO login_audit (username, status, ip_address) VALUES (?, ?, ?)");
    $audit_stmt->execute([$username, $status, $ip_address]);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesando Login</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 500px; 
            margin: 100px auto; 
            padding: 20px; 
            text-align: center;
        }
        .message { 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 5px; 
            font-size: 18px;
        }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h2> Procesando Autenticación</h2>
    
    <div class="message <?php echo $status === 'success' ? 'success' : 'error'; ?>">
        <?php echo $message; ?>
    </div>
    
    <?php if ($status === 'success'): ?>
        <p>Redirigiendo al dashboard...</p>
    <?php else: ?>
        <a href="login.html">← Volver a intentar</a>
    <?php endif; ?>
    
    <div style="margin-top: 30px; font-size: 12px; color: #666;">
        <strong>Información de auditoría:</strong><br>
        Usuario: <?php echo htmlspecialchars($username); ?><br>
        Estado: <?php echo $status; ?><br>
        IP: <?php echo $ip_address; ?><br>
        Hora: <?php echo date('Y-m-d H:i:s'); ?>
    </div>
</body>
</html>