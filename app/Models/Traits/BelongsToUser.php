<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\MyFitness;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    /**
     * @return BelongsTo<User,MyFitness>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, constant('self::USER_FOREIGN_KEY'));
    }
    /**
     * @param Builder<MyFitness> $query
     * @param User $user
     *
     * @return void
     */
    public function scopeByUser(Builder $query, User $user): void
    {
        $query->where(constant('self::USER_FOREIGN_KEY'), $user->id);
    }

    /**
     * @param Builder<MyFitness> $query
     * @param int $id
     *
     * @return void
     */
    public function scopeByUserId(Builder $query, int $id): void
    {
        $query->where(constant('self::USER_FOREIGN_KEY'), $id);
    }
}
