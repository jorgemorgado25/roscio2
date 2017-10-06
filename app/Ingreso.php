<?php

namespace Roscio;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable = [
    	'tipo_ingreso_id', 
    	'estudiante_id', 
    	'mencion_id', 
    	'escolaridad_id', 
    	'ano_id', 
    	'seccion_id'];
}
