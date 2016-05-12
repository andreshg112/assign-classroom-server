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
#$app->contentType("application/json; charset=utf-8");

$app->get('/', function() {
    echo "Recibos de caja menor";
});

$app->get('/recibos', "get_all_recibos");
$app->get('/recibos/:id', "get_recibo");
$app->post('/recibos', "post_recibo");
$app->delete("/recibos/:id", "delete_recibo");
$app->put("/recibos/:id", "put_recibo");

$app->run();
