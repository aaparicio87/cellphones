<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';


    public function user()
    {
        return $this->hasOne('User');
    }

    public function cotizacion()
    {
        return $this->hasOne('Cotizacion');
    }

    public function caja()
    {
        return $this->belongsTo('Caja');
    }
}
