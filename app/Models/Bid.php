<?php

namespace App\Models;

use App\Utilities\TimeRemainingUtility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'user_id', 'lot_id', 'bid_time'];

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBiddedTime()
    {
        return $this->created_at->format('H:i d/m/Y');
    }
}
