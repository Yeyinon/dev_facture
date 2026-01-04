<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    use HasFactory;

    protected $table = 'ligne_devis';

    protected $fillable = [
        'devis_id',
        'description',
        'quantite',
        'prix_unite',
        'total',
    ];

    public $timestamps = false;

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'devis_id');
    }
}
