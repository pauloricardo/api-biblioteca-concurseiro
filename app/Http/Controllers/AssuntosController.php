<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Entities\Assunto;
use BibliotecaConcurseiro\Entities\Disciplina;
use BibliotecaConcurseiro\Factories\AssuntoFactory;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AssuntosController extends Controller
{
    protected $assuntosList;

    public function index($skip=null, $top=null){
        $total = 0;
        if(is_null($skip) && is_null($top)){
            $total = Assunto::all();
            $this->assuntosList = AssuntoFactory::convertList(Assunto::all());
        }else{
            $this->assuntosList = AssuntoFactory::convertList(Assunto::limit($top)->offset($skip)->orderBy('id','DESC')->get());
            $total = count($this->assuntosList);
        }

        $retorno = [
          'X-Total-Rows' => $total,
          'assuntos' => $this->assuntosList
        ];

        return response()->json($retorno);
    }

    public function getAssunto($id){
        $assunto = Assunto::find($id);

        return response()->json($assunto);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = AssuntoFactory::convertBack($data);
        $assunto = Assunto::create($data);

        return response()->json($assunto);
    }

    public function deleta($id){
        $assunto = Assunto::find($id);
        $assunto->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $assunto = Assunto::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        AssuntoFactory::convertObject($assunto, $data);
        $assunto->save();

        return response()->json($assunto);
    }
}