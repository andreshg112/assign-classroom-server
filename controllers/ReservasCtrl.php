<?php

require_once './models/Reserva.php';

function get_reserva($id) {
    $instancia = Reserva::find($id);
    $respuesta = new stdClass();
    if ($instancia) {
        $respuesta->result = $instancia;
        $respuesta->mensaje = "Existe.";
    } else {
        $respuesta->mensaje = "No se encuentra registrado.";
    }
    echo json_encode($respuesta);
}

function get_all_reservas() {
    $respuesta = new stdClass();
    $respuesta->result = Reserva::all();
    if (count($respuesta->result) == 0) {
        $respuesta->result = false;
        $respuesta->mensaje = "No hay registros.";
    }
    echo json_encode($respuesta);
}

function post_reserva() {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    $instancia = new Reserva((array) $recibido);
    $respuesta = new stdClass();
    $cruce = Reserva::hayCruce($instancia);
    if ($cruce) {
        var_dump($cruce);
        $respuesta->result = false;
        $respuesta->mensaje = "Hay cruce de horarios con $cruce->asunto.";
    } else {
        $respuesta->result = $instancia->save();
        if ($respuesta->result) {
            $respuesta->mensaje = "Registrado correctamente.";
            $respuesta->result = $instancia;
        } else {
            $respuesta->mensaje = "No se pudo registrar.";
        }
    }
    echo json_encode($respuesta);
}

function delete_reserva($id) {
    $instancia = Reserva::find($id);
    $respuesta = new stdClass();
    if ($instancia) {
        $respuesta->result = $instancia->delete();
        if ($instancia->trashed()) {
            $respuesta->mensaje = "Cancelado correctamente.";
            $respuesta->eliminado = $instancia;
        } else {
            $respuesta->mensaje = "Error tratando de cancelar.";
        }
    } else {
        $respuesta->mensaje = "No se encuentra registrado.";
    }
    echo json_encode($respuesta);
}

function put_reserva($id) {
    $request = \Slim\Slim::getInstance()->request();
    $recibido = json_decode($request->getBody());
    $instancia = Reserva::find($id);
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
