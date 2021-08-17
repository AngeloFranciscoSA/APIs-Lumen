<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{

    public $timestamps = false;
    protected $fillable = ['temporada', 'numero', 'assistido', 'serie_id'];
    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Series::class);
    }

    //TODO Acessors do Eloquent
    //! Toda vez que puxa um GET ou SET, você defini evento que ocorrem naquela variavel após o get ou set.
    public function getAssistidoAttribute($assistido): bool
    {
        return $assistido;
    }

    public function getLinksAttribute(): array
    {
        return [
            'episodios' => '/series/'. $this->serie_id
        ];
    }
}
