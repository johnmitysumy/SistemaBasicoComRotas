<?php

include '../app/bootstrap/bootstrap.php';

require_once '../app/routes.php';

// Obtém a URL solicitada
$request_uri = $_SERVER['REQUEST_URI'];

// Remove a query string, se houver
$request_uri = strtok($request_uri, '?');

// Verifica se a rota está definida
if (array_key_exists($request_uri, $routes)) {
    // Obtém o controlador e o método associados à rota
    $route_parts = explode('@', $routes[$request_uri]);
    $controller = $route_parts[0];
    $method = $route_parts[1];

    // Inclui o arquivo do controlador
    require_once "../app/controllers/$controller.php";

    // Cria uma instância do controlador e chama o método associado à rota
    $controller_instance = new $controller();
    $controller_instance->$method();
} else {
    // Rota não encontrada, exiba uma página de erro ou redirecione para uma rota padrão
    echo '<center><h1>404 - Página não encontrada</h1></ccenter>';
}

?>
