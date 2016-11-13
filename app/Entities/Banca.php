<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:22
 */

namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class Banca extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'bancas';

    protected $fillable = [
        'nome'
    ];

    protected function concursos()
    {
        return $this->hasMany('BibliotecaConcurseiro\Entities\Concurso');
    }
}