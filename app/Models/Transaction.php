<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'status',
        'number',
        'total',
        'course',
        'snap_token',
        'payment_method',
        'payment_status',
        'pending_at',
        'expired_at',
        'failed_at',
        'success_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'admin_id' => 'integer',
        'course' => 'array',
        'pending_at' => 'datetime',
        'expired_at' => 'datetime',
        'failed_at' => 'datetime',
        'success_at' => 'datetime',
    ];

    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
