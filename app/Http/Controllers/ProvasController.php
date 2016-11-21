<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Prova;
use BibliotecaConcurseiro\Entities\Concurso;
use BibliotecaConcurseiro\Entities\Cargo;
use BibliotecaConcurseiro\Factories\ProvaFactory;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProvasController extends Controller
{
    protected $provasList;

    public function index($skip=null, $top=null){

        if(is_null($skip) && is_null($top)){
            $this->provasList = ProvaFactory::convertList(Prova::all());
        }else{
            $this->provasList = ProvaFactory::convertList(Prova::limit($top)->offset($skip)->orderBy('id','DESC')->get());
        }

        $retorno = [
          'X-Total-Rows' => count(Prova::all()),
          'provas' => $this->provasList
        ];

        return response()->json($retorno);
    }

    public function getProva($id){
        $provas = Prova::find($id);

        return response()->json($provas);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = ProvaFactory::convertBack($data);
        $prova = Prova::create($data);

        return response()->json($prova);
    }

    public function deleta($id){
        $prova = Prova::find($id);
        $prova->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $prova = Prova::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        ProvaFactory::convertObject($prova, $data);

        $prova->save();

        return response()->json($data);
    }
}