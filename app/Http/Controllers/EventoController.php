<?php

namespace App\Http\Controllers;

use App\Models\Corredor;
use App\Models\Evento;
use App\Models\Prova;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function create(Request $request)
    {
        $model_evento = new Evento();
        $model_prova = new Prova();
        $model_corredor = new Corredor();

        $id_prova = $request->header('prova');
        $id_corredor = $request->header('corredor');

        if ($id_prova != '' && $id_corredor != ''){
            $prova = $model_prova->buscaProvaPeloId($id_prova);

            if ($prova) {
                $corredor = $model_corredor->buscaCorredorPeloId($id_corredor);
                if ($corredor) {
                    $provas = $model_prova->buscaProvasNaData($prova[0]->data_prova);
                    $existe_no_evento = $model_evento->buscarCorredorNasProvas($provas, $id_corredor);
                    if ($existe_no_evento == false) {
                        $model_evento->inserirCorredorNoEvento($id_prova, $id_corredor);
                        return response()->json($model_evento->listaCorredorNoEvento($id_prova, $id_corredor));
                    } else {
                        return response()->json(['mensagem' => 'corredor ja cadastrado nessa data']);
                    }
                } else {
                    return response()->json(['mensagem' => 'o corredor informado nao existe']);
                }
            } else {
                return response()->json(['mensagem' => 'a prova informada nao existe']);
            }
        } else {
            return response()->json(['mensagem' => 'algum item obrigatorio nao foi preenchido']);
        }
    }

    public function update(Request $request)
    {
        $id_evento = $request->header('id_evento');
        $hora_inicio = $request->header('hora_inicio');
        $hora_fim = $request->header('hora_fim');

        if ($id_evento != '' && $hora_inicio != '' && $hora_fim != ''){
            $tempo_gasto = strtotime($hora_fim) - strtotime($hora_inicio);
            $model = new Evento();
            $model->atualizarEvento($id_evento, $hora_inicio, $hora_fim, $tempo_gasto);
            return response()->json(['mensagem' => 'tempo cadastrado']);

        } else {
            return response()->json(['mensagem' => 'algum item obrigatorio nao foi preenchido']);
        }
    }

    public function idade(Request $request)
    {
        $model_prova = new Prova();
        $provas = $model_prova->todasProvas();

        $resultado = array();

        for ($i=0; $i<count($provas);$i++){
            $tipo = $provas[$i]->tipo_prova.'KM';
            $model = new Evento();
            $resultado[$tipo] = $model->buscarResultadoEventoIdade($provas[$i]->id_prova);

        }

        return $resultado;

    }

    public function geral(Request $request)
    {
        $model_prova = new Prova();
        $provas = $model_prova->todasProvas();

        $resultado = array();

        for ($i=0; $i<count($provas);$i++){
            $tipo = $provas[$i]->tipo_prova.'KM';
            $model = new Evento();
            $resultado[$tipo] = $model->buscarResultadoEvento($provas[$i]->id_prova);

        }

        return $resultado;
    }
}
