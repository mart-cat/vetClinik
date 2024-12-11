<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'specialization',
        'phone',
        'login',
        'password',
        'is_active',
        
    ];
  
    protected $dates = ['deleted_at'];

    public function dayoffs(): HasMany
    {
        return $this->hasMany(DayOff::class);
    }
}
