<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Banca;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BancasController extends Controller
{
    protected $bancasList;

    public function index($skip=null, $top=null){

        if(is_null($skip) && is_null($top)){
            $this->bancasList = Banca::all();
        }else{
            $this->bancasList = Banca::limit($top)->offset($skip)->orderBy('id','DESC')->get();
        }

        $retorno = [
          'X-Total-Rows' => count(Banca::all()),
          'bancas' => $this->bancasList
        ];

        return response()->json($retorno);
    }

    public function getBanca($id){
        $banca = Banca::find($id);

        return response()->json($banca);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = [
            'nome' => $data->nome
        ];
        $banca = Banca::create($data);

        return response()->json($banca);
    }

    public function deleta($id){
        $banca = Banca::find($id);
        $banca->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $banca = Banca::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        $banca->nome = $data->nome;
        $banca->save();

        return response()->json($banca);
    }
}