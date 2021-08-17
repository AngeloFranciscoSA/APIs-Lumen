<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController{

    public function index()
    {
        return Series::all();
    }

    public function store(Request $req)
    {
        return response()->json(Series::create($req->all()), 201);
    }

    public function show(int $id)
    {
        $serie = Series::find($id);
        if(is_null($serie)){
            return response()->json('', 204);
        }

        return response()->json($serie, 200);
    }

    public function update(int $id, Request $req)
    {
        $serie = Series::find($id);
        if (is_null($serie)) {
            return response()->json(['status' => 'error', 'feedback' => 'Recurso não encontrado'], 404);
        }

        //TODO Método fill
        //! Vai apenas atualizar aquelas colunas que tiverem dentro do Model da variavel $fillable
        $serie->fill($req->all());
        $serie->save();
        return response()->json($serie, 200);
    }

    public function destroy(int $id){

        //TODO Método Destroy
        //! Este método vai tentar deletar todo e assim devolver o número de coisas que ele deletou.
        //! Caso seja apenas 1 dado, ele tem que retorna > 1
        $numbRemove = Series::destroy($id);
        if($numbRemove === 0){
            return response()->json(['status' => 'error', 'feedback' => 'Recurso não encontrado'], 404);
        }

        return response()->json('', 200);
    }
}
