<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 12/11/2016
 * Time: 19:06
 */

namespace BibliotecaConcurseiro\Http\Controllers;

use BibliotecaConcurseiro\Entities\Questao;
use BibliotecaConcurseiro\Entities\Disciplina;
use BibliotecaConcurseiro\Entities\Banca;
use BibliotecaConcurseiro\Entities\Concurso;
use BibliotecaConcurseiro\Entities\Orgao;
use BibliotecaConcurseiro\Entities\QuestaoResposta;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use BibliotecaConcurseiro\Factories\QuestaoFactory;
use BibliotecaConcurseiro\Factories\BancaFactory;
use BibliotecaConcurseiro\Factories\CargoFactory;
use BibliotecaConcurseiro\Factories\ConcursoFactory;
use BibliotecaConcurseiro\Factories\DisciplinaFactory;
//use BibliotecaConcurseiro\Factories\ConcursoFactory;
use Illuminate\Http\Request;


class QuestoesPublicController extends Controller
{

    private function checkFilterValues($array){
        $valores = [];
        foreach($array as $key => $value){
            if($key !== "skip" && $key !== "top"){
                $valores[] = $value;
            }
        }
        return $valores;
    }
    public function getQuestoes(Request $request)
    {
        $questao = [];
        $data = $request->all();
        $skip = isset($data['skip']) && !is_null($data['skip']) ? $data['skip'] : null;
        $top = isset($data['top']) && !is_null($data['top']) ? $data['top'] : null;

        $where = [];
        $concursos = [];
        if (isset($data['concurso_id'])) {
            array_push($concursos, $data['concurso_id']);
        }
        if (isset($data['banca_id'])) {
            $concurso_id_banca = Concurso::where(['banca_id' => $data['banca_id']])->get();
            foreach ($concurso_id_banca as $key => $value) {
                array_push($concursos, $value['id']);
            }
        }
        if (isset($data['orgao_id'])) {
            $concurso_id_banca = Concurso::where(['orgao_id' => $data['orgao_id']])->get();
            foreach ($concurso_id_banca as $key => $value) {
                array_push($concursos, $value['id']);
            }
        }
        if (isset($data['nivel_questao'])) {
            if (count($where) == 0) {
                $where[] = ['tipo_questao' => $data['nivel_questao']];
            } else {
                array_push($where, [
                    'tipo_questao' => $data['nivel_questao']
                ]);
            }
        }
        if (isset($data['cargo_id'])) {
            if (count($where) == 0) {
                $where[] = ['cargo_id' => $data['cargo_id']];
            } else {
                array_push($where, [
                    'cargo_id' => $data['cargo_id']
                ]);
            }
        }
        if (isset($data['tipo_questao'])) {
            if (count($where) == 0) {
                $where[] = ['tipo_questao' => $data['tipo_questao']];
            } else {
                array_push($where, [
                    'tipo_questao' => $data['tipo_questao']
                ]);
            }
        }
        if (isset($data['disciplina_id'])) {
            if (count($where) == 0) {
                $where[] = ['disciplina_id' => $data['disciplina_id']];
            } else {
                array_push($where, [
                    'disciplina_id' => $data['disciplina_id']
                ]);
            }
        }
        $filter = $this->populateFilterList($where);
        $re['Total-Questoes'] = Questao::where($filter)->count();
        if (count($concursos) > 0) {
            $questao = Questao::whereIn('concurso_id', array_unique($concursos))->where($filter)->orderBy('id', 'DESC')->limit($top)->offset($skip)->get();
        } else {
            if (count($filter) > 0) {
                $questao = Questao::where($filter)->orderBy('id', 'DESC')->limit($top)->offset($skip)->get();
            } else {
                if(count($this->checkFilterValues($data)) > 0){
                    $questao = [];
                    $re['Total-Questoes'] = 0;
                }else{
                    $re['Total-Questoes'] = Questao::count();
                    $questao = Questao::orderBy('id', 'DESC')->limit($top)->offset($skip)->get();
                }
            }
        }

        $re['questoes'] = $this->populateQuestoes($questao);
        $retorno = [
            'filtroQuestoes' => $re
        ];
        return response()->json($retorno);
    }

    private function populateDisciplinas($arr)
    {
        $retorno = [];
        foreach ($arr as $key => $value) {
            $retorno[] = [
                'disciplina' => [
                    'id' => $value->disciplina->id,
                    'nome' => $value->disciplina->nome
                ]
            ];
        }
        return $retorno;
    }

    private function populateQuestoes($arr)
    {
        $retorno = [];
        foreach ($arr as $key => $value) {
            $retorno[$key] = [
                [
                    'id' => $value->id,
                    'texto' => $value->texto,
                    'banca' => $value->concurso->banca->nome,
                    'orgao' => $value->concurso->orgao->nome,
                    'cargo' => $value->cargo->nome,
                    'anoConcurso' => $value->concurso->ano,
                    'disciplina' => $value->disciplina->nome
                ]
            ];
            if ($value->questoesresposta) {
                foreach ($value->questoesresposta as $chave => $resposta) {
                    $retorno[$key]['questoes_resposta'][] = [
                        'id' => $resposta->id,
                        'questao_id' => $resposta->questao_id,
                        'enunciado' => $resposta->enunciado,
                        'correta' => $resposta->correta
                    ];
                }
            }
        }
        return $retorno;
    }

    private function populateFilterList($where)
    {
        $filter = [];
        foreach ($where as $key => $value) {
            foreach ($value as $k => $v) {
                if ($k !== "concurso_id") {
                    $filter[$k] = $v;
                }
            }
        }
        return $filter;
    }

    public function getDisciplinas(Request $request)
    {
        $re = [];
        $questao = [];
        if (!is_null($request->all()) && count($request->all()) > 0) {
            $concurso_id = isset($request->all()['concurso_id']) && !is_null($request->all()['concurso_id']) ? $request->all()['concurso_id'] : null;
            $cargo_id = isset($request->all()['cargo_id']) && !is_null($request->all()['cargo_id']) ? $request->all()['cargo_id'] : null;
            $nivel_questao = isset($request->all()['nivel_questao']) && !is_null($request->all()['nivel_questao']) ? $request->all()['nivel_questao'] : null;
            $where = [];
            if (!is_null($concurso_id)) {
                if (count($where) == 0) {
                    $where[] = ['concurso_id' => $concurso_id];
                } else {
                    array_push($where, [
                        'concurso_id' => $concurso_id,
                    ]);
                }
            }
            if (!is_null($nivel_questao)) {
                if (count($where) == 0) {
                    $where[] = ['tipo_questao' => $nivel_questao];
                } else {
                    array_push($where, [
                        'tipo_questao' => $nivel_questao
                    ]);
                }
            }
            if (!is_null($cargo_id)) {
                if (count($where) == 0) {
                    $where[] = ['cargo_id' => $cargo_id];
                } else {
                    array_push($where, [
                        'cargo_id' => $cargo_id
                    ]);
                }
            }
            $filter = $this->populateFilterList($where);
            $questao = Questao::where($filter)->orderBy('id', 'DESC')->get();
        } else {
            $questao = Questao::orderBy('id', 'DESC')->get();
        }

        $re = $this->populateDisciplinas($questao);
        $retorno = [
            'filtroDisciplinas' => $re
        ];
        return response()->json($retorno);

    }

    public function getBancas()
    {
        $this->bancasList = Banca::orderBy('id', 'DESC')->get();
        $re = [];
        foreach ($this->bancasList as $key => $value) {
            $re[$key] = [
                "banca" => [
                    "id" => $value['id'],
                    "nome" => $value['nome']
                ]
            ];
            if ($value->concursos) {
                foreach ($value->concursos as $k => $concurso) {
                    $re[$key]["orgao"][] = [
                        "id" => $concurso->orgao->id,
                        "nome" => $concurso->orgao->nome
                    ];
                }
            }
        }
        $retorno = [
            'filtroBancas' => $re
        ];
        return response()->json($re);
    }

    public function getCargos(Request $request)
    {
        $orgao_id = $request->all()['orgao_id'];
        $concurso = Concurso::where('orgao_id', $orgao_id)->orderBy('id', 'DESC')->get();
        $re = [];
        foreach ($concurso as $key => $value) {
            if ($value->questoes) {
                foreach ($value->questoes as $k => $v) {
                    $re[] = [
                        "cargos" => [
                            "id" => $v->cargo->id,
                            "nome" => $v->cargo->nome
                        ]
                    ];
                }
            }
        }
        $retorno = [
            'filtroCargos' => $re
        ];
        return response()->json($retorno);
    }

    public function getConcursos(Request $request)
    {
        $cargo_id = $request->all()['cargo_id'];
        $questao = Questao::where('cargo_id', $cargo_id)->orderBy('id', 'DESC')->get();
        $re = [];
        foreach ($questao as $key => $value) {
            $re[] = [
                "concurso" => [
                    "id" => $value->concurso->id,
                    "ano" => $value->concurso->ano
                ]
            ];
        }
        $retorno = [
            'filtroConcursos' => $re
        ];
        return response()->json($retorno);
    }

    public function getAssunto()
    {

    }


}