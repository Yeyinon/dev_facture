<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'ligne_facture';

    protected $fillable = [
        'facture_id',
        'description',
        'quantite',
        'prix_unite',
        'total',
    ];

    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'facture_id');
    }
}
