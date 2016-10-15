<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:26
 */

namespace BibliotecaConcurseiro\Entities;

use BibliotecaConcurseiro\Models;

class Questao extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'questoes';

    protected $fillable = [
        'concurso_id',
        'disciplina_id',
        'texto',
        'tipo'
    ];
}