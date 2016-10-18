<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;

use BibliotecaConcurseiro\Entities\Questao;
use BibliotecaConcurseiro\Entities\QuestaoResposta;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use BibliotecaConcurseiro\Factories\QuestaoFactory;
use Illuminate\Http\Request;


class QuestoesController extends Controller
{
    protected $questoesList;

    public function index($skip = null, $top = null)
    {

        if (is_null($skip) && is_null($top)) {
            $this->questoesList = QuestaoFactory::convertQuestaoList(Questao::all());
        } else {
            $this->questoesList = QuestaoFactory::convertQuestaoList(Questao::limit($top)->offset($skip)->orderBy('id', 'DESC')->get());
        }
        $retorno = [
            'X-Total-Rows' => count(Questao::all()),
            'questoes' => $this->questoesList
        ];

        return response()->json($retorno);
    }

    public function getQuestao($id)
    {

        $questao = QuestaoFactory::convertQuestaoToArray(Questao::find($id));
        return response()->json($questao);
    }

    public function save(Request $request)
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = QuestaoFactory::convertQuestaoToArray($data);

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
        $data = QuestaoFactory::convertQuestaoToArray($data);

        $questao->texto = $data['texto'];
        $questao->concurso_id = $data['concurso_id'];
        $questao->disciplina_id = $data['disciplina_id'];
        $questao->cargo_id = $data['cargo_id'];
        //$questao->questoesresposta = $data['respostas'];



        $saveQuestao = $questao->save();
            foreach($data['respostas'] as $key => $value){
                $questaoresposta = QuestaoResposta::find($value['id']);

                if($questaoresposta){
                    $questaoresposta->enunciado = $value['enunciado'];
                    $questaoresposta->correta = $value['correta'];
                    $questaoresposta->questao_id = $value['questao_id'];
                    $questaoresposta->disciplina_id = 100;
                    $questaoresposta->save();
                }else{
                    $value['disciplina_id'] = 100;
                    $q = QuestaoResposta::create($value);
                }
            }
            $questao->questoesresposta()->save($data['respostas']);
        return response()->json($questao);
    }
}