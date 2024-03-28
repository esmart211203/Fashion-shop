<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class order extends Model
{
    use HasFactory;
    const STATUS_PROCESSING = 'Processing';
    const STATUS_APPROVED = 'Approved';
    const STATUS_FINISHED = 'Finished';
    protected $fillable = [
        'user_id',
        'total_amount',
        'price',
        'status',
        'receiver',
        'phone',
        'address',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
