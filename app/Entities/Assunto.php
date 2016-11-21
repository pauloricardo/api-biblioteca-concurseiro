<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 18:57
 */
namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class Assunto extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'assuntos';

    protected $fillable = [
        'id',
        'disciplina_id',
        'nome'
    ];

    public function disciplina(){
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Disciplina');
    }

}