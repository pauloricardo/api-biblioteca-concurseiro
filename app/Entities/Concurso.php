<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:23
 */

namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class Concurso extends \BibliotecaConcurseiro\Models\AppModel
{

    protected $table = 'concursos';

    protected $fillable = [
        'ano', 'orgao_id', 'banca_id'
    ];

    public function banca(){
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Banca');
    }
    public function orgao(){
        return $this->belongsTo('BibliotecaConcurseiro\Entities\Orgao');
    }
    public function questoes(){
        return $this->hasMany('BibliotecaConcurseiro\Entities\Questao');
    }
}