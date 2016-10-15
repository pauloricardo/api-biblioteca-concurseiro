<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Orgao;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrgaosController extends Controller
{
    protected $orgaosList;

    public function index($skip=null, $top=null){
        if(is_null($skip) && is_null($top)){
            $this->orgaosList = Orgao::all();
        }else{
            $this->orgaosList = Orgao::limit($top)->offset($skip)->orderBy('id','DESC')->get();
        }

        $retorno = [
          'X-Total-Rows' => count(Orgao::all()),
          'orgaos' => $this->orgaosList
        ];

        return response()->json($retorno);
    }

    public function getOrgao($id){
        $orgao = Orgao::find($id);

        return response()->json($orgao);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = [
            'nome' => $data->nome
        ];
        $orgao = Orgao::create($data);

        return response()->json($orgao);
    }

    public function deleta($id){
        $orgao = Orgao::find($id);
        $orgao->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $orgao = Orgao::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);

        $orgao->nome = $data->nome;
        $orgao->save();

        return response()->json($orgao);
    }
}