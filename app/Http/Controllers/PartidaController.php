<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Partida;
class PartidaController extends Controller
{
    //construir o crud
    //mostrar todos os registros da tabela livros
    //crud -> Read(leitura) select/ visualizar
    public function index() {
        $regPartida = Partida::All();
        $contador = $regPartida->count();

        return 'Partidas: '.$contador.$regPartida.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    //cadastrar registro
    //Crud -> Create(criar/cadastrar)
    public function show (string $id){
        $regPartida = Partida::find($id);

        if($regPartida){
            return 'Partidas: localizadas '.$regPartida.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Partidas: localizadas '.$regPartida.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Alterar registro
    //Crud ->
    public function store(Request $request){
        $regPartida=$request->All();

        $regVerifq = Validator::make($regPartida,[
            'localPart'=>'required',
            'resultPart'=>'required',

        ]);

        if($regVerifq->fails()){
            return 'Registros das partidas Invalidos '.Response()->json([],Response::HTTP_NO_CONTENT);;
        }

        $regPartidaCad = Partida::create($regPartida);

        if($regPartidaCad){
            return 'Partida cadastrada '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
        else {
            'Partida não cadastrada  '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Alterar registros
    //Crud -> update(alterar)
    public function update(Request $request, string $id)
    {
        $regPartida = $request->All();

        $regVerifq = Validator::make($regPartida,[
            'localPart'=>'required',
            'resultPart'=>'required',
        ]);
        if($regVerifq->fails()){
            return 'registros não atualizados: '.Response()->json([],Response::HTTP_NO_CONTENT);
        }

        $regPartidaBanco = Partida::find($id);
        $regPartidaBanco->localPart = $regPartida['localPart'];
        $regPartidaBanco->resultPart = $regPartida['resultPart'];

        $retorno = $regPartidaBanco->save();

        if($retorno) {
            return "Partida atualizada com sucesso.".Response()->json([],Response::HTTP_NO_CONTENT);

        } else {
            return "atenção... Erro: Partida não atualizada".Response()->json([],Response::HTTP_NO_CONTENT);
        }

    }

    //Deletar os registros
    //Crud -> delete(apagar)
    public function destroy (string $id){
        $regPartida = Partida::find($id);

        if($regPartida->delete()) {

            return "A partida foi deletada com sucesso".Response()->json([],Response::HTTP_NO_CONTENT);
        }

        return "algo deu errado, a partida não foi deletado".Response()->json([],Response::HTTP_NO_CONTENT);
    }
}
