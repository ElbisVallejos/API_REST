<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/Producto.php';

$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'POST':
        // Crear nuevo producto
        $data = json_decode(file_get_contents("php://input"));
        
        if(
            !empty($data->nombre) &&
            !empty($data->precio) &&
            !empty($data->stock)
        ) {
            $producto->nombre = $data->nombre;
            $producto->descripcion = $data->descripcion;
            $producto->precio = $data->precio;
            $producto->stock = $data->stock;

            if($producto->crear()) {
                http_response_code(201);
                echo json_encode(array("message" => "Producto creado exitosamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "No se pudo crear el producto."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Datos incompletos."));
        }
        break;

    case 'GET':
        $stmt = $producto->listar();
        $num = $stmt->rowCount();

        if($num > 0) {
            $productos_arr = array();
            $productos_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $producto_item = array(
                    "id" => $id,
                    "nombre" => $nombre,
                    "descripcion" => $descripcion,
                    "precio" => $precio,
                    "stock" => $stock,
                    "fecha_creacion" => $fecha_creacion
                );
                array_push($productos_arr["records"], $producto_item);
            }

            http_response_code(200);
            echo json_encode($productos_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No se encontraron productos."));
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id)) {
            $producto->id = $data->id;
            $producto->nombre = $data->nombre;
            $producto->descripcion = $data->descripcion;
            $producto->precio = $data->precio;
            $producto->stock = $data->stock;

            if($producto->actualizar()) {
                http_response_code(200);
                echo json_encode(array("message" => "Producto actualizado exitosamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "No se pudo actualizar el producto."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de producto requerido."));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Método no permitido."));
        break;
}
?>