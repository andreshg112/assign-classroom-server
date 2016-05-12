<?php

require_once './models/Recibo.php';

function get_recibo($id) {
    $instancia = Recibo::find($id);
    $respuesta = new stdClass();
    if ($instancia) {
        $respuesta->result = $instancia;
        $respuesta->mensaje = "Existe.";
    } else {
        $respuesta->mensaje = "No se encuentra registrado.";
    }
    echo json_encode($respuesta);
}

function get_all_recibos() {
    $respuesta = new stdClass();
    $respuesta->result = Recibo::all();
    if (count($respuesta->result) == 0) {
        $respuesta->result = false;
        $respuesta->mensaje = "No hay registros.";
    }
    echo json_encode($respuesta);
}

function post_recibo() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    $instancia = new Recibo((array) $recibido);
    //$instancia->add_data($recibido);
    $respuesta = new stdClass();
    $respuesta->result = $instancia->save();
    if ($respuesta->result) {
        $respuesta->mensaje = "Registrado correctamente.";
        $respuesta->result = $instancia;
    } else {
        $respuesta->mensaje = "No se pudo registrar.";
    }
    echo json_encode($respuesta);
}

function delete_recibo($id) {
    $instancia = Recibo::find($id);
    $respuesta = new stdClass();
    if ($instancia) {
        $respuesta->result = $instancia->delete();
        if ($instancia->result) {
            $respuesta->mensaje = "Eliminado correctamente.";
            $respuesta->eliminado = $instancia;
        } else {
            $respuesta->mensaje = "Error tratando de eliminar.";
        }
    } else {
        $respuesta->mensaje = "No se encuentra registrado.";
    }
    echo json_encode($respuesta);
}

function put_recibo($id) {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    $instancia = Recibo::find($id);
    $instancia->fill((array) $recibido);
    //HugeForm::find($id)->update($post_data); Actualización con mass assigment. Similar a la anterior.
    $respuesta = new stdClass();
    $respuesta->result = $instancia->save();
    if ($respuesta->result) {
        $respuesta->mensaje = "Actualizado correctamente.";
        $respuesta->instancia = $instancia;
    } else {
        $respuesta->mensaje = "Error al momento de actualizar.";
    }
    echo json_encode($respuesta);
}
