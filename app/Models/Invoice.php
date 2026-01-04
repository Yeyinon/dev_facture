<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'factures';

    protected $fillable = [
        'client_id',
        'devis_id',
        'num_facture',
        'issue_date',
        'due_date',
        'subtotal',
        'tax',
        'total',
        'status',
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'devis_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'facture_id');
    }
}
