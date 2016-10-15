<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:21
 */

namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class Cargo extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'cargos';

    protected $fillable = [
        'nome'
    ];
}