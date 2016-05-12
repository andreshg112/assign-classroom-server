<?php

require_once './config.php';

//use Illuminate\Database\Eloquent\SoftDeletes;

class Recibo extends Illuminate\Database\Eloquent\Model {

    //use SoftDeletes;
    public $timestamps = false;
    protected $table = 'recibos';
    protected $primaryKey = 'numero';
    //protected $fillable = ['ciudad', 'valor', 'valor_letras', 'pagado_a', 'concepto', 'codigo', 'aprobado', 'fecha'];
    protected $guarded = ['numero'];
    protected $dates = ['fecha'];

}
