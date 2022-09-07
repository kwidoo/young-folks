<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YFEvent extends Model
{
    use HasFactory;

    public function event_type()
    {
        return $this->belongsToMany(YFEventType::class);
    }

    public function event_schedule()
    {
        return $this->hasMany(YFEventSchedule::class);
    }
}
