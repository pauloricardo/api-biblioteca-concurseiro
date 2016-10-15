<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:35
 */

namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class QuestaoResposta extends \BibliotecaConcurseiro\Models\AppModel
{
    public $table = 'questoes_respostas';

    public $fillable = [
        'questao_id',
        'enunciado'
    ];
}