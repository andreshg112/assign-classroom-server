<?php

require 'cors.php';
require 'Slim/Slim.php';

foreach (glob("controllers/*.php") as $filename) {
    require_once $filename;
}

// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();

// Creamos la aplicación.
$app = new \Slim\Slim();

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
$app->contentType("application/json; charset=utf-8");

$app->get('/', function() {
    echo "Asignación de salas";
});

$app->get('/reservas', "get_all_reservas");
$app->get('/reservas/:id', "get_reserva");
$app->post('/reservas', "post_reserva");
$app->delete("/reservas/:id", "delete_reserva");
$app->put("/reservas/:id", "put_reserva");

$app->run();
