<?php

require_once './config.php';

use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Illuminate\Database\Eloquent\Model {

    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'reservas_sala';
    protected $fillable = ['docente', 'asignatura', 'sala', 'fecha', 'hora_inicio', 'hora_fin'];
    protected $dates = ['fecha', 'created_at', 'updated_at', 'deleted_at'];

}
