<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{

    protected $classe;

    public function index()
    {
        return $this->classe::all();
    }

    public function store(Request $req)
    {
        return response()->json($this->classe::create($req->all()), 201);
    }

    public function show(int $id)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json('', 204);
        }

        return response()->json($recurso, 200);
    }

    public function update(int $id, Request $req)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json(['status' => 'error', 'feedback' => 'Recurso não encontrado'], 404);
        }

        //TODO Método fill
        //! Vai apenas atualizar aquelas colunas que tiverem dentro do Model da variavel $fillable
        $recurso->fill($req->all());
        $recurso->save();
        return response()->json($recurso, 200);
    }

    public function destroy(int $id)
    {

        //TODO Método Destroy
        //! Este método vai tentar deletar todo e assim devolver o número de coisas que ele deletou.
        //! Caso seja apenas 1 dado, ele tem que retorna > 1
        $numbRemove = $this->classe::destroy($id);
        if ($numbRemove === 0) {
            return response()->json(['status' => 'error', 'feedback' => 'Recurso não encontrado'], 404);
        }

        return response()->json('', 200);
    }
}
