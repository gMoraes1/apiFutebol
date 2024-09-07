<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Jogador;
class JogadorController extends Controller
{
    //construir o crud
    //mostrar todos os registros da tabela livros
    //crud -> Read(leitura) select/ visualizar
    public function index() {
        $regJogador = Jogador::All();
        $contador = $regJogador->count();

        return 'Jogadores: '.$contador.$regJogador.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    //cadastrar registro
    //Crud -> Create(criar/cadastrar)
    public function show (string $id){
        $regJogador = Jogador::find($id);

        if($regJogador){
            return 'Jogadores localizados '.$regJogador.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Jogadores localizados '.$regJogador.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Alterar registro
    //Crud -> insere dados
    public function store(Request $request){
        $regJogador=$request->All();

        $regVerifq = Validator::make($regJogador,[
            'nome'=>'required',
            'idade'=>'required',
            'altura'=>'required'
        ]);

        if($regVerifq->fails()){
            return 'Registros Invalidos '.Response()->json([],Response::HTTP_NO_CONTENT);;
        }

        $regJogadorCad = Jogador::create($regJogador);

        if($regJogadorCad){
            return 'Jogador cadastrados '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
        else {
            'Registros Invalidos '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    //Alterar registros
    //Crud -> update(alterar)
    public function update(Request $request, string $id)
    {
    
    $regJogador = $request->all();

    $regVerifq = Validator::make($regJogador, [
        'nome' => 'required|string',
        'idade' => 'required|integer',
        'altura' => 'required|numeric'
    ]);

    if ($regVerifq->fails()) {
        return response()->json([
            'errors' => $regVerifq->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $regJogadorBanco = Jogador::find($id);

    if (!$regJogadorBanco) {
        return response()->json([
            'message' => 'Jogador não encontrado'
        ], Response::HTTP_NOT_FOUND);
    }

    $regJogadorBanco->nome = $regJogador['nome'];
    $regJogadorBanco->idade = $regJogador['idade'];
    $regJogadorBanco->altura = $regJogador['altura'];

    if ($regJogadorBanco->save()) {
        return response()->json([
            'message' => 'Jogador atualizado com sucesso'
        ], Response::HTTP_OK);
    } else {
        return response()->json([
            'message' => 'Erro: Jogador não atualizado'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    //Deletar os registros
    //Crud -> delete(apagar)
    public function destroy (string $id){
        $regJogador = Jogador::find($id);

        if($regJogador->delete()) {

            return "o jogador foi deletado com sucesso".Response()->json([],Response::HTTP_NO_CONTENT);
        }

        return "algo deu errado, o jogador não foi deletado".Response()->json([],Response::HTTP_NO_CONTENT);
    }
}
