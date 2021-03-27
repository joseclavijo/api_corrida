<?php

namespace App\Http\Controllers;

use App\Models\Corredor;
use Illuminate\Http\Request;

class CorredorController extends Controller
{
    public function index()
    {
        $model = new Corredor();

        $dados = $model->todosCorredores();

        return response()->json($dados);
    }

    public function create(Request $request)
    {
        $model = new Corredor();

        $nome_corredor = $request->header('nome');

        $cpf_corredor = $request->header('cpf');

        $data_nascimento_corredor = $request->header('data_nascimento');

        $idade = $this->verificaIdade($data_nascimento_corredor);

        $dados = $model->buscaCorredor($cpf_corredor);

        if ($dados == null) {
            if ($idade > 18) {
                if ($nome_corredor != '' && $cpf_corredor != '' && $data_nascimento_corredor != '' && $idade != '') {

                    $model->insereCorredor($nome_corredor, $cpf_corredor, $data_nascimento_corredor, $idade);

                    return response()->json($model->buscaCorredor($cpf_corredor));
                } else {
                    return response()->json(['mensagem' => 'algum item obrigatorio nao foi preenchido']);
                }
            } else {
                return response()->json(['mensagem' => 'nao cadastramos menores de idade']);
            }
        } else {
            return response()->json(['mensagem' => 'corredor já cadastrado']);
        }
    }

    public function verificaIdade($data_nascimento)
    {
        list($ano, $mes, $dia) = explode('-', $data_nascimento);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        return $idade;
    }
}
