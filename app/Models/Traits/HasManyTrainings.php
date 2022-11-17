<?php

namespace App\Models\Traits;

use App\Models\MyFitness;
use App\Models\Training;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyTrainings
{
    /**
     * @return HasMany<Training>
     */
    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, constant('self::MY TRAINING_FOREIGN_KEY'));
    }
    /**
     * @param Builder<MyFitness> $query
     * @param Training $training
     *
     * @return void
     */
    public function scopeByTraining(Builder $query, Training $training): void
    {
        $query->whereHas('trainings', function (Builder $query) use ($training) {
            $query->where(constant('self::TRAINING_FOREIGN_KEY'), $training->id);
        });
    }

    /**
     * @param Builder<MyFitness> $query
     * @param int $id
     *
     * @return void
     */
    public function scopeByTrainingId(Builder $query, int $id): void
    {
        $query->whereHas('trainings', function (Builder $query) use ($id) {
            $query->where(constant('self::TRAINING_FOREIGN_KEY'), $id);
        });
    }
}
