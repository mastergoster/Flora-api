<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paid_amount',
        'price',
        'user_id',
        'issued_at',
        'invoice_number',
        'is_editable',
        'stripe_id',
    ];

    /**
     * The attributes that should be appended to the model.
     *
     * @var array
     */
    protected $append = ['is_paid'];

     /**
     * Get the user that owns the invoice.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the invoice lines for the invoice.
     */
    public function invoiceLines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }

    /**
     * Get the paid status of the invoice.
     *
     * @return Attribute
     */
    public function isPaid(): Attribute
    {
        return new Attribute(get: fn() => $this->paid_amount == $this->price);
    }

    /**
     * Scope a query to only include non-editable invoices.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNonEditable(Builder $query): Builder
    {
        return $query->where('is_editable', '=', false);
    }

    /**
     * Scope a query to only include non-editable invoices.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEditable(Builder $query): Builder
    {
        return $query->where('is_editable', '=', true);
    }
}
