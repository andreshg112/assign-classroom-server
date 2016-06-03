<?php

require_once './config.php';

use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Illuminate\Database\Eloquent\Model {

    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'reservas_sala';
    protected $fillable = ['docente', 'asunto', 'sala', 'fecha', 'hora_inicio', 'hora_fin'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public static function hayCruce($reserva) {
        $respuesta = Reserva::where('fecha', $reserva->fecha)
                ->where('sala', $reserva->sala)
                ->where(function($query) use($reserva) {
                    $query->where('hora_inicio', '<', $reserva->hora_inicio)
                    ->where('hora_fin', '>', $reserva->hora_inicio);
                })
                ->orWhere(function($query) use($reserva) {
            $query->where('hora_inicio', '>=', $reserva->hora_inicio)
            ->where('hora_inicio/', '<', $reserva->hora_fin);
        })->first();
        return $respuesta;
    }

}
