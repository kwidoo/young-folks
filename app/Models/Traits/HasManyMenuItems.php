<?php

namespace App\Models\Traits;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyMenuItems
{
    /**
     * @return HasMany<MenuItem>
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
