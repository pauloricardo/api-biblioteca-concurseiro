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
        'cargo_id',
        'texto',
        'tipo'
    ];

    protected function concurso()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Concurso');
    }
    protected function disciplina()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Disciplina');
    }
    protected function cargo()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Cargo');
    }
    protected function prova()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Prova');
    }
    protected function assunto()
    {
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Assunto');
    }
    protected function questoesresposta()
    {
        return $this->hasMany('BibliotecaConcurseiro\Entities\QuestaoResposta');
    }
}