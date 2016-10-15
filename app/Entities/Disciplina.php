<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 18:57
 */
namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'disciplinas';

    protected $fillable = [
        'nome'
    ];

}