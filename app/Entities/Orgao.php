<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:23
 */

namespace BibliotecaConcurseiro\Entities;
use BibliotecaConcurseiro\Models;

class Orgao extends \BibliotecaConcurseiro\Models\AppModel
{
    protected $table = 'orgaos';

    protected $fillable = [
      'nome'
    ];

}