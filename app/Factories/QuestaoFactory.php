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
                'id' => isset($questao->id) ? $questao->id : "",
                'disciplina_id' => $questao->disciplina_id,
                'cargo_id' => $questao->cargo_id,
                'concurso_id' => $questao->concurso_id,
                'assunto_id' => $questao->assunto_id,
                'prova_id' => $questao->prova_id,
                'multipla_escolha' => $questao->multipla_escolha,
                'tipo_questao' => $questao->tipo_questao,
                'texto' => $questao->texto,
                'texto_auxiliar' => $questao->texto_auxiliar,
            ];
            if ($questao->questoesresposta) {
                foreach ($questao->questoesresposta as $key => $value) {

                    $converted['respostas'][] = [
                        'id' => is_object($value) && isset($value->id) ? $value->id : "",
                        'questao_id' => isset($value->questao_id) ? $value->questao_id : "",
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
                'assunto_id' => $questao->assunto_id,
                'prova_id' => $questao->prova_id,
                'texto' => $questao->texto,
                'texto_auxiliar' => $questao->texto_auxiliar
            ];

            if ($questao->questoesresposta) {
                foreach ($questao->questoesresposta as $key => $value) {
                    $converted['respostas'][] = [
                        'id' => isset($value->id)  ? $value->id : "",
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
                    'texto' => strip_tags(nl2br($value->texto)),
                    'texto_auxiliar' => $value->texto_auxiliar,
                    'concurso' => ConcursoFactory::convert($value->concurso),
                    'disciplina' => DisciplinaFactory::convert($value->disciplina),
                    'cargo' => CargoFactory::convert($value->cargo),
                    'prova' => $value->prova,
                    'assunto' => $value->assunto,
                    'concurso_id' => $value->concurso_id,
                    'disciplina_id' => $value->disciplina_id,
                    'assunto_id' => $value->assunto_id,
                    'prova_id' => $value->prova_id,
                    'multipla_escolha' => $value->multipla_escolha,
                    'tipo_questao' => $value->tipo_questao,
                    'cargo_id' => $value->cargo_id,
                ];
            }
        }
        return $converted;
    }
    public static function convertQuestaoToUpdate($object, $array){
        if(isset($object) && isset($array)){
            $object->texto = $array->texto;
            $object->texto_auxiliar = $array->texto_auxiliar;
            $object->concurso_id = $array->concurso_id;
            $object->disciplina_id = $array->disciplina_id;
            $object->assunto_id = $array->assunto_id;
            $object->prova_id = $array->prova_id;

            $object->multipla_escolha = $array->multipla_escolha;
            $object->tipo_questao = $array->tipo_questao;
            $object->cargo_id = $array->cargo_id;

        }
    }
    public static function convertQuestaoRespostaToUpdate($object, $array){
        if(isset($object) && isset($array)){
            $object->enunciado = $array->enunciado;
            $object->correta = $array->correta;
            $object->questao_id = $array->questao_id;
        }
    }
}