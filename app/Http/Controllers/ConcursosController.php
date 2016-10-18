<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Concurso;
use BibliotecaConcurseiro\Factories;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ConcursosController extends Controller
{
    protected $concursosList;

    public function index($skip=null, $top=null){
        if(is_null($skip) && is_null($top)){
            $this->concursosList = Factories\ConcursoFactory::convertConcursoList(Concurso::all());
        }else{
            $this->concursosList = Factories\ConcursoFactory::convertConcursoList(Concurso::limit($top)->offset($skip)->orderBy('id','DESC')->get());
        }

        $retorno = [
          'X-Total-Rows' => count(Concurso::all()),
          'concursos' => $this->concursosList
        ];

        return response()->json($retorno);
    }

    public function getConcurso($id){
        $concurso = Factories\ConcursoFactory::convert(Concurso::find($id));


        return response()->json($concurso);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = Factories\ConcursoFactory::convert($data);
        $concurso = Concurso::create($data);

        return response()->json($concurso);
    }

    public function deleta($id){
        $concurso = Concurso::find($id);
        $concurso->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $concurso = Concurso::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        $concurso->ano = $data->ano;
        $concurso->banca_id = $data->banca_id;
        $concurso->orgao_id = $data->orgao_id;
        $concurso->save();

        return response()->json($concurso);
    }
}