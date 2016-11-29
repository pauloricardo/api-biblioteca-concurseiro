<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 21:09
 */

namespace BibliotecaConcurseiro\Http\Controllers;
use BibliotecaConcurseiro\Auth\User;
use BibliotecaConcurseiro\Factories\Usuario;
use BibliotecaConcurseiro\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UsuariosController extends Controller
{
    protected $usuariosList;

    public function index($skip=null, $top=null){
        $total = 0;
        if(is_null($skip) && is_null($top)){
            $total = Usuario::all();
            $this->usuariosList = UsuarioFactory::convertList(Usuario::all());
        }else{
            $this->usuariosList = UsuarioFactory::convertList(Usuario::limit($top)->offset($skip)->orderBy('id','DESC')->get());
            $total = count($this->assuntosList);
        }

        $retorno = [
          'X-Total-Rows' => $total,
          'usuarios' => $this->usuariosList
        ];

        return response()->json($retorno);
    }

    public function getUsuario($id){
        $usuario = Usuario::find($id);

        return response()->json($usuario);
    }

    public function save(Request $request){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $data = UsuarioFactory::convertBack($data);
        $usuario = Usuario::create($data);

        return response()->json($usuario);
    }

    public function deleta($id){
        $usuario = Usuario::find($id);
        $usuario->delete();

        return response()->json('deleted');

    }
    public function update(Request $request, $id){

        $usuario = Usuario::find($id);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        UsuarioFactory::convertObject($usuario, $data);
        $usuario->save();

        return response()->json($usuario);
    }
}