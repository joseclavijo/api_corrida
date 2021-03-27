<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prova extends Model
{
    protected $table = 'prova';

    public function todasProvas()
    {
        $dados = DB::table($this->table)->get();

        return $dados;
    }

    public function inserirProva($tipo_prova, $data_prova)
    {
        DB::table($this->table)
            ->insert(array(
                'tipo_prova' => $tipo_prova,
                'data_prova' => $data_prova,
            ));
    }

    public function buscaProvaPeloId($id_prova){
        $dados = DB::table($this->table)
            ->where('id_prova', '=', $id_prova)
            ->get();

        return $dados;
    }

    public function buscaProvasNaData($data_prova)
    {
        return DB::table($this->table)
            ->where('data_prova', '=', $data_prova)
            ->get();
    }
}
