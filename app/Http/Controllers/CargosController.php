<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Cargo;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CargosController extends Controller
{
    protected $cargosList;

    public function index($skip=null, $top=null){

        if(is_null($skip) && is_null($top)){
            $this->cargosList = Cargo::all();
        }else{
            $this->cargosList = Cargo::limit($top)->offset($skip)->orderBy('id','DESC')->get();
        }

        $retorno = [
          'X-Total-Rows' => count(Cargo::all()),
          'cargos' => $this->cargosList
        ];

        return response()->json($retorno);
    }

    public function getCargo($id){
        $cargos = Cargo::find($id);

        return response()->json($cargos);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = [
            'nome' => $data->nome
        ];
        $Cargo = Cargo::create($data);

        return response()->json($Cargo);
    }

    public function deleta($id){
        $Cargo = Cargo::find($id);
        $Cargo->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $Cargo = Cargo::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        $Cargo->nome = $data->nome;
        $Cargo->save();

        return response()->json($Cargo);
    }
}