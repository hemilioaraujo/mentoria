<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tutor;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';
    protected $fillable = ['nome', 'idade', 'tipo', 'raca', 'tutor_id'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}
