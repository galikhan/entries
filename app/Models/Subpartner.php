<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subpartner extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'partner_id'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function partnerIDs()
    {
        return $this->hasMany(PartnerID::class);
    }

    // public static function boot() {
    //     parent::boot();
    //     static::deleting(function(Subpartner $subpartner) {
    //         $subpartner->partnerIDs()->delete();
    //     });
    // }
}
