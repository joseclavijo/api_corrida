<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Corredor extends Model
{
    protected $table = 'corredor';

    public function todosCorredores()
    {
        $dados = DB::table($this->table)->get();

        return $dados;
    }

    public function buscaCorredor($cpf)
    {
        $dados = DB::table($this->table)
            ->where('cpf_corredor', '=', $cpf)
            ->first();

        return $dados;
    }

    public function insereCorredor($nome, $cpf, $data_nascimento, $idade)
    {
        DB::table($this->table)
            ->insert(array(
                'nome_corredor'            => $nome,
                'cpf_corredor'             => $cpf,
                'data_nascimento_corredor' => $data_nascimento,
                'idade_corredor'           => $idade,
            ));

    }

    public function buscaCorredorPeloId($id_corredor)
    {
        return DB::table($this->table)
                    ->where('id_corredor', '=', $id_corredor)
                    ->get();
    }
}
