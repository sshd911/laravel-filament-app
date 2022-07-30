<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'blog_id',
        'comment_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function trader() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
