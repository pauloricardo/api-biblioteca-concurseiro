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
        $where = [];
        $countQuestoes = 0;
        if(isset($data['filtroConcurso'])){
            $where = ['concurso_id'=>$data['filtroConcurso']];
        }
        if(isset($data['filtroDisciplina'])){
            $where = ['disciplina_id'=>$data['filtroDisciplina']];
        }
        if(isset($data['filtroTipoQuestao'])){
            $where = ['tipo_questao' => $data['filtroTipoQuestao']];
        }
        if(isset($data['filtroMultiplaEscolha'])){
            $where = ['multipla_escolha'=>$data['filtroMultiplaEscolha']];
        }

        if (!isset($data['skip']) && !isset($data['top'])) {
            $this->questoesList = QuestaoFactory::convertQuestaoList(Questao::all());
            $countQuestoes = count($this->questoesList);
        } else if(isset($data['skip']) && isset($data['top']) && count($where) > 0){
            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::where($where)->limit($data['top'])->offset($data['skip'])->orderBy('id', 'DESC')->get()
            );
            $countQuestoes = count($this->questoesList);
        }else{
            $this->questoesList = QuestaoFactory::convertQuestaoList(
                Questao::limit($data['top'])->offset($data['skip'])->orderBy('id', 'DESC')->get()
            );
            $countQuestoes = count(Questao::all());
        }
        $retorno = [
            'X-Total-Rows' => $countQuestoes,
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
        QuestaoFactory::convertQuestaoToUpdate($questao, $data);
        $saveQuestao = $questao->save();
        foreach ($data->questoesresposta as $key => $value) {
            $questaoresposta = QuestaoResposta::find($value->id);
            QuestaoFactory::convertQuestaoRespostaToUpdate($questaoresposta, $value);
            $questaoresposta->save();
        }
        return response()->json($questao);
    }
}