<?php

namespace App\Http\Controllers;

use App\Models\Prova;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function index()
    {
        $model = new Prova();

        $dados = $model->todasProvas();

        return response()->json($dados);
    }

    public function create(Request $request)
    {
        $model = new Prova();

        $tipo_prova = $request->header('tipo');
        $data_prova = $request->header('data');

        if ($tipo_prova != '' && $data_prova != '') {
            $model->inserirProva($tipo_prova, $data_prova);
            return response()->json(['mensagem' => 'prova cadastrada']);
        } else {
            return response()->json(['mensagem' => 'algum item obrigatorio nao foi preenchido']);
        }
    }
}
