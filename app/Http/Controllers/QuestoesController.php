<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;

use BibliotecaConcurseiro\Entities\questao;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class QuestoesController extends Controller
{
    protected $questoesList;

    public function index($skip = null, $top = null)
    {

        if (is_null($skip) && is_null($top)) {
            $this->questoesList = Questao::all();
        } else {
            $this->questoesList = Questao::limit($top)->offset($skip)->orderBy('id', 'DESC')->get();
            foreach ($this->questoesList as $key => $value) {

                $questoes[] = [
                    'id' => $value->id,
                    'texto' => $value->texto,
                    'concurso' => [
                        'id' => $value->concurso_id,
                        'ano' => $value->concurso->ano,
                        'orgao' => [
                            'id' => $value->concurso->orgao->id,
                            'nome' => $value->concurso->orgao->nome
                        ]
                    ],
                    'disciplina' => [
                        'id' => $value->disciplina_id,
                        'nome' => $value->disciplina->nome

                    ],
                    'cargo' => [
                        'id' => $value->cargo_id,
                        'nome' => $value->cargo->nome
                    ],
                    'concurso_id' => $value->concurso_id,
                    'disciplina_id' => $value->disciplina_id,
                    'cargo_id' => $value->cargo_id
                ];
            }
            $this->questoesList = $questoes;
        }

        $retorno = [
            'X-Total-Rows' => count(Questao::all()),
            'questoes' => $this->questoesList
        ];

        return response()->json($retorno);
    }

    public function getQuestao($id)
    {
        $questao = Questao::find($id);

        return response()->json($questao);
    }

    public function save(Request $request)
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = [
            'id' => $value->id,
            'texto' => $value->texto,
            'concurso_id' => $value->concurso_id,
            'disciplina_id' => $value->disciplina_id,
            'cargo_id' => $value->cargo_id
        ];

        $questao = Questao::create($data);

        return response()->json($questao);
    }

    public function deleta($id)
    {
        $questao = Questao::find($id);
        $questao->delete();

        return response()->json('deleted');

    }

    public function update(Request $request, $id)
    {

        $questao = Questao::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        $questao->texto = $data->texto;
        $questao->concurso_id = $data->concurso_id;
        $questao->disciplina_id = $data->disciplina_id;
        $questao->cargo_id = $data->cargo_id;
        $questao->save();

        return response()->json($questao);
    }
}