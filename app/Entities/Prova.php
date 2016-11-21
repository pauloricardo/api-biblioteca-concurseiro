<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:25
 */

namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class Prova extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'provas';

    protected $fillable = [
        'concurso_id',
        'cargo_id',
        'nome'
    ];
    protected function concurso()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Concurso');
    }
    protected function cargo()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Cargo');
    }

}