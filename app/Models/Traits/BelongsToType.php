<?php

namespace App\Models\Traits;

use App\Models\MenuItem;
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToType
{
    /**
     * @return BelongsTo<Type, MenuItem>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
