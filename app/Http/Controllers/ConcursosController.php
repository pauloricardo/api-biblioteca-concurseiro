<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\concurso;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ConcursosController extends Controller
{
    protected $concursosList;

    public function index($skip=null, $top=null){

        if(is_null($skip) && is_null($top)){
            $this->concursosList = Concurso::all();
        }else{
            $this->concursosList = Concurso::limit($top)->offset($skip)->orderBy('id','DESC')->get();
            foreach($this->concursosList as $key => $value){
                $concursos[] = [
                  'id' => $value->id,
                  'ano' => $value->ano,
                  'orgao' => [
                      'id' => $value->orgao_id,
                      'nome' => $value->orgao->nome
                  ],
                  'banca' => [
                      'id' => $value->banca_id,
                      'nome' => $value->banca->nome

                  ],
                 'banca_id' => $value->banca_id,
                  'orgao_id' => $value->orgao_id
                ];
            }
        }

        $retorno = [
          'X-Total-Rows' => count(Concurso::all()),
          'concursos' => $concursos
        ];

        return response()->json($retorno);
    }

    public function getConcurso($id){
        $concurso = Concurso::find($id);

        return response()->json($concurso);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = [
            'ano' => $data->ano,
            'orgao_id' => $data->orgao_id,
            'banca_id' => $data->banca_id
        ];
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