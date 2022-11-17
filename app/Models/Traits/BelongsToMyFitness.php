<?php

namespace App\Models\Traits;

use App\Models\MyFitness;
use App\Models\Training;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToMyFitness
{
    /**
     * @return BelongsTo<MyFitness,Training>
     */
    public function my_fitness(): BelongsTo
    {
        return $this->belongsTo(MyFitness::class, constant('self::MYFITNESS_FOREIGN_KEY'));
    }

    /**
     * @param Builder<Training> $query
     * @param MyFitness $myFitness
     *
     * @return void
     */
    public function scopeByMyFitness(Builder $query, MyFitness $myFitness): void
    {
        $query->where(constant('self::MYFITNESS_FOREIGN_KEY'), $myFitness->id);
    }

    /**
     * @param Builder<Training> $query
     * @param int $id
     *
     * @return void
     */
    public function scopeByMyFitnessId(Builder $query, int $id): void
    {
        $query->where(constant('self::MYFITNESS_FOREIGN_KEY'), $id);
    }
}
