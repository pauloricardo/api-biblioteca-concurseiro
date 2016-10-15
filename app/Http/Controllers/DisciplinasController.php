<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Disciplina;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DisciplinasController extends Controller
{
    protected $disciplinasList;

    public function index($skip=null, $top=null){

        if(is_null($skip) && is_null($top)){
            $this->disciplinasList = Disciplina::all();
        }else{
            $this->disciplinasList = Disciplina::limit($top)->offset($skip)->orderBy('id','DESC')->get();
        }

        $retorno = [
          'X-Total-Rows' => count(Disciplina::all()),
          'disciplinas' => $this->disciplinasList
        ];

        return response()->json($retorno);
    }

    public function getDisciplina($id){
        $disciplinas = Disciplina::find($id);

        return response()->json($disciplinas);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = [
            'nome' => $data->nome
        ];
        $disciplina = Disciplina::create($data);

        return response()->json($disciplina);
    }

    public function deleta($id){
        $disciplina = Disciplina::find($id);
        $disciplina->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $disciplina = Disciplina::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        $disciplina->nome = $data->nome;
        $disciplina->save();

        return response()->json($disciplina);
    }
}