<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 16/10/2016
 * Time: 11:58
 */
namespace BibliotecaConcurseiro\Factories;
use BibliotecaConcurseiro\Entities\Disciplina;

class QuestaoFactory
{

    public static function convertQuestaoToArray($questao)
    {
        $converted = [];
        if ($questao) {
            $converted = [
                'id' => $questao->id,
                'disciplina_id' => $questao->disciplina_id,
                'cargo_id' => $questao->cargo_id,
                'concurso_id' => $questao->concurso_id,
                'texto' => $questao->texto
            ];
            if ($questao->questoesresposta) {
                foreach ($questao->questoesresposta as $key => $value) {
                    $converted['respostas'][] = [
                        'id' => is_object($value) && isset($value->id) ? $value->id : "",
                        'questao_id' => is_object($value) ? $value->questao_id : $value['questao_id'],
                        'enunciado' => is_object($value) ? $value->enunciado : $value['enunciado'],
                        'correta' => is_object($value) ? $value->correta : $value['correta']
                    ];
                }
            }
        }
        return $converted;
    }

    public static function convertQuestaoToObject($questao)
    {
        $converted = [];
        if ($questao) {
            $converted = [
                'id' => $questao->id,
                'disciplina_id' => $questao->disciplina_id,
                'cargo_id' => $questao->cargo_id,
                'concurso_id' => $questao->concurso_id,
                'texto' => $questao->texto
            ];

            if ($questao->questoesresposta) {
                foreach ($questao->questoesresposta as $key => $value) {
                    $converted['respostas'][] = [
                        'id' => is_object($value) && $value->id ? $value->id : "",
                        'disciplina_id' => $value->disciplina_id,
                        'questao_id' => $value->questao_id,
                        'enunciado' => $value->enunciado,
                        'correta' => $value->correta
                    ];
                }
            }
        }
        return $converted;
    }
    public static function convertQuestaoList($questaoList)
    {
        $converted = [];

        if ($questaoList) {
            foreach ($questaoList as $key => $value) {
                $converted[] = [
                    'id' => $value->id,
                    'texto' => $value->texto,
                    'concurso' => ConcursoFactory::convert($value->concurso),
                    'disciplina' => DisciplinaFactory::convert($value->disciplina),
                    'cargo' => CargoFactory::convert($value->cargo),
                    'concurso_id' => $value->concurso_id,
                    'disciplina_id' => $value->disciplina_id,
                    'cargo_id' => $value->cargo_id,
                ];
            }
        }
        return $converted;
    }
}