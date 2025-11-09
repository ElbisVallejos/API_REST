**📚 API REST con PHP - Laboratorio Académico**


**🎯 Descripción del Proyecto**
Este proyecto consiste en una API REST desarrollada en PHP nativo como parte del laboratorio de la asignatura Desarrollo de Software VII. La API implementa operaciones CRUD básicas para la gestión de productos, utilizando una arquitectura MVC y siguiendo los principios RESTful.

**🛠️ Tecnologías Utilizadas**
Backend: PHP 7+

Servidor: WAMP (Apache)

Base de Datos: MySQL

Cliente API: Postman

Patrón: MVC (Modelo-Vista-Controlador)

**📁 Estructura del Proyecto**
text
api_rest/
├── config/
│   └── database.php          # Configuración de conexión a BD
├── controllers/
│   └── ProductosController.php # Lógica de endpoints REST
├── models/
│   └── Producto.php          # Modelo y operaciones de BD
├── index.php                 # Punto de entrada
└── README.md                # Este archivo

**🗃️ Base de Datos**
Estructura de la tabla productos:
sql
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
🔌 Endpoints Implementados
📥 POST - Crear Producto
URL: http://localhost/api_rest/controllers/ProductosController.php

json
{
    "nombre": "Macbook Air M1",
    "descripcion": "Portatil para uso empresarial",
    "precio": 500.40,
    "stock": 3
}
Respuesta: 201 Created

📤 GET - Listar Productos
URL: http://localhost/api_rest/controllers/ProductosController.php
Método: GET
Respuesta: 200 OK con array JSON de productos

✏️ PUT - Actualizar Producto
URL: http://localhost/api_rest/controllers/ProductosController.php

json
{
    "id": 5,
    "nombre": "Macbook Air M11",
    "descripcion": "Portatil para uso empresarial",
    "precio": 500.50,
    "stock": 3
}
Respuesta: 200 OK

🧪 Pruebas con Postman
Configuración Recomendada:
Content-Type: application/json

Método: Según operación (POST, GET, PUT)

Body: Raw JSON para POST y PUT

Evidencias de Prueba:
✅ POST - Creación exitosa (201)

✅ GET - Listado de productos (200)

✅ PUT - Actualización exitosa (200)

✅ GET - Verificación de cambios (200)
