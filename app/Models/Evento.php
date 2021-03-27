<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evento extends Model
{
    protected $table = 'evento';

    public function inserirCorredorNoEvento($id_prova, $id_corredor)
    {
        DB::table($this->table)
            ->insert(array(
                'id_prova'    => $id_prova,
                'id_corredor' => $id_corredor
            ));

    }

    public function listaCorredorNoEvento($id_prova,$id_corredor)
    {
        return DB::table($this->table)
            ->where('id_prova', '=', $id_prova)
            ->where('id_corredor', '=', $id_corredor)
            ->get();
    }

    public function buscarCorredorNasProvas($provas, $id_corredor)
    {
        for ($i=0; $i < count($provas); $i++) {
            $bool = $this->listaCorredorNoEvento($provas[$i]->id_prova, $id_corredor);
            if ($bool != null && count($bool) > 0){
                return true;
            }
        }

        return false;
//        dd($provas, $id_corredor);
    }

    public function atualizarEvento($id_evento, $hora_inicio, $hora_fim, $tempo_gasto)
    {
        DB::table($this->table)
            ->where('id_evento', '=', $id_evento)
            ->update(['hora_inicio' => $hora_inicio, 'hora_fim' => $hora_fim, 'tempo_gasto' => $tempo_gasto]);
    }

    public function buscarResultadoEventoIdade($id_prova)
    {
        $arr = array();

        $grupo_1 = ['18', '19', '20', '21', '22', '23', '24', '25'];
        $grupo_2 = ['26', '27', '28', '29', '30', '31', '32', '33', '34', '35'];
        $grupo_3 = ['36', '37', '38', '39', '40', '41', '42', '43', '44', '45'];
        $grupo_4 = ['46', '47', '48', '49', '50', '51', '52', '53', '54', '55'];
        $grupo_5 = ['56'];


        $arr['18 - 25'] = $this->buscarResultadoEventoIdadeGrupo($id_prova, $grupo_1);
        $arr['25 - 35'] = $this->buscarResultadoEventoIdadeGrupo($id_prova, $grupo_2);
        $arr['35 - 45'] = $this->buscarResultadoEventoIdadeGrupo($id_prova, $grupo_3);
        $arr['45 - 55'] = $this->buscarResultadoEventoIdadeGrupo($id_prova, $grupo_4);
        $arr['Acima de 55'] = $this->buscarResultadoEventoIdadeAcima($id_prova);

        return $arr;
    }

    public function buscarResultadoEvento($id_prova)
    {
        $dados = DB::table($this->table)
            ->join('prova', 'evento.id_prova', '=', 'prova.id_prova')
            ->join('corredor', 'evento.id_corredor', '=', 'corredor.id_corredor')
            ->select('prova.id_prova', 'prova.tipo_prova', 'corredor.id_corredor', 'corredor.idade_corredor', 'corredor.nome_corredor', )
            ->where('prova.id_prova', '=', $id_prova)
            ->orderBy('evento.tempo_gasto', 'asc')
            ->get();

        $posicao = 1;

        for ($i=0; $i<count($dados); $i++) {
            $dados[0]->posicao = $posicao;
            $posicao += 1;
        }

        return $dados;
    }

    public function buscarResultadoEventoIdadeGrupo($id_prova, $grupo)
    {
        $dados = DB::table($this->table)
            ->join('prova', 'evento.id_prova', '=', 'prova.id_prova')
            ->join('corredor', 'evento.id_corredor', '=', 'corredor.id_corredor')
            ->select('prova.id_prova', 'prova.tipo_prova', 'corredor.id_corredor', 'corredor.idade_corredor', 'corredor.nome_corredor', )
            ->where('prova.id_prova', '=', $id_prova)
            ->whereIn('corredor.idade_corredor', $grupo)
            ->orderBy('evento.tempo_gasto', 'asc')
            ->get();

        $posicao = 1;

        for ($i=0; $i<count($dados); $i++) {
            $dados[0]->posicao = $posicao;
            $posicao += 1;
        }

        return $dados;
    }

    public function buscarResultadoEventoIdadeAcima($id_prova)
    {
        $dados = DB::table($this->table)
            ->join('prova', 'evento.id_prova', '=', 'prova.id_prova')
            ->join('corredor', 'evento.id_corredor', '=', 'corredor.id_corredor')
            ->select('prova.id_prova', 'prova.tipo_prova', 'corredor.id_corredor', 'corredor.idade_corredor', 'corredor.nome_corredor', )
            ->where('corredor.idade_corredor', '>', 55)
            ->orderBy('evento.tempo_gasto', 'asc')
            ->get();

        $posicao = 1;

        for ($i=0; $i<count($dados); $i++) {
            $dados[0]->posicao = $posicao;
            $posicao += 1;
        }

        return $dados;
    }
}
