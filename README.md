#  Laboratorio 4 – Sistema de Login con Registro de Sesiones y Auditoría de Intentos

### Universidad Tecnológica de Panamá  
**Facultad de Sistemas Computacionales – Licenciatura en Ingeniería de Software**  
**Curso:** Ingeniería Web  
**Estudiante:** Jose Bustamante – 8-1011-1717  
**Facilitador:** Irina Fong  
**Grupo:** 1SF131  
**Año:** 2025  

---
##  Introducción

Este laboratorio implementa un **sistema completo de autenticación web en PHP**, que incorpora principios modernos de seguridad como el modelo **Zero Trust** y el **cumplimiento con la Ley 81 de Protección de Datos Personales de Panamá**.  
El sistema incluye **gestión de sesiones**, **hashing seguro de contraseñas**, y un **módulo de auditoría** para registrar los intentos de inicio de sesión exitosos y fallidos.

---

##  Tecnologías Usadas

- **PHP** (Programación Orientada a Objetos)  
- **MySQL** con *prepared statements*  
- **Sesiones PHP seguras**  
- **Hashing** con `password_hash()`  
- **HTML5 y CSS3** para la interfaz de usuario  

---
## Objetivos del Laboratorio

- Desarrollar un **sistema de autenticación seguro** con conexión a MySQL.  
- Implementar **gestión de sesiones** para usuarios autenticados.  
- Aplicar **hashing seguro** para la protección de credenciales.  
- Crear un **sistema de auditoría** que registre accesos exitosos y fallidos.  
- Reforzar los **principios de seguridad web**: validación, sesiones y modelo Zero Trust.

---
##  Instalación y Configuración

###  Requisitos Previos
Antes de ejecutar el proyecto, asegúrate de tener instalado:
- [XAMPP](https://www.apachefriends.org/es/index.html) o [WAMP](https://www.wampserver.com/)  
- **PHP 8.0+**  
- **MySQL 5.7+**  
- Un navegador web moderno (Chrome, Firefox, Edge)
###  Instalación y Configuración

1. **Clonar el repositorio**
   ```bash
   https://github.com/flopero29/Laboratorio---SISTEMA-DE-LOGIN-CON-REGISTRO-DE-SESIONES-Y-AUDITOR-A-DE-INTENTOS.git
   ```
   o descarga el repositorio como .zip y extrae el contenido en la carpeta htdocs de XAMPP.

2. **Configurar la BD**
   - Abre phpMyAdmin (http://localhost/phpmyadmin)
   - Crea una nueva base de datos, por ejemplo:
   ```bash
   CREATE DATABASE sistema_login;
   ```
   - Importa el archivo SQL incluido en la carpeta /sql.
  
3. **Configurar la conexión**
- Abre el archivo db.php.
- Ajusta los valores de conexión según tu entorno local:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_login";
```

4. **Iniciar el servidor local**
- Abre el Panel de control de XAMPP.
- Activa Apache y MySQL.
- Accede desde tu navegador a:
```bash
http://localhost/proyecto-login/login.html
```
---
##  Uso del Sistema
- Registro de Usuario: Crea un nuevo usuario en crear_usuario.php.
- Inicio de Sesión: Accede con tus credenciales desde login.html.
- Dashboard: Al iniciar sesión correctamente, se mostrará el panel principal (dashboard.php).
- Cierre de Sesión: Usa el botón de salida para cerrar sesión (logout.php).
- Auditoría: Los intentos de inicio de sesión (exitosos o fallidos) se registran automáticamente en la base de datos.

---

##  Aspectos de Seguridad Implementados

### **Modelo Zero Trust**
- Validación estricta en cada acceso.  
- Verificación de sesión en todas las páginas protegidas.  
- No se confía implícitamente en ningún usuario.  

### **Protección de Datos – Ley 81 de Panamá**
- Contraseñas **hasheadas** (no en texto plano).  
- Auditoría completa de accesos.  
- Principio de **mínimo privilegio** aplicado.  

### **Seguridad Técnica**
- Uso de **prepared statements** (previene SQL injection).  
- Hashing seguro con **bcrypt (`password_hash()`)**.  
- **Validación y sanitización** de entradas.  
- **Headers seguros** y redirección controlada.  

---


## Capturas de Pantalla

1. Creación del usuario  
2. Dashboard del sistema  
3. Interfaz de Login  
4. Autenticación de usuario  
5. Tabla de auditoría de sesiones  
6. Tabla de usuarios registrados

(Disclaimer: Las imágenes están en la carpeta Imagenes)
---


## Conclusiones

Durante el desarrollo del proyecto se logró implementar un **sistema completo de autenticación web**, garantizando la **seguridad, integridad y confidencialidad de los datos**.  
Se validó el uso correcto de **sesiones PHP** y se aplicaron **técnicas modernas de seguridad**, incluyendo auditoría de accesos.  

Entre los principales aprendizajes destacan:
- La importancia del **hashing seguro** de credenciales.  
- La aplicación del **principio Zero Trust** en entornos web.  
- El manejo adecuado de **sesiones y control de accesos**.  
- El diseño de **bases de datos orientadas al cumplimiento normativo**.  
