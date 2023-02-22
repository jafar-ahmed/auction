<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

class Lot extends Model
{
    use HasFactory, Sluggable;

    protected $dates = [
        'dt_end',
    ];

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'img',
        'price',
        'step',
        'dt_end',
        'user_id',
        'active',
    ];

    /**
     * Get bidding price of lot
     *
     * @return int
     */
    public function getBidPrice(): int
    {
        // if ($this->bids->last()) {
        //     $lastPrice = $this->bids->last()->price + $this->step;
        // }

        $lastPrice = $this->getCurrentPrice() + $this->step;
        $priceToBid = $this->price + $this->step;
        return $lastPrice ?? $priceToBid;
    }

    /**
     * Get lot's price (or last bidded if exists)
     *
     * @return int
     */
    public function getCurrentPrice(): int
    {
        return $this->bids->last()->price ?? $this->price;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function isActive()
    {
        return $this->dt_end > Carbon::now();
    }

    /**
     * Get User model of winner if exists
     *
     * @return mixed
     */
    public function getWinner()
    {
        if (!$this->isActive()) {
            return $this->bids->last()->user;
        }

        return false;
    }

    public function getTimeRemaing()
    {
        $r =  $this->dt_end->diffForHumans(['syntax' => CarbonInterface::DIFF_ABSOLUTE], null, false, 1);

        if ($this->dt_end < $this->dt_end->now()) {
            $this->active = false;
            $this->save(); // maybe should queue??
            $r = false;
        }

        return $r;
    }

    public function scopeActiveLots($query)
    {
        return $query->where('active', true);
    }
}
