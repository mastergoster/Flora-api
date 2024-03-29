<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, HasUuids;

    //TODO ajouter paymentState
    //TODO ajouter relation avec User
    //TODO ajouter relation avec InvoiceLine
    //TODO ajouter relation avec Products
    //TODO ajouter scope pour récupérer les factures NON editable
}
