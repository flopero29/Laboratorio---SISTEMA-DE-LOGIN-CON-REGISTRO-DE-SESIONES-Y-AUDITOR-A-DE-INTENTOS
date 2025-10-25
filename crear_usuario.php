<?php
// Crear usuario inicial
require 'db.php';

$database = new Database();
$pdo = $database->getConnection();

$username = 'admin';
$password = '123456'; // Contraseña simple para pruebas

// Hashear la contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario
$stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password_hash]);

echo "Usuario creado exitosamente:<br>";
echo "Usuario: admin<br>";
echo "Contraseña: 123456<br>";
echo "Hash generado: " . $password_hash;
?>