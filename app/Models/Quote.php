<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'devis';

    protected $fillable = [
        'num_devis',
        'client_id',
        'issue_date',
        'status',
        'subtotal',
        'tax',
        'total',
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class, 'devis_id');
    }
}
