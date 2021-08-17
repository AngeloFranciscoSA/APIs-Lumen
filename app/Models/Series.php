<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];
    protected $appends = ['links'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => 'series/'. $this->id,
            'episodios' => '/series/'. $this->id . '/episodios'
        ];
    }
}
