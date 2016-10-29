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

    public function uploadQuestaoFile(Request $request){

        $uploadFolder = 'img/questoes';
        $file = $request->file('file');
        $fileName = base64_encode($request->file('file')->getClientOriginalName() . date("YYYYmmddHHmmss")) . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move('img/questoes', $fileName);
        $retorno = [
            'imagem' => $uploadFolder . '/' . $fileName
        ];
        return response()->json($retorno);

    }
    public function index(Request $request)
    {
        $data = array();
        $data = $request->all();
        if (!isset($data['skip']) && !isset($data['top'])) {
            $this->questoesList = QuestaoFactory::convertQuestaoList(Questao::all());
        } else if (isset($data['skip']) && isset($data['top']) &&
            isset($data['filtroConcurso'])) {
            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::where('concurso_id', $data['filtroConcurso'])->limit($data['top'])->offset($data['skip'])->orderBy('id', 'DESC')->get()
            );

        } else if (isset($data['skip']) && isset($data['top']) && isset($data['filtroDisciplina'])) {

            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::where('disciplina_id', $data['filtroDisciplina'])
                    ->limit($data['top'])->offset($data['skip'])->orderBy('id', 'DESC')->get()
            );

        } else if (isset($data['skip']) && isset($data['top']) && isset($data['filtroConcurso']) && isset($data['filtroDisciplina'])) {
            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::where([
                    ['concurso_id', $data['filtroConcurso']],
                    ['disciplina_id', $data['filtroDisciplina']]
                ])->limit($data['top'])->offset($data['skip'])->orderBy('id', 'DESC')->get()
            );
        } else if (!isset($data['skip']) && !isset($data['top']) && isset($data['filtroConcurso']) && isset($data['filtroDisciplina'])) {
            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::where([
                    ['concurso_id', $data['filtroConcurso']],
                    ['disciplina_id', $data['filtroDisciplina']]
                ])->orderBy('id', 'DESC')->get()
            );
        } else {
            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::limit($data['top'])->offset($data['skip'])->orderBy('id', 'DESC')->get()
            );
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
        if ($questao) {
            foreach ($data['respostas'] as $key => $value) {
                $questaoresposta = [
                    'enunciado' => $value['enunciado'],
                    'correta' => $value['correta'],
                    'questao_id' => $questao['id'],
                    'disciplina_id' => $questao['disciplina_id']
                ];
                $questaorespostaSave = QuestaoResposta::create($questaoresposta);

            }

        }
        return response()->json($questao);
    }

    public function trash($id)
    {
        $questao = Questao::find($id);
        foreach ($questao->questoesresposta as $key => $value) {
            $questoesresposta = QuestaoResposta::find($value->id);
            $questoesresposta->delete();
        }
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
        $questao->multipla_escolha = $data['multipla_escolha'];
        $questao->tipo_questao = $data['tipo_questao'];
        $questao->cargo_id = $data['cargo_id'];
        //$questao->questoesresposta = $data['respostas'];


        $saveQuestao = $questao->save();
        foreach ($data['respostas'] as $key => $value) {
            $questaoresposta = QuestaoResposta::find($value['id']);

            if ($questaoresposta) {
                $questaoresposta->enunciado = $value['enunciado'];
                $questaoresposta->correta = $value['correta'];
                $questaoresposta->questao_id = $value['questao_id'];
                $questaoresposta->disciplina_id = 100;
                $questaoresposta->save();
            } else {
                $value['disciplina_id'] = 100;
                $q = QuestaoResposta::create($value);
            }
        }
        return response()->json($questao);
    }
}