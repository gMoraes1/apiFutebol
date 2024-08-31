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
    //Crud ->
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
        $regJogador = $request->All();

        $regVerifq = Validator::make($regJogador,[
            'nome' => 'required',
            'idade' => 'required',
            'altura' => 'required'
        ]);
        if($regVerifq->fails()){
            return 'registros não atualizados: '.Response()->json([],Response::HTTP_NO_CONTENT);
        }

        $regJogadorBanco = Jogador::find($id);
        $regJogadorBanco->nome = $regJogador['nome'];
        $regJogadorBanco->idade = $regJogador['idade'];
        $regJogadorBanco->altura = $regJogador['altura'];

        $retorno = $regJogadorBanco->save();

        if($retorno) {
            return "Jogador atualizado com sucesso.".Response()->json([],Response::HTTP_NO_CONTENT);

        } else {
            return "atenção... Erro: Jogador não atualizado".Response()->json([],Response::HTTP_NO_CONTENT);
        }

    }

    //Deletar os registros
    //Crud -> delete(apagar)
    public function destroy (string $id){
        $regJogador = tbllivros::find($id);

        if($regJogador->delete()) {

            return "o jogador foi deletado com sucesso".Response()->json([],Response::HTTP_NO_CONTENT);
        }

        return "algo deu errado, o jogador não foi deletado".Response()->json([],Response::HTTP_NO_CONTENT);
    }
}
