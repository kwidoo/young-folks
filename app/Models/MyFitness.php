<?php

namespace App\Models;

use App\Models\Traits\BelongsToUser;
use App\Models\Traits\HasManyTrainings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyFitness extends Model
{
    use HasFactory;
    use BelongsToUser;
    use HasManyTrainings;

    public const USER_FOREIGN_KEY = 'user_id';
    public const TRAINING_FOREIGN_KEY = 'my_fitness_id';

    protected $casts = [
        'password' => 'encrypted',
    ];
}
