<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    protected $table = 'celulares';

    public function venta()
    {
        return $this->hasOne('Venta');
    }

}
